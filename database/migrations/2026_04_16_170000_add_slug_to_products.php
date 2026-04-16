<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration {
    public $withinTransaction = false;

    public function up(): void
    {
        if (! Schema::hasColumn('products', 'slug')) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('name');
            });
        }

        // Backfill slugs for existing products.
        $taken = [];
        foreach (DB::table('products')->get(['id', 'name', 'slug']) as $p) {
            if (! empty($p->slug)) {
                $taken[$p->slug] = true;
                continue;
            }
            $base = Str::slug($p->name) ?: ('product-' . $p->id);
            $slug = $base;
            $i = 2;
            while (isset($taken[$slug]) || DB::table('products')->where('slug', $slug)->where('id', '!=', $p->id)->exists()) {
                $slug = $base . '-' . $i++;
            }
            DB::table('products')->where('id', $p->id)->update(['slug' => $slug]);
            $taken[$slug] = true;
        }

        // Now enforce uniqueness.
        Schema::table('products', function (Blueprint $table) {
            $table->unique('slug');
        });

        // Rewrite any /shop/product/{id} references stored in Section meta to use the new slug.
        $idToSlug = DB::table('products')
            ->whereNotNull('slug')
            ->pluck('slug', 'id')
            ->toArray();

        $rewrite = function ($value) use ($idToSlug) {
            if (! preg_match('#^/shop/product/(\d+)$#', (string) $value, $m)) {
                return $value;
            }
            $id = (int) $m[1];
            return isset($idToSlug[$id]) ? '/shop/product/' . $idToSlug[$id] : $value;
        };

        foreach (DB::table('sections')->whereNotNull('meta')->get(['id', 'meta']) as $section) {
            $decoded = is_array($section->meta) ? $section->meta : json_decode($section->meta, true);
            if (! is_array($decoded) || ! isset($decoded['items']) || ! is_array($decoded['items'])) {
                continue;
            }
            $changed = false;
            foreach ($decoded['items'] as &$item) {
                if (is_array($item) && isset($item['url'])) {
                    $new = $rewrite($item['url']);
                    if ($new !== $item['url']) {
                        $item['url'] = $new;
                        $changed = true;
                    }
                }
            }
            unset($item);
            if ($changed) {
                DB::table('sections')->where('id', $section->id)->update([
                    'meta' => json_encode($decoded),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
