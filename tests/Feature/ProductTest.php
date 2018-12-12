<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductTest extends TestCase
{
    use ApiAuth;

    public function testGetProducts()
    {
        $product = $this->create('App\Entities\Product');

        $response = $this->getJson('/api/products');

        $response->assertOk()
            ->assertJsonFragment(
                ['id' => $product->id]
            );
    }

    public function testGetProduct()
    {
        $product = $this->create('App\Entities\Product');

        $response = $this->getJson('/api/products/'.$product->id);

        $response->assertOk()
            ->assertJson(
                ['id' => $product->id]
            );
    }

    public function testStoreProduct()
    {
        $product = $this->make('App\Entities\Product');

        $response = $this->postJson('/api/products', [
            'description' => $product->description,
            'unit'        => $product->unit,
            'cost_price'  => $product->cost_price,
            'price'       => $product->price,
            'tobuy'       => $product->tobuy,
            'tosell'      => $product->tosell,
            'raw'         => $product->raw,
        ]);

        $response->assertSuccessful()
            ->assertJson([
                'description' => $product->description,
                'unit'        => $product->unit,
                'cost_price'  => $product->cost_price,
                'price'       => $product->price,
                'tobuy'       => $product->tobuy,
                'tosell'      => $product->tosell,
                'raw'         => $product->raw,
            ]);
    }

    public function testUpdateProduct()
    {
        $product = $this->create('App\Entities\Product');
        $productNew = $this->make('App\Entities\Product');

        $response = $this->putJson('/api/products/'.$product->id, [
            'description' => $productNew->description,
            'unit'        => $productNew->unit,
            'cost_price'  => $productNew->cost_price,
            'price'       => $productNew->price,
            'tobuy'       => $productNew->tobuy,
            'tosell'      => $productNew->tosell,
            'raw'         => $productNew->raw,
        ]);

        $response->assertSuccessful()
            ->assertJson([
                'description' => $productNew->description,
                'unit'        => $productNew->unit,
                'cost_price'  => $productNew->cost_price,
                'price'       => $productNew->price,
                'tobuy'       => $productNew->tobuy,
                'tosell'      => $productNew->tosell,
                'raw'         => $productNew->raw,
            ]);
    }

    public function testDeleteProduct()
    {
        $product = $this->create('App\Entities\Product');

        $response = $this->deleteJson('/api/products/'.$product->id);

        $response->assertSuccessful()
            ->assertJson([
                'id' => $product->id,
            ]);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}
