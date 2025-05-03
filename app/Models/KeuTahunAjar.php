<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     schema="TahunAjar",
 *     type="object",
 *     required={"tahun", "semester"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="tahun", type="string", example="2023/2024"),
 *     @OA\Property(property="semester", type="string", enum={"Ganjil", "Genap"}, example="Ganjil"),
 *     @OA\Property(property="is_aktif", type="boolean", example=true),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class KeuTahunAjar extends Model
{
    protected $table = 'keu_tahun_ajar';
    protected $fillable = ['tahun', 'semester', 'aktif'];
}

