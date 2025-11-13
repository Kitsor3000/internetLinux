<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

// Головна -> каталог
Route::get('/', [ProductController::class, 'index'])->name('home');

// Каталог інструментів
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Сторінка товару
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Кошик
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Замовлення
Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
Route::post('/checkout', [OrderController::class, 'store'])->name('orders.store');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');


use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

Route::prefix('admin')->name('admin.')->group(function () {

    // Панель адміна -> список товарів
    Route::get('/', fn() => redirect()->route('admin.products.index'));

    // Товари (CRUD)
    Route::resource('products', AdminProductController::class);

    // Категорії (CRUD)
    Route::resource('categories', AdminCategoryController::class)->except(['show']);

    // Замовлення (перегляд + зміна статусу)
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'update']);
});
