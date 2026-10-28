<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de la Evaluación</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F3EFE6] text-gray-800 font-sans p-6">
    <div class="max-w-md mx-auto space-y-6">
        
        <div class="bg-[#E2CEF6] py-2 px-4 rounded-xl text-center font-bold text-[#5C3C8B]">
            Resultados de la evaluación
        </div>

        <!-- Tarjeta de Reporte Preliminar -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 text-center space-y-4">
            <h2 class="text-base font-bold text-[#4A3E3D]">Reporte preliminar de observaciones</h2>
            
            <div class="bg-[#FFEAD7] p-4 rounded-2xl text-left border border-[#F2D0B4]">
                <p class="text-xs text-gray-500 font-semibold uppercase">Puntaje acumulado:</p>
                <p class="text-2xl font-extrabold text-[#333]">{{ $resultado->puntaje_total }} Puntos</p>
                
                <p class="text-xs text-gray-500 font-semibold uppercase mt-3">Observación:</p>
                <p class="text-xs text-gray-700 mt-1 leading-relaxed">
                    {{ $resultado->observaciones_preliminares }}
                </p>
            </div>

            <p class="text-[11px] text-gray-400 italic text-justify leading-tight">
                * {{ $resultado->disclaimer_prediagnostico }}
            </p>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 text-center space-y-3">
            <p class="text-xs text-gray-600 font-medium">
                ¿Deseas profundizar en estos resultados con la Dra. Monserrat?
            </p>
            <a href="#" class="block w-full bg-[#64C9CF] text-white py-3 rounded-2xl font-bold shadow-sm hover:bg-[#52b5bb] transition">
                Agendar cita
            </a>
            <a href="{{ route('pruebas.index') }}" class="block text-xs text-gray-400 hover:underline">
                Volver al catálogo de pruebas
            </a>
        </div>

    </div>
</body>
</html>