<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::with('user')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post = Post::create($data);

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


    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'string|max:255',
            'body' => 'string',
        ]);

        $post->update($data);

        return response()->json($post);
    }

    public function destroy(Post $post)
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
