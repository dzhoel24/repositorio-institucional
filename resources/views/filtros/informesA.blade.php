<x-app-main>
    <div class="bg-black">
        <x-breadcrumb name="filtros.autores"></x-breadcrumb>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-2 sm:gap-4">
        <div class="container hidden md:block">
            <x-filter></x-filter>
        </div>
        <div class="md:col-span-3 flex flex-col w-full px-4">
            <!-- Sección de búsqueda -->
            <h3 class="text-3xl font-semibold py-2">Buscar</h3>

            <x-search :parametro="'repositorio'" :parametro2="'index'" :descrip="'Buscar en todo el repositorio'" />

            <h2 class="text-2xl font-semibold py-2">
                Informes de: {{ $autor->nombres ?? '' }} {{ $autor->apellidos ?? '' }}
            </h2>

            <div class="py-2 gap-4 w-full">
                @forelse ($informes as $informe)
                    <x-card 
                        :parametro="'filtros'" 
                        :codigo="$informe->id" 
                        :image="$informe->ruta_caratula" 
                        :title="$informe->titulo" 
                        :resumen="$informe->resumen"
                        :autores="$informe->autores" 
                        :acceso="$informe->acceso" 
                        :action="'showInformeAutores'" 
                    />
                @empty
                    <p class="text-gray-500 py-4 text-center">No se encontraron informes para este autor.</p>
                @endforelse
            </div>

            <x-pagination :paginator="$informes" />
        </div>
    </div>
</x-app-main>