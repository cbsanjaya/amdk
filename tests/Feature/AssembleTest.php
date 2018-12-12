<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AssembleTest extends TestCase
{
    use ApiAuth, WithFaker;

    public function testGetAssembles()
    {
        $this->seed('AssembleSeeder');

        $response = $this->getJson('/api/assembles');

        $response->assertOk()
            ->assertJsonFragment(
                ['id' => 1]
            );
    }

    public function testGetAssemble()
    {
        $this->seed('AssembleSeeder');

        $response = $this->getJson('/api/assembles/1');
        
        $response->assertOk()
            ->assertJson(
                ['id' => 1,]
            );
    }

    public function testStoreAssemble()
    {
        $qtyProduct = $this->faker->numberBetween(5, 20);
        $qtyRaw1 = $this->faker->numberBetween(20, 50);
        $qtyRaw2 = $this->faker->numberBetween(5, 30);
        $transactionTime = '2018-12-31 01:00:00';

        $product1 = factory('App\Entities\Product')->state('product')->create();
        $product2 = factory('App\Entities\Product')->state('raw')->create();
        $product3 = factory('App\Entities\Product')->state('raw')->create();

        $newPrice = ($product2->cost_price * $qtyRaw1) + ($product3->cost_price * $qtyRaw2);

        $response = $this->postJson('/api/assembles', [
            'type'             => 'manual',
            'transaction_time' => $transactionTime,
            'product_id'       => $product1->id,
            'quantity'         => $qtyProduct,
            'memo'             => 'Assemble Hari ini',
            'user_id'          => $this->user->id,
            'products'         => [
                [
                    'product_id' => $product2->id,
                    'quantity'   => $qtyRaw1,
                    'price'      => $product2->cost_price,
                ],
                [
                    'product_id' => $product3->id,
                    'quantity'   => $qtyRaw2,
                    'price'      => $product3->cost_price,
                ],
            ],
        ]);

        $response->assertOk()
            ->assertJson([
                'message' => 'Perakitan Berhasil disimpan',
            ]);

        $assembleResponse = $response->original['assemble'];

        $this->assertDatabaseHas('assembles', [
            'product_id' => $product1->id,
            'price'      => $newPrice,
            'user_id'    => $this->user->id,
        ]);

        $this->assertDatabaseHas('assemble_products', [
            'product_id' => $product3->id,
            'quantity'   => $qtyRaw2,
            'price'      => $product3->cost_price,
        ]);

        $this->assertDatabaseHas('product_mutations', [
            'product_id' => $product1->id,
            'group'      => 'assemble:'.$assembleResponse->id,
            'reference'  => 'assemble:'.$assembleResponse->id,
            'quantity'   => $qtyProduct,
            'period'     => substr($transactionTime, 0, 7),
            'at'         => $transactionTime,
        ]);

        $this->assertDatabaseHas('product_mutations', [
            'product_id' => $product3->id,
            'group'      => 'assemble:'.$assembleResponse->id,
            'reference'  => 'assemble_product:'. 2,
            'quantity'   => -$qtyRaw2,
            'period'     => substr($transactionTime, 0, 7),
            'at'         => $transactionTime,
        ]);
    }

    public function testUpdateAssemble()
    {
        $this->seed('AssembleSeeder');

        $qtyProduct = $this->faker->numberBetween(5, 20);
        $qtyRaw1 = $this->faker->numberBetween(20, 50);
        $transactionTime = '2018-12-31 07:00:00';

        $product1 = factory('App\Entities\Product')->state('product')->create();
        $product2 = factory('App\Entities\Product')->state('raw')->create();
        $newPrice = $product2->cost_price * $qtyRaw1;
        
        $response = $this->putJson('/api/assembles/1', [
            'type'             => 'manual',
            'transaction_time' => $transactionTime,
            'product_id'       => $product1->id,
            'quantity'         => $qtyProduct,
            'memo'             => 'Assemble Hari ini',
            'user_id'          => $this->user->id,
            'products'         => [
                [
                    'product_id' => $product2->id,
                    'quantity'   => $qtyRaw1,
                    'price'      => $product2->cost_price,
                ],
            ],
        ]);

        $response->assertOk()
            ->assertJson([
                'message' => 'Perakitan Berhasil diupdate',
            ]);

        $assembleResponse = $response->original['assemble'];

        $this->assertDatabaseHas('assembles', [
            'id'         => $assembleResponse->id,
            'product_id' => $product1->id,
            'quantity'   => $qtyProduct,
            'price'      => $newPrice,
            'user_id'    => $this->user->id,
        ]);

        $this->assertDatabaseHas('assemble_products', [
            'product_id' => $product2->id,
            'quantity'   => $qtyRaw1,
            'price'      => $product2->cost_price,
        ]);

        $this->assertDatabaseMissing('assemble_products', [
            'product_id' => 2,
        ]);

        $this->assertDatabaseMissing('assemble_products', [
            'product_id' => 3,
        ]);

        $this->assertDatabaseHas('product_mutations', [
            'product_id' => $product1->id,
            'group'      => 'assemble:'.$assembleResponse->id,
            'reference'  => 'assemble:'.$assembleResponse->id,
            'quantity'   => $qtyProduct,
            'period'     => substr($transactionTime, 0, 7),
            'at'         => $transactionTime,
        ]);

        $this->assertDatabaseHas('product_mutations', [
            'product_id' => $product2->id,
            'group'      => 'assemble:'.$assembleResponse->id,
            'reference'  => 'assemble_product:'. 3,
            'quantity'   => -$qtyRaw1,
            'period'     => substr($transactionTime, 0, 7),
            'at'         => $transactionTime,
        ]);
 
        $this->assertDatabaseMissing('product_mutations', [
            'product_id' => 1,
        ]);

        $this->assertDatabaseMissing('product_mutations', [
            'product_id' => 2,
        ]);

        $this->assertDatabaseMissing('product_mutations', [
            'product_id' => 3,
        ]);
    }

    public function testDeleteAssemble()
    {
        $this->seed('AssembleSeeder');

        $response = $this->deleteJson('/api/assembles/1');

        $response->assertOk()
            ->assertJson([
                'message' => 'Perakitan Berhasil dihapus',
            ]);

        $assembleResponse = $response->original['assemble'];

        $this->assertDatabaseMissing('assembles', [
            'id' => 1,
        ]);

        $this->assertDatabaseMissing('assemble_products', [
            'assemble_id' => 1,
        ]);

        $this->assertDatabaseMissing('product_mutations', [
            'product_id' => 1,
        ]);

        $this->assertDatabaseMissing('product_mutations', [
            'product_id' => 2,
        ]);

        $this->assertDatabaseMissing('product_mutations', [
            'product_id' => 3,
        ]);
    }
}
