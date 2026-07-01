<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendAdminOtpMail;
use App\Mail\AdminOtpMail;
use App\Models\AuditLog;
use App\Models\Category;
use App\Models\Dispute;
use App\Models\Payment;
use App\Models\Review;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct()
    {
        // Apply admin middleware to all methods EXCEPT login/authenticate and OTP flow
        $this->middleware('admin')->except([
            'login',
            'authenticate',
            'showLinkRequestForm',
            'sendResetLinkEmail',
            'showResetForm',
            'reset',
            'showOtpForm',
            'verifyOtp',
            'resendOtp',
        ]);
    }

    public function login()
    {
        $guard = Auth::guard('admin');
        if ($guard->check()) {
            $user = $guard->user();
            if (! $user instanceof User || ! $user->isAdmin()) {
                $guard->logout();
                request()->session()->invalidate();
                request()->session()->regenerateToken();

                return redirect()->route('admin.login');
            }

            if (! $this->twoFactorEnabled()) {
                request()->session()->put('admin_2fa_passed', true);
                request()->session()->put('admin_last_activity_at', now()->timestamp);

                return redirect()->route('admin.dashboard');
            }

            if (request()->session()->get('admin_2fa_passed')) {
                request()->session()->put('admin_last_activity_at', now()->timestamp);

                return redirect()->route('admin.dashboard');
            }

            request()->session()->put('admin_2fa_user_id', (int) $guard->id());
            $this->sendOtp(request());

            return redirect()->route('admin.otp.show');
        }

        return view('admin.auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $key = $this->loginThrottleKey($request);
        $maxAttempts = (int) config('services.admin.login_max_attempts', 5);
        $decayMinutes = (int) config('services.admin.login_decay_minutes', 15);

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);

            return back()->withErrors([
                'email' => "Too many login attempts. Please try again in {$seconds} seconds.",
            ])->withInput($request->only('email'));
        }

        $remember = $request->boolean('remember');
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            RateLimiter::clear($key);

            $user = Auth::guard('admin')->user();
            if (! $user instanceof User || ! $user->isAdmin()) {
                Auth::guard('admin')->logout();

                return back()->withErrors([
                    'email' => 'Access denied. You do not have admin privileges.',
                ]);
            }

            if (! $this->twoFactorEnabled()) {
                $request->session()->put('admin_2fa_passed', true);
                $request->session()->put('admin_last_activity_at', now()->timestamp);

                AuditLog::create([
                    'actor_id' => $user->id,
                    'action' => 'admin.login',
                    'target_type' => User::class,
                    'target_id' => $user->id,
                    'metadata' => ['remember' => $remember],
                    'ip' => $request->ip(),
                    'user_agent' => (string) $request->userAgent(),
                ]);

                return redirect()->route('admin.dashboard');
            }

            $request->session()->forget('admin_2fa_passed');
            $request->session()->put('admin_2fa_user_id', (int) Auth::guard('admin')->id());
            $this->sendOtp($request);

            return redirect()->route('admin.otp.show');
        }

        RateLimiter::hit($key, $decayMinutes * 60);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showOtpForm(Request $request)
    {
        if (! $this->twoFactorEnabled()) {
            return redirect()->route('admin.dashboard');
        }

        if (! $request->session()->has('admin_2fa_user_id')) {
            $user = Auth::guard('admin')->user();
            if ($user instanceof User && $user->isAdmin()) {
                $request->session()->put('admin_2fa_user_id', (int) Auth::guard('admin')->id());
                $this->sendOtp($request);

                return view('admin.auth.otp');
            }

            return redirect()->route('admin.login');
        }

        return view('admin.auth.otp');
    }

    public function verifyOtp(Request $request)
    {
        if (! $this->twoFactorEnabled()) {
            return redirect()->route('admin.dashboard');
        }

        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        if (! $request->session()->has('admin_2fa_user_id')) {
            return redirect()->route('admin.login');
        }

        $expected = $request->session()->get('admin_otp_code');
        $expiresAt = $request->session()->get('admin_otp_expires_at');

        if (! $expected || ! $expiresAt || now()->greaterThan($expiresAt)) {
            $this->sendOtp($request);

            return back()->withErrors(['otp' => 'OTP expired. A new code has been sent.']);
        }

        if (hash_equals($expected, $request->input('otp'))) {
            $request->session()->forget(['admin_otp_code', 'admin_otp_expires_at']);
            $request->session()->put('admin_2fa_passed', true);
            $request->session()->put('admin_last_activity_at', now()->timestamp);

            $user = Auth::guard('admin')->user();
            if ($user instanceof User) {
                AuditLog::create([
                    'actor_id' => $user->id,
                    'action' => 'admin.login',
                    'target_type' => User::class,
                    'target_id' => $user->id,
                    'metadata' => ['two_factor' => true],
                    'ip' => $request->ip(),
                    'user_agent' => (string) $request->userAgent(),
                ]);
            }

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['otp' => 'Invalid code. Please try again.']);
    }

    public function resendOtp(Request $request)
    {
        if (! $this->twoFactorEnabled()) {
            return redirect()->route('admin.dashboard');
        }

        if (! $request->session()->has('admin_2fa_user_id')) {
            return redirect()->route('admin.login');
        }
        $this->sendOtp($request);

        return back()->with('status', 'A new code has been sent to your email.');
    }

    private function sendOtp(Request $request): void
    {
        if (! $this->twoFactorEnabled()) {
            return;
        }

        $user = Auth::guard('admin')->user();
        if (! $user) {
            Log::warning('Admin OTP send skipped: no authenticated user');

            return;
        }

        $email = (string) $user->email;
        $emailRule = app()->environment('production') ? 'required|email:rfc,dns' : 'required|email';
        $validator = Validator::make(['email' => $email], ['email' => $emailRule]);
        if ($validator->fails()) {
            Log::warning('Admin OTP send skipped: invalid recipient email', [
                'admin_id' => $user->id,
                'email' => $email,
                'errors' => $validator->errors()->toArray(),
            ]);

            return;
        }

        $domain = strtolower((string) substr(strrchr($email, '@') ?: '', 1));
        $blockedSuffixes = ['.invalid', '.test', '.example', '.localhost'];
        foreach ($blockedSuffixes as $suffix) {
            if ($domain !== '' && str_ends_with($domain, $suffix)) {
                Log::warning('Admin OTP send skipped: blocked recipient domain', [
                    'admin_id' => $user->id,
                    'email' => $email,
                    'domain' => $domain,
                    'suffix' => $suffix,
                ]);

                return;
            }
        }

        $code = (string) random_int(100000, 999999);
        $expiresAt = now()->addMinutes(10);
        $request->session()->put('admin_otp_code', $code);
        $request->session()->put('admin_otp_expires_at', $expiresAt);

        $correlationId = (string) Str::uuid();

        if (app()->environment('local') && in_array(config('mail.default'), ['log', 'array'], true)) {
            $request->session()->flash('warning', "Email delivery is not configured (MAIL_MAILER='".config('mail.default')."'). OTP is in storage/logs/laravel.log.");
        }

        Log::info('Admin OTP send attempt', [
            'correlation_id' => $correlationId,
            'admin_id' => $user->id,
            'email' => $email,
            'mailer' => config('mail.default'),
        ]);

        try {
            retry(2, fn () => Mail::to($email)->send(new AdminOtpMail($code, 10)), 200);
            Log::info('Admin OTP mail sent', [
                'correlation_id' => $correlationId,
                'admin_id' => $user->id,
                'email' => $email,
                'mailer' => config('mail.default'),
            ]);
        } catch (\Throwable $e) {
            Log::error('Admin OTP mail send failed', [
                'correlation_id' => $correlationId,
                'admin_id' => $user->id,
                'email' => $email,
                'mailer' => config('mail.default'),
                'queue_connection' => config('queue.default'),
                'error' => $e->getMessage(),
            ]);

            SendAdminOtpMail::dispatch($user->id, $email, $code, 10, $correlationId);
        }

        if (app()->environment(['local', 'testing'])) {
            Log::debug('Admin OTP generated', [
                'correlation_id' => $correlationId,
                'admin_id' => $user->id,
                'email' => $email,
                'code' => $code,
            ]);
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('admin')->user();
        if ($user instanceof User) {
            AuditLog::create([
                'actor_id' => $user->id,
                'action' => 'admin.logout',
                'target_type' => User::class,
                'target_id' => $user->id,
                'metadata' => [],
                'ip' => $request->ip(),
                'user_agent' => (string) $request->userAgent(),
            ]);
        }

        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    private function twoFactorEnabled(): bool
    {
        return (bool) config('services.admin.two_factor_enabled');
    }

    private function loginThrottleKey(Request $request): string
    {
        return 'admin-login:'.mb_strtolower((string) $request->input('email')).'|'.$request->ip();
    }

    public function showLinkRequestForm()
    {
        return view('admin.auth.password-email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::query()->where('email', $data['email'])->first();
        if (! ($user instanceof User) || ! $user->isAdmin()) {
            return back()->with('status', Password::RESET_LINK_SENT);
        }

        $status = Password::broker('admins')->sendResetLink($data);

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', $status)
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm(string $token)
    {
        return view('admin.auth.password-reset', [
            'token' => $token,
            'email' => request()->query('email'),
        ]);
    }

    public function reset(Request $request)
    {
        $data = $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::query()->where('email', $data['email'])->first();
        if (! ($user instanceof User) || ! $user->isAdmin()) {
            return back()->withErrors(['email' => 'This password reset is not available for this account.']);
        }

        $status = Password::broker('admins')->reset(
            $data,
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ]);
                $user->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            return back()->withErrors(['email' => __($status)]);
        }

        return redirect()->route('admin.login')->with('success', 'Password updated successfully. Please login.');
    }

    public function dashboard()
    {
        $totalUsers = User::count();
        $totalTasks = Task::count();
        $openTasks = Task::where('status', 'open')->count();
        $assignedTasks = Task::where('status', 'assigned')->count();
        $inProgressTasks = Task::where('status', 'in_progress')->count();
        $completedTasks = Task::where('status', 'completed')->count();
        $cancelledTasks = Task::where('status', 'cancelled')->count();
        $activeTasks = $openTasks + $assignedTasks + $inProgressTasks;
        $totalRevenue = Payment::where('status', 'completed')->sum('amount');
        $pendingDisputes = Dispute::where('status', 'pending')->count();
        $totalCategories = Category::count();
        $totalReviews = Review::count();

        // User type counts for pie chart
        $clientsCount = User::where('role', 'client')->count();
        $taskersCount = User::where('role', 'tasker')->count();
        $adminsCount = User::where('role', 'admin')->count();

        // Recent data
        $recentUsers = User::latest()->limit(5)->get();
        $recentTasks = Task::with('client')->latest()->limit(5)->get();

        $startMonth = now()->startOfMonth()->subMonths(5);
        $months = collect(range(0, 5))
            ->map(fn (int $i) => $startMonth->copy()->addMonths($i)->format('Y-m'));
        $monthLabels = $months->map(fn (string $ym) => \Illuminate\Support\Carbon::createFromFormat('Y-m', $ym)->format('M'))->all();
        $monthExpression = $this->monthExpression('created_at');
        $completedMonthExpression = $this->monthExpression('completed_at');

        $registrationsByMonth = User::query()
            ->where('created_at', '>=', $startMonth)
            ->selectRaw("{$monthExpression} as ym, COUNT(*) as c")
            ->groupBy('ym')
            ->pluck('c', 'ym');

        $tasksCreatedByMonth = Task::query()
            ->where('created_at', '>=', $startMonth)
            ->selectRaw("{$monthExpression} as ym, COUNT(*) as c")
            ->groupBy('ym')
            ->pluck('c', 'ym');

        $tasksCompletedByMonth = Task::query()
            ->whereNotNull('completed_at')
            ->where('completed_at', '>=', $startMonth)
            ->selectRaw("{$completedMonthExpression} as ym, COUNT(*) as c")
            ->groupBy('ym')
            ->pluck('c', 'ym');

        $revenueByMonth = Payment::query()
            ->where('status', 'completed')
            ->where('created_at', '>=', $startMonth)
            ->selectRaw("{$monthExpression} as ym, COALESCE(SUM(amount), 0) as s")
            ->groupBy('ym')
            ->pluck('s', 'ym');

        $chartSeries = [
            'labels' => $monthLabels,
            'registrations' => $months->map(fn (string $ym) => (int) ($registrationsByMonth[$ym] ?? 0))->all(),
            'tasks_created' => $months->map(fn (string $ym) => (int) ($tasksCreatedByMonth[$ym] ?? 0))->all(),
            'tasks_completed' => $months->map(fn (string $ym) => (int) ($tasksCompletedByMonth[$ym] ?? 0))->all(),
            'revenue' => $months->map(fn (string $ym) => (float) ($revenueByMonth[$ym] ?? 0))->all(),
        ];

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalTasks',
            'activeTasks',
            'openTasks',
            'assignedTasks',
            'inProgressTasks',
            'completedTasks',
            'cancelledTasks',
            'totalRevenue',
            'pendingDisputes',
            'totalCategories',
            'totalReviews',
            'clientsCount',
            'taskersCount',
            'adminsCount',
            'recentUsers',
            'recentTasks',
            'chartSeries'
        ));
    }

    private function monthExpression(string $column): string
    {
        return match (config('database.default')) {
            'sqlite' => "strftime('%Y-%m', {$column})",
            default => "DATE_FORMAT({$column}, '%Y-%m')",
        };
    }

    public function reports()
    {
        // Generate comprehensive reports data
        $totalUsers = User::count();
        $totalTasks = Task::count();
        $completedTasks = Task::where('status', 'completed')->count();
        $totalRevenue = Payment::where('status', 'completed')->sum('amount');
        $totalDisputes = Dispute::count();
        $resolvedDisputes = Dispute::where('status', 'resolved')->count();

        // Monthly statistics for charts
        $monthlyUsers = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthlyTasks = Task::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthlyRevenue = Payment::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->where('status', 'completed')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // User role distribution
        $usersByRole = User::selectRaw('role, COUNT(*) as count')
            ->groupBy('role')
            ->get();

        // Task status distribution
        $tasksByStatus = Task::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        // Top performing categories
        $topCategories = Task::join('categories', 'tasks.category_id', '=', 'categories.id')
            ->selectRaw('categories.name, COUNT(tasks.id) as task_count, AVG((tasks.budget_min + tasks.budget_max) / 2) as avg_budget')
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('task_count', 'desc')
            ->take(10)
            ->get();

        return view('admin.reports', compact(
            'totalUsers',
            'totalTasks',
            'completedTasks',
            'totalRevenue',
            'totalDisputes',
            'resolvedDisputes',
            'monthlyUsers',
            'monthlyTasks',
            'monthlyRevenue',
            'usersByRole',
            'tasksByStatus',
            'topCategories'
        ));
    }
}
