<x-admin.alerts />
@include('admin.publicaciones.modals.publish')
@include('admin.publicaciones.modals.unpublish')

<x-admin.title titulo="CONTROL DE PUBLICACIONES"
    subtitulo="Gestión centralizada de visibilidad y accesibilidad del contenido institucional." :table="$publicaciones"
    singular="publicación" plural="publicaciones" />

<div class="mb-8">
    <x-admin.search :action="route('admin.publicaciones.index')" placeholder="Filtrar por título, autor o categoría..." />
</div>

@if ($publicaciones->count() > 0)
    <div class="space-y-4">
        @foreach ($publicaciones as $info)
            @php
                $estiloFicha =
                    $tipoEstilos[$info->tipo_informe_id] ??
                    'bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300';

                $estadoClase =
                    $info->estado === 'Publicado'
                        ? 'bg-emerald-500 text-white dark:bg-emerald-600'
                        : 'bg-slate-400 text-white dark:bg-slate-500';

                $accesoClase =
                    strtolower($info->acceso) === 'publico'
                        ? 'bg-sky-500 text-white dark:bg-sky-600'
                        : 'bg-rose-500 text-white dark:bg-rose-600';
            @endphp

            <div
                class="group relative flex flex-col gap-4 rounded-lg border border-slate-200 bg-slate-50 p-5 
                        transition-all duration-200 hover:border-indigo-100 hover:shadow-md
                        dark:border-slate-700 dark:bg-slate-800
                        dark:hover:border-indigo-600 
                        lg:flex-row lg:items-center lg:gap-6 lg:p-5">

                {{-- Información Principal --}}
                <div class="min-w-0 flex-1">
                    <div class="mb-2 flex flex-wrap items-center gap-4 text-xs text-slate-500 dark:text-slate-400">
                        <span class="inline-flex items-center gap-1.5">
                            <x-heroicon-o-identification class="h-4 w-4" />
                            REF-{{ $info->id }}
                        </span>
                        <span class="inline-flex items-center gap-1.5">
                            <x-heroicon-o-calendar class="h-4 w-4" />
                            {{ $info->anio }}
                        </span>
                    </div>

                    <h3
                        class="text-lg font-semibold text-slate-800 transition-colors 
                               group-hover:text-indigo-600 dark:text-white dark:group-hover:text-indigo-400">
                        {{ $info->titulo }}
                    </h3>

                    <div class="mt-1.5 flex items-start gap-2 text-sm text-slate-500 dark:text-slate-400">
                        <x-heroicon-o-user-circle class="mt-0.5 h-4 w-4 shrink-0" />
                        <span class="line-clamp-1">
                            {{ $info->autores->isNotEmpty()
                                ? $info->autores->map(fn($a) => $a->nombres . ' ' . $a->apellidos)->implode(', ')
                                : 'Sin autores registrados' }}
                        </span>
                    </div>

                    <div class="mt-3 flex flex-wrap items-center gap-2">
                        <span
                            class="{{ $estiloFicha }} inline-block rounded px-3 py-0.5 text-xs font-semibold uppercase tracking-wide">
                            {{ strtoupper($info->tipoInforme->nombre ?? 'Sistema') }}
                        </span>

                        @if ($info->carrera_id && in_array($info->tipo_informe_id, [1, 3, 4]))
                            <span
                                class="inline-flex items-center gap-1.5 rounded bg-slate-100 px-3 py-0.5 text-sm font-medium text-slate-600 dark:bg-slate-700 dark:text-slate-400">
                                <x-heroicon-o-academic-cap class="h-3.5 w-3.5" />
                                {{ $info->carrera->nombre ?? 'General' }}
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Estado y Acceso --}}
                <div class="flex flex-wrap items-center gap-2">
                    <div
                        class="inline-flex items-center gap-1.5 rounded-md px-3 py-1 text-[12px] font-semibold uppercase {{ $estadoClase }}">
                        <x-heroicon-o-check-badge class="h-4 w-4" />
                        {{ $info->estado }}
                    </div>

                    <div
                        class="inline-flex items-center gap-1.5 rounded-md px-3 py-1 text-[12px] font-semibold uppercase {{ $accesoClase }}">
                        <x-heroicon-o-globe-alt class="h-4 w-4" />
                        {{ $info->acceso }}
                    </div>
                </div>

                {{-- Separador --}}
                <div class="hidden lg:block lg:w-px lg:h-8 lg:bg-slate-300 dark:lg:bg-slate-600"></div>

                {{-- Acciones --}}
                <div class="lg:w-[130px]">
                    @if ($info->estado === 'Publicado')
                        <button type="button" data-tw-toggle="modal"
                            data-tw-target="#despublicar-modal{{ $info->id }}"
                            class="inline-flex w-full items-center justify-center gap-1.5 rounded-md bg-amber-500 px-4 py-2 text-sm font-semibold text-white 
                                   transition-all duration-150 hover:bg-amber-600 active:scale-95
                                   dark:bg-amber-600 dark:hover:bg-amber-500">
                            <x-heroicon-o-archive-box-x-mark class="h-4 w-4" />
                            Retirar
                        </button>
                    @else
                        <button type="button" data-tw-toggle="modal"
                            data-tw-target="#publicar-modal{{ $info->id }}"
                            class="inline-flex w-full items-center justify-center gap-1.5 rounded-md bg-indigo-500 px-4 py-2 text-sm font-semibold text-white 
                                   transition-all duration-150 hover:bg-indigo-600 active:scale-95
                                   dark:bg-indigo-600 dark:hover:bg-indigo-500">
                            <x-heroicon-o-cloud-arrow-up class="h-4 w-4" />
                            Publicar
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    @if ($publicaciones->hasPages())
        <div class="mt-6">
            {{ $publicaciones->links() }}
        </div>
    @endif
@else
    <div
        class="flex flex-col items-center justify-center rounded-lg border border-slate-200 bg-slate-50/30 py-12 px-4 text-center dark:border-slate-700 dark:bg-slate-800/20">
        <div class="mb-3 rounded-full bg-slate-100 p-3 dark:bg-slate-800/50">
            <x-heroicon-o-document-text class="h-10 w-10 text-slate-400 dark:text-slate-500" />
        </div>
        <h3 class="text-sm font-semibold text-slate-600 dark:text-slate-300">
            @if (request('buscador'))
                Sin resultados
            @else
                No hay publicaciones registradas
            @endif
        </h3>
        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
            @if (request('buscador'))
                No se encontraron coincidencias para "{{ request('buscador') }}"
            @else
                Comienza registrando la primera publicación
            @endif
        </p>
        @if (request('buscador'))
            <a href="{{ route('admin.publicaciones.index') }}" hx-get="{{ route('admin.publicaciones.index') }}"
                hx-target="#main-content" hx-swap="innerHTML" hx-push-url="true"
                class="mt-4 inline-flex items-center gap-1.5 rounded-full bg-slate-700 px-5 py-2 text-sm font-medium text-white hover:bg-slate-800 dark:bg-slate-600 dark:hover:bg-slate-500">
                <x-heroicon-o-arrow-path class="h-4 w-4" />
                Mostrar todos
            </a>
        @endif
    </div>
@endif

<script>
    document.dispatchEvent(new CustomEvent('page:title', {
        detail: 'Publicaciones'
    }));
</script>
