<?php

use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SoldController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserPermission;

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
Auth::routes(['verify' => true]);
Route::resource('profile', ProfileController::class);
Route::resource('category', CategoryController::class)->middleware(UserPermission::class);;
Route::resource('category.subcategory', SubCategoryController::class)->middleware(UserPermission::class);;
Route::resource('product', ProductController::class)->middleware(UserPermission::class);
Route::resource('customer', CustomerController::class);
Route::resource('addtocart', AddToCartController::class);
Route::resource('sold', SoldController::class)->middleware(UserPermission::class);;
Route::resource('wishlist', WishlistController::class);
Route::resource('order',OrderController::class);
Route::resource('chat',ChatController::class);
Route::resource('user-address',UserAddressController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

