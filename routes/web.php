<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\PictureController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController as ClientProductController;

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

Route::get('/',[HomeController::class,'index']);


Route::prefix("/dashboard")->group(function (){

    Route::get('/', function () {
        return view('Admin.layout.index');
    });

    Route::resource("/category",CategoryController::class);
    Route::resource("/brands",BrandController::class);
    Route::resource("/products",ProductController::class);
    Route::get('/products/pictures/{product}',[PictureController::class,'index'])->name('products.pictures');
    Route::post('/products/pictures/{product}/store',[PictureController::class,'store'])->name('products.pictures.store');
    Route::delete('/products/picture/{picture}/{product}/destroy',[PictureController::class,'destroy'])->name('products.pictures.destroy');
    //Route::resource('/products/discount',DiscountController::class);
    Route::get('/products/discount/{product}/create',[DiscountController::class,'create'])->name('discount.create');
    Route::post('/products/discount/{product}/store',[DiscountController::class,'store'])->name('discount.store');
    Route::get('/products/discount/{product}/edit',[DiscountController::class,'edit'])->name('discount.edit');
    Route::patch('/products/discount/{product}/update',[DiscountController::class,'update'])->name('discount.update');
    Route::delete('/products/discount/{product}/destroy',[DiscountController::class,'destroy'])->name('discount.destroy');

});

Route::get('/product/{product}', [ClientProductController::class,'index'])->name('client.product.index');

