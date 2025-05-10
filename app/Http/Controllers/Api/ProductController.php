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

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'sku' => 'required',
            'state' => 'required',
        ]);

        $product = Product::create($data);

        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully' , 'product' => $product->name]);
    }
}
