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
        Schema::create('pupuk', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_tanaman');           // Contoh: Padi, Tomat
            $table->string('kondisi_tanah');           // Contoh: Lembab, Kering, Asam
            $table->string('tahap_pertumbuhan');       // Contoh: Bibit, Vegetatif, Generatif
            $table->text('rekomendasi');               // Isi rekomendasi pupuk
            $table->string('gambar')->nullable();      // Path gambar, jika ingin ditampilkan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pupuk');
    }
};
