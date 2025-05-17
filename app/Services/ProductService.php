<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index($request)
    {
        return $this->productRepository->index($request);
    }

    public function show($request)
    {
        return $this->productRepository->show($request);
    }
    
}
