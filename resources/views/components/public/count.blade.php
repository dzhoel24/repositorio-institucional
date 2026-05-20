<div class="pt-2 pl-2">
    @if ($contador > 0)
        @php
            $start = ($paginator->currentPage() - 1) * $paginator->perPage() + 1;
            $end = min($contador, $paginator->currentPage() * $paginator->perPage());
        @endphp
        <p class="text-sm text-gray-600">
            Mostrando <span class="font-medium ">{{ $start }}</span>
            al <span class="font-medium ">{{ $end }}</span>
            de <span class="font-medium ">{{ $contador }}</span> resultados
        </p>
    @else
        <p class="text-sm text-gray-400">No hay resultados disponibles</p>
    @endif
</div>
