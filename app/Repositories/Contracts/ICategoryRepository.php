<?php
namespace App\Repositories\Contracts;


interface ICategoryRepository{
    public function GetAll();
    public function GetById();
    public function Create();
    public function Update();
    public function Remove();

}