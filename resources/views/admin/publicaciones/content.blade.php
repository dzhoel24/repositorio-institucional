<x-admin.alerts />
@include('admin.publicaciones.modals.publish')
@include('admin.publicaciones.modals.unpublish')

<x-admin.title titulo="CONTROL DE PUBLICACIONES"
    subtitulo="Administración centralizada de visibilidad y protocolos de acceso institucional." :table="$publicaciones"
    singular="publicación" plural="publicaciones" />

<div class="mb-8">
    <x-admin.search :action="route('admin.publicaciones.index')" placeholder="Filtrar por título, autor o categoría..." />
</div>

@if ($publicaciones->count() > 0)
    <div class="space-y-5">
        @foreach ($publicaciones as $info)
            @php
                $estiloFicha =
                    $tipoEstilos[$info->tipo_informe_id] ??
                    'bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300';

                $estadoClase =
                    $info->estado === 'Publicado'
                        ? 'bg-emerald-600 text-white dark:bg-emerald-700'
                        : 'bg-slate-500 text-white dark:bg-slate-600';

                $accesoClase =
                    strtolower($info->acceso) === 'publico'
                        ? 'bg-sky-600 text-white dark:bg-sky-700'
                        : 'bg-orange-600 text-white dark:bg-orange-700';
            @endphp

            <div
                class="group relative flex flex-col gap-5 rounded-xl border border-slate-200 bg-slate-50/80 p-5 
                        transition-all duration-200 hover:border-indigo-300 hover:shadow-md
                        dark:border-slate-800 dark:bg-slate-900/50
                        dark:hover:border-indigo-600 
                        md:p-6
                        lg:flex-row lg:items-center lg:gap-6">

                {{-- Información Principal --}}
                <div class="min-w-0 flex-1">
                    <div
                        class="mb-2 flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-slate-500 dark:text-slate-400">
                        <span class="inline-flex items-center gap-1.5">
                            <x-heroicon-o-identification class="h-3.5 w-3.5" />
                            <span class="font-mono">REF-{{ $info->id }}</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5">
                            <x-heroicon-o-calendar class="h-3.5 w-3.5" />
                            {{ $info->anio }}
                        </span>
                    </div>

                    <h3
                        class="line-clamp-2 text-base font-bold text-slate-800 transition-colors 
                               group-hover:text-indigo-600 dark:text-white dark:group-hover:text-indigo-400
                               sm:text-lg md:text-xl">
                        {{ $info->titulo }}
                    </h3>

                    <div class="mt-2 flex items-start gap-2 text-sm text-slate-600 dark:text-slate-300">
                        <x-heroicon-o-user-circle class="mt-0.5 h-4 w-4 shrink-0" />
                        <span class="line-clamp-2 text-sm">
                            {{ $info->autores->isNotEmpty()
                                ? $info->autores->map(fn($a) => $a->nombres . ' ' . $a->apellidos)->implode(', ')
                                : 'Anónimo' }}
                        </span>
                    </div>

                    <div class="mt-3 flex flex-wrap items-center gap-2">
                        <span
                            class="{{ $estiloFicha }} inline-block rounded-md px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wide">
                            {{ strtoupper($info->tipoInforme->nombre ?? 'SISTEMA') }}
                        </span>

                        @if ($info->carrera_id && in_array($info->tipo_informe_id, [1, 3, 4]))
                            <span
                                class="inline-flex items-center gap-1.5 rounded-md bg-slate-100 px-2.5 py-1 text-[12px] font-medium text-slate-600 
                                         dark:bg-slate-700 dark:text-slate-300">
                                <x-heroicon-o-academic-cap class="h-3 w-3" />
                                {{ $info->carrera->nombre ?? 'General' }}
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Estado y Acceso --}}
                <div class="flex flex-wrap items-center gap-3">
                    <div
                        class="{{ $estadoClase }} inline-flex items-center gap-1.5 rounded-lg px-3 py-1.5 text-xs font-bold uppercase tracking-wide">
                        <x-heroicon-o-check-badge class="h-4 w-4" />
                        {{ $info->estado }}
                    </div>

                    <div
                        class="{{ $accesoClase }} inline-flex items-center gap-1.5 rounded-lg px-3 py-1.5 text-xs font-bold uppercase tracking-wide">
                        <x-heroicon-o-globe-alt class="h-4 w-4" />
                        {{ $info->acceso }}
                    </div>
                </div>

                {{-- Separador --}}
                <div class="hidden lg:block lg:w-px lg:h-10 lg:bg-slate-200 dark:lg:bg-slate-700"></div>

                {{-- Acciones - Botón Retirar en ROJO --}}
                <div class="lg:w-[130px]">
                    @if ($info->estado === 'Publicado')
                        <button type="button" data-tw-toggle="modal"
                            data-tw-target="#despublicar-modal{{ $info->id }}"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-red-600 px-3 py-2 text-sm font-semibold text-white 
                                   transition-all duration-150 hover:bg-red-700 hover:shadow-sm active:scale-95
                                   dark:bg-red-700 dark:hover:bg-red-600">
                            <x-heroicon-o-archive-box-x-mark class="h-4 w-4" />
                            Retirar
                        </button>
                    @else
                        <button type="button" data-tw-toggle="modal"
                            data-tw-target="#publicar-modal{{ $info->id }}"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-emerald-600 px-3 py-2 text-sm font-semibold text-white 
                                   shadow-sm transition-all duration-150 hover:bg-emerald-700 hover:shadow-md active:scale-95
                                   dark:bg-emerald-700 dark:hover:bg-emerald-600">
                            <x-heroicon-o-cloud-arrow-up class="h-4 w-4" />
                            Publicar
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    @if ($publicaciones->hasPages())
        <div class="mt-8">
            {{ $publicaciones->links() }}
        </div>
    @endif
@else
    <div
        class="flex flex-col items-center justify-center rounded-xl border border-slate-200 bg-slate-50/30 py-16 px-4 text-center
                dark:border-slate-700 dark:bg-slate-800/20">

        <div class="mb-4 rounded-full bg-slate-100 p-4 dark:bg-slate-800/50">
            <x-heroicon-o-document-text class="h-12 w-12 text-slate-400 dark:text-slate-500" />
        </div>

        <h3 class="text-base font-semibold text-slate-600 dark:text-slate-300">
            @if (request('buscador'))
                No hay resultados
            @else
                Sin registros
            @endif
        </h3>

        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
            @if (request('buscador'))
                No se encontraron publicaciones que coincidan con
                <span class="font-medium text-indigo-600 dark:text-indigo-400">"{{ request('buscador') }}"</span>
            @else
                No hay publicaciones registradas en el repositorio.
            @endif
        </p>

        @if (request('buscador'))
            <a href="{{ route('admin.publicaciones.index') }}" hx-get="{{ route('admin.publicaciones.index') }}"
                hx-target="#main-content" hx-swap="innerHTML" hx-push-url="true"
                class="mt-5 inline-flex items-center gap-2 rounded-full bg-slate-700 px-5 py-2 text-sm font-medium text-white 
                      transition-all hover:bg-slate-800 dark:bg-slate-600 dark:hover:bg-slate-500">
                <x-heroicon-o-arrow-path class="h-4 w-4" />
                Ver todas las publicaciones
            </a>
        @endif
    </div>
@endif

<script>
    document.dispatchEvent(new CustomEvent('page:title', {
        detail: 'Publicaciones'
    }));
</script>
