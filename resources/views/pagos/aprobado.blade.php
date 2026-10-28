<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¡Pago Exitoso! - Cerebritos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-emerald-50 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8 text-center space-y-6">
        <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto text-4xl font-bold">
            ✓
        </div>
        
        <h1 class="text-2xl font-bold text-gray-800">¡Pago Registrado con Éxito!</h1>
        <p class="text-gray-600 text-sm">Tu cita ha sido confirmada correctamente. Hemos guardado los detalles de tu transacción.</p>

        <div class="bg-gray-50 p-4 rounded-xl text-left text-sm space-y-2 border">
            <p><strong>Folio Cita:</strong> #{{ $pago->id_cita }}</p>
            <p><strong>Transacción:</strong> {{ $pago->transaccion_externa_id }}</p>
            <p><strong>Monto Pagado:</strong> ${{ number_format($pago->monto, 2) }}</p>
            <p><strong>Método:</strong> {{ $pago->metodo_pago }}</p>
            <p><strong>Estado:</strong> <span class="text-emerald-600 font-bold">{{ $pago->estatus_pago }}</span></p>
        </div>

        <a href="{{ url('/') }}" class="block w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition-colors shadow-md">
            Volver a la Página Principal
        </a>
    </div>
</body>
</html>