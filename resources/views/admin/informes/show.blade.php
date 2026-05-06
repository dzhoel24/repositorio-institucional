<div id="app" data-buscar-url="{{ route('admin.informes.buscar-dni') }}"></div>

@push('scripts')
    @vite(['resources/js/modules/form-add.js', 'resources/js/modules/form-edit.js'])
@endpush

<x-alerts />
@include('admin.informes.modals.create')
@include('admin.informes.modals.edit')
@include('admin.informes.modals.delete')

<x-header-admin titulo="DIRECTORIO PROYECTOS"
    subtitulo="Consulta, registra y administra los proyectos almacenados en el sistema." :table="$informes"
    singular="proyecto" plural="proyectos" />

<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div class="w-full sm:flex-1">
        <x-search-admin :action="route('admin.informes.index')" placeholder="Buscar por título, tipo o autor..." />
    </div>
    <button type="button" data-tw-toggle="modal" data-tw-target="#add-informe-modal"
        class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-6 py-3 text-[13px] font-bold uppercase tracking-wide text-white shadow-lg transition-all hover:bg-black active:scale-95">
        <i class="fa-solid fa-plus text-xs"></i>
        Nuevo Proyecto
    </button>
</div>

<div
    class="overflow-hidden rounded-3xl border border-slate-300 bg-white shadow-sm dark:border-white/10 dark:bg-[#16161d]">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[1000px] border-collapse">
            <thead>
                <tr
                    class="border-b border-slate-200 bg-slate-50 text-[12px] font-bold uppercase tracking-[0.15em] text-slate-500 dark:border-white/10 dark:bg-[#1c1c24] dark:text-slate-400">
                    <th class="w-[40%] px-6 py-5 text-left">Detalles del Proyecto</th>
                    <th class="w-[35%] px-6 py-5 text-left">Autores y Categoría</th>
                    <th class="w-[10%] px-6 py-5 text-center">Estado</th>
                    <th class="w-[15%] px-6 py-5 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-[15px] dark:divide-white/5">
                @forelse ($informes as $info)
                    @php $badgeStyle = $badgeEstilos[$info->tipo_informe_id] ?? 'bg-slate-100 text-slate-700 border-slate-200 dark:bg-slate-500/10 dark:text-slate-400'; @endphp

                    <tr class="group transition-colors hover:bg-slate-50 dark:hover:bg-white/[0.01]">

                        {{-- Detalles --}}
                        <td class="px-6 py-5 text-left">
                            <div class="flex flex-col gap-1.5">
                                <span
                                    class="text-[11px] font-bold text-slate-400 dark:text-slate-500">#{{ $info->id }}</span>
                                <span
                                    class="text-[15px] font-bold uppercase leading-tight text-slate-800 dark:text-zinc-100">
                                    {{ $info->titulo }}
                                </span>
                                <div class="flex items-center gap-1.5 text-slate-400 dark:text-slate-500">
                                    <i class="fa-regular fa-calendar text-[13px]"></i>
                                    <span class="text-[12px] font-bold uppercase">{{ $info->anio }}</span>
                                </div>
                                @if ($info->carrera_id && in_array($info->tipo_informe_id, [1, 3, 4]))
                                    <div class="flex items-center gap-1.5 text-slate-400 dark:text-slate-500">
                                        <i class="fa-solid fa-graduation-cap text-[12px]"></i>
                                        <span
                                            class="text-[12px] font-medium capitalize">{{ $info->carrera->nombre ?? '—' }}</span>
                                    </div>
                                @endif
                                @if ($info->modulo && $info->tipo_informe_id === 1)
                                    <div class="flex items-center gap-1.5 text-slate-400 dark:text-slate-500">
                                        <i class="fa-solid fa-layer-group text-[12px]"></i>
                                        <span class="text-[12px] font-medium">Módulo {{ $info->modulo }}</span>
                                    </div>
                                @endif
                            </div>
                        </td>

                        {{-- Autores y Badge --}}
                        <td class="px-6 py-5 text-left">
                            <div class="flex flex-col gap-3">
                                <span class="text-[13px] font-medium capitalize text-slate-600 dark:text-slate-400">
                                    <i class="fa-solid fa-users mr-1 text-[11px]"></i>
                                    {{ mb_strtolower($info->autores->map(fn($a) => $a->nombres . ' ' . $a->apellidos)->implode(', ')) }}
                                </span>
                                <span
                                    class="{{ $badgeStyle }} inline-block w-fit rounded-md border px-3 py-1 text-[11px] font-bold uppercase tracking-wider">
                                    {{ $info->tipo_nombre }}
                                </span>
                            </div>
                        </td>

                        {{-- Estado --}}
                        <td class="px-6 py-5 text-center">
                            @if ($info->estado === 'Publicado')
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-50 px-3 py-1.5 text-[11px] font-bold uppercase text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
                                    <i class="fa-solid fa-circle-check text-[10px]"></i>
                                    Publicado
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-lg bg-slate-100 px-3 py-1.5 text-[11px] font-bold uppercase text-slate-500 dark:bg-zinc-800 dark:text-zinc-400">
                                    <i class="fa-solid fa-circle-xmark text-[10px]"></i>
                                    No publicado
                                </span>
                            @endif
                        </td>

                        {{-- Acciones --}}
                        <td class="px-6 py-5 text-center">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <button type="button" data-tw-toggle="modal"
                                    data-tw-target="#edit-modal{{ $info->id }}"
                                    class="inline-flex w-full max-w-[130px] items-center justify-center gap-2 rounded-xl bg-amber-500 px-4 py-2.5 text-[12px] font-bold uppercase text-white transition-all hover:bg-amber-600 active:scale-95">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Editar
                                </button>
                                <button type="button" data-tw-toggle="modal"
                                    data-tw-target="#delete-modal{{ $info->id }}"
                                    class="inline-flex w-full max-w-[130px] items-center justify-center gap-2 rounded-xl bg-red-600 px-4 py-2.5 text-[12px] font-bold uppercase text-white transition-all hover:bg-red-700 active:scale-95">
                                    <i class="fa-solid fa-trash-can"></i>
                                    Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="4" class="py-20 text-center">
                            <div class="flex flex-col items-center justify-center opacity-70">
                                <i class="fa-solid fa-folder-open mb-3 text-3xl text-slate-300"></i>
                                <h3 class="text-[14px] font-bold uppercase tracking-widest text-slate-400">
                                    @if (request('buscador'))
                                        Sin resultados para "{{ request('buscador') }}"
                                    @else
                                        No se encontraron proyectos registrados
                                    @endif
                                </h3>
                                @if (request('buscador'))
                                    <a href="{{ route('admin.informes.index') }}"
                                        hx-get="{{ route('admin.informes.index') }}" hx-target="#main-content"
                                        hx-swap="innerHTML" hx-push-url="true"
                                        class="mt-2 text-[13px] text-indigo-500 hover:underline">
                                        Ver todos los proyectos
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $informes->links() }}
</div>
