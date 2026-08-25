<?php

use App\Enums\EstadoTarea;
use App\Models\Categoria;
use App\Models\Tareas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);

    Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
});


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        $tareas = Tareas::with('categoria')->where('usuario_id', Auth::id())->latest()->get();

        return view('welcome', [
            'total' => $tareas->count(),
            'pendientes' => $tareas->where('estado', EstadoTarea::PENDIENTE)->count(),
            'enProceso' => $tareas->where('estado', EstadoTarea::EN_PROCESO)->count(),
            'completadas' => $tareas->where('estado', EstadoTarea::COMPLETADA)->count(),
            'categorias' => Categoria::where('usuario_id', Auth::id())->count(),
            'recientes' => $tareas->take(5),
        ]);
    })->name('dashboard');

    Route::resource('categorias', App\Http\Controllers\CategoriasController::class)->except('show');
    Route::resource('tareas', App\Http\Controllers\TareasController::class)->except('show');
    Route::patch('tareas/{tarea}/estado', [App\Http\Controllers\TareasController::class, 'updateEstado'])->name('tareas.estado');
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

});