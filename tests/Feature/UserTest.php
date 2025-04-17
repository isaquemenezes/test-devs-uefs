<?php
namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_user()
    {
        $response = $this->postJson('/api/users', [
            'name' => 'Hiro',

        ]);

        $response->assertStatus(201)
                ->assertJsonStructure([
                    'id',
                    'name',
                    'created_at',
                    'updated_at'
                ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Hiro'
        ]);
    }

    /** @test */
    public function it_can_list_users()
    {
        User::factory()->count(3)->create();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    /** @test */
    public function it_can_show_a_single_user()
    {
        $user = User::factory()->create();

        $response = $this->getJson("/api/users/{$user->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $user->id
                 ]);
    }

    /** @test */
    public function it_can_update_a_user()
    {
        $user = User::factory()->create();

        $response = $this->putJson("/api/users/{$user->id}", [
            'name' => 'Update Nome'
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'name' => 'Update Nome'
                 ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Update Nome'
        ]);
    }

    /** @test */
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/api/users/{$user->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id
        ]);
    }
}
