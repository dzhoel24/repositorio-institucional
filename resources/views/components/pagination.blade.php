<nav class="flex items-center justify-center pt-4">
    <ul class="inline-flex -space-x-px text-base h-10">
        {{-- Enlace de "Anterior" --}}
        <li>
            @if ($paginator->onFirstPage())
                <span class="flex items-center justify-center px-4 h-10 text-gray-500 bg-white border border-gray-300 rounded-s-lg cursor-default" aria-disabled="true">Anterior</span>
            @else
                <a href="{{ $paginator->previousPageUrl() . '&' . http_build_query(request()->except('page')) }}" 
                   class="flex items-center justify-center px-4 h-10 text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                   Anterior
                </a>
            @endif
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li>
                @if ($i == $paginator->currentPage())
                    <span class="flex items-center justify-center px-4 h-10 text-blue-600 border border-gray-300 bg-blue-50">{{ $i }}</span>
                @else
                    <a href="{{ $paginator->url($i) . '&' . http_build_query(request()->except('page')) }}" 
                       class="flex items-center justify-center px-4 h-10 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                       {{ $i }}
                    </a>
                @endif
            </li>
        @endfor
        <li>
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() . '&' . http_build_query(request()->except('page')) }}" 
                   class="flex items-center justify-center px-4 h-10 text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                   Siguiente
                </a>
            @else
                <span class="flex items-center justify-center px-4 h-10 text-gray-500 bg-white border border-gray-300 rounded-e-lg cursor-default" aria-disabled="true">Siguiente</span>
            @endif
        </li>
    </ul>
</nav>
