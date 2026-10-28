<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Cita;

class PagoController extends Controller
{
    public function create(Request $request)
    {
        $id_cita = $request->query('id_cita');
        $cita = Cita::with(['paciente', 'horarios_disponibles'])->find($id_cita);

        return view('pagos', compact('id_cita', 'cita'));
    }

    public function store(Request $request)
    {
        // 1. Validaciones base
        $rules = [
            'id_cita'     => 'required|exists:citas,id_cita',
            'tipo_pago'   => 'required|in:anticipo,completo',
            'metodo_pago' => 'required|in:Tarjeta,PayPal,Transferencia',
        ];

        // 2. Validaciones condicionales según el método de pago seleccionado
        if ($request->metodo_pago === 'Tarjeta') {
            $rules['numero_tarjeta'] = 'required|numeric|digits:16';
            $rules['expiracion']     = 'required|string|min:4';
            $rules['cvv']            = 'required|numeric|digits_between:3,4';
        } elseif ($request->metodo_pago === 'PayPal') {
            $rules['paypal_email']   = 'required|email';
        } elseif ($request->metodo_pago === 'Transferencia') {
            $rules['comprobante']    = 'required|file|mimes:jpg,jpeg,png,pdf|max:2048';
        }

        $request->validate($rules);

        // 3. Procesar archivo si es transferencia
        $comprobanteUrl = null;
        if ($request->hasFile('comprobante')) {
            $comprobanteUrl = $request->file('comprobante')->store('comprobantes', 'public');
        }

        // 4. Determinar monto
        $monto = ($request->tipo_pago === 'anticipo') ? 300.00 : 900.00;

        $idUsuario = auth()->id() ?? auth()->user()->id_usuario ?? 1;

        // 5. Crear Pago
        $pago = Pago::create([
            'id_cita'                => $request->id_cita,
            'id_usuario'             => $idUsuario,
            'monto'                  => $monto,
            'tipo_pago'              => $request->tipo_pago,
            'metodo_pago'            => $request->metodo_pago,
            'transaccion_externa_id' => 'SIM-PAY-' . rand(10000, 99999),
            'estatus_pago'           => 'Completado',
            'comprobante_imagen_url' => $comprobanteUrl,
            'fecha_pago'             => now(),
        ]);

        // 6. Actualizar estado de la Cita de forma correcta
        $cita = Cita::find($request->id_cita);
        if ($cita) {
            $saldoPendiente = ($request->tipo_pago === 'anticipo') ? ($cita->costo_total - 300.00) : 0.00;
            
            $cita->update([
                'estado_cita'     => 'Confirmada',
                'saldo_pendiente' => $saldoPendiente
            ]);
        }

        // Redirigir a la vista de aprobación enviando el ID del pago
        return redirect()->route('pagos.aprobado', ['id_pago' => $pago->id_pago]);
    }

    public function aprobado($id_pago)
    {
        $pago = Pago::findOrFail($id_pago);
        return view('pagos.aprobado', compact('pago'));
    }
}