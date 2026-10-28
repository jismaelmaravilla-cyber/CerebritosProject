<div class="p-4 bg-white rounded-lg shadow">
    <h3 class="text-lg font-bold text-gray-800 mb-4">Horarios Disponibles para la Fecha Seleccionada</h3>

    <div class="grid grid-cols-3 gap-3">
        @forelse ($horarios as $horario)
            <button 
                type="button" 
                class="px-4 py-2 border rounded-md text-sm font-medium transition-colors {{ $horario->disponible ? 'bg-green-100 border-green-400 text-green-800 hover:bg-green-200' : 'bg-gray-100 border-gray-300 text-gray-400 cursor-not-allowed' }}"
                {{ !$horario->disponible ? 'disabled' : '' }}
                onclick="seleccionarHorario('{{ $horario->hora }}')">
                {{ $horario->hora_formateada }}
            </button>
        @empty
            <p class="col-span-3 text-sm text-gray-500">No hay horarios configurados o disponibles para esta fecha.</p>
        @endforelse
    </div>
</div>