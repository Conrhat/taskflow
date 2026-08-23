<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);

    Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
});


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('dashboard');

    Route::resource('categorias', App\Http\Controllers\CategoriasController::class)->except('show');
    Route::resource('tareas', App\Http\Controllers\TareasController::class)->except('show');
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

});