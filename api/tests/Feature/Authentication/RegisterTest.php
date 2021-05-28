<?php

namespace Tests\Feature\Authentication;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register(): void
    {
        $email = $this->faker->email;

        $response = $this->post('/api/auth/register', [
            'name'                  => 'John doe',
            'email'                 => $email,
            'password'              => 'secret1234',
            'password_confirmation' => 'secret1234'
        ]);

        $response->assertJson(
            [
                'token' => true
            ]
        );

        self::assertSame(User::query()->where('email', $email)->count(), 1);

        $response->assertStatus(201);
    }
}
