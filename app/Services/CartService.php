<?php

namespace App\Services;

use App\Models\Cart;
use App\Repositories\CartRepository;

class CartService
{
    protected $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function indexByAuth($request)
    {
        return $this->cartRepository->indexByAuth($request);
    }

    public function addItemToCart($request)
    {
        return $this->cartRepository->addItemToCart($request);
    }

    public function clearCart()
    {
        return $this->cartRepository->clearCart();
    }

   
}
