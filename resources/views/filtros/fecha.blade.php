<x-public.app-main title="Fecha de Publicación">
    {{-- Barra de Navegación / Breadcrumb --}}
    <div class="bg-gray-900 dark:bg-black py-1">
        <x-breadcrumb name="filtros.fecha"></x-breadcrumb>
    </div>

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
                        Listar por fecha de publicación
                    </h2>
                </div>
            </div>

            {{-- Rangos de años --}}
            <div class="w-full pt-1">
                <div
                    class="bg-slate-50 dark:bg-gray-800/40 rounded-xl p-4 border border-slate-200 dark:border-gray-700">
                    <h3 class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">📅 Rangos de años</h3>
                    <div class="flex flex-wrap gap-2">
                        @php
                            $currentRange = request()->route('range') ?? request()->get('range');
                        @endphp

                        @foreach ($yearRanges as $range)
                            <a href="{{ route('filtros.rangeYear', ['range' => $range]) }}"
                                class="px-3 py-1.5 rounded-lg text-sm font-medium transition-all
            {{ $currentRange == $range
                ? 'bg-indigo-600 text-white shadow-md'
                : 'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:bg-indigo-50 dark:hover:bg-gray-600' }}">
                                {{ $range }}
                            </a>
                        @endforeach
                    </div>

                    {{-- Rango seleccionado actualmente --}}
                    @if ($currentRange)
                        <div class="mt-3 pt-2 border-t border-gray-200 dark:border-gray-700">
                            <span class="text-xs text-gray-500">Rango seleccionado:</span>
                            <span class="ml-2 text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                                {{ $currentRange }}
                            </span>
                            <a href="{{ route('filtros.fecha') }}" class="ml-3 text-xs text-red-500 hover:text-red-600">
                                ❌ Limpiar
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Buscador por Año Específico --}}
            <div class="w-full pt-1">
                <x-search :parametro="'filtros'" :parametro2="'fecha'" :descrip="'Introduce un año de publicación específico...'" :text="'Buscar'" />
            </div>

            {{-- Barra de Utilidades (Contador y Ordenamiento unificados) --}}
            <div
                class="w-full flex flex-col sm:flex-row sm:items-center justify-between gap-3 py-1.5 border-b border-slate-100 dark:border-gray-800/60">
                <div class="text-sm font-medium text-slate-600 dark:text-slate-400">
                    <x-count :contador="$contador" :paginator="$publi_fecha" />
                </div>

                <div class="flex items-center justify-end">
                    <x-advanced-filter route="filtros.fecha" defaultSort="asc" defaultItemsPerPage="10" />
                </div>
            </div>

            {{-- Listado de Publicaciones (Cards) o Estado Vacío --}}
            <div class="w-full pt-1">
                @forelse ($publi_fecha as $informe)
                    <div class="flex flex-col gap-4 w-full">
                        <x-public.card :parametro="'institucional'" :codigo="$informe->id" :image="$informe->ruta_caratula" :title="$informe->titulo"
                            :anio="$informe->anio" :resumen="$informe->resumen" :autores="$informe->autores_formatted" :acceso="$informe->acceso"
                            :action="'showFechaP'" />
                    </div>
                @empty
                    <div
                        class="text-center py-12 bg-slate-50/50 dark:bg-gray-900/30 rounded-lg border border-dashed border-slate-200 dark:border-gray-800">
                        <svg class="w-8 h-8 text-slate-300 dark:text-gray-600 mx-auto mb-3" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="text-sm font-medium text-slate-500 dark:text-gray-400">
                            No se encontraron publicaciones correspondientes a este año o período.
                        </p>
                    </div>
                @endforelse
            </div>

            <x-public.pagination :paginator="$publi_fecha" />
        </main>
    </div>
</x-public.app-main>
