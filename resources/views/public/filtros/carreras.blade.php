<x-public.app-main title="Programas de Estudio">

    <x-public.breadcrumb name="filtros.carreras.index" />

    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-6 lg:gap-8 mt-4 sm:mt-6">

        <aside class="hidden md:block md:col-span-1">
            <x-public.filter />
        </aside>

        <main class="md:col-span-3 flex flex-col w-full px-0 md:px-4 space-y-5">

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-200 pb-4">
                <div class="flex items-center gap-2.5 min-w-0 flex-wrap">
                    <div class="h-6 w-1 bg-indigo-600 rounded-full shrink-0"></div>
                    <h2 class="text-base sm:text-lg font-bold text-slate-800 tracking-wide">
                        Especialidades Académicas
                    </h2>
                </div>

                <div class="bg-indigo-50 rounded-full px-3 py-1 shrink-0 w-fit">
                    <span class="text-xs font-semibold text-indigo-600">
                        <span class="font-bold">{{ $carreras->count() }}</span>
                        <span class="hidden sm:inline">programas</span>
                    </span>
                </div>
            </div>

            @if ($carreras->isEmpty())
                <div class="text-center py-12 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                    <x-heroicon-s-academic-cap class="w-8 h-8 text-slate-300 mx-auto mb-3" />
                    <p class="text-sm font-medium text-slate-500 px-4">
                        No se encontraron programas de estudio registrados.
                    </p>
                </div>
            @else
                <div class="flex flex-col gap-2 w-full">
                    @foreach ($carreras as $index => $carrera)
                        <a href="{{ route('repositorio.index', ['tipo' => 'institucional', 'origen' => 'carrera', 'carrera_id' => $carrera->id]) }}"
                            class="group flex items-center justify-between p-3.5 sm:p-4 bg-white border border-slate-200 rounded-xl hover:border-indigo-300 hover:bg-indigo-50/5 hover:shadow-sm transition-all duration-200 active:scale-[0.995]">

                            <div class="flex items-center gap-3.5 pr-4 min-w-0">
                                <span
                                    class="text-xs font-mono font-bold text-slate-300 group-hover:text-indigo-400 transition-colors shrink-0">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <span
                                    class="text-sm font-semibold text-slate-700 group-hover:text-indigo-600 transition-colors break-words line-clamp-2 sm:line-clamp-none">
                                    {{ $carrera->nombre }}
                                </span>
                            </div>

                            <div class="shrink-0 ml-auto pl-2">
                                <x-heroicon-s-arrow-right
                                    class="w-4 h-4 text-slate-400 md:opacity-0 md:-translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-indigo-600 transition-all duration-200" />
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

        </main>
    </div>
</x-public.app-main>
