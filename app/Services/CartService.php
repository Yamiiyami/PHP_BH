<?php

namespace App\Services;

use App\Repositories\Contracts\ICartInforRepository;
use App\Repositories\Contracts\ICartRepository;

use Exception;
use Illuminate\Support\Facades\DB;

class CartService
{
    protected $cartRepository;
    protected $cartInforRepository;
    public function __construct(ICartRepository $cartRepository,ICartInforRepository $cartInforRepository)
    {
        $this->cartInforRepository= $cartInforRepository;
        $this->cartRepository = $cartRepository;
    }

    public function getAll()
    {
        return $this->cartRepository->all();
    }
    
    public function getById($id)
    {
        return $this->cartRepository->find($id);
    }

    public function getByIdCate($id)
    {
        return $this->cartRepository->findAllBy('cate_id',$id);
    }

    public function create(array $cart, array $products)
    {
        DB::beginTransaction();
        try{
            $user = auth()->user();
            $request['customer_id'] = $user->id;
            $idcart = $this->cartRepository->create($cart);

            if(!$products){
                throw new Exception('không có sản phẩm');
            }

            foreach($products as $product){
                $productinfor = DB::table('products')->where('id',$product['product_id'])->first();
                $product['price'] = $productinfor->price;
                $product['cart_id'] = $idcart;
                if(!$this->cartInforRepository->create($product)){
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

    public function update($id, $data)
    {
        try{
            return $this->cartRepository->update($id,$data);
        } catch(Exception $e){
            throw new Exception('sửa không thành công'. $e->getMessage());
        }
    }

    public function delete($id)
    {
        return $this->cartRepository->delete($id);
    }
    
    


}

