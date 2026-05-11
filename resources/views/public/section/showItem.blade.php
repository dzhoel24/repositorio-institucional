<x-app-main title="Item Carreras">
    
    <x-breadcrumb name="item.show" :programa="$carreraN"></x-breadcrumb>
    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-2 sm:gap-4">
        <div class="container hidden md:block">
            <x-filter></x-filter>
        </div>
        <div class="md:col-span-3 flex flex-col w-full px-4">
            <h3 class="text-3xl font-semibold py-2">Buscar</h3>
            <x-search
                :parametro="'repositorio'"
                :parametro2="'index'"
                :descrip="'Buscar en todo el repositorio'"
            />
            <x-item class="col-span-2"
                :codigo="$item->codigo"
                :pdf="$item->ruta_pdf"
                :image="$item->ruta_caratula"
                :title="$item->titulo"
                :resumen="$item->resumen"
                :autores="$item->autores"
                :acceso="$item->acceso"
                :anio="$item->anio"
                :tipo="$item->tipo_informe"
            />
        </div>
    </div>
</x-app-main>
