<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;


/**
 * @OA\Tag(
 *     name="Tags",
 *     description="Gerenciamento de tags"
 * )
 */
class TagController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/tags",
     *     tags={"Tags"},
     *     summary="Listar todas as tags",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de tags",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Tag"))
     *     )
     * )
     */
    public function index()
    {
        return Tag::all();
    }

     /**
     * @OA\Post(
     *     path="/api/tags",
     *     tags={"Tags"},
     *     summary="Criar uma nova tag",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="laravel")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Tag criada com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Tag")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:tags,name|max:255',
        ]);

        return Tag::create($data);
    }

    /**
     * @OA\Get(
     *     path="/api/tags/{id}",
     *     tags={"Tags"},
     *     summary="Buscar tag por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tag encontrada",
     *         @OA\JsonContent(ref="#/components/schemas/Tag")
     *     )
     * )
     */
    public function show(Tag $tag)
    {
        return $tag->load('posts');
    }

    /**
     * @OA\Put(
     *     path="/api/tags/{id}",
     *     tags={"Tags"},
     *     summary="Atualizar uma tag",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="php")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tag atualizada com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Tag")
     *     )
     * )
     */
    public function update(Request $request, Tag $tag)
    {
        $data = $request->validate([
            'name' => 'required|unique:tags,name,' . $tag->id,
        ]);

        $tag->update($data);

        return $tag;
    }

    /**
     * @OA\Delete(
     *     path="/api/tags/{id}",
     *     tags={"Tags"},
     *     summary="Remover uma tag",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Tag removida com sucesso"
     *     )
     * )
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return response()->json(null, 204);
    }



}
