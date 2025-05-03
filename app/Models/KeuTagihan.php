<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     schema="KeuTagihan",
 *     type="object",
 *     required={"nim", "id_tahun", "id_komponen", "jumlah"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nim", type="string", example="220501001"),
 *     @OA\Property(property="id_tahun", type="integer", example=2023),
 *     @OA\Property(property="id_komponen", type="integer", example=1),
 *     @OA\Property(property="jumlah", type="number", format="float", example=1500000),
 *     @OA\Property(property="status", type="string", example="belum_lunas"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class KeuTagihan extends Model
{
    protected $table = 'keu_tagihan';
    protected $fillable = ['nim', 'jenis_tagihan_id', 'tahun_ajaran_id', 'jumlah'];
}

