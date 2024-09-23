<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRepuset;
use App\Repositories\Contracts\ICartRepository;
use Illuminate\Cache\Repository;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CartController extends Controller
{
    protected $cartrepository;
    public function __construct(ICartRepository $cartrepository){
        $this->cartrepository = $cartrepository;
    }

    public function index()
    {
        $cart = $this->cartrepository->GetAll();
        return response()->json($cart);
    }

    public function store(Request $request)
    {
        //$cart = $request->validated();
        $user = auth()->user();
        $request['customer_id'] = $user->id;
        $result = $this->cartrepository->Add($request->all());
        if($result){
            return response()->json(['message','tạo thành công'],201);
        }
        return response()->json(['error','tạo thất bại'],400);
    }


    public function show($id)
    {
        try{
            $cart = $this->cartrepository->GetById($id);
            return response()->json($cart,200);
        }catch(\Exception $e){
            return response()->json(['error' => 'không tìm thấy'. $e->getMessage()],404);
        }

    }

    public function update(Request $request, $id)
    {
        $result = $this->cartrepository->Update($request->all(),$id);
        if($result > 0){
            return response()->json(['message','sửa thành công'],201);
        }
        return response()->json(['error','sửa thất bại'],400);
    }

    public function destroy($id)
    {
        $result = $this->cartrepository->Delete($id);
        if($result > 0){
            return response()->json(['message','xoá thành công'],201);
        }
        return response()->json(['error','xoá thất bại'],400);
    }
}
