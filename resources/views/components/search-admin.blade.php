@props(['action', 'placeholder'])

<div class="border-b border-slate-200 bg-slate-50/30 p-3 dark:border-white/5 dark:bg-[#1c1c24]">
    <form
        method="GET"
        action="{{ $action }}"
        hx-get="{{ $action }}"
        hx-target="#main-content"
        hx-swap="innerHTML"
        hx-push-url="true"
        hx-indicator="#btnBuscarAdmin"
        class="flex flex-col items-center gap-4 sm:flex-row"
        id="searchFormAdmin">

        <div class="group relative w-full flex-1">
            <x-heroicon-s-magnifying-glass
                class="absolute left-5 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400 transition-colors group-focus-within:text-indigo-500" />

            <input
                type="text"
                name="buscador"
                value="{{ request('buscador') }}"
                placeholder="{{ $placeholder }}"
                autocomplete="off"
                autofocus
                class="w-full rounded-full border border-slate-300 bg-white py-3.5 pl-12 pr-12 text-[15px] text-slate-900 outline-none transition-all focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/20 dark:border-white/10 dark:bg-[#0f0f13] dark:text-white" />

            @if(request('buscador'))
                <a href="{{ $action }}"
                   hx-get="{{ $action }}"
                   hx-target="#main-content"
                   hx-swap="innerHTML"
                   hx-push-url="true"
                   aria-label="Limpiar búsqueda"
                   class="absolute right-4 top-1/2 flex h-8 w-8 -translate-y-1/2 items-center justify-center rounded-full text-slate-400 transition-colors hover:text-red-500">
                    <x-heroicon-s-x-circle class="w-6 h-6" />
                </a>
            @endif
        </div>

        <button
            id="btnBuscarAdmin"
            type="submit"
            aria-label="Buscar"
            class="group/btn relative flex w-full min-w-[160px] items-center justify-center gap-3 overflow-hidden rounded-full bg-slate-900 px-10 py-3.5 text-[13px] font-bold tracking-widest text-white shadow-lg transition-all hover:bg-black active:scale-95 disabled:cursor-not-allowed disabled:opacity-70 sm:w-auto dark:bg-indigo-600 dark:hover:bg-indigo-700">

            {{-- Contenido normal --}}
            <span id="btnContentAdmin" class="flex items-center gap-3">
                <span class="uppercase tracking-tighter">Filtrar Registros</span>
                <x-heroicon-s-funnel class="w-4 h-4 transition-transform group-hover/btn:rotate-12" />
            </span>

            {{-- Loader htmx --}}
            <span class="htmx-indicator absolute inset-0 flex items-center justify-center">
                <svg class="h-5 w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </span>
        </button>
    </form>
</div>