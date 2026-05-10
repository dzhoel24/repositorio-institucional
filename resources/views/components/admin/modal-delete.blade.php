@props([
    'id',
    'title' => 'Eliminar registro',
    'subtitle' => 'Esta acción es irreversible',
    'route',
    'itemName' => null,
    'itemId' => null
])

<div class="modal fixed inset-0 z-[999] hidden" id="{{ $id }}" role="dialog" aria-modal="true"
    aria-labelledby="delete-title-{{ $id }}">

    {{-- BACKDROP --}}
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm modal-overlay"></div>

    {{-- CENTER --}}
    <div class="relative flex items-center justify-center min-h-screen p-4 pointer-events-none">

        {{-- CARD --}}
        <div
            class="w-full max-w-md rounded-2xl bg-white shadow-2xl overflow-hidden pointer-events-auto modal-animate
                    dark:bg-slate-800">

            {{-- HEADER --}}
            <div class="p-6 text-center border-b border-slate-100 dark:border-slate-700">
                <div
                    class="mx-auto w-14 h-14 flex items-center justify-center rounded-full bg-red-100 dark:bg-red-500/20">
                    <x-heroicon-o-exclamation-triangle class="h-7 w-7 text-red-600 dark:text-red-400" />
                </div>

                <h2 id="delete-title-{{ $id }}" class="mt-3 text-lg font-bold text-slate-800 dark:text-white">
                    {{ $title }}
                </h2>

                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    {{ $subtitle }}
                </p>
            </div>

            {{-- CONTENIDO --}}
            <div class="px-6 py-5 text-center">
                <p class="text-sm text-slate-600 dark:text-slate-300">
                    ¿Seguro que deseas eliminar:
                </p>
                @if ($itemName)
                    <p class="mt-2 font-semibold text-slate-800 dark:text-white">
                        {{ $itemName }}
                    </p>
                @endif
                @if ($itemId)
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                        ID: <span class="font-mono">{{ $itemId }}</span>
                    </p>
                @endif
            </div>

            {{-- BOTONES --}}
            <form action="{{ $route }}" method="POST" class="px-6 pb-6">
                @csrf
                @method('DELETE')

                <div class="flex gap-3">
                    <button type="button" data-tw-dismiss="modal"
                        class="flex-1 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 
                                   transition-all duration-200 hover:bg-slate-50 active:scale-95 
                                   dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 dark:hover:bg-slate-600">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="flex-1 rounded-xl bg-red-600 px-4 py-2.5 text-sm font-bold text-white shadow-md 
                                   transition-all duration-200 hover:bg-red-700 hover:shadow-lg active:scale-95
                                   dark:bg-red-600 dark:hover:bg-red-700">
                        <div class="flex items-center justify-center gap-2">
                            <x-heroicon-o-trash class="h-4 w-4" />
                            Sí, eliminar
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
