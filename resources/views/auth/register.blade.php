<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Cerebritos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f5f0eb] min-h-screen py-10 px-4">
    
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-200">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-teal-700">🧠 Cerebritos</h1>
            <p class="text-gray-500 text-sm">Registro de Tutor y Paciente</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('registro.post') }}" method="POST">
            @csrf
            
            <h2 class="text-lg font-semibold text-gray-700 mb-3 border-b pb-2">Información del Tutor</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Nombre(s):</label>
                    <input type="text" name="nombre_tutor" value="{{ old('nombre_tutor') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Apellido(s):</label>
                    <input type="text" name="apellido_tutor" value="{{ old('apellido_tutor') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Teléfono (Usuario para entrar):</label>
                    <input type="text" name="telefono" value="{{ old('telefono') }}" placeholder="Ej. 8712345678" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Contraseña:</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
                </div>
            </div>

            <h2 class="text-lg font-semibold text-gray-700 mb-3 border-b pb-2">Información del Paciente (Niño/a)</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Nombre:</label>
                    <input type="text" name="nombre_paciente" value="{{ old('nombre_paciente') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Apellido Paterno:</label>
                    <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Apellido Materno:</label>
                    <input type="text" name="apellido_materno" value="{{ old('apellido_materno') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Fecha de Nacimiento:</label>
                    <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Escolaridad:</label>
                    <input type="text" name="escolaridad" value="{{ old('escolaridad') }}" placeholder="Ej. Primaria" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Grado:</label>
                    <input type="text" name="grado" value="{{ old('grado') }}" placeholder="Ej. 3ro" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                </div>
            </div>

            <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 rounded-lg transition shadow-md">
                Registrar Tutor y Paciente
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-600">
            ¿Ya tienes una cuenta? 
            <a href="{{ route('login') }}" class="text-teal-600 font-semibold hover:underline">Iniciar sesión</a>
        </div>
    </div>

</body>
</html>