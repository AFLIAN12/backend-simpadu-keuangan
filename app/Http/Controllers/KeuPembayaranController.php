<?php

namespace App\Http\Controllers;

use App\Models\KeuPembayaran;
use Illuminate\Http\Request;

class KeuPembayaranController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/keuangan/pembayaran",
     *     tags={"Pembayaran"},
     *     summary="Ambil semua data pembayaran",
     *     @OA\Response(response=200, description="Berhasil mengambil data")
     * )
     */
    public function index()
    {
        return KeuPembayaran::with('kategoriUkt')->get();
    }

    /**
     * @OA\Post(
     *     path="/api/keuangan/pembayaran",
     *     tags={"Pembayaran"},
     *     summary="Simpan data pembayaran",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nim", "kategori_ukt_id", "tanggal_pembayaran", "jumlah", "metode_pembayaran"},
     *             @OA\Property(property="nim", type="string"),
     *             @OA\Property(property="kategori_ukt_id", type="integer"),
     *             @OA\Property(property="tanggal_pembayaran", type="string", format="date"),
     *             @OA\Property(property="jumlah", type="number", format="float"),
     *             @OA\Property(property="metode_pembayaran", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Berhasil disimpan")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nim' => 'required|string|max:20',
            'kategori_ukt_id' => 'required|integer',
            'tanggal_pembayaran' => 'required|date',
            'jumlah' => 'required|numeric',
            'metode_pembayaran' => 'required|string|max:50',
        ]);

        return KeuPembayaran::create($data);
    }

    /**
     * @OA\Get(
     *     path="/api/keuangan/pembayaran/{id}",
     *     tags={"Pembayaran"},
     *     summary="Lihat detail pembayaran",
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Detail ditemukan"),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function show($id)
    {
        return KeuPembayaran::with('kategoriUkt')->findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/api/keuangan/pembayaran/{id}",
     *     tags={"Pembayaran"},
     *     summary="Update pembayaran",
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="nim", type="string"),
     *             @OA\Property(property="kategori_ukt_id", type="integer"),
     *             @OA\Property(property="tanggal_pembayaran", type="string", format="date"),
     *             @OA\Property(property="jumlah", type="number", format="float"),
     *             @OA\Property(property="metode_pembayaran", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Berhasil diupdate")
     * )
     */
    public function update(Request $request, $id)
    {
        $pembayaran = KeuPembayaran::findOrFail($id);

        $data = $request->validate([
            'nim' => 'sometimes|string|max:20',
            'kategori_ukt_id' => 'sometimes|integer',
            'tanggal_pembayaran' => 'sometimes|date',
            'jumlah' => 'sometimes|numeric',
            'metode_pembayaran' => 'sometimes|string|max:50',
        ]);

        $pembayaran->update($data);

        return response()->json(['message' => 'Data pembayaran diperbarui']);
    }

    /**
     * @OA\Delete(
     *     path="/api/keuangan/pembayaran/{id}",
     *     tags={"Pembayaran"},
     *     summary="Hapus pembayaran",
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Data dihapus"),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function destroy($id)
    {
        $pembayaran = KeuPembayaran::findOrFail($id);
        $pembayaran->delete();

        return response()->json(['message' => 'Data pembayaran berhasil dihapus']);
    }
}

