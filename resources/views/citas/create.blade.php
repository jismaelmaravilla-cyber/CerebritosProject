<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elige tu fecha y horario - Neurodesarrollo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'crema-bg': '#F2ECE4',
                        'verde-texto': '#385040',
                        'verde-turquesa': '#78C6C7',
                        'cyan-btn': '#00C2CB',
                        'rosa-brand': '#F4A8A8',
                        'deshabilitado': '#D8D1C7'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-crema-bg min-h-screen text-verde-texto font-sans flex flex-col justify-center items-center p-6 md:p-12">

    <div class="w-full max-w-5xl mx-auto">
        <!-- Botón de Regresar corregido a la ruta raíz -->
        <div class="mb-6">
            <a href="{{ url('/') }}" class="inline-block hover:opacity-80 transition-opacity">
                <svg class="w-8 h-8 text-verde-texto" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
        </div>

        @if(session('excelente'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-2xl mb-6 text-center font-medium">
                {{ session('excelente') }}
            </div>
        @endif

        <form action="{{ url('/citas') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            @csrf

            <!-- SECCIÓN IZQUIERDA: Marca y Frase -->
            <div class="space-y-8 pr-0 md:pr-6">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-full bg-rosa-brand flex-shrink-0"></div>
                    <p class="text-sm md:text-base tracking-wide">
                        <span class="font-bold text-verde-texto">Neurodesarrollo</span> 
                        <span class="font-normal text-verde-texto/80">con Amor</span>
                    </p>
                </div>

                <div class="space-y-3">
                    <h1 class="text-3xl md:text-4xl lg:text-[2.6rem] font-bold leading-tight text-verde-texto">
                        Cada día que pasa logramos más sonrisas
                    </h1>
                    <p class="text-verde-texto/70 text-sm md:text-base">
                        y vamos por muchas más.
                    </p>
                </div>
            </div>

            <!-- SECCIÓN DERECHA: Formulario e Interacción -->
            <div class="space-y-6">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-verde-texto">
                        Elige tu fecha y horario
                    </h2>
                    <p class="text-xs md:text-sm text-verde-texto/70 mt-1 font-medium">
                        Agosto 2026
                    </p>
                </div>

                <!-- Campo Oculto de Fecha -->
                <input type="hidden" name="fecha_cita" id="fecha_cita" value="2026-08-13" required>

                <!-- Tira Semanal Interactiva -->
                <div class="flex justify-between items-center text-center gap-1">
                    <button type="button" onclick="seleccionarDia(this, '2026-08-11', 'martes 11')" class="dia-btn flex flex-col items-center py-2 px-3 rounded-2xl text-verde-texto hover:bg-black/5 transition">
                        <span class="text-xs text-verde-texto/70">Mar</span>
                        <span class="text-base font-bold mt-1">11</span>
                    </button>
                    <button type="button" onclick="seleccionarDia(this, '2026-08-12', 'miércoles 12')" class="dia-btn flex flex-col items-center py-2 px-3 rounded-2xl text-verde-texto hover:bg-black/5 transition">
                        <span class="text-xs text-verde-texto/70">Mié</span>
                        <span class="text-base font-bold mt-1">12</span>
                    </button>
                    <button type="button" onclick="seleccionarDia(this, '2026-08-13', 'jueves 13')" class="dia-btn flex flex-col items-center py-2.5 px-4 rounded-2xl bg-verde-turquesa text-verde-texto shadow-sm font-extrabold">
                        <span class="text-xs font-medium">Jue</span>
                        <span class="text-base font-extrabold mt-0.5">13</span>
                    </button>
                    <button type="button" onclick="seleccionarDia(this, '2026-08-14', 'viernes 14')" class="dia-btn flex flex-col items-center py-2 px-3 rounded-2xl text-verde-texto hover:bg-black/5 transition">
                        <span class="text-xs text-verde-texto/70">Vie</span>
                        <span class="text-base font-bold mt-1">14</span>
                    </button>
                    <button type="button" onclick="seleccionarDia(this, '2026-08-15', 'sábado 15')" class="dia-btn flex flex-col items-center py-2 px-3 rounded-2xl text-verde-texto hover:bg-black/5 transition">
                        <span class="text-xs text-verde-texto/70">Sáb</span>
                        <span class="text-base font-bold mt-1">15</span>
                    </button>
                    <button type="button" onclick="seleccionarDia(this, '2026-08-17', 'lunes 17')" class="dia-btn flex flex-col items-center py-2 px-3 rounded-2xl text-verde-texto hover:bg-black/5 transition">
                        <span class="text-xs text-verde-texto/70">Lun</span>
                        <span class="text-base font-bold mt-1">17</span>
                    </button>
                </div>

                <p class="text-xs text-verde-texto/70 font-medium pt-1">
                    Horarios disponibles – <span id="texto-fecha-seleccionada">jueves 13</span>
                </p>

                <!-- Rejilla de Horarios en Píldora -->
                <div class="grid grid-cols-3 gap-3">
                    @if(isset($horarios) && count($horarios) > 0)
                        @foreach($horarios as $horario)
                            <label class="cursor-pointer">
                                <input type="radio" name="id_horario" value="{{ $horario->id_horario ?? $horario->id }}" class="peer hidden" required>
                                <div class="w-full py-2.5 bg-white text-verde-texto text-center font-medium text-xs md:text-sm rounded-xl border border-transparent peer-checked:bg-verde-turquesa peer-checked:font-bold transition shadow-sm">
                                    {{ \Carbon\Carbon::parse($horario->hora_inicio)->format('g:i a') }}
                                </div>
                            </label>
                        @endforeach
                    @else
                        <div class="col-span-3 bg-white/60 p-4 rounded-xl text-center">
                            <p class="text-xs text-verde-texto/70 font-medium">No hay horarios registrados en la base de datos.</p>
                            <p class="text-[11px] text-verde-texto/50 mt-1">Por favor inserta registros en la tabla <code class="bg-black/5 px-1 py-0.5 rounded">horarios_disponibles</code>.</p>
                        </div>
                    @endif
                </div>

                <!-- Select de Pacientes Dinámico -->
                <div class="pt-1">
                    <div class="relative">
                        <select name="id_paciente" class="w-full py-3 px-4 bg-white text-verde-texto/80 text-sm rounded-2xl appearance-none focus:outline-none focus:ring-2 focus:ring-verde-turquesa cursor-pointer shadow-sm" required>
                            <option value="" disabled selected>Selecciona al paciente</option>
                            @if(isset($pacientes))
                                @foreach($pacientes as $paciente)
                                    <option value="{{ $paciente->id_paciente ?? $paciente->id }}">
                                        {{ $paciente->nombre }} {{ $paciente->apellido_paterno ?? '' }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-verde-texto">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Botón de Acción Principal (Sin el botón de registro de pacientes) -->
                <div class="pt-2">
                    <button type="submit" class="w-full py-3 px-4 bg-cyan-btn text-verde-texto font-semibold text-xs md:text-sm rounded-2xl hover:opacity-90 transition shadow-sm">
                        Continuar al pago
                    </button>
                </div>

            </div>
        </form>
    </div>

    <!-- Script de selección de días -->
    <script>
        function seleccionarDia(elemento, fecha, textoDia) {
            document.querySelectorAll('.dia-btn').forEach(btn => {
                btn.classList.remove('bg-verde-turquesa', 'shadow-sm', 'font-extrabold');
                btn.classList.add('hover:bg-black/5');
            });
            
            elemento.classList.add('bg-verde-turquesa', 'shadow-sm', 'font-extrabold');
            elemento.classList.remove('hover:bg-black/5');
            
            document.getElementById('fecha_cita').value = fecha;
            document.getElementById('texto-fecha-seleccionada').innerText = textoDia;
        }
    </script>
</body>
</html>