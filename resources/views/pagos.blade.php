<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirma y paga tu cita - Neurodesarrollo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-crema-bg min-h-screen text-verde-texto font-sans flex flex-col justify-center items-center p-6 md:p-12">

<div class="w-full max-w-5xl mx-auto">
    <div class="mb-6">
        <a href="{{ url('/citas') }}" class="inline-block hover:opacity-80 transition-opacity">
            <svg class="w-8 h-8 text-verde-texto" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pagos.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
        @csrf
        <input type="hidden" name="id_cita" value="{{ $id_cita ?? 1 }}">
        <input type="hidden" name="tipo_pago" id="input_tipo_pago" value="anticipo">
        <input type="hidden" name="metodo_pago" id="input_metodo_pago" value="Tarjeta">

        <!-- SECCIÓN IZQUIERDA: Resumen de la cita -->
        <div class="space-y-6">
            <h1 class="text-3xl md:text-4xl font-bold leading-tight text-verde-texto">
                Completa tu reserva
            </h1>
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 space-y-4">
                <h2 class="text-xl font-semibold border-b pb-2">Detalles del Servicio</h2>
                <p><strong>Paciente:</strong> {{ $cita->paciente->nombre ?? 'Paciente' }}</p>
                <p><strong>Fecha:</strong> {{ $cita->fecha_cita ?? 'N/A' }}</p>
                <p><strong>Horario:</strong> {{ $cita->hora_inicio ?? '' }} - {{ $cita->hora_fin ?? '' }}</p>
                
                <div class="pt-4 border-t">
                    <label class="block font-medium mb-2">Modalidad de pago:</label>
                    <div class="flex gap-4">
                        <button type="button" onclick="setTipoPago('anticipo', 300)" id="btn-anticipo" class="flex-1 py-2 px-4 rounded-lg border-2 border-emerald-600 bg-emerald-50 text-emerald-800 font-bold">
                            Anticipo ($300.00)
                        </button>
                        <button type="button" onclick="setTipoPago('completo', 900)" id="btn-completo" class="flex-1 py-2 px-4 rounded-lg border-2 border-gray-200 text-gray-600">
                            Total ($900.00)
                        </button>
                    </div>
                </div>

                <div class="text-2xl font-bold text-right pt-2 text-emerald-700">
                    Monto a pagar: $<span id="monto-display">300.00</span>
                </div>
            </div>
        </div>

        <!-- SECCIÓN DERECHA: Métodos de Pago y Formularios dinámicos -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 space-y-6">
            <h2 class="text-xl font-semibold">Selecciona el Método de Pago</h2>

            <!-- Selector de Métodos -->
            <div class="grid grid-cols-3 gap-3">
                <button type="button" onclick="setMetodo('Tarjeta')" id="metodo-Tarjeta" class="py-3 px-2 text-center rounded-xl border-2 border-emerald-600 bg-emerald-50 font-bold text-sm">
                    💳 Tarjeta
                </button>
                <button type="button" onclick="setMetodo('PayPal')" id="metodo-PayPal" class="py-3 px-2 text-center rounded-xl border-2 border-gray-200 font-bold text-sm">
                    🅿️ PayPal
                </button>
                <button type="button" onclick="setMetodo('Transferencia')" id="metodo-Transferencia" class="py-3 px-2 text-center rounded-xl border-2 border-gray-200 font-bold text-sm">
                    🏦 Transferencia
                </button>
            </div>

            <!-- Campos: TARJETA -->
            <div id="form-Tarjeta" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Número de Tarjeta</label>
                    <input type="text" name="numero_tarjeta" placeholder="1234 5678 9012 3456" maxlength="16" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Expiración (MM/AA)</label>
                        <input type="text" name="expiracion" placeholder="12/28" maxlength="5" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">CVV</label>
                        <input type="password" name="cvv" placeholder="123" maxlength="4" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                </div>
            </div>

            <!-- Campos: PAYPAL -->
            <div id="form-PayPal" class="space-y-4 hidden">
                <div class="p-4 bg-blue-50 text-blue-800 rounded-lg text-sm">
                    Serás redirigido a la plataforma de PayPal para autorizar el pago con tu cuenta.
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Correo asociado a PayPal</label>
                    <input type="email" name="paypal_email" placeholder="usuario@paypal.com" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                </div>
            </div>

            <!-- Campos: TRANSFERENCIA -->
            <div id="form-Transferencia" class="space-y-4 hidden">
                <div class="p-4 bg-gray-50 rounded-lg text-sm space-y-1">
                    <p class="font-bold text-gray-800">Datos Bancarios para Depósito/Transferencia:</p>
                    <p><strong>Banco:</strong> BBVA Bancomer</p>
                    <p><strong>CLABE:</strong> 0121 8000 1234 5678 90</p>
                    <p><strong>Cuenta:</strong> 1234567890</p>
                    <p><strong>Beneficiario:</strong> Cerebritos Neurodesarrollo</p>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Adjuntar comprobante de pago (JPG, PNG o PDF)</label>
                    <input type="file" name="comprobante" accept="image/*,.pdf" class="w-full p-2 border rounded-lg">
                </div>
            </div>

            <button type="submit" class="w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition-colors shadow-md">
                Confirmar y Procesar Pago
            </button>
        </div>
    </form>
</div>

<script>
function setTipoPago(tipo, monto) {
    document.getElementById('input_tipo_pago').value = tipo;
    document.getElementById('monto-display').innerText = monto.toFixed(2);
    
    if (tipo === 'anticipo') {
        document.getElementById('btn-anticipo').className = 'flex-1 py-2 px-4 rounded-lg border-2 border-emerald-600 bg-emerald-50 text-emerald-800 font-bold';
        document.getElementById('btn-completo').className = 'flex-1 py-2 px-4 rounded-lg border-2 border-gray-200 text-gray-600';
    } else {
        document.getElementById('btn-completo').className = 'flex-1 py-2 px-4 rounded-lg border-2 border-emerald-600 bg-emerald-50 text-emerald-800 font-bold';
        document.getElementById('btn-anticipo').className = 'flex-1 py-2 px-4 rounded-lg border-2 border-gray-200 text-gray-600';
    }
}

function setMetodo(metodo) {
    document.getElementById('input_metodo_pago').value = metodo;

    ['Tarjeta', 'PayPal', 'Transferencia'].forEach(m => {
        const btn = document.getElementById(`metodo-${m}`);
        const form = document.getElementById(`form-${m}`);
        if (m === metodo) {
            btn.className = 'py-3 px-2 text-center rounded-xl border-2 border-emerald-600 bg-emerald-50 font-bold text-sm';
            form.classList.remove('hidden');
        } else {
            btn.className = 'py-3 px-2 text-center rounded-xl border-2 border-gray-200 font-bold text-sm';
            form.classList.add('hidden');
        }
    });
}
</script>
</body>
</html>