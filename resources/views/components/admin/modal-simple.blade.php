@props([
    'id',
    'title' => 'Eliminar registro',
    'subtitle' => 'Esta acción es irreversible',
    'route',
    'type' => 'danger',
    'method' => 'DELETE',
    'buttonText' => 'Eliminar'
])

@php
    $config = [
        'danger' => [
            'icon' => 'heroicon-o-trash',
            'iconBg' => 'bg-red-100 dark:bg-red-500/20',
            'iconColor' => 'text-red-600 dark:text-red-400',
            'buttonBg' => 'bg-red-600 hover:bg-red-700 dark:bg-red-600 dark:hover:bg-red-700',
            'buttonTextColor' => 'text-white'
        ],
        'warning' => [
            'icon' => 'heroicon-o-exclamation-triangle',
            'iconBg' => 'bg-amber-100 dark:bg-amber-500/20',
            'iconColor' => 'text-amber-600 dark:text-amber-400',
            'buttonBg' => 'bg-amber-600 hover:bg-amber-700 dark:bg-amber-600 dark:hover:bg-amber-700',
            'buttonTextColor' => 'text-white'
        ],
        'success' => [
            'icon' => 'heroicon-o-check-circle',
            'iconBg' => 'bg-emerald-100 dark:bg-emerald-500/20',
            'iconColor' => 'text-emerald-600 dark:text-emerald-400',
            'buttonBg' => 'bg-emerald-600 hover:bg-emerald-700 dark:bg-emerald-600 dark:hover:bg-emerald-700',
            'buttonTextColor' => 'text-white'
        ]
    ];

    $current = $config[$type] ?? $config['danger'];
@endphp

<div class="modal fixed inset-0 z-[999] hidden" id="{{ $id }}" role="dialog" aria-modal="true"
    aria-labelledby="delete-title-{{ $id }}">

    <div class="absolute inset-0 bg-slate-900/70 modal-overlay"></div>

    <div class="relative flex items-center justify-center min-h-screen p-4 pointer-events-none">

        <div
            class="w-full max-w-md rounded-xl bg-white shadow-2xl overflow-hidden pointer-events-auto modal-animate dark:bg-slate-800">

            <div class="flex-shrink-0 flex items-center justify-end p-3">
                <button type="button" data-tw-dismiss="modal"
                    class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 transition-all duration-200 
                           hover:bg-slate-100 hover:text-slate-600 dark:hover:bg-slate-700 dark:hover:text-white">
                    <x-heroicon-o-x-mark class="h-5 w-5" />
                </button>
            </div>

            <div class="px-6 pb-6 text-center">
                <div class="mx-auto w-14 h-14 flex items-center justify-center rounded-full {{ $current['iconBg'] }}">
                    <x-dynamic-component :component="$current['icon']" class="h-7 w-7 {{ $current['iconColor'] }}" />
                </div>

                <h2 id="delete-title-{{ $id }}" class="mt-4 text-xl font-bold text-slate-800 dark:text-white">
                    {{ $title }}
                </h2>

                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    {{ $subtitle }}
                </p>
            </div>

            <form action="{{ $route }}" method="POST" class="px-6 pb-6">
                @csrf
                @if (strtoupper($method) !== 'POST')
                    @method($method)
                @endif

                @if (isset($slot) && $slot->isNotEmpty())
                    {{ $slot }}
                @endif

                <div class="flex gap-3 mt-6">
                    <button type="button" data-tw-dismiss="modal"
                        class="flex-1 rounded-lg bg-white px-4 py-2.5 text-sm font-medium text-slate-700 
                               border border-slate-300 transition-all duration-200 hover:bg-slate-50 active:scale-95
                               dark:bg-slate-800 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-700">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="flex-1 rounded-lg {{ $current['buttonBg'] }} px-4 py-2.5 text-sm font-medium {{ $current['buttonTextColor'] }}
                               transition-all duration-200 hover:shadow-md active:scale-95
                               focus:outline-none focus:ring-2 focus:ring-offset-2
                               {{ $type === 'danger' ? 'focus:ring-red-500' : ($type === 'warning' ? 'focus:ring-amber-500' : 'focus:ring-emerald-500') }}">
                        {{ $buttonText }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
