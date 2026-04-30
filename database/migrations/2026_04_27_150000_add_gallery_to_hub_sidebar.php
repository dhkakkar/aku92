<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public $withinTransaction = false;

    public function up(): void
    {
        $now = now();

        $linksRow = DB::table('sections')->where('key', 'aku92.hub_sidebar_links')->first();
        if (! $linksRow) {
            return;
        }

        $meta = json_decode($linksRow->meta, true);
        if (! isset($meta['items']) || ! is_array($meta['items'])) {
            return;
        }

        // Skip if already present.
        foreach ($meta['items'] as $item) {
            if (($item['url'] ?? '') === '/gallery') {
                return;
            }
        }

        $galleryLink = [
            'icon'   => 'fas fa-images',
            'title'  => 'Gallery',
            'sub'    => 'Photos & moments',
            'url'    => '/gallery',
            'target' => '_self',
        ];

        // Insert just before the last "Back to Home" entry if present, else append.
        $inserted = false;
        $items = [];
        foreach ($meta['items'] as $item) {
            if (! $inserted && stripos($item['title'] ?? '', 'Back to Home') !== false) {
                $items[] = $galleryLink;
                $inserted = true;
            }
            $items[] = $item;
        }
        if (! $inserted) {
            $items[] = $galleryLink;
        }
        $meta['items'] = $items;

        DB::table('sections')->where('id', $linksRow->id)->update([
            'meta'       => json_encode($meta),
            'updated_at' => $now,
        ]);
    }

    public function down(): void
    {
        $linksRow = DB::table('sections')->where('key', 'aku92.hub_sidebar_links')->first();
        if (! $linksRow) {
            return;
        }
        $meta = json_decode($linksRow->meta, true);
        if (! isset($meta['items']) || ! is_array($meta['items'])) {
            return;
        }
        $meta['items'] = array_values(array_filter(
            $meta['items'],
            fn ($i) => ($i['url'] ?? '') !== '/gallery',
        ));
        DB::table('sections')->where('id', $linksRow->id)->update([
            'meta'       => json_encode($meta),
            'updated_at' => now(),
        ]);
    }
};
