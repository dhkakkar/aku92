<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public $withinTransaction = false;

    public function up(): void
    {
        $now = now();

        $text = [
            'shop.hero_title'       => ['title' => 'Hero Title',       'content' => 'Our Products'],
            'shop.hero_sub'         => ['title' => 'Hero Sub-text',    'content' => 'Quality medical products & supplies at affordable prices'],
            'shop.search_placeholder'=> ['title' => 'Search placeholder', 'content' => 'Search products...'],
            'shop.category_all'     => ['title' => 'All-categories option label', 'content' => 'All Categories'],
            'shop.apply_label'      => ['title' => 'Apply button label','content' => 'Apply'],
            'shop.product_desc_fallback' => ['title' => 'Product detail fallback description', 'content' => 'High-quality medical product from AKU 92. Trusted by healthcare professionals and patients alike. All our products are 100% genuine and sourced directly from manufacturers.'],
        ];

        foreach ($text as $key => $data) {
            DB::table('sections')->updateOrInsert(
                ['key' => $key],
                [
                    'page' => 'shop',
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'is_active' => true,
                    'sort_order' => 0,
                    'updated_at' => $now,
                    'created_at' => $now,
                ],
            );
        }

        $lists = [
            'shop.categories' => ['title' => 'Shop Categories', 'items' => [
                ['label' => 'Medicines',         'value' => 'medicines'],
                ['label' => 'Surgical Supplies', 'value' => 'surgical'],
                ['label' => 'Books & Publications','value' => 'books'],
                ['label' => 'Equipment',         'value' => 'equipment'],
            ]],
            'shop.info_banner' => ['title' => 'Shop Info Banner', 'items' => [
                ['icon' => 'fas fa-truck',      'title' => 'Free Delivery',  'description' => 'Orders above ₹500'],
                ['icon' => 'fas fa-shield-alt', 'title' => '100% Genuine',   'description' => 'Authentic products'],
                ['icon' => 'fas fa-undo',       'title' => 'Easy Returns',   'description' => '7-day return policy'],
                ['icon' => 'fas fa-headset',    'title' => '24/7 Support',   'description' => 'Call us anytime'],
            ]],
            'shop.product_features' => ['title' => 'Product detail inline features', 'items' => [
                ['icon' => 'fas fa-truck',      'color' => 'text-success', 'text' => 'Free delivery above ₹500'],
                ['icon' => 'fas fa-shield-alt', 'color' => 'text-primary', 'text' => 'Genuine product'],
                ['icon' => 'fas fa-undo',       'color' => 'text-warning', 'text' => '7-day returns'],
            ]],
        ];

        foreach ($lists as $key => $data) {
            DB::table('sections')->updateOrInsert(
                ['key' => $key],
                [
                    'page' => 'shop',
                    'title' => $data['title'],
                    'meta' => json_encode(['items' => $data['items']]),
                    'is_active' => true,
                    'sort_order' => 0,
                    'updated_at' => $now,
                    'created_at' => $now,
                ],
            );
        }
    }

    public function down(): void
    {
        DB::table('sections')
            ->whereIn('key', [
                'shop.hero_title', 'shop.hero_sub', 'shop.search_placeholder',
                'shop.category_all', 'shop.apply_label', 'shop.product_desc_fallback',
                'shop.categories', 'shop.info_banner', 'shop.product_features',
            ])
            ->delete();
    }
};
