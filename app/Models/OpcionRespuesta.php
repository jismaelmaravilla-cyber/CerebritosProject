<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpcionRespuesta extends Model
{
 protected $table = 'opciones_respuesta';
 protected $primaryKey = 'id_opcion';
protected $fillable = ['id_pregunta', 'texto_opcion', 'valor_puntos'];

public function pregunta()
{
    return $this->belongsTo(Pregunta::class, 'id_pregunta', 'id_pregunta');
    
}
}
