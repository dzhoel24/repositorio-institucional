<div class="pt-2 pl-2">
    @if ($contador > 0)
        @php
            $start = ($paginator->currentPage() - 1) * $paginator->perPage() + 1;
            $end = min($contador, $paginator->currentPage() * $paginator->perPage());
        @endphp
        <p class="text-black text-sm">
            Mostrando resultados {{ $start }}-{{ $end }} de {{ $contador }}
        </p>
    @else
        <p class="text-black text-sm">No se encontraron resultados.</p>
    @endif
</div>
