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
        Schema::table('users', function (Blueprint $table) {
            // Add initial_balance column with default value 0.00
            // decimal(15, 2) means total 15 digits, 2 of which are after the decimal point
            $table->decimal('initial_balance', 15, 2)->default(0.00)->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the initial_balance column if migration is rolled back
            $table->dropColumn('initial_balance');
        });
    }
};
