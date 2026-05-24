@props(['action', 'placeholder' => 'Buscar...', 'autoSearch' => false])

<div class="border-b border-slate-200 bg-white p-4 dark:border-slate-700 dark:bg-slate-800">
    <div class="flex flex-col gap-3 md:flex-row md:items-center">

        <div class="relative flex-1">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                <x-heroicon-o-magnifying-glass class="h-5 w-5 text-slate-400 dark:text-slate-500" />
            </div>

            <input type="text" id="buscador-input" value="{{ request('buscador') }}" placeholder="{{ $placeholder }}"
                autocomplete="off"
                class="h-11 w-full rounded-xl border border-slate-200 bg-white pl-11 pr-11 text-sm text-slate-700 
                          placeholder:text-slate-400
                          focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100
                          transition-all duration-200
                          dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 
                          dark:placeholder:text-slate-500 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/20" />

            @if (request('buscador'))
                <button type="button" id="btnLimpiarBusqueda"
                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 transition-colors hover:text-red-500 dark:text-slate-500 dark:hover:text-red-400"
                    aria-label="Limpiar búsqueda">
                    <x-heroicon-o-x-mark class="h-5 w-5" />
                </button>
            @endif
        </div>

        <div class="flex justify-end gap-2 sm:gap-3">
            <button type="button" id="btnBuscarAdmin"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-500 px-5 py-2 text-sm font-medium text-white 
                           shadow-sm shadow-indigo-200/50
                           transition-all duration-200 hover:bg-indigo-600 hover:shadow-md 
                           focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2
                           disabled:opacity-70 disabled:cursor-not-allowed active:scale-95
                           dark:bg-indigo-600 dark:hover:bg-indigo-500
                           dark:shadow-indigo-900/30">
                <x-heroicon-o-magnifying-glass class="h-4 w-4" />
                <span>Buscar</span>
            </button>

            @if (isset($slot) && $slot->isNotEmpty())
                <div class="shrink-0">
                    {{ $slot }}
                </div>
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
        let debounceTimer = null;
        const autoSearch = {{ $autoSearch ? 'true' : 'false' }};

        function showError() {
            input.classList.add('border-red-400', 'ring-2', 'ring-red-200', 'bg-red-50');
            input.focus();
            setTimeout(() => {
                input.classList.remove('border-red-400', 'ring-2', 'ring-red-200', 'bg-red-50');
            }, 800);
        }

        function realizarBusqueda() {
            const value = input.value.trim();

            if (value === '') {
                showError();
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

        function limpiarBusqueda() {
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
        }

        function buscarConDebounce() {
            clearTimeout(debounceTimer);
            const value = input.value.trim();

            if (value === '') {
                debounceTimer = setTimeout(() => {
                    if (input.value.trim() === '') {
                        limpiarBusqueda();
                    }
                }, 500);
            } else if (autoSearch) {
                debounceTimer = setTimeout(() => {
                    if (input.value.trim() !== '') {
                        realizarBusqueda();
                    }
                }, 500);
            }
        }

        btn.addEventListener('click', realizarBusqueda);

        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                clearTimeout(debounceTimer);
                realizarBusqueda();
            }
        });

        if (autoSearch) {
            input.addEventListener('input', buscarConDebounce);
        }

        input.addEventListener('input', () => {
            input.classList.remove('border-red-400', 'ring-2', 'ring-red-200', 'bg-red-50');
        });

        if (btnLimpiar) {
            btnLimpiar.addEventListener('click', limpiarBusqueda);
        }
    })();
</script>
