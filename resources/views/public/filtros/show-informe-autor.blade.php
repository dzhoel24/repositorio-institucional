<x-public.app-main title="Informes por Autor">
    <x-public.breadcrumb name="filtros.autores.informes" :params="[$autor]" />

    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-6 lg:gap-8 mt-4 sm:mt-6">

        <aside class="hidden md:block md:col-span-1">
            <div class="sticky top-6">
                <x-public.filter />
            </div>
        </aside>

        <main class="md:col-span-3 flex flex-col w-full px-2 sm:px-4 space-y-5">

            <div class="py-2">
                <x-public.search :route="'filtros.autores.informes'" :params="['autor' => $autor->dni]" :descrip="'O introduce las primeras letras del título...'" :text="'Buscar'"
                    :param="'search'" />
            </div>

            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-200 pb-3 mt-2">
                <div class="flex items-center gap-2.5 min-w-0 flex-wrap">
                    <div class="h-6 w-1 bg-indigo-600 rounded-full shrink-0"></div>
                    <h2 class="text-base sm:text-lg font-bold text-slate-800 tracking-wide">
                        Publicaciones de:
                        <span class="text-indigo-600 font-extrabold break-words">
                            {{ trim(($autor->nombres ?? '') . ' ' . ($autor->apellidos ?? '')) }}
                        </span>
                    </h2>
                </div>

                <div class="bg-indigo-50 rounded-full px-3 py-1 shrink-0 w-fit">
                    <span class="text-xs font-semibold text-indigo-600">
                        <span class="font-bold">{{ $informes->total() }}</span> publicaciones
                    </span>
                </div>
            </div>

            <div
                class="w-full flex flex-col sm:flex-row sm:items-center justify-between gap-3 py-2 border-b border-slate-100">
                <div class="text-xs sm:text-sm font-medium text-slate-500 min-w-0">
                    <x-public.count :contador="$informes->total()" :paginator="$informes" />
                </div>
                <div class="flex items-center justify-start sm:justify-end shrink-0">
                    <x-public.advanced-filter route="filtros.autores.informes" :params="['autor' => $autor->dni]" defaultSort="asc"
                        defaultItemsPerPage="10" />
                </div>
            </div>

            <div class="flex flex-col gap-4 w-full pt-1">
                @forelse ($informes as $informe)
                    <x-public.card :parametro="$informe->tipo_slug" :action="'show'" :codigo="$informe->id" :image="$informe->ruta_caratula"
                        :title="$informe->titulo" :resumen="$informe->resumen" :anio="$informe->anio" :autores="$informe->autores_formatted" :acceso="$informe->acceso"
                        :origen="'autor'" :origenId="$autor->dni" />
                @empty
                    <div class="text-center py-12 bg-slate-50 rounded-lg border border-dashed border-slate-200">
                        <x-heroicon-s-user class="w-8 h-8 text-slate-300 mx-auto mb-3" />
                        <p class="text-sm font-medium text-slate-500 px-4">
                            No se encontraron publicaciones para este autor.
                        </p>
                        <a href="{{ route('filtros.autores.index') }}"
                            class="inline-flex items-center gap-2 mt-4 px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                            <x-heroicon-s-arrow-left class="w-4 h-4" />
                            Volver al índice de autores
                        </a>
                    </div>
                @endforelse
            </div>

            @if ($informes->hasPages())
                <x-public.pagination :paginator="$informes" />
            @endif

        </main>
    </div>
</x-public.app-main>
