<?php

use App\Http\Controllers\MissingPersonController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReportController;
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

// Ресурсні маршрути для зниклих осіб (CRUD)
Route::resource('missing-persons', MissingPersonController::class);

// Маршрути для категорій (тільки перегляд)
Route::resource('categories', CategoryController::class)->only(['index', 'show']);

// Маршрути для локацій (тільки перегляд)
Route::resource('locations', LocationController::class)->only(['index', 'show']);

// Маршрути для звітів про появи
Route::resource('reports', ReportController::class)->only(['store', 'destroy']);

// Додаткові маршрути для звітів (прив'язані до конкретної особи)
Route::post('missing-persons/{missing_person}/reports', [ReportController::class, 'store'])
    ->name('missing-persons.reports.store');

// Сторінка "Про проект"
Route::view('/about', 'about')->name('about');
