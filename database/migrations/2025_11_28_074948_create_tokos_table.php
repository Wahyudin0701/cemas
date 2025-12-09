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
        Schema::create('tokos', function (Blueprint $table) {
            $table->id();
            // Kunci Asing ke Penjual
            $table->foreignId('penjual_id')->constrained('penjuals')->onDelete('cascade');

            $table->string('nama_toko');
            $table->time('jam_buka')->nullable();
            $table->time('jam_tutup')->nullable();
            $table->string('foto_toko')->nullable();
            $table->string('lokasi')->nullable();
            $table->text('deskripsi_toko')->nullable();

            // Status Verifikasi Admin
            $table->enum('status_verifikasi', ['Menunggu', 'Terverifikasi', 'Ditolak'])->default('Menunggu');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tokos');
    }
};
