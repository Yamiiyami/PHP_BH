<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRepuset;
use App\Services\CartInforService;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;
    protected $cartInforService;
    public function __construct(CartService $cartService,CartInforService $cartInforService){
        $this->cartService = $cartService;
        $this->cartInforService = $cartInforService;
    }

    public function index()
    {
        $cart = $this->cartService->GetAll();
        return response()->json($cart);
    }

    public function store(StoreCartRepuset $request)
    {
        $this->cartService->create($request->only(['address','notes', 'phone']), $request['products']);
    }
    
    public function show($id)
    {
        try{
            $cart = $this->cartService->getById($id);
            return response()->json($cart,200);
        }catch(\Exception $e){
            return response()->json(['error' => 'không tìm thấy'. $e->getMessage()],404);
        }
    }
    
    public function update(Request $request, $id)
    {
        $result = $this->cartService->update($request->all(),$id);
        if($result > 0){
            return response()->json(['message','sửa thành công'],201);
        }
        return response()->json(['error','sửa thất bại'],400);
    }

    public function destroy($id)
    {
        $result = $this->cartService->delete($id);
        if($result > 0){
            return response()->json(['message','xoá thành công'],201);
        }
        return response()->json(['error','xoá thất bại'],400);
    }
}
