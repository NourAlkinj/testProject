<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});


Route::get('/products', [ProductController::class, 'index']);


//------- Product ------//

Route::group(['namespace' => 'Product', 'prefix' => 'product','middleware'=>'auth:api'], function () {
    Route::get('index', [ProductController::class, 'index'])->name('product.index');
    Route::post('store', [ProductController::class, 'store'])->name('product.store');
    Route::get('show', [ProductController::class, 'show'])->name('product.show');
    Route::post('update', [ProductController::class, 'update'])->name('product.update');
    Route::get('delete', [ProductController::class, 'delete'])->name('product.delete');
});

//------- User ------//

Route::group(['namespace' => 'User', 'prefix' => 'user','middleware'=>'auth:api'], function () {
    Route::get('index', [UserController::class, 'index'])->name('user.index');
    Route::post('store', [UserController::class, 'store'])->name('user.store');
    Route::get('show/{id}', [UserController::class, 'show'])->name('user.show');
    Route::post('update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    Route::get('assign-products-to-user/{id}', [UserController::class, 'assignProductsToUser'])->name('user.assignProductsToUser');
//    Route::get('login', [UserController::class, 'login'])->name('user.login');
//    Route::get('register', [UserController::class, 'register'])->name('user.register');
    Route::get('change-password', [UserController::class, 'changePassword'])->name('user.changePassword');
    Route::get('assign-products-to-user/{id}', [UserController::class, 'assignProductsToUser'])->name('user.assignProductsToUser');



});




Route::group(['namespace' => 'User', 'prefix' => 'user',], function () {
    Route::get('login', [UserController::class, 'login'])->name('user.login');
    Route::get('register', [UserController::class, 'register'])->name('user.register');
    Route::post('create', [UserController::class, 'create'])->name('user.create');
    Route::get('verify', [UserController::class, 'verify'])->name('user.verify');
    Route::get('show-user-products/{id}', [UserController::class, 'showUserProducts'])->name('user.showUserProducts');
    Route::get('get-user-products/{id}', [UserController::class, 'getUserProducts'])->name('user.getUserProducts');

});
