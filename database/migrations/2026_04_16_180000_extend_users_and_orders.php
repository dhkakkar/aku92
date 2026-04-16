<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public $withinTransaction = false;

    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'role'))    $table->string('role')->default('customer')->after('password');
            if (! Schema::hasColumn('users', 'phone'))   $table->string('phone', 20)->nullable()->after('email');
            if (! Schema::hasColumn('users', 'address')) $table->text('address')->nullable()->after('phone');
            if (! Schema::hasColumn('users', 'city'))    $table->string('city', 100)->nullable()->after('address');
            if (! Schema::hasColumn('users', 'state'))   $table->string('state', 100)->nullable()->after('city');
            if (! Schema::hasColumn('users', 'pincode')) $table->string('pincode', 10)->nullable()->after('state');
        });

        // Existing user(s) — mark them as admin so the Filament panel stays usable.
        DB::table('users')->whereNull('role')->orWhere('role', '')->update(['role' => 'admin']);

        Schema::table('orders', function (Blueprint $table) {
            if (! Schema::hasColumn('orders', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->nullOnDelete();
            }
            if (! Schema::hasColumn('orders', 'cancel_reason')) {
                $table->text('cancel_reason')->nullable()->after('notes');
            }
            if (! Schema::hasColumn('orders', 'return_reason')) {
                $table->text('return_reason')->nullable()->after('cancel_reason');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }
            if (Schema::hasColumn('orders', 'cancel_reason')) $table->dropColumn('cancel_reason');
            if (Schema::hasColumn('orders', 'return_reason')) $table->dropColumn('return_reason');
        });

        Schema::table('users', function (Blueprint $table) {
            foreach (['role', 'phone', 'address', 'city', 'state', 'pincode'] as $col) {
                if (Schema::hasColumn('users', $col)) $table->dropColumn($col);
            }
        });
    }
};
