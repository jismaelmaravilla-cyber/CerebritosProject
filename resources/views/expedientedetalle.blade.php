<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Expediente - Neurodesarrollo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'crema-bg': '#F2ECE4',
                        'verde-texto': '#385040',
                        'verde-turquesa': '#78C6C7',
                        'rosa-brand': '#F4A8A8',
                        'card-antecedentes': '#EAF4E8',
                        'card-criterios': '#F4EFEA',
                        'card-evaluaciones': '#F4F2EA',
                        'card-plan': '#F7DDCF'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-crema-bg min-h-screen text-verde-texto font-sans flex">

    <aside class="w-72 bg-[#EADECF]/50 border-r border-black/5 flex flex-col justify-between p-6">
        <div class="space-y-8">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-full bg-rosa-brand flex-shrink-0"></div>
                <div>
                    <p class="font-bold text-sm">Neurodesarrollo</p>
                    <p class="text-xs text-verde-texto/70">con Amor</p>
                </div>
            </div>
            <nav class="space-y-2">
                <a href="{{ url('/expedientes') }}" class="block py-2 px-3 rounded-xl font-semibold text-sm bg-white/60 text-verde-texto">Inicio</a>
            </nav>
        </div>
        <div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-xs font-semibold text-verde-texto/70 hover:text-verde-texto">Cerrar sesión</button>
            </form>
        </div>
    </aside>

    <main class="flex-1 p-8 md:p-12 overflow-y-auto">
        <div class="max-w-6xl mx-auto space-y-6">
            
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">Hola, Doctora</h1>
                    <p class="text-xs text-verde-texto/70 mt-1">{{ now()->translatedFormat('l j \de F, Y') }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-rosa-brand flex items-center justify-center font-bold text-sm">
                    D
                </div>
            </div>

            <h2 class="text-xl font-bold pt-2">Expediente Clínico</h2>

            <div class="bg-white rounded-3xl p-8 shadow-sm grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="space-y-4 border-b lg:border-b-0 lg:border-r border-black/5 pb-6 lg:pb-0 lg:pr-6">
                    <div class="w-12 h-12 rounded-full bg-[#EADECF] flex items-center justify-center">
                        <svg class="w-6 h-6 text-verde-texto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>

                    <div class="space-y-2 text-xs md:text-sm">
                        <p><strong class="font-bold">{{ $expediente->paciente->nombre }} {{ $expediente->paciente->apellido_paterno }} {{ $expediente->paciente->apellido_materno }}</strong></p>
                        <p><span class="text-verde-texto/60">Fecha de nacimiento:</span> {{ $expediente->paciente->fecha_nacimiento }}</p>
                        <p><span class="text-verde-texto/60">Edad:</span> {{ $expediente->paciente->edad ?? 'N/A' }} años</p>
                        <p><span class="text-verde-texto/60">Escolaridad:</span> {{ $expediente->paciente->escolaridad ?? 'No especificada' }}</p>
                        <p><span class="text-verde-texto/60">Grado:</span> {{ $expediente->paciente->grado ?? 'N/A' }}</p>
                        <p><span class="text-verde-texto/60">Tutor:</span> {{ $expediente->paciente->tutor->nombre ?? 'N/A' }} {{ $expediente->paciente->tutor->apellido ?? '' }}</p>
                        <p><span class="text-verde-texto/60">Teléfono del tutor:</span> {{ $expediente->paciente->tutor->telefono ?? 'N/A' }}</p>
                        <p><span class="text-verde-texto/60">Parentesco:</span> {{ $expediente->paciente->parentesco_tutor ?? 'N/A' }}</p>
                        <p><strong class="font-bold">Diagnóstico: {{ $expediente->diagnostico_oficial ?? 'Pendiente' }}</strong></p>
                    </div>
                </div>

                <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    <div class="bg-card-antecedentes p-5 rounded-2xl flex flex-col justify-between space-y-4 shadow-sm">
                        <div>
                            <h3 class="font-bold text-sm text-verde-texto mb-2">Antecedentes</h3>
                            <p class="text-xs text-verde-texto/80 leading-relaxed">
                                {{ $expediente->antecedentes ?? 'Sin antecedentes registrados.' }}
                            </p>
                        </div>
                        <div class="flex justify-end">
                            <svg class="w-4 h-4 text-verde-texto/60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                    </div>

                    <div class="bg-card-criterios p-5 rounded-2xl flex flex-col justify-between space-y-4 shadow-sm">
                        <div>
                            <h3 class="font-bold text-sm text-verde-texto mb-2">Criterios de diagnóstico</h3>
                            <p class="text-xs text-verde-texto/80 leading-relaxed">
                                {{ $expediente->criterios_diagnostico ?? 'Sin criterios registrados.' }}
                            </p>
                        </div>
                        <div class="flex justify-end">
                            <svg class="w-4 h-4 text-verde-texto/60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                    </div>

                    <div class="bg-card-evaluaciones p-5 rounded-2xl flex flex-col justify-between space-y-4 shadow-sm">
                        <div>
                            <h3 class="font-bold text-sm text-verde-texto mb-2">Notas de Consulta</h3>
                            <p class="text-xs text-verde-texto/80 leading-relaxed">
                                {{ $expediente->notas_consulta ?? 'Sin notas registradas.' }}
                            </p>
                        </div>
                        <div class="flex justify-end">
                            <svg class="w-4 h-4 text-verde-texto/60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                    </div>

                    <div class="bg-card-plan p-5 rounded-2xl flex flex-col justify-between space-y-4 shadow-sm">
                        <div>
                            <h3 class="font-bold text-sm text-verde-texto mb-2">Plan de tratamiento</h3>
                            <p class="text-xs text-verde-texto/80 leading-relaxed">
                                {{ $expediente->plan_tratamiento ?? 'Sin plan registrado.' }}
                            </p>
                        </div>
                        <div class="flex justify-end">
                            <svg class="w-4 h-4 text-verde-texto/60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </main>

</body>
</html>