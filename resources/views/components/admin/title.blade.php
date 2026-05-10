@props(['titulo', 'subtitulo', 'table' => null, 'singular' => null, 'plural' => null, 'badgeColor' => 'indigo'])

<div class="mb-3 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

    {{-- TEXTO PRINCIPAL --}}
    <div>
        <div class="flex items-center gap-3">
            <div class="h-7 w-1 rounded-full bg-indigo-600"></div>
            <h1 class="text-2xl font-bold tracking-wide text-slate-800 dark:text-zinc-100">
                {{ $titulo }}
            </h1>
        </div>

        <p class="mt-1.5 text-sm text-slate-500 dark:text-zinc-400">
            {{ $subtitulo }}
        </p>
    </div>

    @if ($table && $table->total() > 0)
        <div
            class="inline-flex items-center gap-2 rounded-full border border-{{ $badgeColor }}-100 bg-{{ $badgeColor }}-50 px-4 py-2 dark:border-{{ $badgeColor }}-500/20 dark:bg-{{ $badgeColor }}-500/10">

            <svg class="h-4 w-4 text-{{ $badgeColor }}-500 dark:text-{{ $badgeColor }}-400" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>

            <span class="text-sm font-medium text-slate-700 dark:text-zinc-300">
                <span class="font-bold text-{{ $badgeColor }}-600 dark:text-{{ $badgeColor }}-400">
                    {{ number_format($table->total()) }}
                </span>

                @if ($singular && $plural)
                    {{ $table->total() === 1 ? $singular : $plural }}
                @endif
            </span>
        </div>
    @endif
</div>
