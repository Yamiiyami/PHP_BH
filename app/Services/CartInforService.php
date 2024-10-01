<?php

namespace App\Services;

use App\Repositories\Contracts\ICartInforRepository;

class CartInforService {
    protected $cartinforRepository;
    public function __construct(ICartInforRepository $cartinforRepository)
    {
        $this->cartinforRepository = $cartinforRepository;
    }

    public function create($data)
    {
        $this->cartinforRepository->create($data);
    }

}