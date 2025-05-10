<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vanilo\Product\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function show(Request $request)
    {
        $product = Product::find($request->id);

        return response()->json($product);
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());

        return response()->json($product);
    }

    public function update(Request $request)
    {
        $product = Product::find($request->id);

        $product->update($request->all());

        return response()->json($product);
    }

    public function destroy(Request $request)
    {
        $product = Product::find($request->id);

        $product->delete();
        
    }
}
