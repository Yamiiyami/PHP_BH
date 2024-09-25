<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\APi\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ProductController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('customer',CustomerController::class);

Route::group([
    'prefix' => 'product'
], function ($router) {
    Route::get('/getall', [ProductController::class,'index']);
    Route::get('/getbyid/{id}', [ProductController::class,'show']);
    Route::get('/getbyidcate/{id}', [ProductController::class,'getbyidcate']);
    Route::post('/create', [ProductController::class,'store']);
    Route::post('/update/{id}', [ProductController::class,'update']);
    Route::post('/remove/{id}', [ProductController::class,'destroy']);
    Route::post('/{id}/upload-image', [ProductController::class, 'uploadImage']);
});

Route::group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class,'login']);
    Route::post('/logout', [AuthController::class,'logout']);
    // Route::post('refresh', 'AuthController@refresh');
    Route::get('/profile', [AuthController::class,'infor'])->middleware('jwt.auth');
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

Route::group(['prefix' => 'cate'],function(){

    Route::get('/getall',[CategoryController::class,'GetAll']);
});




