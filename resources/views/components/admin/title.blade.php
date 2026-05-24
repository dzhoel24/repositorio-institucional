@props(['titulo', 'subtitulo', 'table' => null, 'singular' => null, 'plural' => null])

<div class="mb-4 flex gap-3 flex-row items-center sm:justify-between">

    <div class="flex items-start gap-2 sm:gap-3 min-w-0 flex-1">
        <div class="mt-1 h-6 w-1 shrink-0 rounded-full bg-gradient-to-b from-indigo-500 to-indigo-700 sm:mt-0 sm:h-7">
        </div>

        <div class="min-w-0 flex-1">
            <h1 class="text-base font-bold text-slate-900 truncate sm:text-lg md:text-xl dark:text-zinc-50">
                {{ $titulo }}
            </h1>
            @if ($subtitulo)
                <p class="mt-0.5 text-xs text-slate-500 sm:mt-1 sm:text-sm dark:text-zinc-400">
                    {{ $subtitulo }}
                </p>
            @endif
        </div>
    </div>

    @if ($table && $table->total() > 0)
        <div class="shrink-0">
            <div
                class="inline-flex items-center rounded-lg border border-slate-200 bg-white px-2.5 py-1.5 text-sm font-medium text-slate-600 gap-1.5
                sm:rounded-xl sm:px-4 sm:py-2 sm:gap-2
                dark:border-slate-800 dark:bg-slate-900 dark:text-zinc-300">

                <x-heroicon-o-document-text class="h-4 w-4 text-slate-400 sm:h-5 sm:w-5 dark:text-zinc-500" />

                <span>
                    <span class="font-semibold text-slate-900 sm:font-bold dark:text-zinc-100">
                        {{ number_format($table->total()) }}
                    </span>

                    @if ($singular && $plural)
                        <span class="hidden text-slate-600 sm:inline dark:text-zinc-400">
                            {{ $table->total() === 1 ? $singular : $plural }}
                        </span>
                    @endif
                </span>
            </div>
        </div>
    @endif
</div>
