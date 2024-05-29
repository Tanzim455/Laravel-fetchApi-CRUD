<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[ProductController::class,'allproducts']);
  Route::resource('products',ProductController::class);
  Route::post('products/store',[ProductController::class,'store'])->name('productsstore');
 Route::get('viewall',function(){
     return view('products.viewall');
 });
  Route::get('/carts',[CartController::class,'index']);
    Route::post('addTo/Cart',[CartController::class,'addToCart'])->name('addToCart');
