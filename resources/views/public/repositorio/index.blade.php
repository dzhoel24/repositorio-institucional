<x-public.app-main :title="$config['titulo']">
    <x-public.breadcrumb name="repositorio.index" :params="[$tipo]" />

    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-6 lg:gap-8 mt-4 sm:mt-6">

        <div class="container hidden md:block">
            <x-public.filter></x-public.filter>
        </div>

        <main class="md:col-span-3 flex flex-col w-full space-y-4">

            <x-public.search :route="'repositorio.index'" :params="['tipo' => $tipo]" :descrip="'Buscar en todo el repositorio'" />

            <div
                class="w-full flex flex-col sm:flex-row sm:items-center justify-between gap-3 py-2 border-b border-gray-100 dark:border-gray-850">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    <x-public.count :contador="$informes->total()" :paginator="$informes" />
                </div>

                <div class="flex items-center justify-end">
                    <x-public.advanced-filter route="repositorio.index" :params="['tipo' => $tipo]" defaultSort="asc"
                        defaultItemsPerPage="10" />
                </div>
            </div>

            {{-- Búsqueda específica para ciertos tipos (opcional) --}}
            @if (in_array($tipo, ['modulo', 'investigacion', 'feria']))
                <div class="py-2">
                    <x-public.search :descrip="'O introduce las primeras letras'" :text="'IR'" :param="'search'" />
                </div>
            @endif

            <div class="flex flex-col gap-4 w-full pt-2">
                @forelse ($informes as $informe)
                    <x-public.card :parametro="$tipo" :codigo="$informe->id" :image="$informe->ruta_caratula" :title="$informe->titulo"
                        :resumen="$informe->resumen" :anio="$informe->anio" :autores="$informe->autores_formatted" :acceso="$informe->acceso" />
                @empty
                    <div
                        class="text-center py-12 bg-gray-50 dark:bg-gray-900/50 rounded-2xl border border-dashed border-gray-200 dark:border-gray-800">
                        <p class="text-gray-500 dark:text-gray-400 text-sm">No se encontraron resultados.</p>
                    </div>
                @endforelse
            </div>

            <x-public.pagination :paginator="$informes" />

        </main>
    </div>
</x-public.app-main>
