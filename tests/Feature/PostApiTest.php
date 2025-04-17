<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Post;

class PostApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }



    public function test_user_can_create_post()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/posts', [
            'user_id' => $user->id,
            'title' => 'Meu Post',
            'body' => 'Conteúdo legal'
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'Meu Post']);
    }

    public function test_can_list_posts()
    {
        Post::factory()->count(3)->create();

        $response = $this->getJson('/api/posts');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_can_update_post()
    {
        $post = Post::factory()->create();

        $response = $this->putJson("/api/posts/{$post->id}", [
            'user_id' => $post->user_id,
            'title' => 'Post Atualizado',
            'body' => $post->body
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Post Atualizado']);
    }

    public function test_can_delete_post()
    {
        $post = Post::factory()->create();

        $response = $this->deleteJson("/api/posts/{$post->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }




}
