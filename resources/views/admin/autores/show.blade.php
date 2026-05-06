<x-alerts />
@include('admin.autores.modals.create')
@include('admin.autores.modals.edit')
@include('admin.autores.modals.delete')

<x-header-admin titulo="DIRECTORIO AUTORES" subtitulo="Investigadores registrados en el sistema" :table="$autores"
    singular="autor" plural="autores" />

<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div class="w-full sm:flex-1">
        <x-search-admin :action="route('admin.autores.index')" placeholder="Buscar por DNI, nombres o apellidos..." />
    </div>
    <div class="w-full sm:w-auto">
        <button type="button" data-tw-toggle="modal" data-tw-target="#add-modal" aria-label="Añadir nuevo autor"
            class="inline-flex w-full items-center justify-center gap-2.5 rounded-xl bg-indigo-600 px-5 py-3 text-[14px] font-semibold text-white shadow-sm transition-all duration-150 hover:bg-indigo-700 active:scale-[.97] sm:w-auto">
            <i class="fa-solid fa-user-plus text-[13px]" aria-hidden="true"></i>
            Añadir Autor
        </button>
    </div>
</div>

<div
    class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm dark:border-white/[.06] dark:bg-[#16161d]">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[640px] border-collapse">
            <thead>
                <tr class="border-b border-slate-100 bg-slate-50/80 dark:border-white/[.05] dark:bg-white/[.03]">
                    <th
                        class="w-1/4 px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[.14em] text-slate-400 dark:text-zinc-600">
                        DNI</th>
                    <th
                        class="w-1/4 px-6 py-4 text-left text-[11px] font-bold uppercase tracking-[.14em] text-slate-400 dark:text-zinc-600">
                        Autor</th>
                    <th
                        class="w-1/4 px-6 py-4 text-center text-[11px] font-bold uppercase tracking-[.14em] text-slate-400 dark:text-zinc-600">
                        Proyectos</th>
                    <th
                        class="w-1/4 px-6 py-4 text-right text-[11px] font-bold uppercase tracking-[.14em] text-slate-400 dark:text-zinc-600">
                        Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 dark:divide-white/[.04]">
                @forelse ($autores as $autor)
                    @php $paleta = $paletas[$loop->index % count($paletas)]; @endphp
                    <tr class="transition-colors duration-150 hover:bg-indigo-50/40 dark:hover:bg-indigo-500/[.04]">

                        <td class="w-1/4 px-6 py-4 align-middle">
                            <span
                                class="inline-flex items-center gap-1.5 rounded-lg border border-slate-100 bg-slate-50 px-3 py-1.5 font-mono text-[13px] font-semibold text-slate-600 dark:border-white/[.08] dark:bg-white/[.05] dark:text-zinc-300">
                                <i class="fa-solid fa-id-card text-[11px] text-slate-300 dark:text-zinc-600"
                                    aria-hidden="true"></i>
                                {{ $autor->dni }}
                            </span>
                        </td>

                        <td class="w-1/4 px-6 py-4 align-middle">
                            <div class="flex items-center gap-3">
                                <div class="{{ $paleta['bg'] }} {{ $paleta['text'] }} flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-[14px] font-bold"
                                    aria-hidden="true">
                                    {{ mb_strtoupper(mb_substr($autor->apellidos, 0, 1)) }}
                                </div>
                                <p class="whitespace-nowrap text-[15px] font-bold text-slate-800 dark:text-zinc-100">
                                    {{ mb_strtoupper($autor->apellidos) }},
                                    <span class="font-medium capitalize text-slate-500 dark:text-zinc-400">
                                        {{ mb_strtolower($autor->nombres) }}
                                    </span>
                                </p>
                            </div>
                        </td>

                        <td class="w-1/4 px-6 py-4 text-center align-middle">
                            <span
                                class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-50 px-3 py-1.5 text-[13px] font-bold text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                                <i class="fa-solid fa-folder text-[11px]"></i>
                                {{ $autor->informes_count }}
                            </span>
                        </td>

                        <td class="w-1/4 px-6 py-4 align-middle">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button" data-tw-toggle="modal"
                                    data-tw-target="#edit-modal{{ $autor->dni }}"
                                    aria-label="Editar a {{ $autor->apellidos }}, {{ $autor->nombres }}"
                                    class="inline-flex items-center gap-2 rounded-xl border border-amber-300 bg-amber-100 px-4 py-2 text-[12px] font-semibold text-amber-800 transition-all duration-150 hover:bg-amber-200 active:scale-[.94] dark:border-amber-500/30 dark:bg-amber-500/20 dark:text-amber-300">
                                    <i class="fa-solid fa-pen-to-square text-[12px]" aria-hidden="true"></i>
                                    <span class="hidden sm:inline">Editar</span>
                                </button>
                                <button type="button" data-tw-toggle="modal"
                                    data-tw-target="#delete-modal{{ $autor->dni }}"
                                    aria-label="Eliminar a {{ $autor->apellidos }}, {{ $autor->nombres }}"
                                    class="inline-flex items-center gap-2 rounded-xl border border-rose-300 bg-rose-100 px-4 py-2 text-[12px] font-semibold text-rose-800 transition-all duration-150 hover:bg-rose-200 active:scale-[.94] dark:border-rose-500/30 dark:bg-rose-500/20 dark:text-rose-300">
                                    <i class="fa-solid fa-trash-can text-[12px]" aria-hidden="true"></i>
                                    <span class="hidden sm:inline">Eliminar</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="4" class="py-20 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div
                                    class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 dark:bg-white/[.05]">
                                    <i class="fa-solid fa-users-slash text-2xl text-slate-300 dark:text-zinc-600"
                                        aria-hidden="true"></i>
                                </div>
                                <p class="text-[15px] font-semibold text-slate-500 dark:text-zinc-400">
                                    @if (request('buscador'))
                                        Sin resultados para <span
                                            class="text-slate-700 dark:text-zinc-200">"{{ request('buscador') }}"</span>
                                    @else
                                        No hay autores registrados aún
                                    @endif
                                </p>
                                @if (request('buscador'))
                                    <a href="{{ route('admin.autores.index') }}"
                                        hx-get="{{ route('admin.autores.index') }}" hx-target="#main-content"
                                        hx-swap="innerHTML" hx-push-url="true"
                                        class="text-[13px] text-indigo-500 hover:underline">
                                        Ver todos los autores
                                    </a>
                                @else
                                    <p class="text-[13px] text-slate-400 dark:text-zinc-600">Comienza añadiendo el
                                        primer autor al directorio.</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($autores->hasPages())
        <div class="border-t border-slate-100 px-6 py-4 dark:border-white/[.05]">
            {{ $autores->links() }}
        </div>
    @endif
</div>

@if (!$autores->hasPages() && $autores->isNotEmpty())
    <p class="mt-4 text-center text-[13px] text-slate-400 dark:text-zinc-600">
        Mostrando {{ $autores->count() }} de {{ $autores->total() }}
        {{ $autores->total() === 1 ? 'autor' : 'autores' }}
    </p>
@endif
