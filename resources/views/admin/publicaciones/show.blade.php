<x-alerts />
@include('admin.publicaciones.modals.publish')
@include('admin.publicaciones.modals.unpublish')

<x-header-admin titulo="CONTROL DE PUBLICACIONES"
    subtitulo="Administración centralizada de visibilidad y protocolos de acceso institucional." />

<div class="mb-10">
    <x-search-admin :action="route('admin.publicaciones.index')" placeholder="Filtrar por título, autor o categoría..." />
</div>

<div class="space-y-4">
    @forelse ($publicaciones as $info)
        @php $estiloFicha = $tipoEstilos[$info->tipo_informe_id] ?? 'bg-zinc-600 text-white'; @endphp

        <div
            class="group relative flex flex-col gap-6 rounded-2xl border border-slate-100 bg-white p-7 transition-colors duration-300 hover:shadow-xl hover:shadow-slate-200/50 dark:border-white/5 dark:bg-[#16161d] lg:flex-row lg:items-center">

            {{-- 1. Información Principal --}}
            <div class="min-w-0 flex-1">
                <div
                    class="mb-2 flex items-center gap-4 text-[11px] font-medium tracking-[0.15em] text-slate-400 dark:text-zinc-500">
                    <span class="flex items-center gap-1.5">
                        <x-heroicon-s-identification class="w-4 h-4" /> REF-{{ $info->id }}
                    </span>
                    <span class="uppercase">Registro {{ $info->anio }}</span>
                </div>

                <h3 class="truncate text-[18px] font-bold uppercase leading-snug text-slate-900 dark:text-zinc-100">
                    {{ $info->titulo }}
                </h3>

                <div class="mt-3 flex items-center gap-2 text-[14px] font-medium text-slate-500 dark:text-zinc-400">
                    <x-heroicon-s-user-circle class="w-4 h-4 opacity-50" />
                    <span class="capitalize">
                        {{ mb_strtolower($info->autores?->map(fn($a) => $a->nombres . ' ' . $a->apellidos)->implode(', ') ?? 'Anónimo') }}
                    </span>
                </div>

                <div class="mt-4 flex flex-wrap items-center gap-2">
                    <span
                        class="{{ $estiloFicha }} inline-block rounded-lg px-3 py-1 text-[10px] font-black uppercase tracking-widest shadow-sm">
                        {{ mb_strtoupper($info->tipoInforme->nombre ?? 'SISTEMA') }}
                    </span>

                    @if ($info->carrera_id && in_array($info->tipo_informe_id, [1, 3, 4]))
                        <span
                            class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-3 py-1 text-[10px] font-bold uppercase text-slate-600 dark:bg-zinc-800 dark:text-zinc-400">
                            <x-heroicon-s-academic-cap class="w-3.5 h-3.5" />
                            {{ $info->carrera->nombre ?? 'General' }}
                        </span>
                    @endif
                </div>
            </div>

            {{-- 2. Estado y Acceso --}}
            <div class="flex items-center gap-4 lg:border-x lg:border-slate-100 lg:px-8 dark:lg:border-zinc-800">
                <div
                    class="{{ $info->estado === 'Publicado' ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400' : 'bg-slate-50 text-slate-500 dark:bg-zinc-800/50 dark:text-zinc-400' }} flex items-center gap-2 rounded-xl px-3 py-2">
                    <x-heroicon-s-check-badge class="w-4 h-4" />
                    <span class="text-[11px] font-bold uppercase">{{ $info->estado }}</span>
                </div>

                <div
                    class="{{ strtolower($info->acceso) === 'publico' ? 'bg-blue-50 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400' : 'bg-rose-50 text-rose-700 dark:bg-rose-500/10 dark:text-rose-400' }} flex items-center gap-2 rounded-xl px-3 py-2">
                    <x-heroicon-s-globe-alt class="w-4 h-4" />
                    <span class="text-[11px] font-bold uppercase">{{ $info->acceso }}</span>
                </div>
            </div>

            {{-- 3. Acciones --}}
            <div class="flex items-center justify-end lg:w-[160px]">
                @if ($info->estado === 'Publicado')
                    <button type="button" data-tw-toggle="modal"
                        data-tw-target="#despublicar-modal{{ $info->id }}"
                        class="flex w-full items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white py-3 text-[11px] font-bold uppercase tracking-widest text-slate-800 transition-colors hover:border-red-600 hover:bg-red-600 hover:text-white dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-200">
                        <x-heroicon-s-archive-box-arrow-down class="w-4 h-4" />
                        Retirar
                    </button>
                @else
                    <button type="button" data-tw-toggle="modal" data-tw-target="#publicar-modal{{ $info->id }}"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-700 py-3 text-[11px] font-bold uppercase tracking-widest text-white transition-colors hover:bg-indigo-800 active:scale-95">
                        <x-heroicon-s-rocket-launch class="w-4 h-4" />
                        Publicar
                    </button>
                @endif
            </div>
        </div>

    @empty
        <div
            class="flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-100 bg-slate-50/30 py-24 dark:border-zinc-800/50 dark:bg-transparent">
            <x-heroicon-s-folder-minus class="w-16 h-16 text-slate-200 dark:text-zinc-700" />
            <h3 class="mt-4 text-lg font-bold uppercase tracking-widest text-slate-400 dark:text-zinc-500">
                Sin registros encontrados
            </h3>
            <p class="mt-2 text-[14px] text-slate-400 dark:text-zinc-600">
                @if (request('buscador'))
                    No hay publicaciones que coincidan con "{{ request('buscador') }}".
                    <a href="{{ route('admin.publicaciones.index') }}"
                        hx-get="{{ route('admin.publicaciones.index') }}" hx-target="#main-content" hx-swap="innerHTML"
                        hx-push-url="true" class="block mt-2 text-indigo-500 hover:underline">
                        Ver todas las publicaciones
                    </a>
                @else
                    No se detectaron publicaciones en el repositorio.
                @endif
            </p>
        </div>
    @endforelse
</div>

<div class="mt-8">
    {{ $publicaciones->links() }}
</div>
