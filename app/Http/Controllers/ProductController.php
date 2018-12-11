<?php

namespace App\Http\Controllers;

use App\Entities\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
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
        $product = new Product();
        $product->description = $request->description;
        $product->unit = $request->unit;
        $product->cost_price = $request->cost_price;
        $product->price = $request->price;
        $product->tobuy = $request->tobuy;
        $product->tosell = $request->tosell;
        $product->raw = $request->raw;
        $product->stock = $request->stock;
        $product->save();

        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Entities\Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Entities\Product    $product
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->description = $request->description;
        $product->unit = $request->unit;
        $product->cost_price = $request->cost_price;
        $product->price = $request->price;
        $product->tobuy = $request->tobuy;
        $product->tosell = $request->tosell;
        $product->raw = $request->raw;
        $product->stock = $request->stock;
        $product->save();

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Entities\Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return $product;
    }
}
