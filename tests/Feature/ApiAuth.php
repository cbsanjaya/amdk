<?php

namespace Tests\Feature;

trait ApiAuth
{
    protected $user;

    protected function setUp()
    {
        parent::setUp();

        $this->user = $this->login();
    }
}
