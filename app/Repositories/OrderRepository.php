<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderRepository
{

    public function checkout()
    {
        $user = Auth::user();
        if (!$user) {
            throw new \Exception("User must be logged in to checkout");
        }

        $cart = Cart::where('user_id', $user->id)->first();
        if (!$cart || $cart->items->isEmpty()) {
            throw new \Exception("Cart is empty");
        }

        $order = Order::create([
            'number' => uniqid('ORD-'),
            'status' => 'pending',
            'user_id' => $user->id,
            'created_by' => $user->id,
        ]);

        // Transfer items to Order
        foreach ($cart->items as $cartItem) {
            $order->items()->create([
                'product_id'   => $cartItem->product_id,
                'price'        => $cartItem->price,
                'quantity'     => $cartItem->quantity,
                'product_type' => get_class($cartItem->product),
                'created_by' => $user->id,
            ]);
        }

        // Clear cart
        $cart->items()->delete();

        DB::commit();
        return $order;

    }

    public function cancelOrder($request)
    {
        $user = Auth::user();
        $order = Order::where('id', $request->order_id)
                    ->firstOrFail();

        if (!in_array($order->status->value(), ['pending', 'processing'])) {
            throw new \Exception("Only pending or processing orders can be cancelled");
        }


        $order->update([
            'status' => 'cancelled',
            'updated_by' => $user->id,
        ]);

        return $order;
    }

    public function listUserOrders()
    {
        $user = Auth::user();
        return Order::where('user_id', $user->id)->latest()->paginate(10);
    }




}