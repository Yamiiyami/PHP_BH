<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IAuthRepository;
use Illuminate\Http\Request;

class AuthController extends Controller{

    protected $authrepository;
    public function __construct(IAuthRepository $authrepository)
    {
        $this->authrepository = $authrepository;
    }

    public function Login(Request $request){

        $ad = $request->only('email','password');
        return $this->authrepository->login($ad['email'],$ad['password']);

    }

    public function Logout(){
        return $this->authrepository->logout();

    }

    public function Infor(){
        return $this->authrepository->infor();
    }








}