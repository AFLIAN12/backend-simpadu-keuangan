<?php

namespace App\Http\Controllers;

use App\Models\Keringanan;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Keringanan",
 *     description="Manajemen keringanan biaya"
 * )
 */
class KeringananController extends Controller
{
        /**
         * @OA\Get(
         *     path="/api/keringanan",
         *     @OA\Response(
         *         response=200,
         *         description="List of Keringanan",
         *         @OA\JsonContent(
         *             type="array",
         *             @OA\Items(ref="#/components/schemas/Keringanan")
         *         )
         *     )
         * )
         */
    public function index()
    {
        return response()->json(Keringanan::with(['mahasiswa', 'tahunAjar'])->get());
    }

    /**
     * @OA\Post(
     *     path="/api/keuangan/keringanan",
     *     tags={"Keringanan"},
     *     summary="Tambahkan data keringanan",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nim", "id_tahun", "jenis_keringanan", "jumlah_potongan"},
     *             @OA\Property(property="nim", type="string", example="220501001"),
     *             @OA\Property(property="id_tahun", type="integer", example=20242),
     *             @OA\Property(property="jenis_keringanan", type="string", enum={"Beasiswa", "Bantuan", "Lainnya"}, example="Beasiswa"),
     *             @OA\Property(property="jumlah_potongan", type="number", format="float", example=500000.00),
     *             @OA\Property(property="keterangan", type="string", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Data ditambahkan",
     *         @OA\JsonContent(ref="#/components/schemas/Keringanan")
     *     ),
     *     @OA\Response(response=422, description="Validasi gagal")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nim' => 'required|string|max:20|exists:mahasiswa,nim',
            'id_tahun' => 'required|integer|exists:tahun_ajar,id',
            'jenis_keringanan' => 'required|string|max:50',
            'jumlah_potongan' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string'
        ]);

        return response()->json(Keringanan::create($data), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/keuangan/keringanan/{id}",
     *     tags={"Keringanan"},
     *     summary="Detail keringanan",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/Keringanan")
     *     ),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function show($id)
    {
        return response()->json(Keringanan::with(['mahasiswa', 'tahunAjar'])->findOrFail($id));
    }

    /**
     * @OA\Put(
     *     path="/api/keuangan/keringanan/{id}",
     *     tags={"Keringanan"},
     *     summary="Update data keringanan",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="jenis_keringanan", type="string"),
     *             @OA\Property(property="jumlah_potongan", type="number"),
     *             @OA\Property(property="keterangan", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Data diperbarui",
     *         @OA\JsonContent(ref="#/components/schemas/Keringanan")
     *     ),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function update(Request $request, $id)
    {
        $keringanan = Keringanan::findOrFail($id);
        $data = $request->validate([
            'jenis_keringanan' => 'sometimes|string|max:50',
            'jumlah_potongan' => 'sometimes|numeric|min:0',
            'keterangan' => 'nullable|string'
        ]);

        $keringanan->update($data);
        return response()->json($keringanan);
    }

    /**
     * @OA\Delete(
     *     path="/api/keuangan/keringanan/{id}",
     *     tags={"Keringanan"},
     *     summary="Hapus data keringanan",
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
        $keringanan = Keringanan::findOrFail($id);
        $keringanan->delete();
        return response()->json(['message' => 'Data dihapus']);
    }
}