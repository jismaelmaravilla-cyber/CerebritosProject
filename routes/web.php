<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctoraController;

// Ruta principal (redirige al login)
Route::get('/', function () {
    return view('auth.login');
});

// Rutas de Autenticación (Login)
Route::get('/login', function () {
    return view('auth.login'); 
})->name('login');

Route::post('/login', [AuthController::class, 'ingresar'])->name('login.post');

// Rutas de Registro (Tutor + Paciente)
Route::get('/registro', function () {
    return view('auth.register'); // Aquí irá tu vista de registro basada en tu diseño de Figma
})->name('registro');

Route::post('/registro', [AuthController::class, 'registrar'])->name('registro.post');

// Rutas protegidas (Requieren iniciar sesión)
Route::middleware(['auth'])->group(function () {

    // Panel de la Doctora (Muestra la lista de pacientes registrados dinámicamente)
    Route::get('/doctora/panel', [DoctoraController::class, 'panel'])->name('doctora.panel');

    // Panel del Tutor / Paciente
    Route::get('/tutor/dashboard', function () {
        return view('tutor.dashboard');
    })->name('tutor.dashboard');

    // Cerrar sesión
    Route::post('/logout', function () {
        Illuminate\Support\Facades\Auth::logout();
        return redirect()->route('login');
    })->name('logout');
});