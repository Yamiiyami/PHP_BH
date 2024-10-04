<?php

namespace App\Services;

use App\Repositories\Contracts\IOrderRepository;

class OrderService{

    protected $orderRepository;
    public function __construct(IOrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

}