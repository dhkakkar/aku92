<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public $withinTransaction = false;

    public function up(): void
    {
        $now = now();

        $text = [
            'jms.hero_title'      => ['title' => 'Hero Title',  'content' => 'Jain Medical Store — Products'],
            'jms.hero_sub'        => ['title' => 'Hero Sub',    'content' => 'Our complete range of medical products'],
            'jms.products_image'  => ['title' => 'Products Image Path', 'content' => 'images/firms/products.jpeg'],
            'jms.contact_title'   => ['title' => 'Contact Title', 'content' => 'Visit Us'],
            'jms.contact_address' => ['title' => 'Address',     'content' => 'D.A.V. Market, Holkar Chowk, Yamunanagar'],
            'jms.contact_phone'   => ['title' => 'Phone',       'content' => '01732-261250'],
        ];

        foreach ($text as $key => $data) {
            DB::table('sections')->updateOrInsert(
                ['key' => $key],
                [
                    'page'       => 'aku92-jain-medical-store',
                    'title'      => $data['title'],
                    'content'    => $data['content'],
                    'is_active'  => true,
                    'sort_order' => 0,
                    'updated_at' => $now,
                    'created_at' => $now,
                ],
            );
        }

        // Repoint Jain Medical Store URL in hub cards.
        $cardsRow = DB::table('sections')->where('key', 'aku92.hub_cards')->first();
        if ($cardsRow) {
            $meta = json_decode($cardsRow->meta, true);
            if (isset($meta['items']) && is_array($meta['items'])) {
                foreach ($meta['items'] as $i => $item) {
                    if (isset($item['title']) && stripos($item['title'], 'Jain Medical Store') !== false) {
                        $meta['items'][$i]['url'] = '/healthcare/jain-medical-store';
                    }
                }
                DB::table('sections')->where('id', $cardsRow->id)->update([
                    'meta' => json_encode($meta), 'updated_at' => $now,
                ]);
            }
        }

        // Same for sidebar links.
        $linksRow = DB::table('sections')->where('key', 'aku92.hub_sidebar_links')->first();
        if ($linksRow) {
            $meta = json_decode($linksRow->meta, true);
            if (isset($meta['items']) && is_array($meta['items'])) {
                foreach ($meta['items'] as $i => $item) {
                    if (isset($item['title']) && stripos($item['title'], 'Jain Medical Store') !== false) {
                        $meta['items'][$i]['url'] = '/healthcare/jain-medical-store';
                    }
                }
                DB::table('sections')->where('id', $linksRow->id)->update([
                    'meta' => json_encode($meta), 'updated_at' => $now,
                ]);
            }
        }
    }

    public function down(): void
    {
        DB::table('sections')->where('page', 'aku92-jain-medical-store')->delete();
    }
};
