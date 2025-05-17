<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function index($request)
    {
        //implement default pagination on 10
        if($request->has('pagination')){
            $pagination = $request->pagination;
        }else{
            $pagination = 10;
        }

        return Product::paginate($pagination);        
    }

    public function show($request)
    {
        return Product::find($request->id);
    }
}
