<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Repositories\Contracts\IUserRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use DateTime;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use Carbon\Carbon;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected $customerRepository;
     public function __construct(IUserRepository $customerRepository)
     {
        $this->customerRepository = $customerRepository;
     }
    public function index()
    {
        // 
        $customer = $this->customerRepository->GetAllUser();
        return response()->json($customer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        try{
            $result = $this->customerRepository->CreateUser($request->validated());
            if($result){
                return response()->json(['message' => 'tạo thành công' , 
            'customer' => $result], 201);
            } else{
                return response()->json(['message' => 'tạo thất bại'], 422);
            }
        }
        catch( \Exception $e){
            return response()->json(['message' => 'Đã xảy ra lỗi', 'error' => $e->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $customer = $this->customerRepository->getById($id);
            return response()->json(['user' => $customer]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
  
            /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, $id)
    {
        try{
            $result = $this->customerRepository->UpdateUser($request->validated(),$id);
            if (!$result['success'] ) {
                return response()->json(['message' => 'Cập nhật thất bại'], 400);
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
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        $result = $this->customerRepository->DeleteUser($id);
        if(!$result['success']){
            return response()->json(["message" => "xoá thất bại, ko tìm thấy user"],404);
        }
        return response()->json(["message"=>"xoá thành công"],200);
    }
}
