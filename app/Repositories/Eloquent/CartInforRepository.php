<?php

namespace App\Repositories\Eloquent;

use App\Models\cartinfo;
use App\Repositories\Contracts\ICartInforRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class CartInforRepository implements ICartInforRepository
{
    public function GetByIdCart($id)
    {
        cartinfo::where('carts_id', $id)->get();
    }

    public function Delete($id) {}

    public function Creat($product, $cart_id)
    {
        return DB::table('cartinfos')->insert([
            'quantity' => $product['quantity'],
            'price' => $product['price'],
            'product_id' => $product['product_id'],
            'carts_id' => $cart_id,
        ]);
    }
}
