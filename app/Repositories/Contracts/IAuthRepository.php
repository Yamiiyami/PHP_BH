<?php
namespace App\Repositories\Contracts;

interface IAuthRepository {

    public function login(string $email,string $password);
    public function logout();
    public function infor() ;
    
}