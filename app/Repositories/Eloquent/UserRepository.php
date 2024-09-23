<?php

namespace App\Repositories\Eloquent;

use App\Models\Customer;
use App\Repositories\Contracts\IUserRepository;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository{

    public function GetAllUser(){
        return Customer::all();
    }

    public function GetById($id){
        return Customer::findOrFail($id);
    }

    public function CreateUser(array $user){
        try{
            //'name','username','email','password','phone','status','role_id'
            return Customer::create([
                'name' => $user['name'],
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'phone' => $user['phone'],
                'status' => $user['status']??'enable',
                'role_id' => $user['role_id']??2
            ]);
        }
        catch(\Exception $e){
            throw new \Exception('tạo User thất bại: '. $e->getMessage());
        }
    }
    public function UpdateUser(array $data, $id){
        try{
            $customer = Customer::findOrFail($id);
            $update = $customer->update($data);
            return ['success' =>  $update , 'message' => ''];
        }
        catch(\Exception $e){
            return ['success' => false, 'message' => 'lỗi khi sửa người dùng: '. $e->getMessage()];
        }
    }

    public function DeleteUser($id){
        $customer = Customer::find($id);
        if(!$customer){
            return ['success' => false, 'messsage' => 'không tìm thấy user'];
        }
        return ['success' =>  $customer->delete() , 'message' => ''];
    }


}

