<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     schema="User",
 *     title="Usuário",
 *     description="Informações do usuário",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="João da Silva"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-04-17T00:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-04-17T00:00:00Z")
 * )
 */
class UserSchema {}
