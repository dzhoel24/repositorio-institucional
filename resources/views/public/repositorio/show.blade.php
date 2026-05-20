<x-public.app-main :title="$informe->titulo">

    <x-public.breadcrumb name="repositorio.show" :params="[$tipo, $informe->id, $origen ?? null, $origenData ?? null]" />
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:gap-8 mt-4 sm:mt-6">

        <aside class="hidden lg:block">
            <div class="sticky top-6">
                <x-public.filter />
            </div>
        </aside>

        <div class="lg:col-span-3 space-y-4">

            <div class="flex justify-start">
                @php
                    $previousUrl = url()->previous();
                    $currentUrl = url()->current();
                    $backUrl =
                        $previousUrl !== $currentUrl && !empty($previousUrl)
                            ? $previousUrl
                            : route('repositorio.index', ['tipo' => $tipo]);
                @endphp

                <a href="{{ $backUrl }}"
                    class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 hover:text-slate-700 transition-all duration-200">
                    <x-heroicon-s-arrow-left class="w-4 h-4" />
                    Volver
                </a>
            </div>

            <x-public.item :codigo="$informe->id" :pdf="$informe->ruta_pdf" :image="$informe->ruta_caratula" :title="$informe->titulo" :resumen="$informe->resumen"
                :autores="$informe->autores_formatted" :acceso="$informe->acceso" :anio="$informe->anio" :tipo="$informe->tipoInforme->nombre ?? 'No especificado'" />

        </div>
    </div>
</x-public.app-main>
