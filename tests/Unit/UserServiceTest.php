<?php

namespace Tests\Unit;

use App\Services\UserService;
use App\Models\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class UserServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_create_user()
    {
        $service = new UserService();
        $data = [
            'name' => 'Teste'

        ];

        $user = $service->create($data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('Teste', $user->name);
    }
}
