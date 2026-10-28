<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expedientes - Neurodesarrollo</title>
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
                        'badge-bg': '#72C7C9'
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
                <a href="#" class="block py-2 px-3 rounded-xl font-semibold text-sm bg-white/60 text-verde-texto">Inicio</a>
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
        <div class="max-w-5xl mx-auto space-y-6">
            
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">Hola, Doctora</h1>
                    <p class="text-xs text-verde-texto/70 mt-1">{{ now()->translatedFormat('l j \de F, Y') }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-rosa-brand flex items-center justify-center font-bold text-sm">
                    D
                </div>
            </div>

            <div class="space-y-4 pt-4">
                <h2 class="text-xl font-bold">Expedientes</h2>
                <div class="relative">
                    <input type="text" placeholder="Buscar" class="w-full py-3 px-4 bg-white rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-verde-turquesa placeholder-verde-texto/50 shadow-sm">
                </div>
            </div>

            <div class="space-y-3">
                @forelse($expedientes ?? [] as $expediente)
                    <a href="{{ route('expediente.show', $expediente->id_expediente) }}" class="flex items-center justify-between p-4 bg-white rounded-2xl shadow-sm hover:shadow-md transition">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 rounded-full bg-[#EADECF] flex items-center justify-center font-bold text-xs">
                                {{ substr($expediente->paciente->nombre ?? 'P', 0, 2) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-sm">{{ $expediente->paciente->nombre ?? 'Paciente' }}</h3>
                                <p class="text-xs text-verde-texto/70">Tutor: {{ $expediente->paciente->tutor->nombre ?? 'N/A' }} {{ $expediente->paciente->tutor->apellido ?? '' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-6">
                            <span class="text-xs text-verde-texto/60">Última fecha: {{ $expediente->fecha_registro ? \Carbon\Carbon::parse($expediente->fecha_registro)->format('d de F, Y') : 'N/A' }}</span>
                            <span class="px-3 py-1 bg-badge-bg text-verde-texto font-bold text-xs rounded-full">
                                {{ $expediente->diagnostico_oficial ?? 'Consulta' }}
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="p-6 bg-white rounded-2xl shadow-sm text-center text-gray-500 text-sm">
                        No hay expedientes registrados en el sistema.
                    </div>
                @endforelse
            </div>

        </div>
    </main>

</body>
</html>