<x-public.app-main title="Fecha de Publicación" :showFilter="true">

    <x-public.breadcrumb name="filtros.fechas.index" />

    <div class="flex flex-col w-full px-0 md:px-4 space-y-5 mt-4 sm:mt-6">

        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-slate-200 pb-3">
            <div class="flex items-center gap-2.5 min-w-0">
                <div class="h-6 w-1 bg-indigo-600 rounded-full shrink-0"></div>
                <h2 class="text-base sm:text-lg font-bold text-slate-800 tracking-wide">
                    LISTAR POR FECHA DE PUBLICACIÓN
                </h2>
            </div>
        </div>

        {{-- Rangos de años --}}
        <div class="bg-slate-50 rounded-xl p-4 border border-slate-200 shadow-sm">
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3 flex items-center gap-1.5">
                <x-heroicon-s-calendar class="w-3.5 h-3.5" />
                Rangos de años
            </h3>
            <div class="flex flex-wrap gap-2">
                @php $currentRange = request()->route('range') ?? request()->get('range'); @endphp
                @foreach ($yearRanges as $range)
                    <a href="{{ route('filtros.fechas.rango', ['range' => $range]) }}"
                        class="px-3.5 py-2 rounded-lg text-xs sm:text-sm font-semibold transition-all duration-150 active:scale-95 border
                        {{ $currentRange == $range
                            ? 'bg-indigo-600 text-white border-indigo-600 shadow-sm'
                            : 'bg-white text-slate-600 border-slate-200 hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-200' }}">
                        {{ $range }}
                    </a>
                @endforeach
            </div>
            @if ($currentRange)
                <div class="mt-4 pt-3 border-t border-slate-200 flex items-center justify-between flex-wrap gap-2">
                    <div class="flex items-center gap-1.5 text-xs text-slate-500">
                        <span>Filtro activo:</span>
                        <span
                            class="px-2 py-0.5 bg-indigo-100 text-indigo-700 font-semibold rounded-md">{{ $currentRange }}</span>
                    </div>
                    <a href="{{ route('filtros.fechas.index') }}"
                        class="inline-flex items-center gap-1 text-xs font-semibold text-rose-500 hover:text-rose-600 transition-colors bg-rose-50 hover:bg-rose-100 px-2.5 py-1 rounded-md">
                        <x-heroicon-s-x-mark class="w-3 h-3" />
                        Limpiar filtro
                    </a>
                </div>
            @endif
        </div>

        {{-- Buscador --}}
        <x-public.search :route="'filtros.fechas.index'" :param="'search'" :descrip="'Introduce un año de publicación específico...'" :text="'Buscar'" />

        {{-- Barra de control --}}
        <div class="w-full flex flex-row sm:items-center justify-between gap-3 py-2 border-b border-slate-100">
            <div class="text-xs sm:text-sm font-medium text-slate-500">
                <x-public.count :contador="$contador" :paginator="$publi_fecha" />
            </div>
            <div class="flex items-center justify-end">
                <x-public.advanced-filter route="filtros.fechas.index" defaultSort="asc" defaultItemsPerPage="10" />
            </div>
        </div>

        {{-- Lista de documentos --}}
        <div class="w-full space-y-3">
            @forelse ($publi_fecha as $informe)
                <x-public.card :parametro="$informe->tipo_slug ?? 'institucional'" :action="'show'" :origen="'fecha'" :codigo="$informe->id"
                    :image="$informe->ruta_caratula" :title="$informe->titulo" :anio="$informe->anio" :resumen="$informe->resumen" :autores="$informe->autores_formatted"
                    :acceso="$informe->acceso" />
            @empty
                <div class="text-center py-12 bg-slate-50/50 rounded-xl border border-dashed border-slate-200">
                    <x-heroicon-s-calendar class="w-10 h-10 text-slate-300 mx-auto mb-3" />
                    <p class="text-sm font-medium text-slate-500 px-4">
                        No se encontraron publicaciones para este año o período.
                    </p>
                    @if ($currentRange || request('search'))
                        <a href="{{ route('filtros.fechas.index') }}"
                            class="inline-flex items-center gap-2 mt-4 px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                            <x-heroicon-s-arrow-path class="w-4 h-4" />
                            Limpiar filtros
                        </a>
                    @endif
                </div>
            @endforelse
        </div>

        {{-- Paginación --}}
        @if ($publi_fecha->hasPages())
            <x-public.pagination :paginator="$publi_fecha" />
        @endif

    </div>

</x-public.app-main>
