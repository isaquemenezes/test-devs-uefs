<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\JsonResponse;


/**
 * @OA\Tag(
 *     name="Posts",
 *     description="Gerenciamento de posts"
 * )
 */
class PostController extends Controller
{
     /**
     * @OA\Get(
     *     path="/api/posts",
     *     tags={"Posts"},
     *     summary="Listar todos os posts",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de posts",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Post"))
     *     )
     * )
     */
    public function index()
    {
        return Post::with('user')->get();
    }

    /**
     * @OA\Post(
     *     path="/api/posts",
     *     tags={"Posts"},
     *     summary="Criar um novo post",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id", "title", "body"},
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="Título de exemplo"),
     *             @OA\Property(property="body", type="string", example="Conteúdo do post")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Post criado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     )
     * )
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        $post = Post::create($request->validated());

        return response()->json($post, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/posts/{post}",
     *     tags={"Posts"},
     *     summary="Exibir um post específico",
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalhes do post",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     )
     * )
     */
    public function show(Post $post)
    {
        return $post->load([
            'user',
            'tags'
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/posts/{post}",
     *     tags={"Posts"},
     *     summary="Atualizar um post existente",
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Novo título"),
     *             @OA\Property(property="body", type="string", example="Novo conteúdo do post")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post atualizado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     )
     * )
     */
    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {

        $post->update($request->validated());

        return response()->json($post);
    }

     /**
     * @OA\Delete(
     *     path="/api/posts/{post}",
     *     tags={"Posts"},
     *     summary="Excluir um post",
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Post excluído com sucesso"
     *     )
     * )
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json(null, 204);
    }

    /**
     * @OA\Post(
     *     path="/api/posts/{post}/tags",
     *     tags={"Posts"},
     *     summary="Sincronizar tags de um post",
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"tags"},
     *             @OA\Property(
     *                 property="tags",
     *                 type="array",
     *                 @OA\Items(type="integer", example=1)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tags sincronizadas com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     )
     * )
     */
    public function syncTags(Request $request, Post $post)
    {
        $data = $request->validate([
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $post->tags()->sync($data['tags']);

        return $post->load('tags');
    }
}
