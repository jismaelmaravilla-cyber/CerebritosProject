<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class DoctoraController extends Controller
{
    public function panel()
    {
        // Obtenemos todos los pacientes junto con la información de su tutor (usuario)
        $pacientes = Paciente::with('tutor')->latest()->get();

        // Retornamos la vista del panel de la doctora pasando los pacientes
        return view('doctora.panel', compact('pacientes'));
    }
}