<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expediente;

class ExpedienteController extends Controller
{
    public function show($id)
    {
        $expediente = Expediente::where('id_paciente', $id)->firstOrFail();

        return view('expedientes.show', compact('expediente'));
    }

 public function update(Request $request, $id)
{
        $request->validate([
            'antecedentes'          => 'nullable|string',
            'criterios_diagnostico' => 'nullable|string',
            'diagnostico_oficial'   => 'nullable|string',
            'evaluaciones'          => 'nullable|string',
            'notas_consulta'        => 'nullable|string',
            'plan_tratamiento'      => 'nullable|string',
        ]);

        $expediente = Expediente::findOrFail($id);

        $expediente->update($request->only([
            'antecedentes',
            'criterios_diagnostico',
            'diagnostico_oficial',
            'evaluaciones',
            'notas_consulta',
            'plan_tratamiento',
        ]));

        return redirect()->back()->with('success', 'Expediente actualizado correctamente.');
    }
}