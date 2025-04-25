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
        Schema::create('order_konsultasi', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_payment')->default(false);
            $table->integer('amount');
            $table->string('question')->nullable();
            $table->string('feedback')->nullable();
            $table->string('picture_feedback')->nullable();
            $table->string('picture_question')->nullable();
            $table->timestamps();
            $table->boolean('is_done')->default(false);
            $table->boolean('payment_ahli')->default(false);
            $table->foreignId('id_petani')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_ahli_tani')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_konsultasi');
    }
};
