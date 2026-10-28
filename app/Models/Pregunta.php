<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $table = 'preguntas';
    protected $primaryKey = "id_pregunta";
    protected $fillable = ['id_prueba', 'texto_pregunta'];

    public function opciones()
    {
      return $this->hasMany(OpcionRespuesta::class, 'id_pregunta', 'id_pregunta');
    }

    public function prueba()
    {
        return $this->belongsTo(Prueba::class, 'id_prueba', 'id_prueba');
    }

}
