<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';
    protected $primaryKey = 'id_paciente';

    protected $fillable = [
        'id_tutor_usuario',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'edad',
        'escolaridad',
        'grado',
        'parentesco_tutor',
    ];

    // Relación inversa con el usuario tutor
    public function tutor()
    {
        return $this->belongsTo(Usuario::class, 'id_tutor_usuario', 'id_usuario');
    }
}