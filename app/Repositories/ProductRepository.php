<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function index($request)
    {
        return Product::all();
    }

    public function show($request)
    {
        return Product::find($request->id);
    }
}
