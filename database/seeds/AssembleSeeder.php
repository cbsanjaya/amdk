<?php

use Illuminate\Database\Seeder;

class AssembleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactionTime = '2018-12-31 01:00:00';

        $user = factory(App\User::class)->create([
            'email' => 'admin@amdk.test',
        ]);

        $product1 = factory('App\Entities\Product')->state('product')->create();
        
        $product2 = factory('App\Entities\Product')->state('raw')->create();

        $product3 = factory('App\Entities\Product')->state('raw')->create();
        
        $assemble = new App\Entities\Assemble();
        $assemble->type = 'manual';
        $assemble->transaction_time = $transactionTime;
        $assemble->product_id = $product1->id;
        $assemble->quantity = 1;
        $assemble->price = $product2->cost_price + $product3->cost_price;
        $assemble->memo = 'Memo Biasa';
        $assemble->user_id = $user->id;
        $assemble->save();
        
        $mutation = new App\Entities\ProductMutation();
        $mutation->product_id = $product1->id;
        $mutation->group = 'assemble:'.$assemble->id;
        $mutation->reference = 'assemble:'.$assemble->id;
        $mutation->quantity = 1;
        $mutation->period = substr($transactionTime, 0, 7);
        $mutation->at = $transactionTime;
        $mutation->save();

        $assembleProduct = new App\Entities\AssembleProduct();
        $assembleProduct->assemble_id = $assemble->id;
        $assembleProduct->product_id = $product2->id;
        $assembleProduct->quantity = 1;
        $assembleProduct->price = $product2->cost_price;
        $assembleProduct->save();

        $mutation = new App\Entities\ProductMutation();
        $mutation->product_id = $product2->id;
        $mutation->group = 'assemble:'.$assemble->id;
        $mutation->reference = 'assemble_product:'.$assembleProduct->id;
        $mutation->quantity = -1;
        $mutation->period = substr($transactionTime, 0, 7);
        $mutation->at = $transactionTime;
        $mutation->save();

        $assembleProduct = new App\Entities\AssembleProduct();
        $assembleProduct->assemble_id = $assemble->id;
        $assembleProduct->product_id = $product3->id;
        $assembleProduct->quantity = 1;
        $assembleProduct->price = $product3->cost_price;
        $assembleProduct->save();

        $mutation = new App\Entities\ProductMutation();
        $mutation->product_id = $product3->id;
        $mutation->group = 'assemble:'.$assemble->id;
        $mutation->reference = 'assemble_product:'.$assembleProduct->id;
        $mutation->quantity = -1;
        $mutation->period = substr($transactionTime, 0, 7);
        $mutation->at = $transactionTime;
        $mutation->save();

    }
}
