<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prueba;
use App\Models\ResultadoPrueba;
use App\Models\OpcionRespuesta;

class PruebaController extends Controller
{
    public function index()
    {
        $pruebasDiagnostico = Prueba::where('tipo_prueba', 'Diagnostico')->get();
        
        $pruebasPaliativas = Prueba::where('tipo_prueba', 'Paliativa')->get();
    
    return view('pruebas.index', compact('pruebasDiagnostico', 'pruebasPaliativas'));    
    }

    public function contestar($id)
    {
        $prueba = Prueba::with('preguntas.opciones')->findOrFail($id);

        return view('pruebas.contestar', compact('prueba'));

    }


    public function guardarRespuestas(Request $request, $id)
    {
        $request->validate([
            'respuestas' => 'required|array',
            'id_paciente' => 'required|integer'
        ]);

        $puntajeTotal = 0;

        foreach($request->respuestas as $idPregunta => $idOpcion){
            $opcion = OpcionRespuesta::find($idOpcion);
            if($opcion){
                $puntajeTotal += $opcion->valor_puntos;

            }
        }

        $observacion = "Resultados.";
        if($puntajeTotal>=10){
            $observacion = "Resultados elevados. Se recomienda una valoración del especialista";
        }elseif ($puntajeTotal >=5){
         $observacion = "Indicadores leves. Se recomienda una valoracion del especialista";
        }

        $resultado = ResultadoPrueba::create([
            'id_paciente' => $request->id_paciente,
            'id_prueba' => $id,
            'puntaje_total' => $puntajeTotal,
            'disclaimer_prediagnostico' => 'Este resultado es solo un prediagnostico sin validez oficial, por favor, contacte a un especialista.',
            'observaciones_preliminares' => $observacion,
            'completada' => 1,
            'fecha_aplicacion' => now()
        ]);

        return redirect()->route('pruebas.resultado', $resultado->id_resultado);

    }

    public function verResultado($idResultado)
    {
        $resultado = ResultadoPrueba::with('prueba')->findOrFail($idResultado);

        return view('pruebas.resultado', compact('resultado'));

    }
}
