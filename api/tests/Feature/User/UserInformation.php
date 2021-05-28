<?php

namespace Tests\Feature\User;

use App\Services\Authentication\AuthenticationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserInformation extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_authenticated_user(): void
    {
        $name = $this->faker->name;
        $email = $this->faker->email;
        $password = 'secret1234';

        $authenticationService = new AuthenticationService();
        $token = $authenticationService->register($name, $email, $password);

        $response = $this->getJson('/api/users/me', [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertJson(
            [
                'email' => true,
                'name' => true
            ]
        );
        $response->assertStatus(200);
    }
}
