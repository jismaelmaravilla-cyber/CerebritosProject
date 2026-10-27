<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table ="pagos"
    protected primarykey = "id_pago"
    protected $fillable =[
        "id_citas",
        "id_usuario_registrado",
        "monto",
        "tipo_pago",
        "metodo_pago",
        "estatus_pago",
        "transaccion_externa_id",
        "comprobante_valido",
        "comprobante_imagen_url",
        "fecha_pago"
    ]

    protected $casts =[
        "monto" =>"decimal, 2",
        "comprobante_valido"=>"boolean"
        "fecha_pago"=>"datetime:H:i"
    ]

    public function citas(){
        return $this->belongTo(Cita::class, "id_citas","id_citas")
    }
    public function citas(){
        return $this->belongTo(Usuario::class, "id_usuario_regristrado", "id_usuario_registrado")
    }
}
