<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctoraController;

// Rutas de Autenticación (Login - Públicas)
Route::get('/login', function () {
    return view('auth.login'); 
})->name('login');

Route::post('/login', [AuthController::class, 'ingresar'])->name('login.post');

// Rutas de Registro (Públicas para nuevos tutores)
Route::get('/registro', function () {
    return view('auth.register'); 
})->name('registro');

Route::post('/registro', [AuthController::class, 'registrar'])->name('registro.post');

// Rutas protegidas (EXIGEN iniciar sesión obligatoriamente)
Route::middleware(['auth'])->group(function () {

    // Página principal (Welcome) - Ahora protegida
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    // Panel de la Doctora
    Route::get('/doctora/panel', [DoctoraController::class, 'panel'])->name('doctora.panel');

    // Panel de la Recepcionista
    Route::get('/recepcion/panel', function () {
        return view('recepcion.panel');
    })->name('recepcion.panel');

    // Cerrar sesión (los regresa al login)
    Route::post('/logout', function () {
        Illuminate\Support\Facades\Auth::logout();
        return redirect()->route('login');
    })->name('logout');
});
=======

Route::get('/', function () {
    return view('welcome');
});
>>>>>>> d606654 (proyecto de la puta cabra del fortnite)
