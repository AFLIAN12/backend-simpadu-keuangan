<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     schema="LogAktivitas",
 *     type="object",
 *     required={"user_id", "aktivitas"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=123),
 *     @OA\Property(property="aktivitas", type="string", example="Login ke sistem"),
 *     @OA\Property(property="ip_address", type="string", example="192.168.1.1"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-01T08:30:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-01T08:30:00Z")
 * )
 */
class KeuLogAktivitas extends Model
{
    protected $table = 'keu_log_aktivitas';
    protected $primaryKey = 'id_log';
    public $timestamps = false;

    protected $fillable = [
        'id_pegawai',
        'aktivitas',
        'entitas',
        'entitas_id',
        'tgl_log',
    ];
}
