<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;



class TagApiTest extends TestCase
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

    public function test_user_can_create_tag(): void
{
    $payload = ['name' => 'Laravel'];

    $response = $this->postJson('/api/tags', $payload);

    $response->assertStatus(201)
             ->assertJsonFragment(['name' => 'Laravel']);

    $this->assertDatabaseHas('tags', ['name' => 'Laravel']);
}

public function test_can_list_tags(): void
{
    \App\Models\Tag::factory()->create(['name' => 'PHP']);
    \App\Models\Tag::factory()->create(['name' => 'Vue']);

    $response = $this->getJson('/api/tags');

    $response->assertStatus(200)
             ->assertJsonFragment(['name' => 'PHP'])
             ->assertJsonFragment(['name' => 'Vue']);
}

public function test_user_can_update_tag(): void
{
    $tag = \App\Models\Tag::factory()->create(['name' => 'Old Name']);

    $response = $this->putJson("/api/tags/{$tag->id}", ['name' => 'New Name']);

    $response->assertStatus(200)
             ->assertJsonFragment(['name' => 'New Name']);

    $this->assertDatabaseHas('tags', ['id' => $tag->id, 'name' => 'New Name']);
}

public function test_user_can_delete_tag(): void
{
    $tag = \App\Models\Tag::factory()->create();

    $response = $this->deleteJson("/api/tags/{$tag->id}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('tags', ['id' => $tag->id]);
}


}
