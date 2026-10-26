<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Paciente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // Lógica para procesar el Registro (Tutor + Paciente)
    public function registrar(Request $request)
    {
        // Validar los campos basados en tu interfaz de registro
        $request->validate([
            'nombre_tutor' => 'required|string|max:255',
            'apellido_tutor' => 'required|string|max:255',
            'telefono' => 'required|string|unique:usuarios,telefono',
            'password' => 'required|string|min:6',
            
            'nombre_paciente' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
        ]);

        // Usamos una transacción para asegurar que si algo falla, no se guarde nada a medias
        DB::beginTransaction();

        try {
            // 1. Crear el usuario Tutor (Asumimos que el ID del rol de Tutor es 2, ajústalo si es diferente en tu BD)
            // Puedes insertar un rol por defecto o asegurarte de tener roles creados.
            $tutor = Usuario::create([
                'id_rol' => 2, // 2 = Tutor / Paciente (Ejemplo)
                'nombre' => $request->nombre_tutor,
                'apellido' => $request->apellido_tutor,
                'telefono' => $request->telefono,
                'contraseña_hash' => Hash::make($request->password), // Encriptamos contraseña
                'estatus' => true,
            ]);

            // 2. Calcular la edad opcionalmente o dejarla nula
            $edad = null;
            if ($request->fecha_nacimiento) {
                $edad = \Carbon\Carbon::parse($request->fecha_nacimiento)->age;
            }

            // 3. Crear el Paciente vinculado al Tutor recién creado
            Paciente::create([
                'id_tutor_usuario' => $tutor->id_usuario,
                'nombre' => $request->nombre_paciente,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'edad' => $edad,
                'escolaridad' => $request->escolaridad,
                'grado' => $request->grado,
            ]);

            DB::commit();

            return redirect()->route('login')->with('success', '¡Registro exitoso! Ya puedes iniciar sesión.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Ocurrió un error al registrar: ' . $e->getMessage()]);
        }
    }

    // Lógica para procesar el Inicio de Sesión (Login por Teléfono)
    public function ingresar(Request $request)
    {
        $request->validate([
            'telefono' => 'required|string',
            'password' => 'required|string',
        ]);

        // Buscar al usuario por su teléfono
        $usuario = Usuario::with('rol')->where('telefono', $request->telefono)->first();

        // Verificar si el usuario existe y si la contraseña coincide
       // En el método ingresar() del AuthController.php:

if ($usuario && Hash::check($request->password, $usuario->contraseña_hash)) {
    Auth::login($usuario);

    // Redirección estricta según el rol
    switch ($usuario->rol->nombre_rol) {
        case 'Doctora':
            return redirect()->route('doctora.panel'); // Pantalla específica de la doctora con los pacientes
        case 'Recepcionista':
            return redirect()->route('recepcion.panel'); // Panel de recepción
        case 'Tutor':
            return redirect()->route('tutor.dashboard'); // Vista del tutor
        default:
            return redirect()->route('home');
    }
}

        return back()->withErrors(['telefono' => 'El teléfono o la contraseña son incorrectos.'])->withInput();
    }
}
