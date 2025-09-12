<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(ImageController::class)->group(function () {
  Route::get('/usuario/avatar', 'fileUpload')->name('image.fileUpload');
  Route::post('/usuario/avatar', 'storeImage')->name('image.store');
})->middleware(['auth', 'verified']);

Route::resource('usuarios', UserController::class)
  ->parameters(['usuarios' => 'user'])
  ->names('users');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';