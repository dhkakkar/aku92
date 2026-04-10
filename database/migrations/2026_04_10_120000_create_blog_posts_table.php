<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('owner')->index(); // dr-akash-jain, dr-prashuka-jain, aku92-clinics, etc.
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('body');
            $table->string('featured_image')->nullable();
            $table->string('category')->nullable();
            $table->string('author')->nullable();
            // Use DB::raw('true') to emit a Postgres-valid boolean literal
            // (default(true) generates default '1' which Postgres rejects).
            $table->boolean('is_published')->default(DB::raw('true'));
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
