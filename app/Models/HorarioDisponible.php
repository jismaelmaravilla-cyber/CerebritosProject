<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioDisponible extends Model
{
 protected $table ="horarios_disponibles";
 protected primarykey = "id_horario";
 protected $fillable = [
    "dia_semana",
    "hora_inicio",
    "hora_fin",
    "status"
 ]
 protected $casts[
    "hora_inicio" =>"datetime:H:1",
    "hora_fin" =>"datetime:H:1"
    "status"=>"boolean"
 ]
 
}
