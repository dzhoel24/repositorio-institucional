<div class="w-full space-y-5">
    <div
        class="overflow-hidden rounded-lg border border-slate-200 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-sm">
        <div
            class="flex items-center gap-2 bg-slate-900 dark:bg-gray-800 px-3.5 py-2.5 text-slate-200 dark:text-gray-300">
            <x-heroicon-s-squares-2x2 class="w-4 h-4 text-indigo-400 shrink-0" />
            <h4 class="text-xs font-bold uppercase tracking-wider">Explorar Repositorio</h4>
        </div>

        <nav class="flex flex-col">
            <a href="{{ route('repositorio.index', ['tipo' => 'institucional']) }}"
                class="group flex items-center text-sm font-medium text-slate-700 dark:text-slate-300 p-3 pl-4 border-l-2 border-b border-transparent border-b-slate-100 dark:border-b-gray-800/70 hover:border-l-indigo-600 dark:hover:border-l-indigo-400 hover:bg-slate-50/80 dark:hover:bg-gray-800/40 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-150">
                Ver todas las publicaciones
            </a>
            <a href="{{ route('filtros.autores') }}"
                class="group flex items-center text-sm text-slate-600 dark:text-slate-400 p-3 pl-4 border-l-2 border-b border-transparent border-b-slate-100 dark:border-b-gray-800/70 hover:border-l-indigo-600 dark:hover:border-l-indigo-400 hover:bg-slate-50/80 dark:hover:bg-gray-800/40 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-150">
                Índice de autores
            </a>
            <a href="{{ route('filtros.fecha') }}"
                class="group flex items-center text-sm text-slate-600 dark:text-slate-400 p-3 pl-4 border-l-2 border-b border-transparent border-b-slate-100 dark:border-b-gray-800/70 hover:border-l-indigo-600 dark:hover:border-l-indigo-400 hover:bg-slate-50/80 dark:hover:bg-gray-800/40 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-150">
                Fecha de publicación
            </a>
            <a href="{{ route('filtros.listTitle') }}"
                class="group flex items-center text-sm text-slate-600 dark:text-slate-400 p-3 pl-4 border-l-2 border-b border-transparent border-b-slate-100 dark:border-b-gray-800/70 hover:border-l-indigo-600 dark:hover:border-l-indigo-400 hover:bg-slate-50/80 dark:hover:bg-gray-800/40 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-150">
                Títulos de documentos
            </a>
            <a href="{{ route('filtros.category') }}"
                class="group flex items-center text-sm text-slate-600 dark:text-slate-400 p-3 pl-4 border-l-2 border-transparent hover:border-l-indigo-600 dark:hover:border-l-indigo-400 hover:bg-slate-50/80 dark:hover:bg-gray-800/40 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-150">
                Programas de estudio
            </a>
        </nav>
    </div>

    {{-- Bloque: Filtro de Autores --}}
    <div
        class="overflow-hidden rounded-lg border border-slate-200 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-sm">
        <div
            class="flex items-center gap-2 bg-slate-900 dark:bg-gray-800 px-3.5 py-2.5 text-slate-200 dark:text-gray-300">
            <x-heroicon-s-funnel class="w-4 h-4 text-indigo-400 shrink-0" />
            <h4 class="text-xs font-bold uppercase tracking-wider">Autores principales</h4>
        </div>

        <nav class="flex flex-col">
            @foreach ($topAutors as $autor)
                <a href="{{ route('filtros.showAutor', $autor['dni']) }}"
                    class="group flex items-center justify-between text-sm text-slate-600 dark:text-slate-400 p-3 pl-4 border-l-2 border-b border-transparent border-b-slate-100 dark:border-b-gray-800/70 hover:border-l-indigo-600 dark:hover:border-l-indigo-400 hover:bg-slate-50/80 dark:hover:bg-gray-800/40 hover:text-slate-900 dark:hover:text-white transition-all duration-150">
                    <span class="truncate pr-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400">
                        {{ $autor['apellidos'] }}, {{ $autor['nombre'] }}
                    </span>
                    <span
                        class="px-2 py-0.5 text-[11px] font-bold rounded bg-slate-100 dark:bg-gray-800 text-slate-500 dark:text-gray-400 border border-slate-200/30 dark:border-gray-700/50 group-hover:bg-indigo-50 dark:group-hover:bg-indigo-950/40 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 group-hover:border-indigo-200/50 transition-colors">
                        {{ $autor['count'] }}
                    </span>
                </a>
            @endforeach

            <a href="{{ route('filtros.autores') }}"
                class="flex items-center justify-center text-xs font-bold text-indigo-600 dark:text-indigo-400 p-2.5 bg-slate-50/30 dark:bg-gray-800/10 hover:bg-indigo-50 dark:hover:bg-indigo-950/20 transition-colors duration-150 border-t border-slate-100 dark:border-gray-800/70">
                Ver catálogo completo
            </a>
        </nav>
    </div>
</div>
