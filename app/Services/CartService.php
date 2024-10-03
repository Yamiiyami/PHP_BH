<?php

namespace App\Services;

use App\Repositories\Contracts\ICartInforRepository;
use App\Repositories\Contracts\ICartRepository;

use Exception;
use Facade\FlareClient\Http\Response;
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

    public function create(){
        $user = auth()->user();
        if(!$this->cartRepository->exitstsWhere( ['customer_id'=>$user->id,'status' => 'pending'])){
            $this->cartRepository->create(['user_id'=>$user->id]);
            return Response()->json(['message','tạo thành công'],201);
        } 
        return Response()->json(['message','đã có cart'],409);
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

