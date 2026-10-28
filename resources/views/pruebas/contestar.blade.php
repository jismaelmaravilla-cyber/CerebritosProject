<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $prueba->titulo }} - Cuestionario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F3EFE6] text-gray-800 font-sans p-6">
    <div class="max-w-md mx-auto bg-white rounded-3xl p-6 shadow-md border border-gray-100">
        
        <a href="{{ route('pruebas.index') }}" class="text-xs text-gray-400 font-bold hover:underline mb-4 inline-block">
            &larr; Volver al inicio
        </a>

        <div class="bg-[#E2CEF6] py-2 px-4 rounded-xl text-center font-bold text-[#5C3C8B] mb-6">
            {{ $prueba->titulo }}
        </div>

        <form action="{{ route('pruebas.guardar', $prueba->id_prueba) }}" method="POST" class="space-y-6">
            @csrf
            
            <input type="hidden" name="id_paciente" value="1">

            @foreach($prueba->preguntas as $index => $pregunta)
                <div class="bg-[#FAF7F2] p-4 rounded-2xl border border-[#EFE8DC]">
                    <p class="font-semibold text-sm text-[#333] mb-3">
                        {{ $index + 1 }}. {{ $pregunta->texto_pregunta }}
                    </p>

                    <div class="grid grid-cols-3 gap-2">
                        @foreach($pregunta->opciones as $opcion)
                            <label class="cursor-pointer">
                                <input type="radio" name="respuestas[{{ $pregunta->id_pregunta }}]" value="{{ $opcion->id_opcion }}" class="peer hidden" required>
                                <div class="bg-white border-2 border-gray-200 peer-checked:border-[#64C9CF] peer-checked:bg-[#EBF9FA] text-center py-2 px-1 rounded-xl text-xs font-semibold text-gray-600 peer-checked:text-[#2B7A7E] transition">
                                    {{ $opcion->texto_opcion }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <button type="submit" class="w-full bg-[#FF6584] text-white py-3 rounded-2xl font-bold shadow-md hover:bg-[#e05471] transition">
                Finalizar y ver resultado
            </button>
        </form>

    </div>
</body>
</html>