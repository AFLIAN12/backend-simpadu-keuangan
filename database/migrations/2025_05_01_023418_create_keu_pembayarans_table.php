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
        Schema::create('keu_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 20);
            $table->foreignId('kategori_ukt_id')->constrained('kategori_ukt');
            $table->date('tanggal_pembayaran');
            $table->decimal('jumlah', 12, 2);
            $table->string('metode_pembayaran');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keu_pembayarans');
    }
};
