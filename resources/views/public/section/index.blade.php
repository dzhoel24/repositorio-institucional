<x-public.app-main title="Programas de Estudio">
    <x-breadcrumb name="section.index"></x-breadcrumb>

    {{-- Layout Principal --}}
    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-6 lg:gap-8 mt-4 sm:mt-6">

        {{-- Barra Lateral: Filtros --}}
        <aside class="hidden md:block md:col-span-1">
            <div class="sticky top-6">
                <x-filter></x-filter>
            </div>
        </aside>

        {{-- Contenido Principal --}}
        <main class="md:col-span-3 flex flex-col w-full px-4 sm:px-6">

            {{-- Encabezado de Sección Moderno y Limpio --}}
            <div class="flex items-center justify-between border-b border-slate-200 dark:border-gray-800 pb-4 mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="h-6 w-1 bg-indigo-600 dark:bg-indigo-400 rounded-full"></div>
                    <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100 tracking-wide">
                        Especialidades Académicas
                    </h2>
                </div>
                <span
                    class="text-xs font-semibold text-slate-400 dark:text-gray-500 bg-slate-100 dark:bg-gray-800 px-2.5 py-1 rounded">
                    8 Programas
                </span>
            </div>

            {{-- Listado de Filas Interactivas Modernas --}}
            <div class="flex flex-col gap-2.5 w-full">

                {{-- Ítem 1 --}}
                <a href="{{ route('carrera.index', ['carrera' => '1']) }}"
                    class="group flex items-center justify-between p-4 bg-white dark:bg-gray-900/40 border border-slate-150 dark:border-gray-800/80 rounded-md hover:border-indigo-500/50 dark:hover:border-indigo-400/50 hover:bg-slate-50/50 dark:hover:bg-gray-800/20 transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <span
                            class="text-xs font-bold text-slate-300 dark:text-gray-600 group-hover:text-indigo-400 transition-colors">01</span>
                        <span
                            class="text-sm font-semibold text-slate-700 dark:text-slate-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            Contabilidad
                        </span>
                    </div>
                    <x-heroicon-s-arrow-right
                        class="w-4 h-4 text-slate-400 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-all duration-200" />
                </a>

                {{-- Ítem 2 --}}
                <a href="{{ route('carrera.index', ['carrera' => '2']) }}"
                    class="group flex items-center justify-between p-4 bg-white dark:bg-gray-900/40 border border-slate-150 dark:border-gray-800/80 rounded-md hover:border-indigo-500/50 dark:hover:border-indigo-400/50 hover:bg-slate-50/50 dark:hover:bg-gray-800/20 transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <span
                            class="text-xs font-bold text-slate-300 dark:text-gray-600 group-hover:text-indigo-400 transition-colors">02</span>
                        <span
                            class="text-sm font-semibold text-slate-700 dark:text-slate-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            Desarrollo de Sistemas de Información
                        </span>
                    </div>
                    <x-heroicon-s-arrow-right
                        class="w-4 h-4 text-slate-400 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-all duration-200" />
                </a>

                {{-- Ítem 3 --}}
                <a href="{{ route('carrera.index', ['carrera' => '5']) }}"
                    class="group flex items-center justify-between p-4 bg-white dark:bg-gray-900/40 border border-slate-150 dark:border-gray-800/80 rounded-md hover:border-indigo-500/50 dark:hover:border-indigo-400/50 hover:bg-slate-50/50 dark:hover:bg-gray-800/20 transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <span
                            class="text-xs font-bold text-slate-300 dark:text-gray-600 group-hover:text-indigo-400 transition-colors">03</span>
                        <span
                            class="text-sm font-semibold text-slate-700 dark:text-slate-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            Electricidad Industrial
                        </span>
                    </div>
                    <x-heroicon-s-arrow-right
                        class="w-4 h-4 text-slate-400 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-all duration-200" />
                </a>

                {{-- Ítem 4 --}}
                <a href="{{ route('carrera.index', ['carrera' => '6']) }}"
                    class="group flex items-center justify-between p-4 bg-white dark:bg-gray-900/40 border border-slate-150 dark:border-gray-800/80 rounded-md hover:border-indigo-500/50 dark:hover:border-indigo-400/50 hover:bg-slate-50/50 dark:hover:bg-gray-800/20 transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <span
                            class="text-xs font-bold text-slate-300 dark:text-gray-600 group-hover:text-indigo-400 transition-colors">04</span>
                        <span
                            class="text-sm font-semibold text-slate-700 dark:text-slate-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            Electrónica Industrial
                        </span>
                    </div>
                    <x-heroicon-s-arrow-right
                        class="w-4 h-4 text-slate-400 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-all duration-200" />
                </a>

                {{-- Ítem 5 --}}
                <a href="{{ route('carrera.index', ['carrera' => '4']) }}"
                    class="group flex items-center justify-between p-4 bg-white dark:bg-gray-900/40 border border-slate-150 dark:border-gray-800/80 rounded-md hover:border-indigo-500/50 dark:hover:border-indigo-400/50 hover:bg-slate-50/50 dark:hover:bg-gray-800/20 transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <span
                            class="text-xs font-bold text-slate-300 dark:text-gray-600 group-hover:text-indigo-400 transition-colors">05</span>
                        <span
                            class="text-sm font-semibold text-slate-700 dark:text-slate-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            Enfermería Técnica
                        </span>
                    </div>
                    <x-heroicon-s-arrow-right
                        class="w-4 h-4 text-slate-400 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-all duration-200" />
                </a>

                {{-- Ítem 6 --}}
                <a href="{{ route('carrera.index', ['carrera' => '8']) }}"
                    class="group flex items-center justify-between p-4 bg-white dark:bg-gray-900/40 border border-slate-150 dark:border-gray-800/80 rounded-md hover:border-indigo-500/50 dark:hover:border-indigo-400/50 hover:bg-slate-50/50 dark:hover:bg-gray-800/20 transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <span
                            class="text-xs font-bold text-slate-300 dark:text-gray-600 group-hover:text-indigo-400 transition-colors">06</span>
                        <span
                            class="text-sm font-semibold text-slate-700 dark:text-slate-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            Mecánica de Producción Automotriz
                        </span>
                    </div>
                    <x-heroicon-s-arrow-right
                        class="w-4 h-4 text-slate-400 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-all duration-200" />
                </a>

                {{-- Ítem 7 --}}
                <a href="{{ route('carrera.index', ['carrera' => '7']) }}"
                    class="group flex items-center justify-between p-4 bg-white dark:bg-gray-900/40 border border-slate-150 dark:border-gray-800/80 rounded-md hover:border-indigo-500/50 dark:hover:border-indigo-400/50 hover:bg-slate-50/50 dark:hover:bg-gray-800/20 transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <span
                            class="text-xs font-bold text-slate-300 dark:text-gray-600 group-hover:text-indigo-400 transition-colors">07</span>
                        <span
                            class="text-sm font-semibold text-slate-700 dark:text-slate-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            Mecatrónica Automotriz
                        </span>
                    </div>
                    <x-heroicon-s-arrow-right
                        class="w-4 h-4 text-slate-400 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-all duration-200" />
                </a>

                {{-- Ítem 8 --}}
                <a href="{{ route('carrera.index', ['carrera' => '3']) }}"
                    class="group flex items-center justify-between p-4 bg-white dark:bg-gray-900/40 border border-slate-150 dark:border-gray-800/80 rounded-md hover:border-indigo-500/50 dark:hover:border-indigo-400/50 hover:bg-slate-50/50 dark:hover:bg-gray-800/20 transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <span
                            class="text-xs font-bold text-slate-300 dark:text-gray-600 group-hover:text-indigo-400 transition-colors">08</span>
                        <span
                            class="text-sm font-semibold text-slate-700 dark:text-slate-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            Química
                        </span>
                    </div>
                    <x-heroicon-s-arrow-right
                        class="w-4 h-4 text-slate-400 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-all duration-200" />
                </a>

            </div>
        </main>
    </div>
</x-public.app-main>
