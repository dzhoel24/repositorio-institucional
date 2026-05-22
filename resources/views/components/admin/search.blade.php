@props(['action', 'placeholder' => 'Buscar...'])

<div class="border-b border-slate-200 bg-white/50 p-4 dark:border-slate-700 dark:bg-slate-800/30">
    <div class="flex flex-col gap-3 md:flex-row md:items-center">

        <div class="relative flex-1">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                <x-heroicon-o-magnifying-glass class="h-5 w-5 text-slate-400 dark:text-slate-500" />
            </div>

            <input type="text" id="buscador-input" value="{{ request('buscador') }}" placeholder="{{ $placeholder }}"
                autocomplete="off"
                class="h-11 w-full rounded-full border border-slate-200 bg-white pl-11 pr-11 text-sm text-slate-700 
                          placeholder:text-slate-400
                          focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100
                          dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 
                          dark:placeholder:text-slate-500 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/20" />

            @if (request('buscador'))
                <button type="button" id="btnLimpiarBusqueda"
                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-red-500 dark:text-slate-500">
                    <x-heroicon-o-x-mark class="h-5 w-5" />
                </button>
            @endif
        </div>
        <div class="flex justify-end gap-2 sm:gap-3">
            <button type="button" id="btnBuscarAdmin"
                class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-5 py-2 text-sm font-medium text-white 
                   hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                   disabled:opacity-70 disabled:cursor-not-allowed
                   dark:bg-indigo-500 dark:hover:bg-indigo-600">
                <x-heroicon-o-magnifying-glass class="h-4 w-4" />
                <span>Buscar</span>
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
        const btnLimpiar = document.getElementById('btnLimpiarBusqueda');

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
            const originalText = btn.innerHTML;
            btn.innerHTML = `
                <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Buscando...</span>
            `;

            const url = new URL(action, window.location.origin);
            url.searchParams.set('buscador', value);

            if (typeof htmx !== 'undefined') {
                htmx.ajax('GET', url.toString(), {
                    target: '#main-content',
                    swap: 'innerHTML',
                    pushUrl: true
                }).finally(() => {
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                });
            } else {
                window.location.href = url.toString();
            }
        }

        btn.addEventListener('click', realizarBusqueda);

        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                realizarBusqueda();
            }
        });

        input.addEventListener('input', () => {
            input.classList.remove('border-red-400', 'ring-2', 'ring-red-200');
        });

        if (btnLimpiar) {
            btnLimpiar.addEventListener('click', () => {
                input.value = '';
                input.focus();
                const url = new URL(action, window.location.origin);
                url.searchParams.delete('buscador');
                if (typeof htmx !== 'undefined') {
                    htmx.ajax('GET', url.toString(), {
                        target: '#main-content',
                        swap: 'innerHTML',
                        pushUrl: true
                    });
                } else {
                    window.location.href = url.toString();
                }
            });
        }
    })();
</script>
