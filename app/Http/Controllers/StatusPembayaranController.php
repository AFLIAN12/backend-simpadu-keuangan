<?php

namespace App\Http\Controllers;

use App\Models\StatusPembayaran;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Status Pembayaran",
 *     description="Manajemen status pembayaran mahasiswa"
 * )
 */
/**
 * @OA\Info(
 *     title="SIMPADU Keuangan API",
 *     version="1.0.0"
 * )
 */
class StatusPembayaranController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/keuangan/status-pembayaran",
     *     tags={"Status Pembayaran"},
     *     summary="Ambil semua status pembayaran",
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/StatusPembayaran")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return response()->json(StatusPembayaran::all());
    }

    /**
     * @OA\Get(
     *     path="/api/keuangan/status-pembayaran-detail",
     *     tags={"Status Pembayaran"},
     *     summary="Ambil semua status pembayaran lengkap dengan data UKT",
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/StatusPembayaranDetail")
     *         )
     *     )
     * )
     */
    public function indexWithKategori()
    {
        $data = StatusPembayaran::with('kategoriUkt')->get();
        return response()->json($data);
    }

    /**
     * @OA\Post(
     *     path="/api/keuangan/status-pembayaran",
     *     tags={"Status Pembayaran"},
     *     summary="Buat status pembayaran baru",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nim","kategori_ukt_id","status"},
     *             @OA\Property(property="nim", type="string", example="220501001"),
     *             @OA\Property(property="kategori_ukt_id", type="integer", example=1),
     *             @OA\Property(property="status", type="string", enum={"Lunas","Belum Bayar"}, example="Lunas"),
     *             @OA\Property(property="tanggal_bayar", type="string", format="date-time", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Data berhasil dibuat",
     *         @OA\JsonContent(ref="#/components/schemas/StatusPembayaran")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasi gagal"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nim' => 'required|string|max:20|exists:mahasiswa,nim',
            'kategori_ukt_id' => 'required|integer|exists:kategori_ukt,id',
            'status' => 'required|in:Lunas,Belum Bayar',
            'tanggal_bayar' => 'nullable|date'
        ]);

        return response()->json(StatusPembayaran::create($data), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/keuangan/status-pembayaran/{id}",
     *     tags={"Status Pembayaran"},
     *     summary="Detail status pembayaran",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil",
     *         @OA\JsonContent(ref="#/components/schemas/StatusPembayaran")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data tidak ditemukan"
     *     )
     * )
     */
    public function show($id)
    {
        return response()->json(StatusPembayaran::with('kategoriUkt')->findOrFail($id));
    }

    /**
     * @OA\Put(
     *     path="/api/keuangan/status-pembayaran/{id}",
     *     tags={"Status Pembayaran"},
     *     summary="Update status pembayaran",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", enum={"Lunas","Belum Bayar"}),
     *             @OA\Property(property="tanggal_bayar", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Data berhasil diperbarui",
     *         @OA\JsonContent(ref="#/components/schemas/StatusPembayaran")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data tidak ditemukan"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $status = StatusPembayaran::findOrFail($id);
        $data = $request->validate([
            'status' => 'sometimes|in:Lunas,Belum Bayar',
            'tanggal_bayar' => 'nullable|date'
        ]);

        $status->update($data);
        return response()->json($status);
    }

    /**
     * @OA\Delete(
     *     path="/api/keuangan/status-pembayaran/{id}",
     *     tags={"Status Pembayaran"},
     *     summary="Hapus status pembayaran",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Data berhasil dihapus",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Data berhasil dihapus")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data tidak ditemukan"
     *     )
     * )
     */
    public function destroy($id)
    {
        $status = StatusPembayaran::findOrFail($id);
        $status->delete();
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}