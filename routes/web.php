<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\APIController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

$router->post('product',[ProductController::class,'createProduct']);   //for creating product
$router->get('product/{id}',[ProductController::class,'updateProduct']); //for updating product
$router->post('product/{id}',[ProductController::class,'deleteProduct']);  // for deleting product
$router->get('product',[ProductController::class,'index']); // for retrieving product

// users

Route::get('users',[APIController::class,'getUsers']);   //for user



