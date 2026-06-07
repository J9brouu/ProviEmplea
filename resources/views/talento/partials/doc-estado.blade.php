@if($doc)
    @if($doc->estado === 'aprobado')
        <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-semibold">✓ Aprobado</span>
    @elseif($doc->estado === 'rechazado')
        <span class="bg-red-100 text-red-700 text-xs px-3 py-1 rounded-full font-semibold">✗ Rechazado</span>
    @else
        <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full font-semibold">En revisión</span>
    @endif
@else
    <span class="bg-gray-100 text-gray-500 text-xs px-3 py-1 rounded-full font-semibold">Pendiente</span>
@endif
