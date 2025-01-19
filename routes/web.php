<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;




Route::get('products/search', [ProductController::class, 'productSearch'])->name('products.search');
Route::get('/products', [ProductController::class, 'productList'])->name('products.list');
Route::get('/products/create', [ProductController::class, 'productCreate'])->name('product.create');
Route::post('/products', [ProductController::class, 'productStore'])->name('product.store');
Route::get('/products/{product}', [ProductController::class, 'productShow'])->name('product.show');
Route::get('/products/{product}/edit', [ProductController::class, 'productEdit'])->name('product.edit');
Route::put('/products/{product}', [ProductController::class, 'productUpdate'])->name('product.update');
Route::delete('/products/{product}', [ProductController::class, 'productDelete'])->name('product.delete');
