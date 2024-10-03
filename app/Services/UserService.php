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
        return $this->userRepository->all(['role']);
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
            throw new Exception('tạo không thành công '. $e->getMessage());
        }
    }

    public function update($id, $data)
    {
        try{
            $data['password'] = Hash::make($data['password']);
            return $this->userRepository->update($id,$data);
        } catch(Exception $e){
            throw new Exception('sửa không thành công '. $e->getMessage());
        }
    }

    public function lockUser($id)  {
        try{
            $user = $this->userRepository->find($id);
            if(!$user){
                throw new Exception('không tìm thấy User');
            }
            if( $this->userRepository->update($id,['status' => 'unable'])){
                return true;
            }
            return false;
        } catch(Exception $e){
            throw new Exception('sửa không thành công '. $e->getMessage());
        }
    }

    public function unLock($id) {
        try{
            $user = $this->userRepository->find($id);
            if(!$user){
                throw new Exception('không tìm thấy User');
            }
            if( $this->userRepository->update($id,['status' => 'enable'])){
                return true;
            }
            return false;
        } catch(Exception $e){
            throw new Exception('sửa không thành công '. $e->getMessage());
        }
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }
}