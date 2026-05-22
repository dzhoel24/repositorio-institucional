@props([
    'route' => null,
    'params' => [],
    'defaultSort' => 'asc',
    'defaultItemsPerPage' => 10
])

@php
    $currentParams = request()->except(['sort', 'items_per_page', 'page']);
    $allParams = array_merge($params, $currentParams);
    $currentSort = request('sort', $defaultSort);
    $currentItemsPerPage = request('items_per_page', $defaultItemsPerPage);
@endphp

<div class="relative inline-block" id="filter-dropdown">
    <button id="filter-button"
        class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 hover:text-slate-700 transition-all duration-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
        <x-heroicon-s-adjustments-horizontal class="w-4 h-4" />
        <span class="hidden sm:inline">Filtrar</span>
        <span class="inline-flex sm:hidden">
            <span class="text-xs font-bold">{{ $currentItemsPerPage }}</span>
        </span>
    </button>

    <div id="filter-menu"
        class="z-20 absolute right-0 mt-2 w-56 bg-white rounded-xl border border-slate-200 shadow-lg hidden overflow-hidden">

        {{-- Ordenar --}}
        <div class="p-3 border-b border-slate-100">
            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Ordenar por</h4>
            <div class="space-y-1">
                @foreach (['asc' => 'Ascendente (A-Z)', 'desc' => 'Descendente (Z-A)'] as $value => $label)
                    @php
                        $sortParams = array_merge($allParams, [
                            'sort' => $value,
                            'items_per_page' => $currentItemsPerPage
                        ]);
                    @endphp
                    <a href="{{ $route ? route($route, $sortParams) : '?' . http_build_query($sortParams) }}"
                        class="flex items-center justify-between px-2 py-1.5 rounded-lg hover:bg-slate-50 transition-colors group">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-4 h-4 rounded-full border-2 flex items-center justify-center
                                {{ $currentSort === $value ? 'border-indigo-500 bg-indigo-500' : 'border-slate-300 bg-white' }}">
                                @if ($currentSort === $value)
                                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                @endif
                            </div>
                            <span
                                class="text-sm text-slate-700 group-hover:text-indigo-600 transition-colors">{{ $label }}</span>
                        </div>
                        @if ($currentSort === $value)
                            <x-heroicon-s-check class="w-4 h-4 text-indigo-500" />
                        @endif
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Mostrar por página --}}
        <div class="p-3">
            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Mostrar por página</h4>
            <div class="grid grid-cols-4 gap-1">
                @foreach ([5, 10, 20, 40, 60, 80, 100] as $number)
                    @php
                        $pageParams = array_merge($allParams, [
                            'sort' => $currentSort,
                            'items_per_page' => $number
                        ]);
                    @endphp
                    <a href="{{ $route ? route($route, $pageParams) : '?' . http_build_query($pageParams) }}"
                        class="text-center px-2 py-1.5 rounded-lg text-sm transition-all duration-150
                        {{ $currentItemsPerPage == $number
                            ? 'bg-indigo-50 text-indigo-600 font-semibold ring-1 ring-indigo-200'
                            : 'text-slate-600 hover:bg-slate-50 hover:text-indigo-600' }}">
                        {{ $number }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const button = document.getElementById('filter-button');
        const menu = document.getElementById('filter-menu');

        if (button && menu) {
            // Abrir/cerrar menú
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });

            // Cerrar al hacer clic fuera
            document.addEventListener('click', function(event) {
                if (!button.contains(event.target) && !menu.contains(event.target)) {
                    menu.classList.add('hidden');
                }
            });

            // Cerrar con tecla ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                }
            });
        }
    });
</script>
