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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            // Kunci Asing ke Pembeli
            $table->foreignId('pembeli_id')->constrained('pembelis')->onDelete('cascade');
            $table->foreignId('toko_id')->constrained('tokos')->onDelete('cascade');

            $table->dateTime('tanggal_pesanan');
            $table->enum('status_pesanan', ['Menunggu Konfirmasi', 'Dikonfirmasi/Diproses', 'Siap Diambil/Diantar', 'Selesai', 'Dibatalkan']);
            $table->string('metode_pengambilan'); // Ambil Sendiri / Diantar Penjual
            $table->decimal('total_harga_final', 10, 2);
            
            // Kolom Kunci untuk Jasa/Jadwal
            $table->text('catatan_pembeli')->nullable(); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
