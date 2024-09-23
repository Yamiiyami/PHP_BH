<?php

namespace App\Repositories\Eloquent;

use App\Models\cart;
use App\Repositories\Contracts\ICartRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CartRepository implements ICartRepository{

    public function GetAll(){
        return Cart::all();
    }
    
    public function GetById($id){
        return Cart::findOrFail($id);

    }

    public function GetByIdUser($id){
        return Cart::findOrFail($id);
    }

    public function Add(array $cart){
        return DB::table('carts')->insert([
            'address' => $cart['address'],
            'notes' => $cart['notes'],
            'phone' => $cart['phone'],
            'create_at' => Carbon::now(),
            'customer_id' => $cart['customer_id'],
        ]);
    }

    public function Update(array $cart,$id){
        //$cart = Cart::findOrFail($id);
        $user = Auth()->user();
        return DB::table('carts')->where(['id'=>$id,'customer_id'=>$user->id])->Update([
            'address' => $cart['address'],
            'notes' => $cart['notes'],
            'phone' => $cart['phone'],
        ]);
    }

    public function Delete($id){
        $user = Auth()->user();
        return DB::table('carts')->where(['id'=>$id,'customer_id'=>$user->id])->delete();
    }


}