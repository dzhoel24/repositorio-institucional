@props(['titulo', 'subtitulo', 'table' => null, 'singular' => null, 'plural' => null])

<div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">

    {{-- TEXTO PRINCIPAL --}}
    <div>
        <h1 class="flex items-center gap-3 text-2xl font-bold tracking-wide text-slate-800 dark:text-zinc-100">
            <span class="h-7 w-1.5 rounded-full bg-indigo-500"></span>
            {{ $titulo }}
        </h1>

        <p class="mt-1 text-[15px] text-slate-500 dark:text-zinc-400">
            {{ $subtitulo }}
        </p>
    </div>

    {{-- BADGE SOLO SI EXISTE TABLE --}}
    @if ($table)
        <div
            class="inline-flex w-fit items-center gap-2 rounded-2xl border border-indigo-100 bg-indigo-50 px-5 py-3 dark:border-indigo-500/20 dark:bg-indigo-500/10">

            <i class="fa-solid fa-users text-[13px] text-indigo-500 dark:text-indigo-400"></i>

            <span class="text-[13px] font-semibold text-slate-600 dark:text-zinc-300">

                <span class="font-bold text-indigo-600 dark:text-indigo-400">
                    {{ $table->total() }}
                </span>

                @if ($singular && $plural)
                    {{ $table->total() === 1 ? $singular . ' registrado' : $plural . ' registrados' }}
                @endif

            </span>
        </div>
    @endif

</div>
