<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    protected $table = "expediente";
    protected primarykey = "id_expediente";
    protected $fillable =[
        "id_paciente",
        "antecedentes",
        "criterios_diagnostico",
        "criterios_diagnostico",
        "diagnostico_oficial",
        "notas_consulta",
        "plan_tratamiento",
        "fecha_registro"
    ];

    protected $casts =[
        "fecha_registro"=>"datetime:H:i"
    ];
   
 public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');
    }

}
