<?php

namespace App\Services;

use App\Repositories\Contracts\IProductRepository;

use Exception;

class ProductService
{
    protected $productRepository;
    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll()
    {
        return $this->productRepository->allWith('images');
    }
    
    public function getById($id)
    {
        return $this->productRepository->find($id);
    }

    public function getByIdCate($id)
    {
        return $this->productRepository->findAllBy('cate_id',$id);
    }

    public function create(array $data)
    {
        try{
            return $this->productRepository->create($data);
        } catch(Exception $e){
            throw new Exception('tạo không thành công'. $e->getMessage());
        }
    }

    public function update($id, $data)
    {
        try{
            return $this->productRepository->update($id,$data);
        } catch(Exception $e){
            throw new Exception('sửa không thành công'. $e->getMessage());
        }
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }

}