<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';
    protected $primaryKey = 'id_pago';

    protected $fillable = [
        'id_cita',           
        'id_usuario',
        'monto',
        'tipo_pago',
        'metodo_pago',
        'transaccion_externa_id',
        'estatus_pago',
        'comprobante_imagen_url',
        'fecha_pago',
    ];
}