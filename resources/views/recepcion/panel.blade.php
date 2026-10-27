<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Recepción - Cerebritos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f5f0eb] min-h-screen">
    
    <!-- Barra superior -->
    <nav class="bg-teal-600 text-white shadow-md px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <span class="text-xl font-bold">🧠 Cerebritos | Panel de Recepción</span>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg text-sm font-semibold transition">
                Cerrar Sesión
            </button>
        </form>
    </nav>

    <!-- Contenido Principal -->
    <div class="max-w-4xl mx-auto px-6 py-12 text-center">
        <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-200">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">¡Bienvenida, Recepcionista!</h1>
            <p class="text-gray-600 mb-6">Desde aquí podrás gestionar citas, recepción de pacientes y control general del consultorio.</p>
            
            <div class="p-6 bg-teal-50 rounded-xl border border-teal-100 text-teal-800">
                <p class="font-medium">Panel en desarrollo. Pronto encontrarás aquí las herramientas de gestión rápida.</p>
            </div>
        </div>
    </div>

</body>
</html>