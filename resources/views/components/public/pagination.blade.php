@if ($paginator->hasPages())
    <nav class="flex items-center justify-center mt-6" aria-label="Paginación">
        <ul class="flex flex-wrap items-center gap-1">
            <li>
                @if ($paginator->onFirstPage())
                    <span
                        class="flex items-center justify-center w-9 h-9 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                        <x-heroicon-s-chevron-left class="w-4 h-4" />
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() . '&' . http_build_query(request()->except('page')) }}"
                        class="flex items-center justify-center w-9 h-9 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:text-gray-800 transition-colors">
                        <x-heroicon-s-chevron-left class="w-4 h-4" />
                    </a>
                @endif
            </li>

            @php
                $currentPage = $paginator->currentPage();
                $lastPage = $paginator->lastPage();
                $start = max(1, $currentPage - 2);
                $end = min($lastPage, $currentPage + 2);
            @endphp

            @if ($start > 1)
                <li>
                    <a href="{{ $paginator->url(1) . '&' . http_build_query(request()->except('page')) }}"
                        class="flex items-center justify-center w-9 h-9 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:text-gray-800 transition-colors">
                        1
                    </a>
                </li>
                @if ($start > 2)
                    <li>
                        <span class="flex items-center justify-center w-9 h-9 text-gray-400">...</span>
                    </li>
                @endif
            @endif

            @for ($i = $start; $i <= $end; $i++)
                <li>
                    @if ($i == $currentPage)
                        <span
                            class="flex items-center justify-center w-9 h-9 text-white bg-gray-700 rounded-lg shadow-sm">
                            {{ $i }}
                        </span>
                    @else
                        <a href="{{ $paginator->url($i) . '&' . http_build_query(request()->except('page')) }}"
                            class="flex items-center justify-center w-9 h-9 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:text-gray-800 transition-colors">
                            {{ $i }}
                        </a>
                    @endif
                </li>
            @endfor

            @if ($end < $lastPage)
                @if ($end < $lastPage - 1)
                    <li>
                        <span class="flex items-center justify-center w-9 h-9 text-gray-400">...</span>
                    </li>
                @endif
                <li>
                    <a href="{{ $paginator->url($lastPage) . '&' . http_build_query(request()->except('page')) }}"
                        class="flex items-center justify-center w-9 h-9 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:text-gray-800 transition-colors">
                        {{ $lastPage }}
                    </a>
                </li>
            @endif

            <li>
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() . '&' . http_build_query(request()->except('page')) }}"
                        class="flex items-center justify-center w-9 h-9 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:text-gray-800 transition-colors">
                        <x-heroicon-s-chevron-right class="w-4 h-4" />
                    </a>
                @else
                    <span
                        class="flex items-center justify-center w-9 h-9 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                        <x-heroicon-s-chevron-right class="w-4 h-4" />
                    </span>
                @endif
            </li>
        </ul>
    </nav>
@endif
