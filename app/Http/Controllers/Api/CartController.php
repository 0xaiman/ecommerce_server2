<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartItemResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Services\CartService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    use ResponseAPI;

    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function indexByAuth(Request $request)
    {
        try {
            $carts = $this->cartService->indexByAuth($request);
            return $this->success('Carts fetched successfully', $carts);
        } catch (\Exception $e) {
            return $this->error('Error fetching carts in CartController.index :' . $e->getMessage());
        }   
    }

    public function addItemToCart(Request $request)
    {
        try {
            $cart = $this->cartService->addItemToCart($request);
            return $this->success('Cart created successfully', $cart);
        } catch (\Exception $e) {
            return $this->error('Error creating cart in CartController.store :' . $e->getMessage());
        }
    }

    public function clearCart()
    {
        try {
            $this->cartService->clearCart();
            return $this->success('Cart cleared successfully');
        } catch (\Exception $e) {
            return $this->error('Error clearing cart in CartController.clearCart :' . $e->getMessage());
        }
    }
    
    
    
    
}

