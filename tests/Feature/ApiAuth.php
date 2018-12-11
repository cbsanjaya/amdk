<?php

namespace Tests\Feature;

trait ApiAuth
{
    protected function setUp()
    {
        parent::setUp();
        
        $this->login();
    }
}
