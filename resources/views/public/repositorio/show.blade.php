<x-public.app-main :title="$informe->titulo">

    <x-public.breadcrumb name="repositorio.show" :params="[$tipo, $informe->id, $origen ?? null, $origenData ?? null]" />

    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-2 sm:gap-4 mt-4">
        <div class="container hidden md:block">
            <x-public.filter></x-public.filter>
        </div>
        <div class="md:col-span-3 flex flex-col w-full px-4">
            <x-public.item :codigo="$informe->id" :pdf="$informe->ruta_pdf" :image="$informe->ruta_caratula" :title="$informe->titulo" :resumen="$informe->resumen"
                :autores="$informe->autores_formatted" :acceso="$informe->acceso" :anio="$informe->anio" :tipo="$informe->tipoInforme->nombre ?? 'No especificado'" />
        </div>
    </div>
</x-public.app-main>
