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
        // database/migrations/xxxx_xx_xx_create_hama_table.php
        Schema::create('hama', function (Blueprint $table) {
            $table->id();
            $table->string('nama_hama');
            $table->text('rekomendasi');
            $table->string('gambar'); // path gambar
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hama');
    }
};
