<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Fix: Replace user_type with role
            $user = Auth::user();
            if ($user->role === 'client') {
                return redirect()->intended(localized_route('dashboard.client'));
            } elseif ($user->role === 'tasker') {
                return redirect()->intended(localized_route('dashboard.tasker'));
            }

            return redirect()->intended(localized_route('home'));
        }

        return back()->withErrors([
            'email' => 'البيانات المدخلة غير صحيحة.',
        ])->onlyInput('email');
    }

    /**
     * Show the registration form
     */
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    /**
     * Handle registration request
     */
    public function register(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20', 'unique:users'],
            'user_type' => ['required', 'in:client,tasker'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['required', 'accepted'],
        ], [
            'first_name.required' => 'الاسم الأول مطلوب',
            'last_name.required' => 'الاسم الأخير مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.unique' => 'رقم الهاتف مستخدم بالفعل',
            'user_type.required' => 'نوع الحساب مطلوب',
            'user_type.in' => 'نوع الحساب غير صحيح',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق',
            'terms.required' => 'يجب الموافقة على الشروط والأحكام',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->first_name.' '.$request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->user_type, // Maps user_type to role
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
            'status' => 'active',
        ]);

        event(new Registered($user));

        Auth::loginUsingId($user->id);

        // Redirect based on user type
        if ($user->role === 'client') {
            return redirect(localized_route('dashboard.client'))->with('success', 'تم إنشاء حسابك بنجاح!');
        } elseif ($user->role === 'tasker') {
            return redirect(localized_route('dashboard.tasker'))->with('success', 'تم إنشاء حسابك بنجاح!');
        }

        return redirect(localized_route('home'))->with('success', 'تم إنشاء حسابك بنجاح!');
    }

    /**
     * Show password reset request form
     */
    public function showLinkRequestForm(): View
    {
        return view('auth.passwords.email');
    }

    /**
     * Send password reset link
     */
    public function sendResetLinkEmail(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', 'تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني.');
        }

        return back()->withErrors([
            'email' => 'لم نتمكن من العثور على مستخدم بهذا البريد الإلكتروني.',
        ]);
    }

    /**
     * Show password reset form
     */
    public function showResetForm(Request $request, string $token): View
    {
        return view('auth.passwords.reset', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * Reset password
     */
    public function reset(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect(localized_route('login'))->with('status', 'تم إعادة تعيين كلمة المرور بنجاح.');
        }

        return back()->withErrors([
            'email' => 'حدث خطأ أثناء إعادة تعيين كلمة المرور.',
        ]);
    }

    /**
     * Logout user
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Fix: Use localized_route instead of hardcoded redirect
        return redirect(localized_route('home'));
    }
}
