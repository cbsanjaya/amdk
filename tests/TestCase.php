<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    protected function apiLogin($user = null)
    {
        $user = $user ?: $this->create('App\User');

        $this->actingAs($user, 'api');

        return $this;
    }

    protected function create($class, $attributes = [], $times = null)
    {
        return factory($class, $times)->create($attributes);
    }

    protected function make($class, $attributes = [], $times = null)
    {
        return factory($class, $times)->make($attributes);
    }

}
