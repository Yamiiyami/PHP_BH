<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller{

    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function Login(Request $request){
        $ad = $request->only('email','password');
        return $this->authService->login($ad['email'],$ad['password']);
    }

    public function Logout(){
        return $this->authService->logout();

    }

    public function Infor(){
        return $this->authService->infor();
    }

    public function Register(Request $request){
        try{
            $this->authService->register($request->all());
            return response()->json(['message' => 'tạo thành công'],201);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }

    }








}