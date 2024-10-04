<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CartinforController;
use App\Http\Controllers\APi\CategoryController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RoleController;

Route::group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'customer'
], function ($router) {
    //jwt.role
    Route::get('/getall', [CustomerController::class,'index'])->middleware('jwt.role:Admin');
    Route::get('/getbyid/{id}', [CustomerController::class,'show'])->middleware('jwt.role:Admin');
    Route::post('/create', [CustomerController::class,'infor'])->middleware('jwt.auth');
    Route::put('/lock/{id}', [CustomerController::class,'lockUser'])->middleware('jwt.role:Admin');
    Route::put('/unlock/{id}', [CustomerController::class,'unLock'])->middleware('jwt.role:Admin');
    Route::put('/update', [CustomerController::class,'update']);
    Route::delete('/delete', [CustomerController::class,'destroy'])->middleware('jwt.role:Admin');

});
Route::group([
    'prefix' => 'product'
], function ($router) {
    Route::get('/getall', [ProductController::class,'index']);
    Route::get('/getbyid/{id}', [ProductController::class,'show']);
    Route::get('/getbyidcate/{id}', [ProductController::class,'getbyidcate']);
    Route::get('/paginate/{id}', [ProductController::class,'getPagein']);
    Route::get('/search',[ProductController::class,'getSearch']);
    Route::post('/create', [ProductController::class,'store'])->middleware('jwt.role:Admin');
    Route::put('/update/{id}', [ProductController::class,'update'])->middleware('jwt.role:Admin');
    Route::delete('/remove/{id}', [ProductController::class,'destroy'])->middleware('jwt.role:Admin');
    Route::post('/{id}/upload-image', [ProductController::class, 'uploadImage'])->middleware('jwt.role:Admin');
});

Route::group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class,'login']);
    Route::post('/logout', [AuthController::class,'logout']);
    Route::get('/profile', [AuthController::class,'infor'])->middleware('jwt.auth');
    Route::post('/register', [AuthController::class,'Register']);
});

Route::group([
    'prefix' => 'role'
],function ($router){
    Route::post('/getall',[RoleController::class,'index'])->middleware('jwt.role:Admin');
});

Route::group([
    'prefix' => 'cart'
],function ($router){

    Route::get('/getall',[CartController::class,'index']);
    Route::get('/getbyid/{id}',[CartController::class,'show']);
    Route::post('/update/{id}',[CartController::class,'update'])->middleware('jwt.auth');
    Route::post('/delete/{id}',[CartController::class,'destroy'])->middleware('jwt.auth');
    Route::post('/create',[CartController::class,'store'])->middleware('jwt.auth');
});
Route::group([
    'prefix' => 'cartinfor'
],function ($router){

    Route::post('/create',[CartinforController::class,'create'])->middleware('jwt.auth');
});

Route::group(['prefix' => 'cate'],function(){

    Route::get('/getall',[CategoryController::class,'GetAll']);
});




