@props(['parametro' => 'institucional', 'parametro2' => 'index', 'descrip' => '¿Qué deseas encontrar hoy?', 'text' => 'Buscar'])

@php
    // Obtener el tipo de la URL actual (institucional, investigacion, modulo, feria)
    $currentTipo = request()->route('tipo') ?? request()->get('tipo') ?? 'institucional';
    
    // Si es un repositorio, usar el tipo actual
    if ($parametro === 'repositorio' && $parametro2 === 'index') {
        $routeName = 'repositorio.index';
        $routeParams = ['tipo' => $currentTipo];
    } else {
        $routeName = $parametro . '.' . $parametro2;
        $routeParams = [];
    }
@endphp

<form class="max-w-2xl w-full group" method="GET" action="{{ route($routeName, $routeParams) }}">
    <div class="relative flex items-center w-full transition-all duration-300">
        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none z-10">
            <svg class="w-5 h-5 text-slate-400 group-focus-within:text-sky-500 transition-colors duration-300"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>

        <input type="search" name="search"
            class="block w-full p-4 pl-12 text-base text-slate-900 bg-white rounded-2xl border-2 border-slate-100 shadow-sm transition-all duration-300 placeholder:text-slate-400 focus:ring-4 focus:ring-sky-500/10 focus:border-sky-500 outline-none"
            placeholder="{{ $descrip }}" value="{{ request('search') }}" />

        <button type="submit"
            class="absolute right-2 top-2 bottom-2 px-6 text-sm font-black text-white bg-sky-600 rounded-xl hover:bg-sky-700 transition-all duration-300">
            <span class="uppercase tracking-widest">{{ $text }}</span>
        </button>
    </div>
</form>