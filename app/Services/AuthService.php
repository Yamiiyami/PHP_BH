<?php

namespace App\Services;

use App\Repositories\Eloquent\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService 
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(string $email,string $password)
    {
        if($token = auth('api')->attempt(['email' => $email,'password'=>$password])){
            return $this->respondWithToken($token);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout(){
        try{
            Auth::guard('api')->logout();
            return response()->json(['message' => 'Successfully logged out']);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function infor() {
        try{
            return response()->json(Auth::guard()->user());
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function respondWithToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            //'expires_in' =>  Auth::guard()->factory()->getTTL() * 60
        ]);
    }

    public function register(array $register){
        try{
            $this->userRepository->create([
                'name' => $register['name'],
                'username' => explode('@',  $register['email'])[0],
                'email' => $register['email'],
                'password' => Hash::make($register['password']),
                'phone' => '',
                'role_id' => 2,
            ]);
            return response()->json(['message'=>'taọ thành công'],201);
        }catch(Exception $e){
            throw new Exception('không đăng ký được' . $e->getMessage());
        }
    }
}