@if ($paginator->hasPages())
    @php
        // Configuración del rango de páginas a mostrar
        $start = max(1, $paginator->currentPage() - 2);
        $end = min($paginator->lastPage(), $paginator->currentPage() + 2);

        // Ajustar si estamos al inicio
        if ($start <= 3) {
            $start = 1;
            $end = min(5, $paginator->lastPage());
        }

        // Ajustar si estamos al final
        if ($end >= $paginator->lastPage() - 2) {
            $end = $paginator->lastPage();
            $start = max(1, $paginator->lastPage() - 4);
        }

        $showDotsStart = $start > 1;
        $showDotsEnd = $end < $paginator->lastPage();
    @endphp

    <nav role="navigation" aria-label="Navegación de paginación" class="flex items-center justify-between mt-6">
        {{-- Versión móvil --}}
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-400 bg-white border border-slate-200 rounded-lg cursor-default 
                           dark:bg-slate-800 dark:border-slate-700 dark:text-slate-500">
                    Anterior
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg 
                          hover:bg-slate-50 hover:text-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-200 transition 
                          dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700">
                    Anterior
                </a>
            @endif

            <span class="text-sm text-slate-500 dark:text-slate-400 self-center">
                {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
            </span>

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg 
                          hover:bg-slate-50 hover:text-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-200 transition 
                          dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700">
                    Siguiente
                </a>
            @else
                <span
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-400 bg-white border border-slate-200 rounded-lg cursor-default 
                           dark:bg-slate-800 dark:border-slate-700 dark:text-slate-500">
                    Siguiente
                </span>
            @endif
        </div>

        {{-- Versión escritorio --}}
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">
                    Mostrando
                    @if ($paginator->firstItem())
                        <span
                            class="font-semibold text-slate-800 dark:text-slate-200">{{ $paginator->firstItem() }}</span>
                        a
                        <span
                            class="font-semibold text-slate-800 dark:text-slate-200">{{ $paginator->lastItem() }}</span>
                    @else
                        <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $paginator->count() }}</span>
                    @endif
                    de
                    <span
                        class="font-semibold text-slate-800 dark:text-slate-200">{{ number_format($paginator->total()) }}</span>
                    resultados
                </p>
            </div>

            <div>
                <ul class="flex items-center gap-1 shadow-sm rounded-lg">
                    {{-- Anterior --}}
                    @if ($paginator->onFirstPage())
                        <li>
                            <span
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-slate-400 bg-white border border-slate-200 rounded-lg cursor-default 
                                       dark:bg-slate-800 dark:border-slate-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-lg 
                                      hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-200 transition 
                                      dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                        </li>
                    @endif

                    {{-- Primera página --}}
                    @if ($showDotsStart)
                        <li>
                            <a href="{{ $paginator->url(1) }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-lg 
                                      hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-200 transition 
                                      dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700">
                                1
                            </a>
                        </li>
                        @if ($start > 2)
                            <li>
                                <span
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-500 bg-white border border-slate-200 rounded-lg cursor-default 
                                           dark:bg-slate-800 dark:border-slate-700">...</span>
                            </li>
                        @endif
                    @endif

                    {{-- Rango de páginas --}}
                    @for ($page = $start; $page <= $end; $page++)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span
                                    class="inline-flex items-center px-4 py-2 text-sm font-semibold text-indigo-600 bg-indigo-50 border border-indigo-200 rounded-lg cursor-default 
                                           dark:bg-indigo-950/30 dark:text-indigo-400 dark:border-indigo-800">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $paginator->url($page) }}"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-lg 
                                          hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-200 transition 
                                          dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endfor

                    {{-- Última página --}}
                    @if ($showDotsEnd)
                        @if ($end < $paginator->lastPage() - 1)
                            <li>
                                <span
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-500 bg-white border border-slate-200 rounded-lg cursor-default 
                                           dark:bg-slate-800 dark:border-slate-700">...</span>
                            </li>
                        @endif
                        <li>
                            <a href="{{ $paginator->url($paginator->lastPage()) }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-lg 
                                      hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-200 transition 
                                      dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700">
                                {{ $paginator->lastPage() }}
                            </a>
                        </li>
                    @endif

                    {{-- Siguiente --}}
                    @if ($paginator->hasMorePages())
                        <li>
                            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-lg 
                                      hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-200 transition 
                                      dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </li>
                    @else
                        <li>
                            <span
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-slate-400 bg-white border border-slate-200 rounded-lg cursor-default 
                                       dark:bg-slate-800 dark:border-slate-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
