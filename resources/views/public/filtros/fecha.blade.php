<x-public.app-main title="Fecha de Publicación">

    <x-public.breadcrumb name="filtros.fechas.index"></x-public.breadcrumb>

    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-6 lg:gap-8 mt-4 sm:mt-6">

        <aside class="hidden md:block md:col-span-1">
            <x-public.filter></x-public.filter>
        </aside>

        <main class="md:col-span-3 flex flex-col w-full px-0 md:px-4 space-y-5">

            <div class="flex items-center justify-between border-b border-slate-200 pb-3 mb-1">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="h-6 w-1 bg-indigo-600 rounded-full shrink-0"></div>
                    <h2 class="text-base sm:text-lg font-bold text-slate-800 tracking-wide truncate">
                        LISTAR POR FECHA DE PUBLICACIÓN
                    </h2>
                </div>
            </div>

            <div class="w-full">
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-200/80 shadow-sm">
                    <h3
                        class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3 flex items-center gap-1.5">
                        <span>📅</span> Rangos de años
                    </h3>

                    <div class="flex flex-wrap gap-2">
                        @php
                            $currentRange = request()->route('range') ?? request()->get('range');
                        @endphp

                        @foreach ($yearRanges as $range)
                            <a href="{{ route('filtros.fechas.rango', ['range' => $range]) }}"
                                class="px-3.5 py-2 rounded-lg text-xs sm:text-sm font-semibold transition-all duration-150 active:scale-95 border
                                {{ $currentRange == $range
                                    ? 'bg-indigo-600 text-white border-indigo-600 shadow-sm shadow-indigo-100'
                                    : 'bg-white text-slate-600 border-slate-200 hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-200' }}">
                                {{ $range }}
                            </a>
                        @endforeach
                    </div>

                    @if ($currentRange)
                        <div
                            class="mt-4 pt-3 border-t border-slate-200 flex items-center justify-between flex-wrap gap-2">
                            <div class="flex items-center gap-1.5 text-xs text-slate-500">
                                <span>Filtro activo:</span>
                                <span class="px-2 py-0.5 bg-indigo-50 text-indigo-600 font-bold rounded-md">
                                    {{ $currentRange }}
                                </span>
                            </div>
                            <a href="{{ route('filtros.fechas.index') }}"
                                class="inline-flex items-center gap-1 text-xs font-semibold text-rose-500 hover:text-rose-600 transition-colors bg-rose-50 hover:bg-rose-100 px-2.5 py-1 rounded-md">
                                Limpiar filtro
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="w-full">
                <x-public.search :parametro="'filtros'" :parametro2="'fecha'" :descrip="'Introduce un año de publicación específico...'" :text="'Buscar'" />
            </div>

            <div
                class="w-full flex flex-col sm:flex-row sm:items-center justify-between gap-3.5 py-2 border-b border-slate-100">
                <div class="text-xs sm:text-sm font-medium text-slate-500 min-w-0">
                    <x-public.count :contador="$contador" :paginator="$publi_fecha" />
                </div>
                <div class="flex items-center justify-start sm:justify-end shrink-0">
                    <x-public.advanced-filter route="filtros.fechas.index" defaultSort="asc" defaultItemsPerPage="10" />
                </div>
            </div>

            <div class="w-full space-y-3">
                @forelse ($publi_fecha as $informe)
                    <x-public.card :parametro="$informe->tipo_slug ?? 'institucional'" :action="'show'" :origen="'fecha'" :codigo="$informe->id"
                        :image="$informe->ruta_caratula" :title="$informe->titulo" :anio="$informe->anio" :resumen="$informe->resumen" :autores="$informe->autores_formatted"
                        :acceso="$informe->acceso" />
                @empty
                    <div class="text-center py-12 bg-slate-50/50 rounded-xl border border-dashed border-slate-200">
                        <svg class="w-8 h-8 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="text-sm font-medium text-slate-500 px-4">
                            No se encontraron publicaciones correspondientes a este año o período.
                        </p>
                    </div>
                @endforelse
            </div>

            <x-public.pagination :paginator="$publi_fecha" />

        </main>
    </div>
</x-public.app-main>
