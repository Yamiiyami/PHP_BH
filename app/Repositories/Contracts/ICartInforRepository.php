<?php
namespace App\Repositories\Contracts;


interface ICartInforRepository {
    public function all();
    public function find($id);
    public function findBy(string $column, $value, $relations=[]);
    public function findWithWhere(array $conditions);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}