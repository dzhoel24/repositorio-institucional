<div class="relative inline-block">
    <button id="dropdownHelperRadioButton" data-dropdown-toggle="dropdownHelperRadio" class="text-white bg-white border shadow-md hover:bg-slate-300 p-1 flex items-center justify-center rounded">
        <box-icon type='solid' name='cog'></box-icon>
    </button>

    <!-- Dropdown del filtro avanzado -->
    <div id="dropdownHelperRadio" class="z-10 hidden bg-white divide-y border rounded divide-gray-100 shadow">
        <!-- Opciones de orden -->
        <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200">
            @foreach (['asc' => 'Ascendente', 'desc' => 'Descendente'] as $value => $label)
                <li>
                    <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <div class="flex items-center h-5">
                            <a href="{{ route($route, ['sort' => $value, 'items_per_page' => request('items_per_page', $defaultItemsPerPage)]) }}" class="flex items-center">
                                <input id="sort-option-{{ $value }}" name="sort-option" type="radio" value="{{ $value }}" class="hidden" {{ request('sort', 'asc') === $value ? 'checked' : '' }}>
                                <span class="w-4 h-4 border border-gray-300 rounded-full mr-2 flex items-center justify-center {{ request('sort', 'asc') === $value ? 'bg-blue-600' : 'bg-white' }}">
                                    @if(request('sort', 'asc') === $value)
                                        <span class="w-2 h-2 rounded-full bg-white"></span>
                                    @endif
                                </span>
                                <div class="text-sm">{{ $label }}</div>
                            </a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        <ul class="list-none p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200">
            @foreach ([5, 10, 20, 40, 60, 80, 100] as $number)
                <li>
                    <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <div class="flex items-center h-5">
                            <a href="{{ route($route, ['sort' => request('sort', 'asc'), 'items_per_page' => $number]) }}" class="flex items-center">
                                <input id="number-option-{{ $number }}" name="number-option" type="radio" value="{{ $number }}" class="hidden" {{ request('items_per_page', $defaultItemsPerPage) == $number ? 'checked' : '' }}>
                                <span class="w-4 h-4 border border-gray-300 rounded-full mr-2 flex items-center justify-center {{ request('items_per_page', $defaultItemsPerPage) == $number ? 'bg-blue-600' : 'bg-white' }}">
                                    @if(request('items_per_page', $defaultItemsPerPage) == $number)
                                        <span class="w-2 h-2 rounded-full bg-white"></span>
                                    @endif
                                </span>
                                <div class="text-sm">{{ $number }}</div>
                            </a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
