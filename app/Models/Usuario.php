<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    // Indicamos el nombre real de la tabla y su llave primaria personalizada
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

    // Ocultamos la contraseña por seguridad
    protected $hidden = [
        'contraseña_hash',
    ];

    // Le decimos a Laravel que use 'contraseña_hash' en lugar de 'password'
    public function getAuthPassword()
    {
        return $this->contraseña_hash;
    }

    // Relación con Roles
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    // Relación con Pacientes (un tutor puede tener pacientes registrados)
    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'id_tutor_usuario', 'id_usuario');
    }
}
