<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetProducts()
    {
        $this->apiLogin();

        $product = $this->create('App\Entities\Product');

        $response = $this->getJson('/api/products');

        $response->assertOk()
            ->assertJsonFragment(
                ['id' => $product->id]
            );
    }
}
