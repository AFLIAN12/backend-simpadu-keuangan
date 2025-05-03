<?php
use App\Http\Controllers\StatusPembayaranController;
use App\Http\Controllers\JenisTagihanController;
use App\Http\Controllers\KeringananController;
use App\Http\Controllers\KeuLogAktivitasController;
use App\Http\Controllers\KeuPembayaranController;
use App\Http\Controllers\KeuTagihanController;
use App\Http\Controllers\KeuTahunAjaraController;

Route::prefix('keuangan')->group(function () {
    Route::apiResource('status-pembayaran', StatusPembayaranController::class);
    Route::get('status-pembayaran-detail', [StatusPembayaranController::class, 'indexWithKategori']);
    Route::apiResource('jenis-tagihan', JenisTagihanController::class);
    Route::apiResource('keringanan', KeringananController::class);
    Route::apiResource('log-aktivitas', KeuLogAktivitasController::class);
    Route::apiResource('pembayaran', KeuPembayaranController::class);
    Route::apiResource('tagihan', KeuTagihanController::class);
    Route::apiResource('tahun-ajaran', KeuTahunAjarController::class);
});
