<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, string $module, string $action = 'read'): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(401);
        }

        $allowed = $action === 'write'
            ? $user->canWrite($module)
            : $user->canRead($module);

        abort_unless($allowed, 403);

        return $next($request);
    }
}
