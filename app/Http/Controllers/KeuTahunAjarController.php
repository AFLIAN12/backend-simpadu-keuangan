<?php

namespace App\Http\Controllers;

use App\Models\KeuTahunAjar;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="KeuTahunAjar",
 *     type="object",
 *     required={"tahun_ajaran", "semester"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="tahun_ajaran", type="string", example="2023/2024"),
 *     @OA\Property(property="semester", type="string", enum={"Ganjil", "Genap"}, example="Ganjil"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class KeuTahunAjarController extends Controller
{
    /**
 * @OA\Get(
 *     path="/api/keu-tahun-ajar",
 *     tags={"Keu Tahun Ajar"},
 *     summary="Get list of academic years",
 *     @OA\Response(
 *         response=200,
 *         description="Success",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/KeuTahunAjar")
 *         )
 *     )
 * )
 */
    public function index()
    {
        return response()->json(KeuTahunAjar::all());
    }

    /**
 * @OA\Post(
 *     path="/api/keu-tahun-ajar",
 *     tags={"Keu Tahun Ajar"},
 *     summary="Membuat tahun ajaran baru",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Data tahun ajaran",
 *         @OA\JsonContent(
 *             required={"tahun_ajaran","semester"},
 *             @OA\Property(property="tahun_ajaran", type="string", example="2023/2024"),
 *             @OA\Property(property="semester", type="string", example="Ganjil")
 *         )
 *     ),
 *     @OA\Response(response=201, description="Data berhasil dibuat")
 * )
 */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tahun_ajaran' => 'required|string|max:255',
            'semester' => 'required|string|in:Ganjil,Genap',
        ]);

        $tahunAjar = KeuTahunAjar::create($data);
        return response()->json($tahunAjar, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/keu-tahun-ajar/{id}",
     *     operationId="getTahunAjarById",
     *     tags={"Keu Tahun Ajar"},
     *     summary="Mendapatkan detail tahun ajaran",
     *     description="Mengembalikan data detail tahun ajaran berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID tahun ajaran",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil",
     *         @OA\JsonContent(ref="#/components/schemas/KeuTahunAjar")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data tidak ditemukan"
     *     )
     * )
     */
    public function show($id)
    {
        $tahunAjar = KeuTahunAjar::findOrFail($id);
        return response()->json($tahunAjar);
    }

    /**
     * @OA\Put(
     *     path="/api/keu-tahun-ajar/{id}",
     *     operationId="updateTahunAjar",
     *     tags={"Keu Tahun Ajar"},
     *     summary="Memperbarui tahun ajaran",
     *     description="Memperbarui data tahun ajaran berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID tahun ajaran yang akan diperbarui",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Data tahun ajaran yang diperbarui",
     *         @OA\JsonContent(
     *             @OA\Property(property="tahun_ajaran", type="string", example="2023/2024"),
     *             @OA\Property(property="semester", type="string", example="Ganjil")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Data berhasil diperbarui",
     *         @OA\JsonContent(ref="#/components/schemas/KeuTahunAjar")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data tidak ditemukan"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasi gagal"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $tahunAjar = KeuTahunAjar::findOrFail($id);
        
        $data = $request->validate([
            'tahun_ajaran' => 'sometimes|required|string|max:255',
            'semester' => 'sometimes|required|string|in:Ganjil,Genap',
        ]);

        $tahunAjar->update($data);
        return response()->json($tahunAjar);
    }

    /**
     * @OA\Delete(
     *     path="/api/keu-tahun-ajar/{id}",
     *     operationId="deleteTahunAjar",
     *     tags={"Keu Tahun Ajar"},
     *     summary="Menghapus tahun ajaran",
     *     description="Menghapus data tahun ajaran berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID tahun ajaran yang akan dihapus",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Data berhasil dihapus"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data tidak ditemukan"
     *     )
     * )
     */
    public function destroy($id)
    {
        $tahunAjar = KeuTahunAjar::findOrFail($id);
        $tahunAjar->delete();
        return response()->json(null, 204);
    }
}