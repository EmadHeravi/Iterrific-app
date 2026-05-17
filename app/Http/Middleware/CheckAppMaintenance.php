<?php

namespace App\Http\Middleware;

use App\Models\AppSetting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAppMaintenance
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $this->maintenanceIsEnabled()) {
            return $next($request);
        }

        if ($request->user()?->role === 'administrator') {
            return $next($request);
        }

        if ($request->routeIs('login', 'logout', 'password.forgot', 'reset-password')) {
            return $next($request);
        }

        if (! $request->user() && $request->routeIs('livewire.update') && $this->isAllowedAuthLivewireRequest($request)) {
            return $next($request);
        }

        return response()->view('errors.maintenance', [
            'message' => AppSetting::valueFor(
                'maintenance_message',
                'ITerrific is temporarily unavailable while we perform scheduled maintenance. Please try again shortly.'
            ),
        ], 503);
    }

    private function maintenanceIsEnabled(): bool
    {
        return filter_var(AppSetting::valueFor('maintenance_enabled', false), FILTER_VALIDATE_BOOLEAN);
    }

    private function isAllowedAuthLivewireRequest(Request $request): bool
    {
        $allowedComponents = [
            'auth.login',
            'auth.forgot-password',
            'auth.reset-password',
        ];

        foreach ((array) $request->input('components', []) as $component) {
            $snapshot = json_decode((string) ($component['snapshot'] ?? ''), true);
            $name = $snapshot['memo']['name'] ?? null;

            if (in_array($name, $allowedComponents, true)) {
                return true;
            }
        }

        return false;
    }
}
