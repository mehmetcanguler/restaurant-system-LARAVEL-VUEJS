<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MainController;
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

Route::get('/',[MainController::class,'index'])->name('index');

Route::resource('/category',CategoryController::class);

Route::get('order/{table_id}',[MainController::class,'order'])->name('addOrder');
Route::post('add-order-detail',[MainController::class,'addOrderDetail'])->name('addOrderDetail');
Route::put('edit-order-detail-qty/{id}',[MainController::class,'editOrderDetailQty'])->name('editOrderDetailQty');
Route::delete('delete-order-detail/{id}',[MainController::class,'deleteOrderDetail'])->name('deleteOrderDetail');
Route::post('complete-order',[MainController::class,'completeOrder'])->name('completeOrder');
Route::delete('delete-order/{id}',[MainController::class,'deleteOrder']);

Route::get('get-product',[MainController::class,'getProduct'])->name('getProduct');
Route::get('tables',[MainController::class,'tables']);

