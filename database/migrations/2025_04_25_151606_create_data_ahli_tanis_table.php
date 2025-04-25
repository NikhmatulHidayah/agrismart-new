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
        Schema::create('data_ahli_tani', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('certificate');
            $table->date('expired_certificate');
            $table->integer('price');
            $table->integer('yoe'); 
            $table->string('alumni');
            $table->foreignId('id_ahli_tani')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_ahli_tani');
    }
};
