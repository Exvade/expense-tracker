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
        Schema::table('categories', function (Blueprint $table) {
            // Add max_budget column with default value 0.00
            // decimal(15, 2) means total 15 digits, 2 of which are after the decimal point
            $table->decimal('max_budget', 15, 2)->default(0.00)->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            // Drop the max_budget column if migration is rolled back
            $table->dropColumn('max_budget');
        });
    }
};
