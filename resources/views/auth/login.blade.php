<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Cerebritos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f5f0eb] flex items-center justify-center min-h-screen">
    
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md border border-gray-200">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-teal-700">🧠 Cerebritos</h1>
            <p class="text-gray-500 text-sm">Inicia sesión para acceder al sistema</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Teléfono:</label>
                <input type="text" name="telefono" value="8711111111" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Contraseña:</label>
                <input type="password" name="password" value="doctora123" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
            </div>

            <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-2.5 rounded-lg transition">
                Entrar al Sistema
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-600">
            ¿Eres tutor y quieres registrarte? 
            <a href="{{ route('registro') }}" class="text-teal-600 font-semibold hover:underline">Ir al registro</a>
        </div>
    </div>

</body>
</html>