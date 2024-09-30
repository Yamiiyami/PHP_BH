<?php

namespace App\Services;

use App\Repositories\Contracts\ICategoryRepository;

use Exception;

class CateService 
{

    protected $cateRepository;
    public function __construct(ICategoryRepository $categoryRepository) {
            $this->cateRepository = $categoryRepository;
    }

    public function getAll()
    {
        return $this->cateRepository->all();
    }
    
    public function getById($id)
    {
        return $this->cateRepository->find($id);
    }

    public function create(array $data)
    {
        try{
            return $this->cateRepository->create($data);
        } catch(Exception $e){
            throw new Exception('tạo không thành công'. $e->getMessage());
        }
    }

    public function update($id, $data)
    {
        try{
            return $this->cateRepository->update($id,$data);
        } catch(Exception $e){
            throw new Exception('sửa không thành công'. $e->getMessage());
        }
    }

    public function delete($id)
    {
        return $this->cateRepository->delete($id);
    }

}