@props(['action', 'placeholder'])

<div class="border-b border-slate-200 bg-white/50 p-3 sm:p-4 dark:border-slate-700 dark:bg-slate-800/30">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">

        {{-- Campo de búsqueda --}}
        <div class="relative w-full sm:flex-1">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 sm:pl-4 pointer-events-none">
                <x-heroicon-o-magnifying-glass class="h-5 w-5 text-slate-400 dark:text-slate-500" />
            </div>

            <input type="text" id="buscador-input" value="{{ request('buscador') }}" placeholder="{{ $placeholder }}"
                autocomplete="off"
                class="w-full h-10 sm:h-11 rounded-full border border-slate-200 bg-white 
                       pl-9 sm:pl-11 pr-9 sm:pr-11 text-sm text-slate-700 
                       outline-none transition-all duration-200
                       placeholder:text-slate-400 
                       focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200
                       dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 
                       dark:placeholder:text-slate-500 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/20" />

            @if (request('buscador'))
                <a href="{{ $action }}"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 sm:pr-4
                          text-slate-400 hover:text-red-500 transition-colors dark:text-slate-500 dark:hover:text-red-400">
                    <x-heroicon-o-x-mark class="h-5 w-5" />
                </a>
            @endif
        </div>

        {{-- Botón filtrar --}}
        <div class="flex gap-2 sm:gap-3">
            <button type="button" id="btnBuscarAdmin"
                class="inline-flex items-center justify-center gap-2 
                       rounded-full bg-slate-700 px-5 sm:px-6 py-2 sm:py-2.5 
                       text-xs sm:text-sm font-medium text-white 
                       transition-all duration-200 hover:bg-slate-800 
                       active:scale-95 disabled:opacity-70
                       dark:bg-slate-700 dark:hover:bg-slate-600">
                <x-heroicon-o-funnel class="h-4 w-4" />
                <span>Filtrar</span>
            </button>

            @if (isset($slot) && $slot->isNotEmpty())
                {{ $slot }}
            @endif
        </div>
    </div>
</div>

<script>
    (function() {
        const input = document.getElementById('buscador-input');
        const btn = document.getElementById('btnBuscarAdmin');

        if (!input || !btn) return;

        const action = "{{ $action }}";

        function realizarBusqueda() {
            const value = input.value.trim();

            if (value === '') {
                input.classList.add('border-red-400', 'ring-2', 'ring-red-200');
                input.focus();
                setTimeout(() => {
                    input.classList.remove('border-red-400', 'ring-2', 'ring-red-200');
                }, 800);
                return;
            }

            btn.disabled = true;

            const url = new URL(action, window.location.origin);
            url.searchParams.set('buscador', value);

            htmx.ajax('GET', url.toString(), {
                target: '#main-content',
                swap: 'innerHTML',
                pushUrl: true
            }).finally(() => {
                btn.disabled = false;
            });
        }

        btn.addEventListener('click', realizarBusqueda);

        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                realizarBusqueda();
            }
        });

        // Mejorar experiencia: limpiar error al escribir
        input.addEventListener('input', () => {
            input.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
        });
    })();
</script>
