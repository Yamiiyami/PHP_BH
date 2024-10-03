<?php

namespace App\Services;

use App\Repositories\Contracts\ICartInforRepository;

class CartInforService {
    protected $cartinforRepository;
    public function __construct(ICartInforRepository $cartinforRepository)
    {
        $this->cartinforRepository = $cartinforRepository;
    }

    public function create( array $data)
    {
        foreach($data as $product){
            $cartinfor = $this->cartinforRepository->findAndRtnId(['product_id' => $product->id,'cart_id' => $product->cart]);
            if($cartinfor){
                $this->cartinforRepository->update($cartinfor->id,['quantity' => $cartinfor->quantity + $product->quantity]);
            }
            $this->cartinforRepository->create($product);
        }
    }


}