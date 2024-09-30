<?php

namespace App\Services;

use App\Repositories\Contracts\IUserRepository;

use Exception;
use Illuminate\Support\Facades\Hash;

class UserService {

    protected $userRepository;
    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    } 

    public function getAll()
    {
        return $this->userRepository->all();
    }
    
    public function getById($id)
    {
        return $this->userRepository->find($id);
    }

    public function create(array $data)
    {
        try{
            $data['password'] = Hash::make($data['password']);
            return $this->userRepository->create($data);
        } catch(Exception $e){
            throw new Exception('tạo không thành công'. $e->getMessage());
        }
    }

    public function update($id, $data)
    {
        try{
            $data['password'] = Hash::make($data['password']);
            return $this->userRepository->update($id,$data);
        } catch(Exception $e){
            throw new Exception('sửa không thành công'. $e->getMessage());
        }
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }
}