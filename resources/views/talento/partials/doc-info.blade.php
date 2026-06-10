@if($doc)
    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100 mb-4">
        <span class="text-xl">📄</span>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-gray-700 truncate">{{ $doc->nombre_archivo }}</p>
            <p class="text-xs text-gray-400">{{ $doc->created_at->format('d/m/Y H:i') }}</p>
        </div>
        <a href="{{ route('archivos.talento', $doc->id) }}" target="_blank"
            class="text-blue-600 hover:text-blue-700 text-sm font-medium">Ver</a>
    </div>
    @if($doc->estado === 'rechazado' && $doc->motivo_rechazo)
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl px-4 py-3 mb-4">
            <strong>Motivo del rechazo:</strong> {{ $doc->motivo_rechazo }}
        </div>
    @endif
@endif
