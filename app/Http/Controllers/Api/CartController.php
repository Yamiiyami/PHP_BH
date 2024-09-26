<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRepuset;
use App\Repositories\Contracts\ICartInforRepository;
use App\Repositories\Contracts\ICartRepository;
use Exception;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Cache\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class CartController extends Controller
{
    protected $cartrepository;
    protected $cartinforrepository;
    public function __construct(ICartRepository $cartrepository,ICartInforRepository $cartinforrepository){
        $this->cartrepository = $cartrepository;
        $this->cartinforrepository = $cartinforrepository;

    }

    public function index()
    {
        $cart = $this->cartrepository->GetAll();
        return response()->json($cart);
    }

    public function store(StoreCartRepuset $request)
    {
        DB::beginTransaction();
        try{
            $user = auth()->user();
            $request['customer_id'] = $user->id;
            $idcart = $this->cartrepository->Add($request->only(['address', 'notes', 'phone', 'customer_id']));
            
            $products = $request->input('products');

            if(!$products){
                throw new Exception('không có sản phẩm');
            }

            foreach($products as $product){
                $productinfor = DB::table('products')->where('id',$product['product_id'])->first();
                $product['price'] = $productinfor->price;
                if(!$this->cartinforrepository->Creat($product,$idcart)){
                    throw new Exception('không thể thêm sản phẩm vào giỏ');
                }
            }
            DB::commit();
            return response()->json(['message' => 'thêm sản phẩm thành công'],201);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['message' => 'không thêm được sản phẩm', 'error' => $e->getMessage()],500);
        } 
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
