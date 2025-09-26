<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmailsController;

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
  ->names('users')->middleware(['auth', 'verified']);

// == RUTAS PARA ENVÍO DE CORREOS ==
// Envío de correo de bienvenida
Route::get('/enviar-correo', [EmailsController::class, 'welcomeEmail'])->name('send.welcome.email');
// Envío de correos masivo a usuarios con recuadro de texto
Route::post('/usuarios/enviar-mensaje', [EmailsController::class, 'sendMessage'])
  ->name('users.sendMessage');

// Envío de correos masivo a usuarios con formato de datos Blade - Manejo de errores
Route::get('enviar-mensajes', [EmailsController::class, 'indexsendMessage'])
  ->name('users.indexsendMessage')->middleware(['auth', 'verified']);
Route::post('/usuarios/enviar-mensajes', [EmailsController::class, 'send'])
  ->name('users.send');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';