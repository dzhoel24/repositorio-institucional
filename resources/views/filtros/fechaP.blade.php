<x-app-main>
    <div class="bg-black">
        <x-breadcrumb name="filtros.fechaP"></x-breadcrumb>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-2 sm:gap-4">

        {{-- Columna izquierda --}}
        <div class="container hidden md:block">
           <x-filter></x-filter>
        </div>
        {{-- Columna derecha --}}
        <div class="md:col-span-3 flex flex-col w-full px-4">
            <h2 class="text-2xl font-semibold py-2">Listar por fecha de Publicación</h2>
            <x-search
            :parametro="'institucional'"
            :parametro2="'index'"
            :descrip="'Buscar en todo el repositorio'"
            />
            <x-count :contador="$contador" :paginator="$publi_fecha" />
            <div class="w-full flex justify-end py-2">
                <x-advanced-filter route="filtros.fechaP" defaultSort="asc" defaultItemsPerPage="10" />
            </div>
            <div class="py-2">
                <x-search 
                    :parametro="'filtros'"
                    :parametro2="'fechaP'"
                    :descrip="'Introduce el año de publicación'"
                    :text="'IR'" 
                />
            </div>
            <div class="py-2 gap-4 w-full ">
                @foreach ($publi_fecha as $informe)
                    <x-card
                        :parametro="'filtros'"
                        :codigo="$informe->id"
                        :image="$informe->ruta_caratula"
                        :title="$informe->titulo"
                        :resumen="$informe->resumen"
                        :autores="$informe->autores"
                        :acceso="$informe->acceso"
                        :action="'showFechaP'" 
                    />
                @endforeach

            </div>
            <x-pagination :paginator="$publi_fecha" />
        </div>

    </div>
</x-app-main>
