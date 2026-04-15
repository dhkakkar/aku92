<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['group', 'key', 'label', 'value', 'type', 'sort_order'];

    public static function get(string $key, $default = null): ?string
    {
        $settings = Cache::remember('site_settings', 3600, function () {
            return static::pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }

    public static function getGroup(string $group): array
    {
        return Cache::remember("site_settings_{$group}", 3600, function () use ($group) {
            return static::where('group', $group)->orderBy('sort_order')->pluck('value', 'key')->toArray();
        });
    }

    public static function clearCache(): void
    {
        Cache::forget('site_settings');
        $groups = static::distinct()->pluck('group');
        foreach ($groups as $group) {
            Cache::forget("site_settings_{$group}");
        }
    }

    protected static function booted(): void
    {
        static::saved(fn () => static::clearCache());
        static::deleted(fn () => static::clearCache());
    }
}
