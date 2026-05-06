<x-app-main title="Modulo">
    <div class="bg-black">
        <x-breadcrumb name="modulo.index"></x-breadcrumb>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-2 sm:gap-4">

        {{-- Columna izquierda --}}
        <div class="container hidden md:block">
            <x-filter></x-filter>
        </div>
        {{-- Columna derecha --}}
        <div class="md:col-span-3 flex flex-col w-full px-4">

            <!-- Sección de búsqueda -->
            <h3 class="text-3xl font-semibold py-2">Buscar</h3>
            <x-search :parametro="'institucional'" :parametro2="'index'" :descrip="'Buscar en todo el repositorio'" />
            <x-count :contador="$contador" :paginator="$informes" />
            <div class="w-full flex justify-end py-2">
                <x-advanced-filter route="modulo.index" defaultSort="asc" defaultItemsPerPage="10" />

            </div>
            <div class="py-2">
                <x-search :parametro="'modulo'" :parametro2="'index'" :descrip="'O introducir las primeras letras'" :text="'IR'" />
            </div>
            <!-- Sección de cards, siempre visible y adaptable -->
            <div class="py-2 gap-4 w-full ">
                @foreach ($informes as $informe)
                    <x-card :parametro="'modulo'" :codigo="$informe->id" :image="$informe->ruta_caratula" :title="$informe->titulo"
                        :resumen="$informe->resumen" :autores="$informe->autores" :acceso="$informe->acceso" />
                @endforeach
            </div>

            <x-pagination :paginator="$informes" />

        </div>

    </div>
</x-app-main>
