<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartItemResource;
use Vanilo\Foundation\Models\Cart;
use Vanilo\Foundation\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display the current user's cart.
     */
    public function show(Request $request)
    {
        $cart = Cart::with('items.product')
                    ->where('user_id', $request->user()->id)
                    ->firstOrCreate([ 'user_id' => $request->user()->id ]);

        return response()->json([
            'cart_id' => $cart->id,
            'total'   => $cart->total(),
            'items'   => CartItemResource::collection($cart->items)
        ]);
    }

    /**
     * Add a product to the current user's cart.
     *
     * Expects:
     * - product_id: integer, existing Vanilo product ID
     * - quantity: integer, minimum 1 (default 1)
     */
    public function add(Request $request)
    {
        // Validate incoming request
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity'   => ['nullable', 'integer', 'min:1'],
        ]);

        $quantity = $data['quantity'] ?? 1;

        // Retrieve or create user's cart
        $cart = Cart::where('user_id', $request->user()->id)
                    ->firstOrCreate([ 'user_id' => $request->user()->id ]);

        // Retrieve the product
        $product = Product::findOrFail($data['product_id']);

        // Add or update cart item
        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $product->id)
                            ->first();

        if ($cartItem) {
            // Increase quantity
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Create new cart item
            $cartItem = CartItem::create([
                'cart_id'    => $cart->id,
                'product_id' => $product->id,
                'price'      => $product->price,
                'quantity'   => $quantity,
                'product_type'=> get_class($product),
            ]);
        }

        return response()->json([
            'message' => 'Product added to cart',
            'item'    => new CartItemResource($cartItem),
            'total'   => $cart->fresh()->total(),
        ], 201);
    }

    public function clear(Request $request)
    {
        $cart = Cart::where('user_id', $request->user()->id)->first();
        $cart->items()->delete();
        return response()->json(['message' => 'Cart cleared']);
    }

    /**
     * Remove a specific item from the cart.
     *
     * @param Request $request
     * @param int $itemId The ID of the cart item to remove
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove(Request $request, $itemId)
    {
        // Find the cart for the current user
        $cart = Cart::where('user_id', $request->user()->id)->firstOrFail();
        
        // Find the cart item and ensure it belongs to the user's cart
        $cartItem = $cart->items()->findOrFail($itemId);
        
        // Remove the item using Vanilo's built-in method
        $cart->removeItem($cartItem);
        
        return response()->json([
            'message' => 'Item removed from cart',
            'cart_total' => $cart->fresh()->total()
        ]);
    }
}

