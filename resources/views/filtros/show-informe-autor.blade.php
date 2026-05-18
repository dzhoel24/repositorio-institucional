<x-public.app-main title="Informes por Autor">
    <x-breadcrumb name="filtros.autores"></x-breadcrumb>

    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-6 lg:gap-8 mt-4 sm:mt-6">

        <aside class="hidden md:block md:col-span-1">
            <div class="sticky top-6">
                <x-filter></x-filter>
            </div>
        </aside>

        <main class="md:col-span-3 flex flex-col w-full px-2 sm:px-4 space-y-5">

            <div class="py-2">
                <x-search :descrip="'O introduce las primeras letras'" :text="'IR'" />
            </div>

            <div class="flex items-center justify-between border-b border-slate-200 dark:border-gray-800 pb-3 mt-2">
                <div class="flex items-center gap-2.5">
                    <div class="h-6 w-1 bg-indigo-600 dark:bg-indigo-400 rounded-full"></div>
                    <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100 tracking-wide">
                        Publicaciones de: <span
                            class="text-indigo-600 dark:text-indigo-400 font-extrabold">{{ $autor->nombres ?? '' }}
                            {{ $autor->apellidos ?? '' }}</span>
                    </h2>
                </div>
            </div>

            {{-- Listado de Publicaciones (Cards) o Estado Vacío --}}
            <div class="flex flex-col gap-4 w-full pt-1">
                @forelse ($informes as $informe)
                    <x-public.card :parametro="'institucional'" :codigo="$informe->id" :image="$informe->ruta_caratula" :title="$informe->titulo"
                        :resumen="$informe->resumen" :autores="$informe->autores_formatted" :acceso="$informe->acceso" />
                @empty
                    <div
                        class="text-center py-12 bg-slate-50/50 dark:bg-gray-900/30 rounded-lg border border-dashed border-slate-200 dark:border-gray-800">
                        <svg class="w-8 h-8 text-slate-300 dark:text-gray-600 mx-auto mb-3" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="text-sm font-medium text-slate-500 dark:text-gray-400">
                            No se encontraron informes o investigaciones registradas para este autor.
                        </p>
                    </div>
                @endforelse
            </div>

            {{-- Paginación Inferior --}}
            <div class="pt-4">
                <x-public.pagination :paginator="$informes" />
            </div>

        </main>
    </div>
</x-public.app-main>
