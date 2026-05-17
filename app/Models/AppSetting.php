<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Cache;

class AppSetting extends Model
{
    private const CACHE_PREFIX = 'app_setting.';

    protected $fillable = [
        'group',
        'key',
        'value',
        'type',
        'is_secret',
    ];

    protected $casts = [
        'is_secret' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saved(fn (self $setting) => Cache::forget(self::CACHE_PREFIX . $setting->key));
        static::deleted(fn (self $setting) => Cache::forget(self::CACHE_PREFIX . $setting->key));
    }

    public static function valueFor(string $key, mixed $default = null): mixed
    {
        try {
            return Cache::rememberForever(self::CACHE_PREFIX . $key, function () use ($key, $default) {
                return static::where('key', $key)->value('value') ?? $default;
            });
        } catch (QueryException) {
            return $default;
        }
    }

    public static function publicPathFor(string $key, string $default): ?string
    {
        $path = (string) static::valueFor($key, $default);

        return is_file(public_path($path))
            ? public_path($path)
            : (is_file(public_path($default)) ? public_path($default) : null);
    }
}
