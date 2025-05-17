<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ResponseAPI;

    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function checkout(Request $request)
    {

        try{

            $order = $this->orderService->checkout($request);
            return $this->success('Order created successfully', $order);

        }catch(\Exception $e){
            return $this->error($e->getMessage());
        }
        
    }

    public function cancelOrder(Request $request)
    {
        try{
            $order = $this->orderService->cancelOrder($request);
            return $this->success('Order cancelled successfully', $order);
        }catch(\Exception $e){
            return $this->error($e->getMessage());
        }
    }

    public function listUserOrders(Request $request)
    {
        try{
            $orders = $this->orderService->listUserOrders($request);
            return $this->success('Orders fetched successfully', $orders);
        }catch(\Exception $e){
            return $this->error($e->getMessage());
        }
    }
}
