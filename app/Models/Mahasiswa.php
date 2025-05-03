<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Mahasiswa",
 *     type="object",
 *     title="Mahasiswa",
 *     required={"id", "nama"},
 *     @OA\Property(property="id", type="integer", example=123),
 *     @OA\Property(property="nama", type="string", example="Budi Santoso"),
 *     @OA\Property(property="nim", type="string", example="1234567890"),
 *     @OA\Property(property="email", type="string", example="budi@example.com"),
 * )
 */
class Mahasiswa extends Model
{
    // ...
}
