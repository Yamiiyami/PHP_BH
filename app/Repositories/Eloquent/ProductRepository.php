<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\IProductRepository;

class ProductRepository implements IProductRepository{

    public function GetAll(){
        return Product::with('images')->get();
    }
    
    public function GetById($id){
        return Product::findOrFail($id);
    } 

    public function GetByIdCate($id){
        $products = Product::with('images')->where('cate_id',$id)->get();
        return $products;
    }

    public function Add(array $products){
        $product = Product::create($products);
        return $product;
    }

    public function Update(array $products,$id){
        $product = Product::findOrFail($id);
        $result = $product->Update($products);
        return $result;

    }

    public function Delete($id){
        
        $product = Product::find($id);
        $product->delete();
        return $product;
    }
}