@props([
    'route' => null,
    'params' => [],
    'defaultSort' => 'asc',
    'defaultItemsPerPage' => 10
])

@php
    $currentParams = request()->except(['sort', 'items_per_page', 'page']);
    $allParams = array_merge($params, $currentParams);
@endphp

<div class="relative inline-block">
    <button id="dropdownHelperRadioButton" data-dropdown-toggle="dropdownHelperRadio"
        class="text-gray-600 bg-gray-100 border border-gray-300 shadow-md hover:bg-gray-200 p-2.5 rounded-xl flex items-center justify-center gap-2 transition-all duration-200">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <span class="text-sm font-medium hidden sm:inline">Filtrar</span>
    </button>

    <div id="dropdownHelperRadio"
        class="z-10 hidden bg-white divide-y border rounded-xl divide-gray-100 shadow-lg min-w-[220px] absolute right-0 mt-2">

        {{-- Ordenar por --}}
        <div class="p-3">
            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Ordenar por</h4>
            <ul class="space-y-1">
                @foreach (['asc' => 'Ascendente', 'desc' => 'Descendente'] as $value => $label)
                    @php
                        $sortParams = array_merge($allParams, [
                            'sort' => $value,
                            'items_per_page' => request('items_per_page', $defaultItemsPerPage)
                        ]);
                    @endphp
                    <li>
                        <a href="{{ route($route, $sortParams) }}"
                            class="flex items-center gap-2 px-2 py-1.5 rounded-lg hover:bg-gray-100 transition-colors">
                            <div
                                class="w-4 h-4 rounded-full border-2 flex items-center justify-center
                                {{ request('sort', 'asc') === $value ? 'border-blue-500 bg-blue-500' : 'border-gray-300 bg-white' }}">
                                @if (request('sort', 'asc') === $value)
                                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                @endif
                            </div>
                            <span class="text-sm text-gray-700">{{ $label }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Mostrar por página --}}
        <div class="p-3 border-t border-gray-100">
            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Mostrar por página</h4>
            <ul class="space-y-1">
                @foreach ([5, 10, 20, 40, 60, 80, 100] as $number)
                    @php
                        $pageParams = array_merge($allParams, [
                            'sort' => request('sort', 'asc'),
                            'items_per_page' => $number
                        ]);
                    @endphp
                    <li>
                        <a href="{{ route($route, $pageParams) }}"
                            class="flex items-center justify-between px-2 py-1.5 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-4 h-4 rounded-full border-2 flex items-center justify-center
                                    {{ request('items_per_page', $defaultItemsPerPage) == $number ? 'border-blue-500 bg-blue-500' : 'border-gray-300 bg-white' }}">
                                    @if (request('items_per_page', $defaultItemsPerPage) == $number)
                                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                    @endif
                                </div>
                                <span class="text-sm text-gray-700">{{ $number }}</span>
                            </div>
                            @if (request('items_per_page', $defaultItemsPerPage) == $number)
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
