<?php

namespace App\Http\Controllers;

use App\Entities\Assemble;
use App\Entities\AssembleProduct;
use App\Entities\Product;
use App\Entities\ProductMutation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssembleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $assemble = DB::transaction(function () use ($request) {
            $products = collect($request->products);

            $newProductPrice = $products->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            });

            $assemble = new Assemble();
            $assemble->type = $request->type;
            $assemble->transaction_time = $request->transaction_time;
            $assemble->product_id = $request->product_id;
            $assemble->quantity = $request->quantity;
            $assemble->price = $newProductPrice;
            $assemble->memo = $request->memo;
            $assemble->user_id = $request->user_id;
            $assemble->save();

            $product = Product::find($request->product_id);
            $product->stock += $request->quantity;
            $product->cost_price = $newProductPrice;
            $product->save();

            $mutation = new ProductMutation();
            $mutation->product_id = $request->product_id;
            $mutation->reference = 'assemble:'.$assemble->id;
            $mutation->quantity = $request->quantity;
            $mutation->period = substr($request->transaction_time, 0, 7);
            $mutation->at = $request->transaction_time;
            $mutation->save();

            foreach ($request->products as $item) {
                $product = Product::find($item['product_id']);
                $product->stock -= $item['quantity'];
                $product->save();

                $assembleProduct = new AssembleProduct();
                $assembleProduct->assemble_id = $assemble->id;
                $assembleProduct->product_id = $item['product_id'];
                $assembleProduct->quantity = $item['quantity'];
                $assembleProduct->price = $item['price'];
                $assembleProduct->save();

                $mutation = new ProductMutation();
                $mutation->product_id = $item['product_id'];
                $mutation->reference = 'assemble_product:'.$assembleProduct->id;
                $mutation->quantity = -$item['quantity'];
                $mutation->period = substr($request->transaction_time, 0, 7);
                $mutation->at = $request->transaction_time;
                $mutation->save();
            }

            return $assemble;
        });

        return [
            'message'  => 'Perakitan Berhasil disimpan',
            'assemble' => $assemble,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
