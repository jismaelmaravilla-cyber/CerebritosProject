<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = "citas";
    protected primarykey = "id_cita";
    protected $fillable = [
        'id_usuario',
        'id_horario',
        'origen',
        'fecha_cita',
        'hora_inicio',
        'hora_fin',
        'costo_total',
        'monto_total',
        'saldo_pendiente',
        'estado_cita'
    ];
    protected $casts[
        "fecha_cita"=> "date",
        "hora_inicio"=>"datetime:H:i",
        "hora_fin"=>"datetime:H:i",
        "costo_total"=>"decimal:2"
        "monto_anticipado"=>"decimal:2"
        "saldo_pendiente"=>"decimal:2"
        
    ];

    //una cita tiene un horario
    //un usuario puede tener muchas citas
public function horarios_disponibles(){
    return $this->belongsTo(HorarioDisponible::class, "id_horario", "id_horario");
}
public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }
}
