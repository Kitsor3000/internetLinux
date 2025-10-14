<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MissingPersonController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
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

// Головна сторінка - список зниклих осіб
Route::get('/', [MissingPersonController::class, 'index'])->name('home');

// Ресурсні маршрути для зниклих осіб
Route::resource('missing-persons', MissingPersonController::class);

// Маршрути для категорій
Route::resource('categories', CategoryController::class)->only(['index', 'show']);

// Маршрути для локацій
Route::resource('locations', LocationController::class);

// Сторінка пошуку
Route::get('/search', [MissingPersonController::class, 'index'])->name('search');

// Dashboard маршрути (для авторизованих користувачів)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
