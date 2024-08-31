<?php

use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/camera',function () {
    return view('camera');
});

Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store');

Route::get('/photos', [PhotoController::class, 'index'])->name('photos.index');
