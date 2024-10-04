<?php

namespace App\Services;

use App\Repositories\Contracts\ICartInforRepository;
use App\Repositories\Contracts\ICartRepository;
use App\Repositories\Contracts\IProductRepository;

class CartInforService
{
    protected $cartinforRepository;
    protected $cartRepository;
    protected $productRepository;
    public function __construct(ICartInforRepository $cartinforRepository, ICartRepository $cartRepository, IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->cartRepository = $cartRepository;
        $this->cartinforRepository = $cartinforRepository;
    }

    public function create(array $products)
    {
        $cart = $this->cartRepository->findBy('status', 'pending');

        if (!$cart) {
            return response()->json(['message' => 'Không tìm thấy giỏ hàng.'], 404);
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
