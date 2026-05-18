<x-public.app-main title="Item Modulo">
    <x-breadcrumb name="modulo.index"></x-breadcrumb>
    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-2 sm:gap-4 mt-4">
        <div class="container hidden md:block">
            <x-filter></x-filter>
        </div>
        <div class="md:col-span-3 flex flex-col w-full px-4">
            <x-public.item :codigo="$informe->id" :pdf="$informe->ruta_pdf" :image="$informe->ruta_caratula" :title="$informe->titulo" :resumen="$informe->resumen"
                :autores="$informe->autores_formatted" :acceso="$informe->acceso" :anio="$informe->anio" :tipo="$informe->tipoInforme->nombre" />
        </div>
    </div>
</x-public.app-main>
