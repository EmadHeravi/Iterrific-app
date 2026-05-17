<?php

namespace App\Support;

use App\Models\User;
use App\Services\MicrosoftGraphMailer;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class TwoFactorCode
{
    public static function send(User $user): void
    {
        $code = (string) random_int(100000, 999999);

        Cache::put(self::codeKey($user), Hash::make($code), now()->addMinutes(10));
        Cache::put(self::sentKey($user), now()->timestamp, now()->addMinutes(10));

        app(MicrosoftGraphMailer::class)->send(
            $user->email,
            'Your ITerrific security code',
            view('emails.two-factor-code', [
                'code' => $code,
                'expiresInMinutes' => 10,
                'user' => $user,
            ])->render()
        );
    }

    public static function verify(User $user, string $code): bool
    {
        $hash = Cache::get(self::codeKey($user));

        if (! $hash || ! Hash::check($code, $hash)) {
            return false;
        }

        Cache::forget(self::codeKey($user));
        Cache::forget(self::sentKey($user));

        return true;
    }

    public static function hasActiveCode(User $user): bool
    {
        return Cache::has(self::codeKey($user));
    }

    public static function secondsUntilResend(User $user): int
    {
        $sentAt = (int) Cache::get(self::sentKey($user), 0);

        if (! $sentAt) {
            return 0;
        }

        return max(0, 60 - (now()->timestamp - $sentAt));
    }

    private static function codeKey(User $user): string
    {
        return 'two_factor_code.' . $user->id;
    }

    private static function sentKey(User $user): string
    {
        return 'two_factor_sent.' . $user->id;
    }
}
