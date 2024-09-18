<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Arr;

interface IUserRepository {
    public function GetAllUser();
    public function GetById($id);
    public function CreateUser(array $user);
    public function UpdateUser(array $data, $id);
    public function DeleteUser($id);

}