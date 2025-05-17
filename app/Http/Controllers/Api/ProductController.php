<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::paginate(10);

        return response()->json($products);
    }

    public function show(Request $request)
    {
        $product = Product::with('images')->findOrFail($request->id);

        return response()->json($product);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'sku' => 'required',
            'state' => 'required',
            'image' => 'nullable|image|max:2048', // Optional image
        ]);
    
        unset($data['image']);

        $product = Product::create($data);
    
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
    
            $product->images()->create([
                'path' => $path,
                'is_primary' => true,
            ]);
        }
    
        return response()->json($product->load('images'));
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
