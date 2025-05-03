<?php

namespace App\Http\Controllers;

use App\Models\JenisTagihan;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Jenis Tagihan",
 *     description="Manajemen jenis-jenis tagihan mahasiswa"
 * )
 */
/**
 * @OA\Schema(
 *     schema="JenisTagihan",
 *     type="object",
 *     required={"nama_jenis_tagihan"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nama_jenis_tagihan", type="string", example="UKT"),
 *     @OA\Property(property="deskripsi_tagihan", type="string", example="Uang Kuliah Tunggal"),
 *     @OA\Property(property="is_active", type="boolean", example=true),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class JenisTagihanController extends Controller
{
 /**
 * @OA\Get(
 *     path="/api/keuangan/jenis-tagihan",
 *     tags={"Jenis Tagihan"},
 *     summary="Ambil semua jenis tagihan",
 *     @OA\Response(
 *         response=200,
 *         description="Berhasil",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/JenisTagihan")
 *         )
 *     )
 * )
 */
    public function index()
    {
        return response()->json(JenisTagihan::all());
    }

    /**
     * @OA\Post(
     *     path="/api/keuangan/jenis-tagihan",
     *     tags={"Jenis Tagihan"},
     *     summary="Tambah jenis tagihan baru",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama_jenis_tagihan"},
     *             @OA\Property(property="nama_jenis_tagihan", type="string", example="UKT"),
     *             @OA\Property(property="deskripsi_tagihan", type="string", example="Uang Kuliah Tunggal"),
     *             @OA\Property(property="is_active", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Berhasil dibuat",
     *         @OA\JsonContent(ref="#/components/schemas/JenisTagihan")
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
            'nama_jenis_tagihan' => 'required|string|max:100|unique:jenis_tagihan',
            'deskripsi_tagihan' => 'nullable|string',
            'is_active' => 'sometimes|boolean'
        ]);

        return response()->json(JenisTagihan::create($data), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/keuangan/jenis-tagihan/{id}",
     *     tags={"Jenis Tagihan"},
     *     summary="Detail jenis tagihan",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Data ditemukan",
     *         @OA\JsonContent(ref="#/components/schemas/JenisTagihan")
     *     ),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function show($id)
    {
        return response()->json(JenisTagihan::findOrFail($id));
    }

    /**
     * @OA\Put(
     *     path="/api/keuangan/jenis-tagihan/{id}",
     *     tags={"Jenis Tagihan"},
     *     summary="Update jenis tagihan",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="nama_jenis_tagihan", type="string"),
     *             @OA\Property(property="deskripsi_tagihan", type="string"),
     *             @OA\Property(property="is_active", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Data diperbarui",
     *         @OA\JsonContent(ref="#/components/schemas/JenisTagihan")
     *     ),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function update(Request $request, $id)
    {
        $tagihan = JenisTagihan::findOrFail($id);
        $data = $request->validate([
            'nama_jenis_tagihan' => 'sometimes|string|max:100|unique:jenis_tagihan,nama_jenis_tagihan,'.$id,
            'deskripsi_tagihan' => 'nullable|string',
            'is_active' => 'sometimes|boolean'
        ]);

        $tagihan->update($data);
        return response()->json($tagihan);
    }

    /**
     * @OA\Delete(
     *     path="/api/keuangan/jenis-tagihan/{id}",
     *     tags={"Jenis Tagihan"},
     *     summary="Hapus jenis tagihan",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Data dihapus",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Data dihapus")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function destroy($id)
    {
        $tagihan = JenisTagihan::findOrFail($id);
        $tagihan->delete();
        return response()->json(['message' => 'Data dihapus']);
    }
}