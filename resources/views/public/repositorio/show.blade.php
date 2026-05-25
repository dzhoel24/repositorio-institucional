<x-public.app-main :title="$informe->titulo" :showFilter="true">

    <x-public.breadcrumb name="repositorio.show" :params="[$tipo, $informe->id, $origen ?? null, $origenData ?? null]" />

    <div class="space-y-4 mt-4 sm:mt-6">

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

        {{-- Informe --}}
        <x-public.item :codigo="$informe->id" :pdf="$informe->ruta_pdf" :image="$informe->ruta_caratula" :title="$informe->titulo" :resumen="$informe->resumen"
            :autores="$informe->autores_formatted" :acceso="$informe->acceso" :anio="$informe->anio" :tipo="$informe->tipoInforme->nombre ?? 'No especificado'" />

    </div>

</x-public.app-main>
