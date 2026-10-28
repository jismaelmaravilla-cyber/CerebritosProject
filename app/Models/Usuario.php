<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'id_rol',
        'nombre',
        'apellido',
        'telefono',
        'contraseña_hash',
        'estatus',
    ];

    protected $hidden = [
        'contraseña_hash',
    ];

    public function getAuthPassword()
    {
        return $this->contraseña_hash;
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'id_tutor_usuario', 'id_usuario');
    }
}