<?php
namespace App\Repositories\Contracts;

use Facade\FlareClient\Stacktrace\File;

interface IPictureRepository {
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}


