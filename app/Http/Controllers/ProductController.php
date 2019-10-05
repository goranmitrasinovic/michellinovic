<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return $products;
    }

    /**
     * Get specific category of products
     *
     * @return \Illuminate\Http\Response
     */
    public function getOtherProducts()
    {
        $products = Product::where([['category', 'Other'], ['completed', 0]])->get();
        return $products;
    }

      /**
     * Get specific category of products
     *
     * @return \Illuminate\Http\Response
     */
    public function getGroceryProducts()
    {
        $products = Product::where([['category', 'Grocery'], ['completed', 0]])->get();
        return $products;
    }

      /**
     * Get specific category of products
     *
     * @return \Illuminate\Http\Response
     */
    public function getClothesProducts()
    {
        $products = Product::where([['category', 'Clothes'], ['completed', 0]])->get();
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::updateOrCreate(['name' => $request->name],
        ['name' => $request->name, 
        'completed' => 0, 
        'quantity' => $request->quantity,
        'category' => $request->category,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clearShoppingListOfProducts(Request $request)
    {
        $products = Product::where('completed', 0)->update(['completed' => 1]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product = $product->update($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function completePurchase(Request $request, $id)
    {
        $product = Product::find($id);
        $product->completed = 1;
        $product->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
