<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\user\AjaxController;
use App\Http\Controllers\User\UserController;


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

Route::middleware([
    'auth',
])->group(function () {

     // dashbosrd

     Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    //

    //Admin Auth
    Route::middleware(['admin_auth'])->group(function(){
        Route::group(['prefix' => 'category'], function(){
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            Route::get('createPage',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
            Route::post('update/{id}',[CategoryController::class,'update'])->name('category#update');
        });

        //password change
        Route::prefix('admin')->group(function(){
            Route::get('change/pass',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');

            //account
            Route::get('account',[AdminController::class,'detail'])->name('admin#detail');
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

            //accunt list
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            Route::get('adminUserDelete/{id}',[AdminController::class,'adminUserDelete'])->name('admin#adminUserDelete');


            //order list
            Route::get('orderList',[OrderController::class,'orderList'])->name('admin#orderList');
            Route::get('filter',[OrderController::class,'filter'])->name('admin#filter');
            Route::get('change',[OrderController::class,'change'])->name('admin#change');
            Route::get('orderInfo/{orderCode}',[OrderController::class,'orderInfo'])->name('admin#orderInfo');

        });
    });

    //product
    Route::prefix('product')->group(function(){
        route::get('list',[ProductController::class,'list'])->name('product#list');
        route::get('create',[ProductController::class,'create'])->name('product#create');
        route::post('create',[ProductController::class,'pizzaCreate'])->name('product#pizzaCreate');
        route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
        route::get('view/{id}',[ProductController::class,'view'])->name('product#view');
        route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
        route::post('update',[ProductController::class,'update'])->name('product#update');
    });
    Route::prefix('user')->group(function(){
        route::get('AdminList',[UserController::class,'roleChange'])->name('admin#roleChange');
        route::get('ajax/role',[UserController::class,'role'])->name('admin#role');
        route::get('userMessage',[UserController::class,'userMessage'])->name('admin#userMessage');


    });


     // user home
     Route::group(['prefix' => 'user', 'middleware' => ['user_auth']], function(){
        Route::get('home',[UserController::class,'home'])->name('user#home');
        route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
        Route::get('history',[UserController::class,'history'])->name('user#history');

        //user pass
        Route::prefix('user')->group(function(){
            route::get('passChange',[UserController::class,'passChangePage'])->name('user#passChangePage');
            route::post('passChange',[UserController::class,'passChange'])->name('user#passChange');
        });

        //account
        Route::prefix('user')->group(function(){
            route::get('contact',[UserController::class,'contactPage'])->name('user#contact');
            route::post('contactData',[UserController::class,'contactDataPage'])->name('user#contactData');
            route::get('account',[UserController::class,'userPage'])->name('user#userPage');
            route::get('editPage',[UserController::class,'editPage'])->name('user#editPage');
            route::post('edit/{id}',[UserController::class,'edit'])->name('user#edit');

            Route::prefix('pizza')->group(function(){
                route::get('details/{id}',[UserController::class,'details'])->name('user#details');
            });

            // caart
            route::prefix('cart')->group(function(){
                route::get('list',[UserController::class,'cartList'])->name('user#cartList');
            });
        });

        //
        route::prefix('ajax')->group(function(){
            route::get('list',[AjaxController::class,'pizzaList'])->name('user#pizzaList');
            route::get('addCart',[AjaxController::class,'addCart'])->name('user#add');
            route::get('order',[AjaxController::class,'order'])->name('user#order');
            route::get('clear',[AjaxController::class,'clear'])->name('user#clear');
            route::get('delete',[AjaxController::class,'delete'])->name('user#delete');
         route::get('view/count',[AjaxController::class,'viewCount'])->name('user#viewCount');
        });
    });

});

Route::middleware(['admin_auth'])->group(function(){

Route::get('/',[AdminController::class,'loginPage'])->name('admin#loginPage');
Route::get('registerPage',[AdminController::class,'registerPage'])->name('admin#registerPage');


});
