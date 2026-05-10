<x-admin.alerts />
@include('admin.publicaciones.modals.publish')
@include('admin.publicaciones.modals.unpublish')

<x-admin.title titulo="CONTROL DE PUBLICACIONES"
    subtitulo="Administración centralizada de visibilidad y protocolos de acceso institucional." badgeColor="green" />

<div class="mb-8">
    <x-admin.search :action="route('admin.publicaciones.index')" placeholder="Filtrar por título, autor o categoría..." />
</div>

<div class="space-y-4">
    @forelse ($publicaciones as $info)
        @php $estiloFicha = $tipoEstilos[$info->tipo_informe_id] ?? 'bg-slate-600 text-white'; @endphp

        <div
            class="group relative flex flex-col gap-5 rounded-2xl border border-slate-200 bg-white p-5 
                    transition-all duration-200 hover:border-indigo-300 hover:bg-indigo-50/20 
                    dark:border-slate-700 dark:bg-slate-900
                    dark:hover:border-indigo-600 dark:hover:bg-indigo-950/20 
                    lg:flex-row lg:items-center lg:p-6">

            {{-- 1. Información Principal --}}
            <div class="min-w-0 flex-1">
                <div
                    class="mb-2 flex flex-wrap items-center gap-3 text-[11px] font-medium tracking-wide text-slate-400 dark:text-slate-500">
                    <span class="inline-flex items-center gap-1.5">
                        <x-heroicon-o-identification class="h-3.5 w-3.5" />
                        REF-{{ $info->id }}
                    </span>
                    <span class="inline-flex items-center gap-1.5 uppercase">
                        <x-heroicon-o-calendar class="h-3.5 w-3.5" />
                        Registro {{ $info->anio }}
                    </span>
                </div>

                <h3
                    class="line-clamp-1 text-base sm:text-lg font-bold uppercase leading-tight text-slate-800 dark:text-white">
                    {{ $info->titulo }}
                </h3>

                <div class="mt-2 flex items-center gap-2 text-sm font-medium text-slate-500 dark:text-slate-400">
                    <x-heroicon-o-user-circle class="h-4 w-4" />
                    <span class="capitalize">
                        {{ mb_strtolower($info->autores?->map(fn($a) => $a->nombres . ' ' . $a->apellidos)->implode(', ') ?? 'Anónimo') }}
                    </span>
                </div>

                <div class="mt-3 flex flex-wrap items-center gap-2">
                    <span
                        class="{{ $estiloFicha }} inline-block rounded-lg px-2.5 py-1 text-[10px] font-black uppercase tracking-wider shadow-sm">
                        {{ mb_strtoupper($info->tipoInforme->nombre ?? 'SISTEMA') }}
                    </span>

                    @if ($info->carrera_id && in_array($info->tipo_informe_id, [1, 3, 4]))
                        <span
                            class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-2.5 py-1 text-[10px] font-bold uppercase text-slate-600 
                                     dark:bg-slate-700 dark:text-slate-300">
                            <x-heroicon-o-academic-cap class="h-3 w-3" />
                            {{ $info->carrera->nombre ?? 'General' }}
                        </span>
                    @endif
                </div>
            </div>

            {{-- 2. Estado y Acceso --}}
            <div class="flex items-center gap-3 lg:border-x lg:border-slate-100 lg:px-6 dark:lg:border-slate-700">
                <div
                    class="{{ $info->estado === 'Publicado'
                        ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400'
                        : 'bg-slate-50 text-slate-500 dark:bg-slate-700 dark:text-slate-400' }} 
                    inline-flex items-center gap-1.5 rounded-lg px-3 py-1.5">
                    <x-heroicon-o-check-badge class="h-4 w-4" />
                    <span class="text-[10px] font-bold uppercase sm:text-[11px]">{{ $info->estado }}</span>
                </div>

                <div
                    class="{{ strtolower($info->acceso) === 'publico'
                        ? 'bg-blue-50 text-blue-700 dark:bg-blue-500/20 dark:text-blue-400'
                        : 'bg-rose-50 text-rose-700 dark:bg-rose-500/20 dark:text-rose-400' }} 
                    inline-flex items-center gap-1.5 rounded-lg px-3 py-1.5">
                    <x-heroicon-o-globe-alt class="h-4 w-4" />
                    <span class="text-[10px] font-bold uppercase sm:text-[11px]">{{ $info->acceso }}</span>
                </div>
            </div>

            {{-- 3. Acciones --}}
            <div class="flex items-center justify-end lg:w-[160px]">
                @if ($info->estado === 'Publicado')
                    <button type="button" data-tw-toggle="modal"
                        data-tw-target="#despublicar-modal{{ $info->id }}"
                        class="flex w-full items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white py-2.5 text-[11px] font-bold uppercase tracking-wider text-slate-700 
                                   transition-all duration-150 hover:border-red-400 hover:bg-red-50 hover:text-red-600 
                                   dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 
                                   dark:hover:border-red-500 dark:hover:bg-red-500/20 dark:hover:text-red-400">
                        <x-heroicon-o-archive-box-x-mark class="h-4 w-4" />
                        Retirar
                    </button>
                @else
                    <button type="button" data-tw-toggle="modal" data-tw-target="#publicar-modal{{ $info->id }}"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 py-2.5 text-[11px] font-bold uppercase tracking-wider text-white 
                                   transition-all duration-150 hover:bg-emerald-700 active:scale-95
                                   dark:bg-emerald-600 dark:hover:bg-emerald-500">
                        <x-heroicon-o-cloud-arrow-up class="h-4 w-4" />
                        Publicar
                    </button>
                @endif
            </div>
        </div>

    @empty
        <div
            class="flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-200 
                    bg-slate-50/30 py-16 px-4 text-center
                    dark:border-slate-700 dark:bg-slate-800/20">

            <div class="mb-4 rounded-full bg-slate-100 p-4 dark:bg-slate-800/50">
                <x-heroicon-o-document-text class="h-12 w-12 text-slate-400 dark:text-slate-500" />
            </div>

            <h3 class="text-base font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                @if (request('buscador'))
                    No hay resultados
                @else
                    Sin registros
                @endif
            </h3>

            <p class="mt-2 max-w-md text-sm text-slate-500 dark:text-slate-400">
                @if (request('buscador'))
                    No se encontraron publicaciones que coincidan con
                    <span class="font-medium text-slate-700 dark:text-slate-300">"{{ request('buscador') }}"</span>
                @else
                    No hay publicaciones registradas en el repositorio.
                @endif
            </p>

            @if (request('buscador'))
                <a href="{{ route('admin.publicaciones.index') }}" hx-get="{{ route('admin.publicaciones.index') }}"
                    hx-target="#main-content" hx-swap="innerHTML" hx-push-url="true"
                    class="mt-5 inline-flex items-center gap-2 rounded-full bg-indigo-50 px-5 py-2 text-sm font-medium text-indigo-600 
                          transition-all duration-200 hover:bg-indigo-100 hover:text-indigo-700
                          dark:bg-indigo-500/20 dark:text-indigo-400 dark:hover:bg-indigo-500/30">
                    <x-heroicon-o-arrow-path class="h-4 w-4" />
                    <span>Ver todas las publicaciones</span>
                </a>
            @endif
        </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $publicaciones->links() }}
</div>

<script>
    document.dispatchEvent(new CustomEvent('page:title', {
        detail: 'Publicaciones'
    }));
</script>
