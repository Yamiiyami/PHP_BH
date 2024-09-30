<?php
namespace App\Repositories\Contracts;


interface IProductRepository {

    public function all();
    public function find($id);
    public function allWith($relations =[]);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function findAllBy(string $column, $value);

}