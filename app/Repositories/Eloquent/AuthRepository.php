<?php

namespace App\Repositories\Eloquent;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\IAuthRepository;


class AuthRepository implements IAuthRepository{

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

}