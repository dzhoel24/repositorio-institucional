@props([
    'parametro' => 'repositorio',
    'parametro2' => 'index',
    'params' => [],
    'descrip' => '¿Qué deseas encontrar?',
    'text' => 'Buscar',
    'param' => 'search'
])

@php
    if (!empty($params) && isset($params['tipo'])) {
        $routeName = 'repositorio.index';
        $routeParams = $params;
    } elseif ($parametro === 'repositorio' && $parametro2 === 'index') {
        $routeName = 'repositorio.index';
        $currentTipo = request()->route('tipo') ?? (request()->get('tipo') ?? 'institucional');
        $routeParams = ['tipo' => $currentTipo];
    } else {
        $routeName = $parametro . '.' . $parametro2;
        $routeParams = [];
    }
@endphp

<form method="GET" action="{{ route($routeName, $routeParams) }}" id="searchForm" class="max-w-2xl w-full group">
    <div class="relative flex items-center">

        {{-- Icono de la Lupa --}}
        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
            <svg class="w-5 h-5 text-slate-400 dark:text-gray-500 transition-colors group-focus-within:text-indigo-500"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>

        {{-- Input de Búsqueda --}}
        <input type="text" id="searchInput" name="{{ $param }}" value="{{ request($param) }}"
            class="w-full p-3.5 pl-12 pr-36 text-sm font-medium bg-white dark:bg-gray-900 text-slate-800 dark:text-slate-100 rounded-lg border border-slate-200 dark:border-gray-800 focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-2 focus:ring-indigo-500/10 outline-none transition-all duration-150 shadow-sm"
            placeholder="{{ $descrip }}" autocomplete="off">

        {{-- Botón de Limpiar (X) --}}
        <button type="button" id="clearSearchBtn"
            class="absolute right-24 p-1.5 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 rounded transition-colors hidden focus:outline-none"
            title="Limpiar búsqueda">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        {{-- Botón Submit --}}
        <button type="submit"
            class="absolute right-1.5 px-5 py-2 text-xs font-bold uppercase tracking-wider text-white bg-indigo-600 dark:bg-indigo-500 rounded-md hover:bg-indigo-700 dark:hover:bg-indigo-600 transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 active:scale-98 shadow-sm">
            {{ $text }}
        </button>

    </div>
</form>

{{-- Script con actualización automática --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const input = document.getElementById("searchInput");
        const clearBtn = document.getElementById("clearSearchBtn");
        const form = document.getElementById("searchForm");

        // Guardamos el estado inicial de si la URL venía con una búsqueda activa
        let hasSearchActive = input.value.trim().length > 0;

        function toggleClearButton() {
            if (input.value.trim().length > 0) {
                clearBtn.classList.remove("hidden");
            } else {
                clearBtn.classList.add("hidden");
            }
        }

        // Evaluar estado al cargar la vista
        toggleClearButton();

        // Listener para la escritura del usuario
        input.addEventListener("input", function() {
            toggleClearButton();

            // Si el usuario borra manualmente todo el texto con el teclado y había una búsqueda activa, actualiza la tabla sola
            if (input.value.trim().length === 0 && hasSearchActive) {
                hasSearchActive = false;
                form.submit();
            }
        });

        // Acción al hacer click en la "X"
        clearBtn.addEventListener("click", function() {
            input.value = ""; // Vaciamos el campo
            toggleClearButton();

            // Si había resultados filtrados en la pantalla, envía el formulario vacío para restablecer la lista completa
            if (hasSearchActive) {
                form.submit();
            } else {
                input.focus();
            }
        });
    });
</script>
