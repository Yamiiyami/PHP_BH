<?php
namespace App\Repositories\Contracts;


interface ICategoryRepository{

    public function all();
    public function find($id);
    public function allWith($relations = []);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);

}