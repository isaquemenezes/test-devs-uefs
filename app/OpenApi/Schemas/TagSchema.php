<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     schema="Tag",
 *     title="Tag",
 *     description="Modelo de uma tag",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Laravel"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-04-17T00:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-04-17T00:00:00Z")
 * )
 */
class TagSchema {}
