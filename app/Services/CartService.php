<?php

namespace App\Services;

use App\Repositories\Contracts\ICartInforRepository;
use App\Repositories\Contracts\ICartRepository;

use Exception;


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

    public function create($user){
        try{
            if(!$this->cartRepository->exitstsWhere( ['customer_id'=>$user->id,'status' => 'pending'])){
                $this->cartRepository->create(['customer_id'=>$user->id]);
                return true;
            } 
            return false;

        }catch(Exception $e){
            return Response()->json(['error',$e->getMessage()],500);
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

