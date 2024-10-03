<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CartInforService;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Http\Request;

class CartinforController extends Controller
{
    protected $cartInforService;
    public function __construct(CartInforService $cartInforService){
        $this->cartInforService = $cartInforService;
    }

    public function create(Request $request){

        $data = $request->only('');
        //$this->cartInforService->create();
    }
}
