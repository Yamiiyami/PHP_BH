<?php
namespace App\Repositories\Contracts;


interface ICartInforRepository {
    public function GetByIdCart($id);
    public function Delete($id);
}