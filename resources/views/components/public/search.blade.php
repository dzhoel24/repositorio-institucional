@props([
    'route' => null,
    'params' => [],
    'descrip' => '¿Qué deseas encontrar?',
    'text' => 'Buscar',
    'param' => 'search'
])

@php
    $currentParams = request()->except([$param, 'page']);
    $allParams = array_merge($currentParams, $params);
    $actionUrl = $route ? route($route, $allParams) : url()->current();
    $hasValue = request()->filled($param);
@endphp

<form method="GET" action="{{ $actionUrl }}" id="searchForm" class="w-full">
    @foreach ($allParams as $key => $value)
        @if (is_array($value))
            @foreach ($value as $v)
                <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
            @endforeach
        @elseif($key !== $param)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endif
    @endforeach

    <div class="relative flex items-center">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 md:pl-4 pointer-events-none">
            <x-heroicon-s-magnifying-glass class="w-4 h-4 md:w-5 md:h-5 text-gray-400" />
        </div>

        <input type="text" name="{{ $param }}" id="searchInput" value="{{ request($param) }}"
            class="w-full py-2.5 md:py-3 pl-9 md:pl-12 pr-20 md:pr-36 text-sm bg-white border border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 outline-none transition-all"
            placeholder="{{ $descrip }}" autocomplete="off" aria-label="Búsqueda">

        <button type="button" id="clearSearchBtn"
            class="absolute right-20 p-1 text-gray-400 hover:text-gray-600 rounded transition-colors {{ $hasValue ? '' : 'hidden' }}"
            aria-label="Limpiar búsqueda">
            <x-heroicon-s-x-mark class="w-4 h-4" />
        </button>

        <button type="submit"
            class="absolute right-1 px-3 md:px-4 py-1.5 text-xs md:text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1">
            {{ $text }}
        </button>
    </div>
</form>

<script>
    (function() {
        const input = document.getElementById('searchInput');
        const clearBtn = document.getElementById('clearSearchBtn');
        const form = document.getElementById('searchForm');

        if (!input || !clearBtn || !form) return;

        const toggleClearButton = () => {
            const hasValue = input.value.trim().length > 0;
            clearBtn.classList.toggle('hidden', !hasValue);
        };

        input.addEventListener('input', toggleClearButton);

        clearBtn.addEventListener('click', () => {
            input.value = '';
            toggleClearButton();
            form.submit();
        });

        toggleClearButton();
    })();
</script>
