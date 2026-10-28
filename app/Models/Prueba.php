<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    protected $table = 'pruebas';
    protected $primaryKey = 'id_prueba';
    protected $fillable = ['titulo', 'descripcion', 'tipo_prueba', 'enfoque_edad'];

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class, 'id_prueba', 'id_prueba');
    }
}
