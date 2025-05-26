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

            $table->foreignId('id_ahli_tani')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('id_petani')->nullable()->constrained('users')->onDelete('cascade');      

            $table->foreignId('id_order_konsultasi')->nullable()->constrained('order_konsultasi')->onDelete('cascade');
            $table->foreignId('id_order_meet')->nullable()->constrained('order_meet')->onDelete('cascade');     

            $table->timestamps();
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
