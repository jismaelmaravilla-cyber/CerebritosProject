<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de la Doctora - Cerebritos</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f5f0eb] min-h-screen">
    
    <!-- Barra de navegación superior -->
    <nav class="bg-teal-600 text-white shadow-md px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <span class="text-xl font-bold">🧠 Cerebritos | Panel Médico</span>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg text-sm font-semibold transition">
                Cerrar Sesión
            </button>
        </form>
    </nav>

    <!-- Contenido Principal -->
    <div class="max-w-7xl mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Pacientes Registrados</h1>
        <p class="text-gray-600 mb-6">Lista oficial de pacientes dados de alta por los tutores en el sistema del consultorio.</p>

        <!-- Tabla de Pacientes -->
        <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200">
            <table class="w-full text-left border-collapse">
                <thead class="bg-teal-50 text-teal-800 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-4">Paciente</th>
                        <th class="px-6 py-4">F. Nacimiento / Edad</th>
                        <th class="px-6 py-4">Escolaridad / Grado</th>
                        <th class="px-6 py-4">Tutor Responsable</th>
                        <th class="px-6 py-4">Teléfono Tutor</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-gray-700 text-sm">
                    @forelse($pacientes as $paciente)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $paciente->nombre }} {{ $paciente->apellido_paterno }} {{ $paciente->apellido_materno }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $paciente->fecha_nacimiento }} <span class="text-xs text-gray-500">({{ $paciente->edad ?? 'N/A' }} años)</span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $paciente->escolaridad ?? 'No especificada' }} - {{ $paciente->grado ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-teal-700">
                                {{ $paciente->tutor->nombre ?? 'Sin tutor' }} {{ $paciente->tutor->apellido ?? '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $paciente->tutor->telefono ?? 'N/A' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500 py-8">
                                No hay pacientes registrados en el sistema todavía.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>