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
        Schema::create('keu_tagihan', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 20);
            $table->foreignId('jenis_tagihan_id')->constrained('keu_jenis_tagihan');
            $table->foreignId('tahun_ajaran_id')->constrained('keu_tahun_ajaran');
            $table->decimal('jumlah', 12, 2);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keu_tagihans');
    }
};
