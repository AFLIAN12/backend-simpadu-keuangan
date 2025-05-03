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
        Schema::create('keu_tahun_ajaran', function (Blueprint $table) {
            $table->id();
            $table->string('tahun');
            $table->enum('semester', ['Ganjil', 'Genap']);
            $table->boolean('aktif')->default(0);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keu_tahun_ajarans');
    }
};
