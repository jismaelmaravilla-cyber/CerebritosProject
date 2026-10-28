<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cerebritos - Pruebas Psicológicas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F3EFE6] text-gray-800 font-sans p-6">
    <div class="max-w-md mx-auto space-y-6">
        
        <div class="bg-[#FFEAD7] p-6 rounded-2xl text-center shadow-sm border border-[#F2D0B4]">
            <h1 class="text-xl font-bold text-[#4A3E3D]">Prueba de desarrollo controlada</h1>
            <p class="mt-2 text-sm text-gray-600">
                En este apartado podrás tomar una prueba preliminar para reconocer posibles patrones que indicarían la necesidad de un especialista.
            </p>
        </div>

        <!-- Sección 1: Pruebas de Tamizaje -->
        <div>
            <div class="bg-[#FF6584] text-white py-2 px-4 rounded-xl text-center font-bold mb-3">
                Prueba de Tamizaje / Diagnóstico
            </div>
            @foreach($pruebasDiagnostico as $prueba)
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between mb-4">
                    <div>
                        <h2 class="font-bold text-lg text-[#333]">{{ $prueba->titulo }}</h2>
                        <p class="text-xs text-gray-500 mt-1">{{ $prueba->descripcion }}</p>
                        <div class="mt-3 text-xs text-gray-400 space-y-1">
                            <p><strong>Enfoque:</strong> {{ $prueba->enfoque_edad }}</p>
                        </div>
                    </div>
                    <a href="{{ route('pruebas.contestar', $prueba->id_prueba) }}" 
                       class="mt-4 bg-[#64C9CF] text-white text-center py-2.5 rounded-xl font-bold shadow-sm hover:bg-[#52b5bb] transition">
                        Iniciar prueba
                    </a>
                </div>
            @endforeach
        </div>

        <div>
            <div class="bg-[#D0BFFF] text-[#4A3E3D] py-2 px-4 rounded-xl text-center font-bold mb-3">
                Pruebas de Seguimiento y Cuidado en Casa
            </div>
            @foreach($pruebasPaliativas as $prueba)
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between mb-4">
                    <div>
                        <h2 class="font-bold text-lg text-[#333]">{{ $prueba->titulo }}</h2>
                        <p class="text-xs text-gray-500 mt-1">{{ $prueba->descripcion }}</p>
                        <div class="mt-3 text-xs text-gray-400 space-y-1">
                            <p><strong>Enfoque:</strong> {{ $prueba->enfoque_edad }}</p>
                        </div>
                    </div>
                    <a href="{{ route('pruebas.contestar', $prueba->id_prueba) }}" 
                       class="mt-4 bg-[#64C9CF] text-white text-center py-2.5 rounded-xl font-bold shadow-sm hover:bg-[#52b5bb] transition">
                        Iniciar prueba
                    </a>
                </div>
            @endforeach
        </div>

    </div>
</body>
</html>