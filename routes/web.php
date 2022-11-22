<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::get('/home',[MainController::class,'index'])->name('index');
    Route::get('/',[MainController::class,'index'])->name('index');
    Route::get('order/{table_id}',[MainController::class,'order'])->name('addOrder');
    Route::post('add-order-detail',[MainController::class,'addOrderDetail'])->name('addOrderDetail');
    Route::put('edit-order-detail-qty/{id}',[MainController::class,'editOrderDetailQty'])->name('editOrderDetailQty');
    Route::delete('delete-order-detail/{id}',[MainController::class,'deleteOrderDetail'])->name('deleteOrderDetail');
    Route::post('complete-order',[MainController::class,'completeOrder'])->name('completeOrder');
    Route::delete('delete-order/{id}',[MainController::class,'deleteOrder']);   
    Route::get('get-product',[MainController::class,'getProduct'])->name('getProduct');
    Route::get('tables',[MainController::class,'tables']);
});


Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/home', function() {
        return view('home');
    });

   Route::resource('/order',OrderController::class);
   Route::resource('/user',UserController::class);
   Route::resource('/table',TableController::class);
   Route::post('tableLocation',[TableController::class,'tableLocation'])->name('tableLocation');
   Route::get('tables/delete/',[TableController::class,'deleteTableShow'])->name('delete.table.show');
   Route::delete('tables/delete/{id}',[TableController::class,'deleteTable'])->name('delete.table.destroy');
});

Auth::routes();


