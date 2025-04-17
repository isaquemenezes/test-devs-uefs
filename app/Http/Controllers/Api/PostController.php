<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\JsonResponse;


class PostController extends Controller
{
    public function index()
    {
        return Post::with('user')->get();
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        $post = Post::create($request->validated());

        return response()->json($post, 201);
    }

    /*
    * Ver as Tags de um Post, juntamente com os users
    *
    */

    public function show(Post $post)
    {
        return $post->load([
            'user',
            'tags'
        ]);
    }


    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {

        $post->update($request->validated());

        return response()->json($post);
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json(null, 204);
    }

    /* Associar Tags a um Post
    *
    *
    *
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
