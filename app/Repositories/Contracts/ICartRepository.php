<?php
namespace App\Repositories\Contracts;


interface ICartRepository {
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function findBy(string $column, $value, $relations=[]);
    public function findWithWhere(array $conditions);
    public function delete($id);
    public function exitstsWhere(array $conditions);
    public function findAllBy(string $column, $value);
}