<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('jenis_tagihans', function (Blueprint $table) {
        $table->id(); // otomatis jadi id
        $table->string('nama_jenis_tagihan', 100);
        $table->text('deskripsi_tagihan')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_tagihans');
    }
};
