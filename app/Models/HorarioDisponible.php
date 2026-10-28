<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioDisponible extends Model
{
    protected $table = "horarios_disponibles";
    protected $primaryKey = "id_horario"; 

    protected $fillable = [
        "dia_semana",
        "hora_inicio",
        "hora_fin",
        "status"
    ];

    protected $casts = [
        "hora_inicio" => "datetime:H:i",
        "hora_fin" => "datetime:H:i",
        "status" => "boolean"
    ];
}