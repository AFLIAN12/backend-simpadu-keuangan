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
        Schema::create('status_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 20); // relasi ke mahasiswa
            $table->foreignId('kategori_ukt_id')->constrained('kategori_ukt');
            $table->enum('status', ['Lunas', 'Belum Bayar']);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_pembayarans');
    }
};
