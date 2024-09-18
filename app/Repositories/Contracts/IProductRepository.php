<?php
namespace App\Repositories\Contracts;


interface IProductRepository {
    public function GetAll();
    public function GetById($id) ;
    public function GetByIdCate($id);
    public function Add(array $products);
    public function Update(array $products,$id);
    public function Delete($id);
}