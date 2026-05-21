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

    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm modal-overlay"></div>

    <div class="relative flex items-center justify-center min-h-screen p-4 pointer-events-none">

        <div
            class="w-full {{ $modalSize }} max-h-[90vh] rounded-2xl bg-white shadow-2xl overflow-hidden modal-animate pointer-events-auto flex flex-col
                    dark:bg-slate-800">

            {{-- HEADER --}}
            <div
                class="flex-shrink-0 flex items-center justify-between border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white px-4 py-4 sm:px-6 sm:py-5
                        dark:border-slate-700 dark:from-slate-800 dark:to-slate-800">
                <div class="flex items-center gap-3">
                    <div
                        class="flex h-8 w-8 sm:h-10 sm:w-10 items-center justify-center rounded-xl bg-amber-100 dark:bg-amber-500/20">
                        <x-heroicon-o-pencil-square class="h-4 w-4 sm:h-5 sm:w-5 text-amber-600 dark:text-amber-400" />
                    </div>
                    <div>
                        <h2 id="{{ $id }}-title"
                            class="text-base sm:text-xl font-bold tracking-tight text-slate-800 dark:text-white">
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
            <div class="flex-1 overflow-y-auto custom-scroll">
                <div class="p-3 sm:p-5">
                    <form id="{{ $id }}-form" action="{{ $action }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4 sm:space-y-5">
                            {{ $slot }}
                        </div>
                    </form>
                </div>
            </div>

            <div
                class="flex-shrink-0 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end p-4 sm:p-6 border-t border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800">
                <button type="button" data-tw-dismiss="modal"
                    class="flex-1 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 
                               border border-slate-300 shadow-sm
                               transition-all duration-200 hover:bg-slate-50 hover:text-slate-800 active:scale-95 
                               dark:bg-slate-800 dark:border-slate-600 dark:text-slate-300 
                               dark:hover:bg-slate-700 dark:hover:text-white">
                    Cancelar
                </button>
                <button type="submit" form="{{ $id }}-form"
                    class="flex-1 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-bold text-white 
                               shadow-md transition-all duration-200 hover:bg-indigo-700 
                               hover:shadow-lg active:scale-95 
                               dark:bg-indigo-600 dark:hover:bg-indigo-500">
                    <div class="flex items-center justify-center gap-2">
                        <x-heroicon-o-check-circle class="h-4 w-4" />
                        Guardar
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>
