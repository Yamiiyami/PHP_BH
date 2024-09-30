<?php

namespace App\Http\Controllers\APi;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICategoryRepository;
use App\Services\CateService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $cateService;
    public function __construct(CateService $cateService)
    {
        $this->cateService = $cateService;
    }

    public function GetAll()  {
        return $this->cateService->getAll();
    }

    

}
