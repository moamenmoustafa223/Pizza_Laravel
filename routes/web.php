<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('frontpage');
Route::get('/pizzas/{pizza}', [App\Http\Controllers\FrontendController::class, 'show'])->name('pizzas.show');
Route::post('/order/store', [App\Http\Controllers\FrontendController::class, 'store'])->name('order.store');

Route::group(['prefix' => 'admin'], function () {
    // Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],function(){
    

Route::get('/pizzas', [App\Http\Controllers\PizzaController::class, 'index'])->name('pizzas.index');
Route::get('/pizzas/create', [App\Http\Controllers\PizzaController::class, 'create'])->name('pizzas.create');
Route::get('/pizzas/edit/{pizza}', [App\Http\Controllers\PizzaController::class, 'edit'])->name('pizzas.edit');
Route::put('/pizzas/update/{pizza}', [App\Http\Controllers\PizzaController::class, 'update'])->name('pizzas.update');
Route::delete('/pizzas/destroy/{pizza}', [App\Http\Controllers\PizzaController::class, 'destroy'])->name('pizzas.destroy');
Route::post('/pizzas/store', [App\Http\Controllers\PizzaController::class, 'store'])->name('pizzas.store');




//user order

Route::get('/user/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
Route::post('/order/{id}/status', [App\Http\Controllers\OrderController::class, 'changeStatus'])->name('order.status');


Route::get('/customers', [App\Http\Controllers\OrderController::class, 'customers'])->name('customers');

});