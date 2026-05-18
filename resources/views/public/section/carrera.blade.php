<x-public.app-main :title="$carreraModel->nombre ?? 'Programa de Estudio'">

    <x-breadcrumb name="filtros.carreras.show" :params="[$carreraModel->id]" />

    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-6 lg:gap-8 mt-4 sm:mt-6">

        <aside class="hidden md:block md:col-span-1">
            <div class="sticky top-6">
                <x-filter></x-filter>
            </div>
        </aside>

        <main class="md:col-span-3 flex flex-col w-full px-2 sm:px-4 space-y-4">

            <div class="flex items-center justify-between border-b border-slate-200 dark:border-gray-800 pb-3">
                <div class="flex items-center gap-2.5">
                    <div class="h-6 w-1 bg-indigo-600 dark:bg-indigo-400 rounded-full"></div>
                    <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100 tracking-wide">
                        {{ $carreraModel->nombre ?? 'Publicaciones del Programa' }}
                    </h2>
                </div>
            </div>

            {{-- Formulario de búsqueda --}}
            <div class="w-full pt-1">
                <form method="GET" action="{{ route('filtros.carreras.show', ['carrera' => $carreraModel->id]) }}"
                    id="searchCarreraForm" class="max-w-2xl w-full group">
                    <div class="relative flex items-center">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400 dark:text-gray-500 transition-colors group-focus-within:text-indigo-500"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" id="searchCarreraInput" name="search_carrera"
                            value="{{ request('search_carrera') }}"
                            class="w-full p-3.5 pl-12 pr-36 text-sm font-medium bg-white dark:bg-gray-900 text-slate-800 dark:text-slate-100 rounded-lg border border-slate-200 dark:border-gray-800 focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-2 focus:ring-indigo-500/10 outline-none transition-all duration-150 shadow-sm"
                            placeholder="Buscar por palabras clave o título de documento..." autocomplete="off">
                        <button type="button" id="clearCarreraBtn"
                            class="absolute right-24 p-1.5 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 rounded transition-colors hidden focus:outline-none"
                            title="Limpiar búsqueda">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <button type="submit"
                            class="absolute right-1.5 px-5 py-2 text-xs font-bold uppercase tracking-wider text-white bg-indigo-600 dark:bg-indigo-500 rounded-md hover:bg-indigo-700 dark:hover:bg-indigo-600 transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 active:scale-98 shadow-sm">
                            Buscar
                        </button>
                    </div>
                </form>
            </div>

            {{-- Contador y filtro --}}
            <div
                class="w-full flex flex-col sm:flex-row sm:items-center justify-between gap-3 py-1.5 border-b border-slate-100 dark:border-gray-800/60">
                <div class="text-sm font-medium text-slate-600 dark:text-slate-400">
                    <x-count :contador="$informes->total()" :paginator="$informes" />
                </div>
                <div class="flex items-center justify-end">
                    <x-advanced-filter route="filtros.carreras.show" :params="['carrera' => $carreraModel->id]" defaultSort="asc"
                        defaultItemsPerPage="10" />
                </div>
            </div>

            <div class="flex flex-col gap-4 w-full pt-1">
                @forelse ($informes as $informe)
                    <x-public.card :parametro="$informe->tipo_slug" :action="'show'" :codigo="$informe->id" :image="$informe->ruta_caratula"
                        :title="$informe->titulo" :resumen="$informe->resumen" :anio="$informe->anio" :autores="$informe->autores_formatted" :acceso="$informe->acceso"
                        :origen="'carrera'" :origenId="$carreraModel->id" />
                @empty
                    <div
                        class="text-center py-12 bg-slate-50/50 dark:bg-gray-900/30 rounded-lg border border-dashed border-slate-200 dark:border-gray-800">
                        <p class="text-sm font-medium text-slate-500 dark:text-gray-400">
                            No se encontraron publicaciones para esta carrera.
                        </p>
                    </div>
                @endforelse
            </div>

            <x-public.pagination :paginator="$informes" />

        </main>
    </div>
</x-public.app-main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const input = document.getElementById("searchCarreraInput");
        const clearBtn = document.getElementById("clearCarreraBtn");
        const form = document.getElementById("searchCarreraForm");
        let hasSearchActive = input.value.trim().length > 0;

        function toggleClearButton() {
            if (input.value.trim().length > 0) {
                clearBtn.classList.remove("hidden");
            } else {
                clearBtn.classList.add("hidden");
            }
        }

        toggleClearButton();

        input.addEventListener("input", function() {
            toggleClearButton();
            if (input.value.trim().length === 0 && hasSearchActive) {
                hasSearchActive = false;
                form.submit();
            }
        });

        clearBtn.addEventListener("click", function() {
            input.value = "";
            toggleClearButton();
            if (hasSearchActive) {
                form.submit();
            } else {
                input.focus();
            }
        });
    });
</script>
