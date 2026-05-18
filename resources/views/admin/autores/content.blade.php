<x-admin.alerts />
@include('admin.autores.modals.create')
@include('admin.autores.modals.edit')
@include('admin.autores.modals.delete')

<x-admin.title titulo="DIRECTORIO AUTORES" subtitulo="Investigadores registrados en el sistema" :table="$autores"
    singular="autor" plural="autores" badgeColor="indigo" />

<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div class="w-full sm:flex-1">
        <x-admin.search :action="route('admin.autores.index')" placeholder="Buscar por DNI, nombres o apellidos...">
            <button type="button" data-tw-toggle="modal" data-tw-target="#add-modal" aria-label="Añadir nuevo autor"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm 
                           transition-all duration-150 hover:bg-indigo-700 active:scale-95 sm:w-auto">
                <x-heroicon-s-user-plus class="h-4 w-4" />
                Añadir Autor
            </button>
        </x-admin.search>
    </div>
</div>

<div
    class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm dark:border-slate-700/50 dark:bg-slate-900/50">
    <div class="overflow-x-auto">
        <table class="w-full m4 py-20px] border-collapse">
            <thead>
                <tr
                    class="border-b border-slate-200 bg-slate-50/80 text-xs font-semibold uppercase tracking-wide text-slate-500 
                           dark:border-slate-700/50 dark:bg-slate-800/50 dark:text-slate-400">
                    <th class="w-1/4 px-5 py-4 text-left">DNI</th>
                    <th class="w-1/4 px-5 py-4 text-left">Autor</th>
                    <th class="w-1/4 px-5 py-4 text-center">Proyectos</th>
                    <th class="w-1/4 px-5 py-4 text-center">Acciones</th>
                <tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                @forelse ($autores as $autor)
                    @php $paleta = $paletas[$loop->index % count($paletas)]; @endphp
                    <tr class="group transition-all duration-150 hover:bg-slate-50/60 dark:hover:bg-slate-800/30">

                        <td class="px-5 py-4 align-middle">
                            <span
                                class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-slate-50 px-3 py-1.5 font-mono text-xs font-semibold text-slate-700 
                                         dark:border-slate-700 dark:bg-slate-800/50 dark:text-slate-300">
                                <x-heroicon-s-identification class="h-3.5 w-3.5 text-slate-400 dark:text-slate-500" />
                                {{ $autor->dni }}
                            </span>
                        </td>

                        <td class="px-5 py-4 align-middle whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="{{ $paleta['bg'] }} {{ $paleta['text'] }} flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-sm font-bold"
                                    aria-hidden="true">
                                    {{ mb_strtoupper(mb_substr($autor->apellidos, 0, 1)) }}
                                </div>
                                <p class="text-sm font-semibold text-slate-800 dark:text-slate-100 whitespace-nowrap">
                                    {{ mb_strtoupper($autor->apellidos) }},
                                    <span class="font-normal text-slate-500 dark:text-slate-400">
                                        {{ $autor->nombres }}
                                    </span>
                                </p>
                            </div>
                        </td>

                        <td class="px-5 py-4 text-center align-middle">
                            <span
                                class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-100 px-3 py-1.5 text-xs font-bold text-indigo-700 
                                         dark:bg-indigo-500/20 dark:text-indigo-400">
                                <x-heroicon-s-folder class="h-3.5 w-3.5" />
                                {{ $autor->informes_count }}
                            </span>
                        </td>

                        <td class="px-5 py-4 align-middle">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button" data-tw-toggle="modal"
                                    data-tw-target="#edit-modal{{ $autor->dni }}"
                                    class="inline-flex items-center gap-1.5 rounded-lg bg-amber-500 px-4 py-2 text-xs font-semibold text-white 
                                               transition-all duration-150 hover:bg-amber-600 hover:shadow-sm active:scale-95
                                               dark:bg-amber-600 dark:hover:bg-amber-700">
                                    <x-heroicon-s-pencil-square class="h-3.5 w-3.5" />
                                    <span class="hidden sm:inline">Editar</span>
                                </button>
                                <button type="button" data-tw-toggle="modal"
                                    data-tw-target="#delete-modal{{ $autor->dni }}"
                                    class="inline-flex items-center gap-1.5 rounded-lg bg-red-600 px-4 py-2 text-xs font-semibold text-white 
                                               transition-all duration-150 hover:bg-red-700 hover:shadow-sm active:scale-95
                                               dark:bg-red-700 dark:hover:bg-red-800">
                                    <x-heroicon-s-trash class="h-3.5 w-3.5" />
                                    <span class="hidden sm:inline">Eliminar</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="4" class="py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="mb-3 rounded-full bg-slate-100 p-3 dark:bg-slate-800/50">
                                    <x-heroicon-s-users class="h-10 w-10 text-slate-400 dark:text-slate-500" />
                                </div>
                                <h3 class="text-sm font-semibold text-slate-600 dark:text-slate-400">
                                    @if (request('buscador'))
                                        Sin resultados
                                    @else
                                        No hay autores registrados
                                    @endif
                                </h3>
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-500">
                                    @if (request('buscador'))
                                        No se encontraron autores para "{{ request('buscador') }}"
                                    @else
                                        Comienza añadiendo el primer autor
                                    @endif
                                </p>
                                @if (request('buscador'))
                                    <a href="{{ route('admin.autores.index') }}"
                                        hx-get="{{ route('admin.autores.index') }}" hx-target="#main-content"
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

    @if ($autores->hasPages())
        <div class="border-t border-slate-200 px-5 py-4 dark:border-slate-700/50">
            {{ $autores->links() }}
        </div>
    @endif
</div>

<script>
    document.dispatchEvent(new CustomEvent('page:title', {
        detail: 'Autores'
    }));
</script>
