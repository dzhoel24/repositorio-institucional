<form class="max-w-2xl w-full group" method="GET" action="{{ route($parametro . '.' . $parametro2) }}">
    <div class="relative flex items-center w-full transition-all duration-300">
        {{-- Icono de Lupa --}}
        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none z-10">
            <svg class="w-5 h-5 text-slate-400 group-focus-within:text-sky-500 transition-colors duration-300"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>

        {{-- Input de Búsqueda --}}
        <input type="search" id="search-dropdown" name="search"
            class="block w-full p-4 pl-12 text-base text-slate-900 bg-white rounded-2xl border-2 border-slate-100 shadow-sm transition-all duration-300 placeholder:text-slate-400 focus:ring-4 focus:ring-sky-500/10 focus:border-sky-500 outline-none"
            placeholder="{{ $descrip ?? '¿Qué deseas encontrar hoy?' }}" required />

        {{-- Botón de Búsqueda --}}
        <button type="submit"
            class="absolute right-2 top-2 bottom-2 px-6 text-sm font-black text-white bg-sky-600 rounded-xl hover:bg-sky-700 focus:ring-4 focus:outline-none focus:ring-sky-300 transition-all duration-300 flex items-center gap-2 active:scale-95 shadow-lg shadow-sky-600/20">
            <span class="uppercase tracking-widest">{{ $text ?? 'Buscar' }}</span>
        </button>
    </div>
</form>
