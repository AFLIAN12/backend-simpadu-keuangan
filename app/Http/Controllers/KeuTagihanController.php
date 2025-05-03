<?php

namespace App\Http\Controllers;

use App\Models\KeuTagihan;
use Illuminate\Http\Request;

class KeuTagihanController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/keu-tagihan",
     *     tags={"Keu Tagihan"},
     *     summary="Menampilkan semua data tagihan",
     *     @OA\Response(response=200, description="Berhasil mengambil data")
     * )
     */
    public function index()
    {
        return response()->json(KeuTagihan::all());
    }

    /**
     * @OA\Post(
     *     path="/api/keu-tagihan",
     *     tags={"Keu Tagihan"},
     *     summary="Membuat tagihan baru",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_mahasiswa", "id_jenis_tagihan", "jumlah", "id_tahun_ajar"},
     *             @OA\Property(property="id_mahasiswa", type="integer"),
     *             @OA\Property(property="id_jenis_tagihan", type="integer"),
     *             @OA\Property(property="jumlah", type="number"),
     *             @OA\Property(property="id_tahun_ajar", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Berhasil disimpan")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_mahasiswa' => 'required|integer',
            'id_jenis_tagihan' => 'required|integer',
            'jumlah' => 'required|numeric',
            'id_tahun_ajar' => 'required|integer',
        ]);
        $tagihan = KeuTagihan::create($data);
        return response()->json($tagihan, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/keu-tagihan/{id}",
     *     tags={"Keu Tagihan"},
     *     summary="Menampilkan detail tagihan",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Berhasil")
     * )
     */
    public function show($id)
    {
        return response()->json(KeuTagihan::findOrFail($id));
    }

    /**
     * @OA\Put(
     *     path="/api/keu-tagihan/{id}",
     *     tags={"Keu Tagihan"},
     *     summary="Memperbarui data tagihan",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="jumlah", type="number"),
     *             @OA\Property(property="id_jenis_tagihan", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Berhasil diperbarui")
     * )
     */
    public function update(Request $request, $id)
    {
        $tagihan = KeuTagihan::findOrFail($id);
        $tagihan->update($request->all());
        return response()->json($tagihan);
    }

    /**
     * @OA\Delete(
     *     path="/api/keu-tagihan/{id}",
     *     tags={"Keu Tagihan"},
     *     summary="Menghapus tagihan",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Berhasil dihapus")
     * )
     */
    public function destroy($id)
    {
        KeuTagihan::destroy($id);
        return response()->json(null, 204);
    }
}