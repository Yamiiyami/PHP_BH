<?php

namespace App\Services;

use App\Repositories\Contracts\ICartInforRepository;
use App\Repositories\Contracts\ICartRepository;
use App\Repositories\Contracts\IProductRepository;

class CartInforService
{
    protected $cartinforRepository;
    protected $cartRepository;
    protected $cartService;

    protected $productRepository;
    public function __construct(ICartInforRepository $cartinforRepository, ICartRepository $cartRepository, IProductRepository $productRepository,CartService $cartService)
    {
        $this->productRepository = $productRepository;
        $this->cartRepository = $cartRepository;
        $this->cartService = $cartService;
        $this->cartinforRepository = $cartinforRepository;
    }

    public function remove($idProduct){
        $user = auth()->user();
        $cart = $this->cartRepository->findWithWhere(['customer_id'=>$user->id,'status'=>'pending']);
        if(!$cart){
            return false;
        }
        $cartinfor = $this->cartinforRepository->findWithWhere(['product_id'=>$idProduct,'carts_id'=>$cart->id]);
        if(!$cartinfor){
            return false;
        }
        if($this->cartinforRepository->delete($cartinfor->id)){
            return true;
        } 
        return false;
    }

    public function create(array $products)
    {
        $cart = $this->cartRepository->findBy('status', 'pending');

        if (!$cart) {
            $cart = $this->cartService->create();
        }

        foreach ($products as $product) {
            if (!isset($product['id']) || !isset($product['quantity'])) {
                return response()->json(['message' => 'Sản phẩm không hợp lệ.'], 400);
            }
            $cartinfor = $this->cartinforRepository->findWithWhere(['product_id' => $product['id'], 'carts_id' => $cart->id]);
            if ($cartinfor) {
                $this->cartinforRepository->update($cartinfor->id, ['quantity' => $cartinfor->quantity + $product['quantity']]);
            } else {
                $produ = $this->productRepository->find($product['id']);
                $this->cartinforRepository->create([
                    'product_id' => $product['id'],
                    'carts_id' => $cart->id,
                    'price' => $produ->price,
                    'quantity' => $product['quantity'],
                ]);
            }
        }
        return response()->json(['message' => 'Thêm sản phẩm vào giỏ hàng thành công.'], 201);
    }



}
