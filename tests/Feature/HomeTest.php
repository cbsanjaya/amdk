<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase
{
    public function testCannotAccessHomePageIfNotAuthenticated()
    {
        $response = $this->get('/home');
        $response->assertRedirect('/login');
    }

    public function testCanAccessHomePageIfNotAuthenticated()
    {
        $user = $this->create('App\User');

        $this->actingAs($user, 'api');

        $response = $this->get('/home');
        $response->assertSuccessful();
    }
}
