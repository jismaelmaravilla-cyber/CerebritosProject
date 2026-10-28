<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\HorarioDisponible;
use App\Models\Paciente;

class CitaController extends Controller
{
    public function getCitas(Request $request)
    {
        // Obtenemos los horarios disponibles y aplicamos unique('hora_inicio') para evitar filas repetidas en la vista
        $horarios = HorarioDisponible::where('status', true)
            ->get()
            ->unique('hora_inicio');
        
        if ($horarios->isEmpty()) {
            $horarios = HorarioDisponible::all()->unique('hora_inicio');
        }

        $usuario = auth()->user();
        
        if ($usuario && $usuario->tutor) {
            $pacientes = $usuario->tutor->pacientes;
        } else {
            $pacientes = Paciente::all();
        }

        return view('citas.create', compact('horarios', 'pacientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha_cita'  => 'required|date',
            'id_horario'  => 'required|exists:horarios_disponibles,id_horario', 
            'id_paciente' => 'required|exists:pacientes,id_paciente', 
        ]);

        $usuarioId = auth()->id() ?? (auth()->user()->id_usuario ?? null);
        $horario = HorarioDisponible::find($request->id_horario);

        // Creamos la cita cubriendo las tarifas base y columnas obligatorias de la BD
        $cita = Cita::create([
            'id_usuario'      => $usuarioId,
            'id_horario'      => $request->id_horario,
            'id_paciente'     => $request->id_paciente,
            'fecha_cita'      => $request->fecha_cita,
            'hora_inicio'     => $horario ? $horario->hora_inicio : '09:00:00',
            'hora_fin'        => $horario ? $horario->hora_fin : '10:00:00',
            'costo_total'     => 900.00,
            'monto_anticipo'  => 300.00,
            'saldo_pendiente' => 900.00,
            'origen'          => 'Web',
            'estado_cita'     => 'Pendiente',
        ]);

        return redirect()->route('pagos.create', ['id_cita' => $cita->id_cita])
                         ->with('excelente', '¡Cita seleccionada con éxito! Procede con tu pago.');
    }
}