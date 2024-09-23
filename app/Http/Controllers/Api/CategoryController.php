<?php

namespace App\Http\Controllers\APi;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;
    public function __construct(ICategoryRepository $category)
    {
        $this->category = $category;
    }

    public function GetAll()  {
        return $this->category->GetAll();
    }


}
