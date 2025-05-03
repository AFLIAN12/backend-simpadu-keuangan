<?php

namespace App\Http\Controllers;

use App\Models\KeuLogAktivitas;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Log Aktivitas",
 *     description="Manajemen log aktivitas sistem"
 * )
 */
class KeuLogAktivitasController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/keuangan/log-aktivitas",
     *     tags={"Log Aktivitas"},
     *     summary="Ambil semua data log aktivitas",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/LogAktivitas")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return response()->json(KeuLogAktivitas::with('pegawai')->get());
    }

    /**
     * @OA\Post(
     *     path="/api/keuangan/log-aktivitas",
     *     tags={"Log Aktivitas"},
     *     summary="Buat log aktivitas baru",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_pegawai","aktivitas","entitas","entitas_id"},
     *             @OA\Property(property="id_pegawai", type="integer", example=1),
     *             @OA\Property(property="aktivitas", type="string", example="Menambah data mahasiswa"),
     *             @OA\Property(property="entitas", type="string", example="Mahasiswa"),
     *             @OA\Property(property="entitas_id", type="integer", example=1),
     *             @OA\Property(property="data_lama", type="string", nullable=true),
     *             @OA\Property(property="data_baru", type="string", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *         @OA\JsonContent(ref="#/components/schemas/LogAktivitas")
     *     ),
     *     @OA\Response(response=422, description="Validasi gagal")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pegawai' => 'required|integer|exists:pegawai,id',
            'aktivitas' => 'required|string|max:100',
            'entitas' => 'required|string|max:50',
            'entitas_id' => 'required|integer',
            'data_lama' => 'nullable|json',
            'data_baru' => 'nullable|json'
        ]);

        return response()->json(KeuLogAktivitas::create($data), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/keuangan/log-aktivitas/{id}",
     *     tags={"Log Aktivitas"},
     *     summary="Detail log aktivitas",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/LogAktivitas")
     *     ),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function show($id)
    {
        return response()->json(KeuLogAktivitas::with('pegawai')->findOrFail($id));
    }

    /**
     * @OA\Delete(
     *     path="/api/keuangan/log-aktivitas/{id}",
     *     tags={"Log Aktivitas"},
     *     summary="Hapus log aktivitas",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Log dihapus",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Log dihapus")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function destroy($id)
    {
        $log = KeuLogAktivitas::findOrFail($id);
        $log->delete();
        return response()->json(['message' => 'Log dihapus']);
    }
}