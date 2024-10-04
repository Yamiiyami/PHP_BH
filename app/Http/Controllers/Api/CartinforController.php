<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CartInforService;
use Exception;
use Illuminate\Http\Request;

class CartinforController extends Controller
{
    protected $cartInforService;
    public function __construct(CartInforService $cartInforService){
        $this->cartInforService = $cartInforService;
    }

    public function create(Request $request){
        try{

            $data = $request->only('products');
            $this->cartInforService->create($data['products']);
            return response()->json(['tạo thành công: '],201);

        }catch(Exception $e){
            return response()->json(['error: '. $e->getMessage()],500);
        }
       
    }
}
