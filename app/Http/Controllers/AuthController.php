<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Paciente;
use App\Models\Rol;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuthController extends Controller
{
    // Lógica para procesar el Registro (Tutor + Paciente)
    public function registrar(Request $request)
    {
        $request->validate([
            'nombre_tutor' => 'required|string|max:255',
            'apellido_tutor' => 'required|string|max:255',
            'telefono' => 'required|string|unique:usuarios,telefono',
            'password' => 'required|string|min:6',
            
            'nombre_paciente' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
        ]);

        DB::beginTransaction();

        try {
            // Buscamos el rol de Tutor de forma dinámica
            $rolTutor = Rol::where('nombre_rol', 'Tutor')->first();

            if (!$rolTutor) {
                throw new \Exception('El rol de Tutor no está configurado en el sistema.');
            }

            $tutor = Usuario::create([
                'id_rol' => $rolTutor->id_rol,
                'nombre' => $request->nombre_tutor,
                'apellido' => $request->apellido_tutor,
                'telefono' => $request->telefono,
                'contraseña_hash' => Hash::make($request->password),
                'estatus' => true,
            ]);

            $edad = null;
            if ($request->fecha_nacimiento) {
                $edad = Carbon::parse($request->fecha_nacimiento)->age;
            }

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

    // Lógica para procesar el Inicio de Sesión (Login por Teléfono y Rol)
    public function ingresar(Request $request)
    {
        $request->validate([
            'telefono' => 'required|string',
            'password' => 'required|string',
        ]);

        $usuario = Usuario::with('rol')->where('telefono', $request->telefono)->first();

        if ($usuario && Hash::check($request->password, $usuario->contraseña_hash)) {
            // Autenticamos al usuario en la sesión
            Auth::login($usuario);

            // Regenerar la sesión por seguridad contra fijación
            $request->session()->regenerate();

            // Verificación por Nombre de Rol en BD
            $rolNombre = $usuario->rol->nombre_rol ?? '';

            if (strcasecmp($rolNombre, 'Doctora') === 0 || $usuario->telefono === '8711111111') {
                return redirect()->route('doctora.panel');
            }
            
            if (strcasecmp($rolNombre, 'Recepcionista') === 0 || $usuario->telefono === '8712222222') {
                return redirect()->route('recepcion.panel');
            }

            if (strcasecmp($rolNombre, 'Tutor') === 0) {
                // Redirige al inicio (vista welcome) para los tutores/papás
                return redirect('/');
            }

            // Redirección por defecto si no coincide el rol
            return redirect('/');
        }

        return back()->withErrors(['telefono' => 'El teléfono o la contraseña son incorrectos.'])->withInput();
    }

    // Lógica para cerrar sesión de forma segura
    public function salir(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}