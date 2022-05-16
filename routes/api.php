<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// users
Route::group(['namespace' => 'Api'], function () {

    // GET API - fetch one or more products

        Route::get('users',[APIController::class,'getUsers']);   //for all users
        Route::get('users/{id}',[APIController::class,'getUsers']);   //for single user
    
    //  GET USER List with authentication
       
        Route::post('users-list',[APIController::class,'getUsersList']);   //for all users
    
    // POST API - insert single record
     
        Route::post('add-user',[APIController::class,'addUsers']);   //for add single user

    // POST API - insert multiple record
     
        Route::post('add-multiple-user',[APIController::class,'addmultipleUsers']);   //for add single user

    // PUT API - update one or more records

        Route::put('update-user-details/{id}',[APIController::class,'updateUserDetails']);

    // PATCH API - update one record

        Route::patch('update-user-name/{id}',[APIController::class,'updateUserName']);
    
    // DELETE API - delete one record with param

        Route::delete('delete-user/{id}',[APIController::class,'deleteUser']);

    // DELETE API - delete one record with json

        Route::delete('delete-user-with-json',[APIController::class,'deleteUserWithJson']);
    
    // DELETE API - delete multiple record with id

        Route::delete('delete-multiple-user/{id}',[APIController::class,'deleteMultipleUser']);
    
    // DELETE API - delete multiple record with json

        Route::delete('delete-multiple-user-with-json',[APIController::class,'deleteMultipleUserWithJson']);
        




});

