<x-public.app-main title="Programas de Estudio">
    <x-public.breadcrumb name="filtros.carreras.index"></x-public.breadcrumb>

    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-6 lg:gap-8 mt-4 sm:mt-6">

        <aside class="hidden md:block md:col-span-1">
            <div class="sticky top-6">
                <x-public.filter></x-public.filter>
            </div>
        </aside>

        <main class="md:col-span-3 flex flex-col w-full px-4 sm:px-6">

            <div class="flex items-center justify-between border-b border-slate-200 dark:border-gray-800 pb-4 mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="h-6 w-1 bg-indigo-600 dark:bg-indigo-400 rounded-full"></div>
                    <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100 tracking-wide">
                        Especialidades Académicas
                    </h2>
                </div>
                <span
                    class="text-xs font-semibold text-slate-400 dark:text-gray-500 bg-slate-100 dark:bg-gray-800 px-2.5 py-1 rounded">
                    {{ $carreras->count() }} Programas
                </span>
            </div>

            <div class="flex flex-col gap-2.5 w-full">
                @foreach ($carreras as $index => $carrera)
                    <a href="{{ route('filtros.carreras.show', ['carrera' => $carrera->id]) }}"
                        class="group flex items-center justify-between p-4 bg-white dark:bg-gray-900/40 border border-slate-150 dark:border-gray-800/80 rounded-md hover:border-indigo-500/50 dark:hover:border-indigo-400/50 hover:bg-slate-50/50 dark:hover:bg-gray-800/20 transition-all duration-200">
                        <div class="flex items-center gap-3">
                            <span
                                class="text-xs font-bold text-slate-300 dark:text-gray-600 group-hover:text-indigo-400 transition-colors">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <span
                                class="text-sm font-semibold text-slate-700 dark:text-slate-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                {{ $carrera->nombre }}
                            </span>
                        </div>
                        <x-heroicon-s-arrow-right
                            class="w-4 h-4 text-slate-400 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-all duration-200" />
                    </a>
                @endforeach
            </div>

        </main>
    </div>
</x-public.app-main>
