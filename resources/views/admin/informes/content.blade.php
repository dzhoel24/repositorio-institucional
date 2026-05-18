<div id="app" data-buscar-url="{{ route('admin.informes.buscar-dni') }}"></div>

<x-admin.alerts />
@include('admin.informes.modals.create')
@include('admin.informes.modals.edit')
@include('admin.informes.modals.delete')

<x-admin.title titulo="DIRECTORIO PROYECTOS"
    subtitulo="Consulta, registra y administra los proyectos almacenados en el sistema." :table="$informes"
    singular="proyecto" plural="proyectos" badgeColor="blue" />

<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div class="w-full sm:flex-1">
        <x-admin.search :action="route('admin.informes.index')" placeholder="Buscar por título, tipo o autor...">
            <button type="button" data-tw-toggle="modal" data-tw-target="#add-informe-modal"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-800 px-5 py-2.5 text-sm font-semibold tracking-wide text-white 
                           shadow-sm transition-all duration-200 hover:bg-slate-900 hover:shadow-md active:scale-95
                           dark:bg-indigo-600 dark:hover:bg-indigo-700">
                <x-heroicon-s-plus class="h-4 w-4" />
                Nuevo Proyecto
            </button>
        </x-admin.search>
    </div>
</div>

<div
    class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm dark:border-slate-700/50 dark:bg-slate-900/50">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[1000px] border-collapse">
            <thead>
                <tr
                    class="border-b border-slate-200 bg-slate-50/80 text-xs font-semibold uppercase tracking-wide text-slate-500 
                           dark:border-slate-700/50 dark:bg-slate-800/50 dark:text-slate-400">
                    <th class="w-[30%] px-5 py-4 text-left">Detalles del Proyecto</th>
                    <th class="w-[35%] px-5 py-4 text-left">Autores y Categoría</th>
                    <th class="w-[15%] px-5 py-4 text-center">Carátula</th>
                    <th class="w-[20%] px-5 py-4 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                @forelse ($informes as $info)
                    @php $badgeStyle = $badgeEstilos[$info->tipo_informe_id] ?? 'bg-slate-100 text-slate-700 border-slate-200 dark:bg-slate-700/50 dark:text-slate-300 dark:border-slate-600'; @endphp

                    <tr class="group transition-all duration-150 hover:bg-slate-50/60 dark:hover:bg-slate-800/30">

                        {{-- Detalles del Proyecto --}}
                        <td class="px-5 py-4 align-top">
                            <div class="flex flex-col gap-2">
                                <span class="text-[11px] font-mono font-medium text-slate-400 dark:text-slate-500">
                                    #{{ $info->id }}
                                </span>
                                <span class="text-base font-semibold leading-tight text-slate-800 dark:text-slate-100">
                                    {{ $info->titulo }}
                                </span>
                                <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400">
                                    <x-heroicon-s-calendar class="h-3.5 w-3.5" />
                                    <span class="text-sm font-medium">{{ $info->anio }}</span>
                                </div>
                                @if ($info->carrera_id && in_array($info->tipo_informe_id, [1, 3, 4]))
                                    <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400">
                                        <x-heroicon-s-academic-cap class="h-3.5 w-3.5" />
                                        <span class="text-sm font-medium">{{ $info->carrera->nombre ?? '—' }}</span>
                                    </div>
                                @endif
                                @if ($info->modulo && $info->tipo_informe_id === 1)
                                    <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400">
                                        <x-heroicon-s-cube class="h-3.5 w-3.5" />
                                        <span class="text-sm font-medium">Módulo {{ $info->modulo }}</span>
                                    </div>
                                @endif
                            </div>
                        </td>

                        {{-- Autores y Categoría --}}
                        <td class="px-5 py-4 align-middle">
                            <div class="flex flex-col gap-2.5">
                                <div class="flex items-start gap-1.5 text-slate-600 dark:text-slate-300">
                                    <x-heroicon-s-user-group class="mt-0.5 h-3.5 w-3.5 shrink-0" />
                                    <span class="text-sm leading-relaxed">
                                        @foreach ($info->autores as $index => $autor)
                                            {{ $autor->nombres }} {{ $autor->apellidos }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </span>
                                </div>
                                <span
                                    class="{{ $badgeStyle }} inline-block w-fit rounded-md px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wide">
                                    {{ $info->tipo_nombre }}
                                </span>
                            </div>
                        </td>

                        {{-- Carátula --}}
                        <td class="px-5 py-4 text-center align-middle">
                            <img src="{{ asset('storage/caratulas/' . $info->ruta_caratula) }}"
                                alt="Carátula de {{ $info->titulo }}"
                                class="h-14 w-14 rounded-lg object-cover shadow-sm mx-auto cursor-pointer hover:scale-105 transition-transform duration-200">
                        </td>

                        {{-- Acciones --}}
                        <td class="px-5 py-4 text-center align-middle">
                            <div class="flex flex-col items-center justify-center gap-2.5">
                                <button type="button" data-tw-toggle="modal"
                                    data-tw-target="#edit-modal{{ $info->id }}"
                                    class="inline-flex w-full max-w-[110px] items-center justify-center gap-1.5 rounded-lg bg-amber-500 px-3 py-2 text-xs font-semibold text-white 
                                               transition-all duration-150 hover:bg-amber-600 hover:shadow-sm active:scale-95
                                               dark:bg-amber-600 dark:hover:bg-amber-700">
                                    <x-heroicon-s-pencil-square class="h-3.5 w-3.5" />
                                    Editar
                                </button>
                                <button type="button" data-tw-toggle="modal"
                                    data-tw-target="#delete-modal{{ $info->id }}"
                                    class="inline-flex w-full max-w-[110px] items-center justify-center gap-1.5 rounded-lg bg-red-600 px-3 py-2 text-xs font-semibold text-white 
                                               transition-all duration-150 hover:bg-red-700 hover:shadow-sm active:scale-95
                                               dark:bg-red-700 dark:hover:bg-red-800">
                                    <x-heroicon-s-trash class="h-3.5 w-3.5" />
                                    Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>

                    @empty
                        <tr>
                            <td colspan="4" class="py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="mb-3 rounded-full bg-slate-100 p-3 dark:bg-slate-800/50">
                                        <x-heroicon-s-folder-open class="h-10 w-10 text-slate-400 dark:text-slate-500" />
                                    </div>
                                    <h3 class="text-sm font-semibold text-slate-600 dark:text-slate-400">
                                        @if (request('buscador'))
                                            Sin resultados
                                        @else
                                            No hay proyectos registrados
                                        @endif
                                    </h3>
                                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-500">
                                        @if (request('buscador'))
                                            No se encontraron proyectos para "{{ request('buscador') }}"
                                        @else
                                            Comienza creando tu primer proyecto
                                        @endif
                                    </p>
                                    @if (request('buscador'))
                                        <a href="{{ route('admin.informes.index') }}"
                                            hx-get="{{ route('admin.informes.index') }}" hx-target="#main-content"
                                            hx-swap="innerHTML" hx-push-url="true"
                                            class="mt-4 inline-flex items-center gap-1.5 rounded-full bg-indigo-500 px-4 py-1.5 text-xs font-medium text-white 
                                              transition-all hover:bg-indigo-600 dark:bg-indigo-600 dark:hover:bg-indigo-700">
                                            <x-heroicon-s-arrow-path class="h-3.5 w-3.5" />
                                            Limpiar búsqueda
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($informes->hasPages())
            <div class="border-t border-slate-200 px-5 py-4 dark:border-slate-700/50">
                {{ $informes->links() }}
            </div>
        @endif
    </div>

    <script>
        document.dispatchEvent(new CustomEvent('page:title', {
            detail: 'Proyectos'
        }));
    </script>
