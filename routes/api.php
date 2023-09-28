<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Get api
Route::get('apiTesting',[RouteController::class,'apiTest']);
Route::get('userLists',[RouteController::class,'userList']);

//post
route::get('categoryLists',[RouteController::class,'categoryLists']);
route::post('categories',[RouteController::class,'categories']);

//route::post('categories/delete',[RouteController::class,'categoriesDelete']);
route::get('categories/delete/{id}',[RouteController::class,'categoriesDelete']);

route::get('categories/details/{id}',[RouteController::class,'categoriesDetail']);

route::post('categories/update',[RouteController::class,'update']);






