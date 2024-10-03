<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Services\UserService;
use DateTime;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use Carbon\Carbon;
use Exception;

class CustomerController extends Controller
{
     protected $userService;
     public function __construct(UserService $userService)
     {
        $this->userService = $userService;
     }

    public function index()
    {
        $customer = $this->userService->getAll();
        return response()->json($customer);
    }

    public function show($id)
    {
        try {
            $customer = $this->userService->getById($id);
            return response()->json(['user' => $customer]);
        } catch (Exception $e) {
            return response()->json(['message' => 'User not found', 'error' => $e->getMessage()], 404);
        }
    }

    public function store(StoreCustomerRequest $request)
    {
        try {
            $data = $request->validated();
            $result = $this->userService->create($data);
            
            if ($result) {
                return response()->json([
                    'message' => 'Tạo thành công',
                    'customer' => $result
                ], 201);
            } else {
                return response()->json(['message' => 'Tạo thất bại'], 400); 
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Đã xảy ra lỗi',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function lockUser( $id){
        if($this->userService->lockUser($id)){
            return response()->json(['message'=>'sửa thành công'],200);
        }
        return response()->json(['message'=>'sửa thất bại'],500);
    }

    public function unLock( $id){
        if($this->userService->unLock($id)){
            return response()->json(['message'=>'sửa thành công'],200);
        }
        return response()->json(['message'=>'sửa thất bại'],500);
    }

    public function update(UpdateCustomerRequest $request, $id)
    {
        try{
            $data = $request->validate();
            $result = $this->userService->update($id,$data);
            if (!$result) {
                return response()->json(['message' => 'Cập nhật thất bại'], 500);
            }
            return response()->json(['message' => 'Cập nhật thành công'], 200);
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json(['message' => 'không tìm thấy', 'error' => $e->getMessage()],404);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Đã xảy ra lỗi', 'error' => $e->getMessage()],500);
        }

    }
    
    public function destroy($id)
    {
        $result = $this->userService->delete($id);
        if(!$result){
            return response()->json(["message" => "xoá thất bại"],404);
        }
        return response()->json(["message"=>"xoá thành công"],200);
    }
}
