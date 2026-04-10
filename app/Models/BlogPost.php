<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = [
        'owner', 'title', 'slug', 'excerpt', 'body',
        'featured_image', 'category', 'author',
        'is_published', 'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title) . '-' . Str::random(5);
            }
            if ($post->is_published && empty($post->published_at)) {
                $post->published_at = now();
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeForOwner($query, string $owner)
    {
        return $query->where('owner', $owner);
    }

    /**
     * Central registry of all blog owners (persons + firms).
     * Used by Filament dropdown and frontend lookups.
     */
    public static function ownerOptions(): array
    {
        return [
            'dr-akash-jain' => 'Dr. Akash Jain',
            'dr-prashuka-jain' => 'Dr. Prashuka Jain',
            'aku92-clinics' => 'Aku92 Clinics',
            'jain-medicines' => 'Jain Medicines',
            'aku-physiotherapy' => 'Aku Physiotherapy',
            'aku-review' => 'Aku Review',
            'jain-medical-store' => 'Jain Medical Store',
            'jan-aushadhi-store' => 'Jan Aushadhi Store',
        ];
    }

    public function ownerLabel(): string
    {
        return self::ownerOptions()[$this->owner] ?? $this->owner;
    }
}
