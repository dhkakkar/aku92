<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Section extends Model
{
    protected $fillable = ['page', 'key', 'title', 'subtitle', 'content', 'meta', 'is_active', 'sort_order'];
    protected $casts = ['is_active' => 'boolean', 'meta' => 'array'];

    public function scopeActive($query) { return $query->where('is_active', true); }
    public function scopeForPage($query, string $page) { return $query->where('page', $page); }

    /**
     * All site pages (used by Filament dropdown and grouping).
     */
    public static function pageOptions(): array
    {
        return [
            'home' => 'Homepage',
            'akash-jain' => 'Dr. Akash Jain Page',
            'prashuka-jain' => 'Dr. Prashuka Jain Page',
            'aku92-hub' => 'AKU92 Hub Page',
            'aku92-clinics' => 'AKU92 Clinics',
            'aku92-jain-medicines' => 'Jain Medicines',
            'aku92-physiotherapy' => 'Aku Physiotherapy',
            'aku92-review' => 'Aku Review',
            'aku92-opd-form' => 'OPD Form Page',
            'about' => 'About Page',
            'contact' => 'Contact Page',
            'product' => 'Product Page',
            'online-medicine' => 'Online Medicine Page',
            'opd-form' => 'OPD Form Page',
            'shop' => 'Shop Page',
        ];
    }

    public static function getContent(string $key, $default = null)
    {
        $sections = Cache::remember('sections_all', 3600, fn () => static::active()->get()->keyBy('key'));
        $section = $sections->get($key);
        return $section?->content ?? $default;
    }

    public static function get(string $key): ?self
    {
        $sections = Cache::remember('sections_all', 3600, fn () => static::active()->get()->keyBy('key'));
        return $sections->get($key);
    }

    public static function field(string $key, string $field, $default = null)
    {
        $section = static::get($key);
        return $section?->{$field} ?? $default;
    }

    public static function meta(string $key, string $metaKey = null, $default = null)
    {
        $section = static::get($key);
        if (!$section) return $default;
        if (!$metaKey) return $section->meta ?? $default;
        return data_get($section->meta, $metaKey, $default);
    }

    public static function clearCache(): void
    {
        Cache::forget('sections_all');
    }

    protected static function booted(): void
    {
        static::saved(fn () => static::clearCache());
        static::deleted(fn () => static::clearCache());
    }
}
