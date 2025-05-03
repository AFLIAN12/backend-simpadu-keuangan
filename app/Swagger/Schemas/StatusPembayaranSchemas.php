<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="StatusPembayaranDetail",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="kode", type="string", example="LUNAS"),
 *     @OA\Property(property="nama", type="string", example="Lunas"),
 *     @OA\Property(
 *         property="kategori",
 *         type="object",
 *         @OA\Property(property="id", type="integer", example=10),
 *         @OA\Property(property="nama", type="string", example="Akademik")
 *     ),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-01T08:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-01T08:00:00Z")
 * )
 */
class StatusPembayaranSchemas {}
