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
        Schema::create('detail_keranjangs', function (Blueprint $table) {
            $table->id();
            // Kunci Asing ke Keranjang dan Produk
            $table->foreignId('keranjang_id')->constrained('keranjangs')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
            
            $table->unsignedInteger('jumlah_produk');
            
            $table->timestamps();
            
            // Memastikan tidak ada duplikat produk dalam satu keranjang
            $table->unique(['keranjang_id', 'produk_id']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_keranjangs');
    }
};
