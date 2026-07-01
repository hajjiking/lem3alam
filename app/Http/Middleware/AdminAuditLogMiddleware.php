<?php

namespace App\Http\Middleware;

use App\Models\AuditLog;
use App\Models\User;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuditLogMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'], true)) {
            return $response;
        }

        $route = $request->route();
        if (! $route) {
            return $response;
        }

        $routeName = (string) ($route->getName() ?? '');
        if ($routeName === '' || ! str_starts_with($routeName, 'admin.')) {
            return $response;
        }

        if ($this->shouldSkip($routeName)) {
            return $response;
        }

        $actor = Auth::guard('admin')->user();
        if (! $actor instanceof User) {
            return $response;
        }

        [$targetType, $targetId] = $this->extractTarget($route->parameters());

        AuditLog::create([
            'actor_id' => $actor->id,
            'action' => $routeName,
            'target_type' => $targetType,
            'target_id' => $targetId,
            'metadata' => [
                'method' => $request->method(),
                'path' => $request->path(),
                'status' => $response->getStatusCode(),
                'params' => $this->safeParams($request),
            ],
            'ip' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
        ]);

        return $response;
    }

    private function shouldSkip(string $routeName): bool
    {
        if (str_starts_with($routeName, 'admin.password.')) {
            return true;
        }

        if (str_starts_with($routeName, 'admin.otp.')) {
            return true;
        }

        return in_array($routeName, [
            'admin.authenticate',
            'admin.logout',
        ], true);
    }

    /**
     * @param  array<string,mixed>  $params
     * @return array{0:string|null,1:int|null}
     */
    private function extractTarget(array $params): array
    {
        foreach ($params as $value) {
            if ($value instanceof Model) {
                return [get_class($value), (int) $value->getKey()];
            }
        }

        return [null, null];
    }

    private function safeParams(Request $request): array
    {
        $data = $request->except([
            'password',
            'password_confirmation',
            'token',
            '_token',
        ]);

        foreach ($data as $key => $value) {
            if (is_string($value) && mb_strlen($value) > 2000) {
                $data[$key] = mb_substr($value, 0, 2000);
            }
        }

        return $data;
    }
}

