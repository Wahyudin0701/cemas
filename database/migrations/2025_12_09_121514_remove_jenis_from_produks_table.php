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
        // Drop 'jenis' if it exists
        if (Schema::hasColumn('produks', 'jenis')) {
            Schema::table('produks', function (Blueprint $table) {
                $table->dropColumn('jenis');
            });
        }

        // Add 'stok' if it doesn't exist
        if (!Schema::hasColumn('produks', 'stok')) {
             Schema::table('produks', function (Blueprint $table) {
                $table->integer('stok')->default(0)->after('harga');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            // Restore 'jenis'
            if (!Schema::hasColumn('produks', 'jenis')) {
                $table->enum('jenis', ['Barang', 'Jasa'])->default('Barang');
            }
            // Drop 'stok' if we added it (this is tricky because we don't know if it existed before, 
            // but for this task assuming we are enforcing it now so reversing might imply removing it if we want full rollback to previous state where it might have been missing or optional. 
            // However, usually we don't drop data columns in down unless sure.
            // Given the task context, I will leave 'stok' alone in down() or drop it if I strictly follow the "removed field" logic.
            // But if the previous state HAD stok (even if missing in migration file), dropping it would be bad.
            // Let's just restore 'jenis'.
        });
    }
};
