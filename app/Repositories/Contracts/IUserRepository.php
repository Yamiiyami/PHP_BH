<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Arr;

interface IUserRepository {

    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);

}