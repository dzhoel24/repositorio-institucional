<x-app-main>
    <div class="bg-black">
        <x-breadcrumb name="home"></x-breadcrumb>
    </div>

    <div class="w-full text-center mt-8 mb-8 px-4">
        <h1 class="text-3xl md:text-5xl font-black tracking-tighter text-slate-900 uppercase">
            Explora nuestro <span class="text-sky-600">Trabajo Académico</span>
        </h1>
    </div>

    {{-- Search --}}
    <div class="flex justify-center w-full mb-12 px-4">
        <x-search :parametro="'institucional'" :parametro2="'index'" :descrip="'¿Qué deseas encontrar hoy?'" />
    </div>

    <div class="w-full px-6 lg:px-12">
        {{-- Banner --}}
        <div
            class="w-full text-center mb-12 bg-slate-900 p-10 rounded-[2.5rem] shadow-md relative overflow-hidden border-b-8 border-sky-500">
            <div class="relative z-10">
                <h2 class="text-2xl md:text-4xl font-black pb-4 text-sky-400 uppercase tracking-widest">Orgullo
                    Salazarino</h2>
                <p class="text-slate-300 text-base md:text-lg leading-relaxed max-w-4xl mx-auto font-medium opacity-90">
                    Aquí compartimos los mejores proyectos y trabajos de investigación realizados por nuestra comunidad
                    académica.
                </p>
            </div>
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-sky-500/10 rounded-full blur-3xl"></div>
        </div>

        {{-- Tabs --}}
        <div class="border-b border-gray-200 w-full mb-10">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 w-full justify-center gap-4">
                <li class="flex-grow max-w-xs">
                    <a href="#" data-tab="tab1"
                        class="inline-flex items-center justify-center w-full p-4 text-sky-600 border-b-2 border-sky-600 active group text-lg font-bold gap-2 uppercase tracking-tight transition-all">
                        <box-icon name='category' type='solid' color='#0284c7'></box-icon> Categorías
                    </a>
                </li>
                <li class="flex-grow max-w-xs">
                    <a href="#" data-tab="tab2"
                        class="inline-flex items-center justify-center w-full p-4 border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 group text-lg font-bold gap-2 uppercase tracking-tight transition-all">
                        <box-icon name='news' color='#94a3b8'></box-icon> Recientes
                    </a>
                </li>
            </ul>
        </div>

        <div class="w-full">
            {{-- Tab 1: Categorías --}}
            <div id="tab1" class="w-full flex flex-wrap" role="tabpanel">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12 w-full">
                    @php
                        $links = [
                            [
                                'route' => 'institucional.index',
                                'title' => 'Repositorio Institucional',
                                'icon' => 'bx-building-house',
                                'color' => 'from-sky-600 to-blue-800'
                            ],
                            [
                                'route' => 'investigacion.index',
                                'title' => 'Proyectos de Investigación',
                                'icon' => 'bx-flask',
                                'color' => 'from-blue-700 to-indigo-900'
                            ],
                            [
                                'route' => 'modulo.index',
                                'title' => 'Prácticas Modulares',
                                'icon' => 'bx-collection',
                                'color' => 'from-sky-700 to-sky-900'
                            ],
                            [
                                'route' => 'feria.index',
                                'title' => 'Ferias Tecnológicas',
                                'icon' => 'bx-rocket',
                                'color' => 'from-slate-800 to-slate-950'
                            ],
                            [
                                'route' => 'filtros.category',
                                'title' => 'Programas de Estudio',
                                'icon' => 'bx-school',
                                'color' => 'from-blue-600 to-sky-700'
                            ],
                            [
                                'route' => 'feria.index',
                                'title' => 'Informes de Practicas',
                                'icon' => 'bx-file-blank',
                                'color' => 'from-sky-800 to-blue-900'
                            ]
                        ];
                    @endphp

                    @foreach ($links as $link)
                        <a href="{{ route($link['route']) }}" class="group block relative">
                            <div
                                class="h-40 relative flex flex-col justify-center p-8 bg-white border-2 border-slate-100 rounded-[2rem] shadow-lg transition-all duration-500 group-hover:-translate-y-2 group-hover:shadow-2xl group-hover:border-sky-200 overflow-hidden">

                                <div
                                    class="absolute -right-4 -bottom-6 opacity-[0.05] group-hover:opacity-[0.10] transition-all duration-700 transform group-hover:scale-110 group-hover:-rotate-12 text-sky-900 pointer-events-none">
                                    <i class='bx bxs-{{ str_replace('bx-', '', $link['icon']) }} text-[150px]'></i>
                                </div>

                                <div
                                    class="absolute left-0 top-0 bottom-0 w-2.5 bg-gradient-to-b {{ $link['color'] }} transform scale-y-75 group-hover:scale-y-100 transition-transform duration-500 rounded-r-xl">
                                </div>

                                <div class="relative z-10 pl-3">
                                    <h3
                                        class="text-xl font-black text-slate-800 group-hover:text-sky-600 transition-colors duration-300 leading-tight uppercase">
                                        {{ $link['title'] }}
                                    </h3>
                                    <p
                                        class="text-slate-400 font-bold text-[10px] mt-1 uppercase tracking-tighter group-hover:text-slate-500 transition-colors">
                                        Ver documentos
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Tab 2: Recientes --}}
            <div id="tab2" class="hidden w-full" role="tabpanel">
                <div class="flex flex-col py-6 md:px-20 gap-8 w-full max-w-6xl mx-auto">
                    @foreach ($recientes as $reciente)
                        <x-card :parametro="'institucional'" :codigo="$reciente->id" :image="$reciente->ruta_caratula" :title="$reciente->titulo"
                            :resumen="$reciente->resumen" :autores="$reciente->autores" :acceso="$reciente->acceso" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-main>
