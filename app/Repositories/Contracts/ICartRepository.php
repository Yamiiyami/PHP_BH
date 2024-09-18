<?php
namespace App\Repositories\Contracts;


interface ICartRepository {
    public function GetAll();
    public function GetById($id);
    public function GetByIdUser($id);
    public function Add(array $products);
    public function Update(array $products,$id);
    public function Delete($id);

}