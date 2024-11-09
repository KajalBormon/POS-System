<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* ---------Supplier Controller----------- */
    Route::controller(SupplierController::class)->group(function(){
        Route::get('/supplier-list','index')->name('supplier.index');
        Route::get('/supplier-create','create')->name('supplier.create');
        Route::post('/supplier-store','store')->name('supplier.store');
        Route::get('/supplier-edit/{id}', 'edit')->name("supplier.edit");
        Route::put("/supplier-update/{id}","update")->name("supplier.update");
        Route::get('/supplier-delete/{id}','destroy')->name('supplier.delete');
    });

    /* --------------Product Controller------------- */
    Route::controller(ProductController::class)->group(function(){
        Route::get('/product_list','index')->name('product.index');
        Route::get('/product_create','create')->name('product.create');
        Route::post('/product_store','store')->name('product.store');
        Route::get('/product_edit/{id}','edit')->name('product.edit');
        Route::put('/product_update/{id}','update')->name('product.update');
        Route::delete('/product_delete','destroy')->name('product.delete');
    });

    /* --------------Purchase Controller------------ */
    Route::controller(PurchaseController::class)->group(function(){
        Route::get('/purchase_list','index')->name('purchase.index');
        Route::get('/purchase_create','create')->name('purchase.create');
        Route::post('/purchase_store','store')->name('purchase.store');
        Route::get('/purchase_delete/{id}','destroy')->name('purchase.delete');
    });


    /* --------------Brands Controller------------- */
    Route::controller(BrandController::class)->group(function(){
        Route::get('/brands_list','index')->name('brand.index');
        Route::get('/brand_create','create')->name('brand.create');
        Route::post('/brands_store','store')->name('brand.store');
        Route::get('/brand_edit/{id}','edit')->name('brand.edit');
        Route::put('/brand_update/{id}','update')->name('brand.update');
        Route::delete('/brand_delete','destroy')->name('brand.delete');

    });


    /* --------------Category Controller -------------- */
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/category_list','index')->name('category.index');
        Route::get('/category_create','create')->name('category.create');
        Route::post('/category_store','store')->name('category.store');
        Route::get('/category_edit/{id}','edit')->name('category.edit');
        Route::put('/category_update/{id}','update')->name('category.update');
        Route::delete('/category_delete','destroy')->name('category.delete');

    });



});

require __DIR__.'/auth.php';
