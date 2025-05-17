<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartRepository
{

    public function indexByAuth($request)
    {
        $paginate = $request->paginate ?? 10;
        $user = Auth::user();
    
        // Retrieve the user's cart
        $cart = Cart::where('user_id', $user->id)->first();
    
        if (!$cart) {
            return collect(); // Or throw an exception or return empty paginated result
        }
    
        // Return paginated CartItems
        return CartItem::where('cart_id', $cart->id)->paginate($paginate);
    }

    public function addItemToCart($request)
    {

        $user = Auth::user();
        if (!$user) {
            throw new \Exception('User must login to add items to cart');
        }

        $productId = $request->product_id;
        $quantityToAdd = $request->quantity ?? 1;

        // 1. Retrieve or create cart for the user
        $cart = Cart::firstOrCreate([
                'user_id' => $user->id,
            ]);

            // 2. Find the product
        $product = Product::findOrFail($productId);

        $existingItem = $cart->items->firstWhere('product_id', $productId);

        if ($existingItem) {
            // Update quantity if item already in cart
            $existingItem->quantity += $quantityToAdd;
            $existingItem->save();
            return $existingItem;
        }
    
        // 4. Add item to the cart using the Vanilo method
        return $cart->addItem($product, $quantityToAdd);

    }

    public function clearCart()
{
    $user = Auth::user();

    if (!$user) {
        throw new \Exception('User must be logged in to clear the cart');
    }

    $cart = Cart::where('user_id', $user->id)->first();

    if (!$cart) {
        throw new \Exception('Cart not found');
    }

    $cart->items()->delete(); // Remove all cart items
    return true;
}

    
}
