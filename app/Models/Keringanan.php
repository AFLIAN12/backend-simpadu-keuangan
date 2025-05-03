<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Keringanan",
 *     type="object",
 *     required={"nim", "jenis_keringanan", "jumlah_potongan"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nim", type="string", example="220501001"),
 *     @OA\Property(property="id_tahun", type="integer", example=2023),
 *     @OA\Property(
 *         property="jenis_keringanan",
 *         type="string",
 *         enum={"Beasiswa", "Bantuan", "Lainnya"},
 *         example="Beasiswa"
 *     ),
 *     @OA\Property(property="jumlah_potongan", type="number", format="float", example=500000),
 *     @OA\Property(property="keterangan", type="string", nullable=true),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time"),
 *     @OA\Property(property="mahasiswa", ref="#/components/schemas/Mahasiswa"),
 *     @OA\Property(property="tahun_ajar", ref="#/components/schemas/TahunAjar")
 * )
 */
class Keringanan extends Model
{
    // Model implementation
}