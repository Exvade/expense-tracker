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
    Schema::create('expenses', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Untuk asosiasi ke pengguna
        $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Untuk asosiasi ke kategori
        $table->decimal('amount', 10, 2); // Contoh: 12345678.99
        $table->text('description')->nullable();
        $table->date('expense_date'); // Tanggal pengeluaran
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
