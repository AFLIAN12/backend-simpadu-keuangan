<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     schema="StatusPembayaran",
 *     type="object",
 *     required={"kode", "nama"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="kode", type="string", example="LUNAS"),
 *     @OA\Property(property="nama", type="string", example="Lunas"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-01T08:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-01T08:00:00Z")
 * )
 */
class StatusPembayaran extends Model
{
    protected $fillable = ['nim', 'kategori_ukt_id', 'status'];

    // Jangan pakai relasi mahasiswa untuk microservice
    public function kategoriUkt()
    {
        return $this->belongsTo(KategoriUKT::class, 'kategori_ukt_id');
    }
}

