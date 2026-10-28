<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\HorarioDisponibleController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ExpedienteController;
use App\Models\Paciente;

// La ruta raíz detecta si hay sesión activa y redirige según el rol
Route::get('/', function () {
    if (auth()->check()) {
        $usuario = auth()->user();
        $rolNombre = $usuario->rol->nombre_rol ?? '';
        
        if (strcasecmp($rolNombre, 'Doctora') === 0 || $usuario->telefono === '8711111111') {
            return redirect()->route('doctora.panel');
        }
        if (strcasecmp($rolNombre, 'Recepcionista') === 0 || $usuario->telefono === '8712222222') {
            return redirect()->route('recepcion.panel');
        }
        // Si es Tutor (papá/mamá), muestra la página principal de bienvenida
        return view('welcome');
    }
    
    // Si no ha iniciado sesión, ve el login
    return view('auth.login');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    
    Route::post('/login', [AuthController::class, 'ingresar'])->name('login.post');

    Route::get('/registro', function () {
        return view('auth.register');
    })->name('registro');
    
    Route::post('/registro', [AuthController::class, 'registrar'])->name('registro.post');
});

// Rutas protegidas (exigen obligatoriamente iniciar sesión)
Route::middleware('auth')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'salir'])->name('logout');

    // Panel de la doctora (Protegido y con la consulta de pacientes integrada)
    Route::get('/doctora/panel', function () {
        $pacientes = Paciente::with('tutor')->get();
        return view('recepcion.doctora.panel', compact('pacientes'));
    })->name('doctora.panel');

    Route::get('/recepcion/panel', function () {
        return view('recepcion.panel');
    })->name('recepcion.panel');

    Route::get('/tutor/dashboard', function () {
        return view('tutor.dashboard');
    })->name('tutor.dashboard');

    // Módulo de Citas
    Route::get('/citas', [CitaController::class, 'getCitas'])->name('cita.crear');
    Route::post('/citas', [CitaController::class, 'store']);
    
    Route::get('/pagos', [PagoController::class, 'create'])->name('pagos.create');
    Route::post('/pagos', [PagoController::class, 'store'])->name('pagos.store');
    
    Route::post('/horarios-disponibles', [HorarioDisponibleController::class, 'store']);
    
    Route::get('/expediente/{id}', [ExpedienteController::class, 'show'])->name('expediente.show');
    Route::put('/expediente/{id}', [ExpedienteController::class, 'update'])->name('expediente.update');
    Route::get('/pagos', [PagoController::class, 'create'])->name('pagos.create');
Route::post('/pagos', [PagoController::class, 'store'])->name('pagos.store');
Route::get('/pagos/aprobado/{id_pago}', [PagoController::class, 'aprobado'])->name('pagos.aprobado');
});