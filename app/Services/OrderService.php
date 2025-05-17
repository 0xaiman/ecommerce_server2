<?php

namespace App\Services;

use App\Repositories\OrderRepository;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function checkout()
    {
        return $this->orderRepository->checkout();
    }

    public function cancelOrder($request)
    {
        return $this->orderRepository->cancelOrder($request);
    }

    public function listUserOrders()
    {
        return $this->orderRepository->listUserOrders();
    }
}