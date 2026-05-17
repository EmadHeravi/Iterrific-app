<?php

namespace App\Support;

use App\Models\AppSetting;
use Illuminate\Support\Facades\Http;

class CaptchaValidator
{
    public static function provider(): string
    {
        return (string) AppSetting::valueFor(
            'captcha_provider',
            config('services.turnstile.site_key') ? 'turnstile' : 'none'
        );
    }

    public static function siteKey(string $provider): ?string
    {
        return match ($provider) {
            'turnstile' => AppSetting::valueFor('turnstile_site_key', config('services.turnstile.site_key')),
            'recaptcha' => AppSetting::valueFor('recaptcha_site_key', config('services.recaptcha.site_key')),
            default => null,
        };
    }

    public static function verify(?string $token, ?string $ip = null): bool
    {
        $provider = self::provider();

        if ($provider === 'none') {
            return true;
        }

        if (! $token) {
            return false;
        }

        if ($provider === 'recaptcha') {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => AppSetting::valueFor('recaptcha_secret_key', config('services.recaptcha.secret_key')),
                'response' => $token,
                'remoteip' => $ip,
            ]);

            return (bool) ($response->json('success') ?? false);
        }

        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => AppSetting::valueFor('turnstile_secret_key', config('services.turnstile.secret_key')),
            'response' => $token,
            'remoteip' => $ip,
        ]);

        return (bool) ($response->json('success') ?? false);
    }
}
