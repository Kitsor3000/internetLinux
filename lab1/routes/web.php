<?php

use App\Http\Controllers\LabController;
use Illuminate\Support\Facades\Route;

Route::middleware(['query.mode'])->group(function () {
    Route::get('/lab', [LabController::class, 'index'])->name('lab.index');
    Route::get('/lab/about', [LabController::class, 'about'])->name('lab.about');
    Route::get('/lab/status', [LabController::class, 'status'])->name('lab.status');
    Route::get('/lab/echo', [LabController::class, 'echo'])->name('lab.echo');
});

Route::get('/', function () {
    return view('welcome');
});
