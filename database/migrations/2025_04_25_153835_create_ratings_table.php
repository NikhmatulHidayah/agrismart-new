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
        Schema::create('rating', function (Blueprint $table) {
            $table->id();
            $table->integer('star')->nullable();
            $table->string('feedback')->nullable();
            $table->foreignId('id_ahli_tani')->constrained('users')->onDelete('cascade')->nullable();
            $table->foreignId('id_petani')->constrained('users')->onDelete('cascade')->nullable();
            $table->foreignId('id_order_konsultasi')->constrained('order_konsultasi')->onDelete('cascade')->nullable();
            $table->foreignId('id_order_meet')->constrained('order_meet')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
