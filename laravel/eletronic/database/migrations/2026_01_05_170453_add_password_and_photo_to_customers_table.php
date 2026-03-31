<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            if (!Schema::hasColumn('customers', 'password')) {
                $table->string('password')->after('phone');
            }
            if (!Schema::hasColumn('customers', 'photo')) {
                $table->string('photo')->nullable()->after('password');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            if (Schema::hasColumn('customers', 'password')) {
                $table->dropColumn('password');
            }
            if (Schema::hasColumn('customers', 'photo')) {
                $table->dropColumn('photo');
            }
        });
    }
};
