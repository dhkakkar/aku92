<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public $withinTransaction = false;

    public function up(): void
    {
        $now = now();

        // ── Seed Aku92 Medical Industries detail page sections ──
        $text = [
            'industries.hero_title'       => ['title' => 'Hero Title', 'content' => 'Aku92 Medical Industries'],
            'industries.hero_sub'         => ['title' => 'Hero Sub',   'content' => 'Manufacturers of medical publications, masks & paper bags'],
            'industries.about_title'      => ['title' => 'About Title','content' => 'About Aku92 Medical Industries'],
            'industries.about_content'    => ['title' => 'About Body', 'content' => '<p>Aku92 Medical Industries, located at 29, HSIIDC Phase-2 Jagadhri, Manakpur, District Yamunanagar, Haryana, is the manufacturing arm of the AKU 92 group. We manufacture a range of medical publications, surgical masks and medical paper products that are supplied across India.</p><p>Our facility focuses on quality and affordability, supporting hospitals, clinics and pharmacies with reliable, regulation-compliant supplies.</p>'],
            'industries.products_title'   => ['title' => 'Products Title', 'content' => 'What We Manufacture'],
            'industries.contact_title'    => ['title' => 'Contact Title', 'content' => 'Contact Us'],
            'industries.contact_address'  => ['title' => 'Address', 'content' => '29, HSIIDC Phase-2 Jagadhri, Manakpur — 135003, District Yamunanagar, Haryana'],
            'industries.contact_phone'    => ['title' => 'Phone', 'content' => '01735-297929, 7056-297929'],
        ];

        foreach ($text as $key => $data) {
            DB::table('sections')->updateOrInsert(
                ['key' => $key],
                [
                    'page'       => 'aku92-medical-industries',
                    'title'      => $data['title'],
                    'content'    => $data['content'],
                    'is_active'  => true,
                    'sort_order' => 0,
                    'updated_at' => $now,
                    'created_at' => $now,
                ],
            );
        }

        DB::table('sections')->updateOrInsert(
            ['key' => 'industries.products_list'],
            [
                'page'       => 'aku92-medical-industries',
                'title'      => 'Products List',
                'meta'       => json_encode(['items' => [
                    ['icon' => 'fas fa-book-medical', 'title' => 'Aku Review',  'description' => 'Medico-Legal special publication — annual.'],
                    ['icon' => 'fas fa-head-side-mask','title' => 'Astrwch',     'description' => 'Medical masks for clinical and personal use.'],
                    ['icon' => 'fas fa-shopping-bag','title' => 'Mnkprr',       'description' => 'Medical paper bags for pharmacies & dispensaries.'],
                ]]),
                'is_active'  => true,
                'sort_order' => 0,
                'updated_at' => $now,
                'created_at' => $now,
            ],
        );

        // ── Swap "MCQs in Cardiology" with "Aku92 Medical Industries" in hub cards ──
        $cardsRow = DB::table('sections')->where('key', 'aku92.hub_cards')->first();
        if ($cardsRow) {
            $meta = json_decode($cardsRow->meta, true);
            if (isset($meta['items']) && is_array($meta['items'])) {
                foreach ($meta['items'] as $i => $item) {
                    if (isset($item['title']) && stripos($item['title'], 'MCQs') !== false) {
                        $meta['items'][$i] = [
                            'variant'     => 'image',
                            'image'       => 'images/firms/aku-review.jpg',
                            'icon'        => 'fas fa-industry',
                            'badge'       => 'Manufacturing Unit',
                            'title'       => 'Aku92 Medical Industries',
                            'description' => 'Manufacturers of Aku Review, Astrwch masks & Mnkprr paper bags.',
                            'url'         => '/healthcare/medical-industries',
                            'target'      => '_self',
                        ];
                    }
                }
                DB::table('sections')->where('id', $cardsRow->id)->update([
                    'meta' => json_encode($meta), 'updated_at' => $now,
                ]);
            }
        }

        // ── Same swap in hub sidebar links ──
        $linksRow = DB::table('sections')->where('key', 'aku92.hub_sidebar_links')->first();
        if ($linksRow) {
            $meta = json_decode($linksRow->meta, true);
            if (isset($meta['items']) && is_array($meta['items'])) {
                foreach ($meta['items'] as $i => $item) {
                    if (isset($item['title']) && stripos($item['title'], 'MCQs') !== false) {
                        $meta['items'][$i] = [
                            'icon'   => 'fas fa-industry',
                            'title'  => 'Aku92 Medical Industries',
                            'sub'    => 'Manufacturing Unit, Jagadhri',
                            'url'    => '/healthcare/medical-industries',
                            'target' => '_self',
                        ];
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
        DB::table('sections')->where('page', 'aku92-medical-industries')->delete();
    }
};
