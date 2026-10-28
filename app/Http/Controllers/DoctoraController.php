<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class DoctoraController extends Controller
{
    public function panel()
    {
        
        $pacientes = Paciente::with('tutor')->latest()->get();

        
        return view('doctora.panel', compact('pacientes'));
    }
}