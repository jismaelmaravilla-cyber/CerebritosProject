<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HorarioDisponible;

class HorarioDisponibleController extends Controller
{
    public function store(Request $request) 
    {
        $request->validate([
            "dia_semana" => "required|string",
            "hora_inicio" => "required",
            "hora_fin" => "required|after:hora_inicio"
        ]);

        $existe = HorarioDisponible::where("dia_semana", $request->dia_semana)
            ->where("hora_inicio", $request->hora_inicio)
            ->where("hora_fin", $request->hora_fin)
            ->exists();

        if ($existe) {
            return back()->withErrors(["mensaje" => "Este horario ya está seleccionado."])->withInput();
        }

        HorarioDisponible::create([
            "dia_semana" => $request->dia_semana,
            "hora_inicio" => $request->hora_inicio,
            "hora_fin" => $request->hora_fin,
        ]);

        return redirect()->back()->with("success", "Horario disponible registrado correctamente.");
    }
}