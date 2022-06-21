<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\PersonalAccessToken;
use Tests\TestCase;

class UserTokenTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_request_for_a_user_token_via_api()
    {
        $input = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ];

        $response = Http::post(route('api.user-token'), $input);

        $this->assertDatabaseHas('users', $input);

        $user = PersonalAccessToken::findToken($response->body())->tokenable;

        $this->assertTrue($user->email === $input['email']);
        $this->assertTrue($user->name === $input['name']);
    }

    /** @test */
    public function it_can_login_the_dashboard_using_the_token()
    {
        $input = [
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
        ];

        $response = Http::post(route('api.user-token'), $input);

        $login = $this->post('/login', [
            'email' => $input['email'],
            'token' => $response->body(),
        ]);

        $login->assertSessionDoesntHaveErrors();

        $login->assertRedirect('/');
    }

    /** @test */
    public function it_cant_login_the_dashboard_using_a_wrong_token()
    {
        $input = [
            'name' => 'Juan Luna',
            'email' => 'juan.luna@example.com',
        ];

        Http::post(route('api.user-token'), $input);

        $login = $this->post('/login', [
            'email' => $input['email'],
            'token' => 'my-invalid-token',
        ]);

        $login->assertSessionHasErrors();
    }
}
