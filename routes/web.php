<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\TestController;

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
// Route::get('/h',[ProductController::class,'index'])->name('products');
Route::get('/cart',[ProductController::class,'cart'])->name('cart');
Route::get('/add-to-cart/{product}',[ProductController::class,'addtocart'])->name('add.cart');
Route::get('/remove/{id}',[ProductController::class,'removefromcart'])->name('remove');

Route::get('/',[ProductController::class,'index2']);

Route::post('/pay',[PaymentController::class,'pay']);
Route::get('stripe', [StripeController::class, 'stripe']);
Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');


Route::get('/dyna',[TestController::class,'dyna']);
Route::post('/dyna',[TestController::class,'submit']);