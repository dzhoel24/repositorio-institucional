<x-public.app-main title="Informes por Autor" :showFilter="true">

    <x-public.breadcrumb name="filtros.autores.informes" :params="[$autor]" />

    <div class="flex flex-col w-full px-2 sm:px-4 space-y-5 mt-4 sm:mt-6">

        {{-- Buscador --}}
        <div class="py-2">
            <x-public.search :route="'filtros.autores.informes'" :params="['autor' => $autor->dni]" :descrip="'Buscar por título del documento...'" :text="'Buscar'"
                :param="'search'" />
        </div>

        {{-- Header del autor --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-200 pb-3">
            <div class="flex items-start sm:items-center gap-2.5 min-w-0 flex-1">
                <div class="h-6 w-1 bg-indigo-600 rounded-full shrink-0 mt-0.5 sm:mt-0"></div>
                <div class="min-w-0 flex-1">
                    <h2 class="text-base sm:text-lg font-bold text-slate-800">Publicaciones de:</h2>
                    <p
                        class="text-indigo-600 font-extrabold break-words text-base sm:text-lg sm:inline sm:ml-1 mt-0.5 sm:mt-0">
                        {{ trim(($autor->nombres ?? '') . ' ' . ($autor->apellidos ?? '')) }}
                    </p>
                </div>
            </div>
            <div class="bg-indigo-50 rounded-full px-3 py-1 w-fit shrink-0">
                <span class="text-xs font-semibold text-indigo-600">
                    <span class="font-bold">{{ $informes->total() }}</span> publicaciones
                </span>
            </div>
        </div>

        {{-- Barra de utilidades --}}
        <div class="w-full flex flex-row items-center justify-between gap-3 border-b border-slate-100">
            <div class="text-xs sm:text-sm font-medium text-slate-500">
                <x-public.count :contador="$informes->total()" :paginator="$informes" />
            </div>
            <div class="flex items-center justify-end">
                <x-public.advanced-filter route="filtros.autores.informes" :params="['autor' => $autor->dni]" defaultSort="asc"
                    defaultItemsPerPage="10" />
            </div>
        </div>

        {{-- Lista de informes --}}
        <div class="flex flex-col gap-4 w-full pt-1">
            @forelse ($informes as $informe)
                <x-public.card :parametro="$informe->tipo_slug" :action="'show'" :codigo="$informe->id" :image="$informe->ruta_caratula"
                    :title="$informe->titulo" :resumen="$informe->resumen" :anio="$informe->anio" :autores="$informe->autores_formatted" :acceso="$informe->acceso"
                    :origen="'autor'" :origenId="$autor->dni" />
            @empty
                <div class="text-center py-12 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                    <x-heroicon-s-user class="w-12 h-12 text-slate-300 mx-auto mb-3" />
                    <p class="text-sm font-medium text-slate-500">
                        @if (request('search'))
                            No se encontraron publicaciones que coincidan con "{{ request('search') }}"
                        @else
                            No se encontraron publicaciones para este autor.
                        @endif
                    </p>
                    <div class="flex items-center justify-center gap-3 mt-4 flex-wrap">
                        <a href="{{ route('filtros.autores.index') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                            <x-heroicon-s-arrow-left class="w-4 h-4" />
                            Volver a autores
                        </a>
                        @if (request('search'))
                            <a href="{{ route('filtros.autores.informes', ['autor' => $autor]) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">
                                <x-heroicon-s-x-mark class="w-4 h-4" />
                                Limpiar búsqueda
                            </a>
                        @endif
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Paginación --}}
        @if ($informes->hasPages())
            <x-public.pagination :paginator="$informes" />
        @endif

    </div>

</x-public.app-main>
