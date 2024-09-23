<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\ICategoryRepository;

class CategoryRepository implements ICategoryRepository{
    public function GetAll(){
        return Category::all();
    }
    public function GetById(){

    }
    public function Create(){

    }
    public function Update(){

    }
    public function Remove(){
        
    }
}