<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Traits\ResponseAPI;
class ProductController extends Controller
{

    use ResponseAPI;

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        try {
            $products = $this->productService->index($request);
            return $this->success('Products fetched successfully', $products);
        } catch (\Exception $e) {
            return $this->error('Error fetching products in ProductController.index :' . $e->getMessage());
        }
    }

    public function show(Request $request)
    {
        try {
            $product = $this->productService->show($request);
            return $this->success('Product fetched successfully', $product);
        } catch (\Exception $e) {
            return $this->error('Error fetching product in ProductController.show :' . $e->getMessage());
        }
    }

}
