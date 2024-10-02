<?php
namespace App\Repositories\Contracts;


interface IProductRepository {

    public function all($relations = []);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function paginate(int $perPage = 15);
    public function delete($id);
    public function findAllBy(string $column, $value);
    public function search(array $columns, string $keyword);

}