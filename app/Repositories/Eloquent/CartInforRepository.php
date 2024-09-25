<?php

namespace App\Repositories\Eloquent;

use App\Models\cartinfo;
use App\Repositories\Contracts\ICartInforRepository;

class CartInforRepository implements ICartInforRepository{
    public function GetByIdCart($id){
        cartinfo::where('carts_id',$id)->get();
    }

    public function Delete($id){

    }

}