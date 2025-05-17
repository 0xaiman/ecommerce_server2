<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function index($request)
    {
        $paginate=$request->paginate ?? 10;
        return Product::paginate($paginate);
    }

    public function show($request)
    {
        return Product::find($request->id);
    }
}
