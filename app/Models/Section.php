<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['page', 'key', 'title', 'subtitle', 'content', 'meta', 'is_active', 'sort_order'];
    protected $casts = ['is_active' => 'boolean', 'meta' => 'array'];

    public function scopeActive($query) { return $query->where('is_active', true); }
    public function scopeForPage($query, string $page) { return $query->where('page', $page); }

    public static function getContent(string $key, $default = null)
    {
        $section = static::where('key', $key)->first();
        return $section?->content ?? $default;
    }
}
