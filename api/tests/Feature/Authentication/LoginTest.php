<?php

namespace Tests\Feature\Authentication;

use App\Models\User;
use App\Services\Authentication\AuthenticationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use WithFaker;

    /**
     * Test a successful login
     *
     * @return void
     */
    public function test_success_login(): void
    {
        $email      = $this->faker->email;
        $password   = 'secret1234';

        $authenticationService = new AuthenticationService();
        $authenticationService->register($this->faker->name, $email, $password);

        $response = $this->postJson('/api/auth/login', [
            'email'     => $email,
            'password'  => $password
        ]);

        $response->assertJson(
            [
                'token' => true
            ]
        );
        $response->assertStatus(200);
    }

    /**
     * Test login with wrong credentials
     *
     * @return void
     */
    public function test_invalid_credentials_on_login(): void{
        $email      = $this->faker->email;
        $password   = 'secret1234';

        $authenticationService = new AuthenticationService();
        $authenticationService->register($this->faker->name, $email, $password);

        $response = $this->postJson('/api/auth/login', [
            'email'     => $email,
            'password'  => 'wrong password'
        ]);

        $response->assertJson(
            [
                'message' => true,
                'errors' => [
                    'login' => true
                ]
            ]
        );
        $response->assertStatus(401);
    }
}
