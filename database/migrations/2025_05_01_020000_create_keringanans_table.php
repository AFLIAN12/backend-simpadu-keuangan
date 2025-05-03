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
        Schema::create('keringanans', function (Blueprint $table) {
            $table->id('id_keringanan');
            $table->string('nim', 20);
            $table->unsignedBigInteger('id_tahun');
            $table->string('jenis_keringanan', 50);
            $table->decimal('jumlah_potongan', 12, 2);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keringanans');
    }
};
