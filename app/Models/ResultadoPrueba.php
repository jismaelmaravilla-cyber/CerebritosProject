<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultadoPrueba extends Model
{
    protected $table = 'resultados_pruebas';
    protected $primaryKey = 'id_resultado';
    protected $fillable = [
        'id_paciente',
        'id_prueba',
        'puntaje_total',
        'disclaimer_prediagnostico',
        'observaciones_preliminares',
        'completada',
        'fecha_aplicacion'

    ];

    public function prueba()
    {
        return $this->belongsTo(Prueba::class, 'id_prueba', 'id_prueba');
    }
}
