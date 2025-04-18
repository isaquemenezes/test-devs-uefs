<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     schema="Post",
 *     title="Post",
 *     description="Modelo de um post",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Título de exemplo"),
 *     @OA\Property(property="body", type="string", example="Conteúdo do post"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-04-17T00:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-04-17T00:00:00Z")
 * )
 */
class PostSchema {}
