<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Firm extends Model
{
    protected $fillable = [
        'name', 'slug', 'image', 'icon', 'badge', 'address',
        'phone', 'description', 'detail', 'link', 'is_active', 'sort_order',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query) { return $query->where('is_active', true); }
    public function scopeOrdered($query) { return $query->orderBy('sort_order'); }

    protected static function booted(): void
    {
        static::saving(function (self $firm) {
            if (empty($firm->slug)) {
                $firm->slug = Str::slug($firm->name);
            }
        });
    }
}
