<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public $withinTransaction = false;

    public function up(): void
    {
        $now = now();

        $map = [
            'MCQs in Cardiology for MD & DM' => 'products/mcqs-in-cardiology-for-md-dm.jpeg',
            'Aku Review (Medico-Legal)'      => 'products/aku_review.jpeg',
            'Astrwch Surgical Mask'          => 'products/astrwch-surgical-mask.jpeg',
            'MNKPRR Medical Paper Bags'      => 'products/mnkprr-medical-paper-bags.jpeg',
        ];

        foreach ($map as $name => $path) {
            DB::table('products')->where('name', $name)->update([
                'image'      => $path,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        // No-op: previous image paths are the legacy defaults.
    }
};
