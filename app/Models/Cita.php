<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = "citas";
    protected $primaryKey = "id_cita";
    
   protected $fillable = [
        'id_usuario',
        'id_horario',
        'id_paciente',
        'origen',
        'fecha_cita',
        'hora_inicio',
        'hora_fin',
        'costo_total',
        'monto_total',
        'monto_anticipo', // <--- Agrégalo aquí
        'saldo_pendiente',
        'estado_cita'
    ];

    protected $casts = [
        "fecha_cita" => "date",
        "hora_inicio" => "datetime:H:i",
        "hora_fin" => "datetime:H:i",
        "costo_total" => "decimal:2",
        "monto_total" => "decimal:2",
        "saldo_pendiente" => "decimal:2"
    ];

    public function horarios_disponibles()
    {
        return $this->belongsTo(HorarioDisponible::class, "id_horario", "id_horario");
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');
    }
}