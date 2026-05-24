@props(['id', 'title', 'subtitle' => null, 'size' => 'md', 'action'])

@php
    $sizes = [
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-2xl',
        'xl' => 'max-w-4xl',
        'full' => 'max-w-5xl'
    ];
    $modalSize = $sizes[$size] ?? 'max-w-md';
@endphp

<div class="modal fixed inset-0 z-[999] hidden" id="{{ $id }}" role="dialog" aria-modal="true"
    aria-labelledby="{{ $id }}-title">

    <div class="absolute inset-0 bg-slate-900/50 modal-overlay"></div>

    <div class="relative flex items-center justify-center min-h-screen p-4 pointer-events-none">

        <div
            class="w-full {{ $modalSize }} max-h-[90vh] rounded-xl bg-white shadow-xl overflow-hidden modal-animate pointer-events-auto flex flex-col
                    dark:bg-slate-800">

            {{-- HEADER --}}
            <div
                class="flex-shrink-0 flex items-center justify-between border-b border-slate-100 px-4 py-3 sm:px-6 sm:py-4
                        dark:border-slate-700">
                <div class="flex items-center gap-3">
                    <div
                        class="flex h-8 w-8 sm:h-10 sm:w-10 items-center justify-center rounded-lg bg-indigo-100 dark:bg-indigo-500/20">
                        <x-heroicon-o-pencil-square
                            class="h-4 w-4 sm:h-5 sm:w-5 text-indigo-600 dark:text-indigo-400" />
                    </div>
                    <div>
                        <h2 id="{{ $id }}-title"
                            class="text-base sm:text-lg font-bold text-slate-800 dark:text-white">
                            {{ $title }}
                        </h2>
                        @if ($subtitle)
                            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">{{ $subtitle }}
                            </p>
                        @endif
                    </div>
                </div>
                <button type="button" data-tw-dismiss="modal"
                    class="flex h-7 w-7 sm:h-8 sm:w-8 items-center justify-center rounded-lg text-slate-400 transition-all duration-200 
                           hover:bg-slate-100 hover:text-slate-600 
                           dark:text-slate-500 dark:hover:bg-slate-700 dark:hover:text-white">
                    <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- CONTENIDO SCROLLEABLE --}}
            <div class="flex-1 overflow-y-auto">
                <div class="p-4 sm:p-6">
                    <form id="{{ $id }}-form" action="{{ $action }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">
                            {{ $slot }}
                        </div>
                    </form>
                </div>
            </div>

            {{-- FOOTER --}}
            <div
                class="flex-shrink-0 flex flex-col-reverse gap-2 border-t border-slate-100 bg-slate-50/50 px-4 py-3 
                        sm:flex-row sm:justify-end sm:px-6 sm:py-4
                        dark:border-slate-700 dark:bg-slate-800/50">
                <button type="button" data-tw-dismiss="modal"
                    class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 
                           transition-all duration-200 hover:bg-slate-50 
                           dark:border-slate-600 dark:bg-slate-800 dark:text-slate-300 
                           dark:hover:bg-slate-700">
                    Cancelar
                </button>
                <button type="submit" form="{{ $id }}-form"
                    class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white 
                           transition-all duration-200 hover:bg-indigo-700 
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                           dark:bg-indigo-500 dark:hover:bg-indigo-600">
                    <div class="flex items-center justify-center gap-2">
                        <x-heroicon-o-check-circle class="h-4 w-4" />
                        Guardar cambios
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>
