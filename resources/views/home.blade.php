<x-public.app-main>
    <x-breadcrumb name="home"></x-breadcrumb>

    <div class="w-full text-center mt-12 mb-8 px-4">
        <h1 class="text-3xl md:text-5xl font-black tracking-tight text-slate-900 uppercase">
            Explora nuestro <span class="text-sky-600">Trabajo Académico</span>
        </h1>
    </div>

    <div class="flex justify-center w-full mb-12 px-4">
        <x-search route="repositorio.index" :params="['tipo' => 'institucional']" descrip="¿Qué deseas encontrar hoy?" />
    </div>

    <div class="w-full px-6 lg:px-12">
        <div
            class="w-full text-center mb-12 bg-gradient-to-br from-slate-900 to-slate-800 p-10 rounded-2xl border border-slate-800 shadow-xl relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-sky-500/10 rounded-full blur-3xl pointer-events-none">
            </div>
            <div class="relative z-10">
                <div class="flex justify-center mb-4">
                    <x-heroicon-s-academic-cap class="w-12 h-12 text-sky-400" />
                </div>
                <h2 class="text-2xl md:text-3xl font-black pb-3 text-white uppercase tracking-wider">Orgullo Salazarino
                </h2>
                <p class="text-slate-400 text-sm md:text-base leading-relaxed max-w-3xl mx-auto font-medium">
                    Aquí compartimos los mejores proyectos y trabajos de investigación realizados por nuestra comunidad
                    académica.
                </p>
            </div>
        </div>

        {{-- Tabs de Navegación --}}
        <div class="border-b border-slate-200 w-full mb-10">
            <ul class="flex flex-wrap justify-center gap-8 -mb-px">
                <li>
                    <button type="button" data-tab="tab1"
                        class="tab-btn inline-flex items-center gap-2.5 py-4 px-3 text-base font-bold uppercase tracking-wide transition-all duration-200
                        text-sky-600 border-b-2 border-sky-600">
                        <x-heroicon-s-squares-2x2 class="w-5 h-5" />
                        Categorías
                    </button>
                </li>
                <li>
                    <button type="button" data-tab="tab2"
                        class="tab-btn inline-flex items-center gap-2.5 py-4 px-3 text-base font-bold uppercase tracking-wide transition-all duration-200
                        text-slate-500 border-b-2 border-transparent hover:text-slate-700">
                        <x-heroicon-s-document-text class="w-5 h-5" />
                        Recientes
                    </button>
                </li>
            </ul>
        </div>

        <div class="w-full">
            {{-- TAB 1 - CATEGORÍAS --}}
            <div id="tab1" class="tab-content">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    @php
                        $links = [
                            [
                                'route' => 'repositorio.index',
                                'params' => ['tipo' => 'institucional'],
                                'title' => 'Repositorio Institucional',
                                'icon' => 'building-library'
                            ],
                            [
                                'route' => 'repositorio.index',
                                'params' => ['tipo' => 'investigacion'],
                                'title' => 'Proyectos de Investigación',
                                'icon' => 'beaker'
                            ],
                            [
                                'route' => 'repositorio.index',
                                'params' => ['tipo' => 'modulo'],
                                'title' => 'Prácticas Modulares',
                                'icon' => 'academic-cap'
                            ],
                            [
                                'route' => 'repositorio.index',
                                'params' => ['tipo' => 'feria'],
                                'title' => 'Ferias Tecnológicas',
                                'icon' => 'sparkles'
                            ],
                            [
                                'route' => 'filtros.carreras.index',
                                'params' => [],
                                'title' => 'Programas de Estudio',
                                'icon' => 'book-open'
                            ]
                        ];
                    @endphp

                    @foreach ($links as $link)
                        <a href="{{ route($link['route'], $link['params']) }}" class="group block">
                            <div
                                class="h-40 relative flex flex-col justify-center p-8 bg-white border border-slate-100 rounded-xl shadow-lg transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:border-sky-200 overflow-hidden">

                                <div
                                    class="absolute -right-6 -bottom-8 text-sky-900 opacity-10 group-hover:opacity-20 group-hover:scale-110 group-hover:-rotate-12 transition-all duration-700 pointer-events-none">
                                    @if ($link['icon'] == 'building-library')
                                        <x-heroicon-s-building-library class="w-32 h-32" />
                                    @elseif($link['icon'] == 'beaker')
                                        <x-heroicon-s-beaker class="w-32 h-32" />
                                    @elseif($link['icon'] == 'academic-cap')
                                        <x-heroicon-s-academic-cap class="w-32 h-32" />
                                    @elseif($link['icon'] == 'sparkles')
                                        <x-heroicon-s-sparkles class="w-32 h-32" />
                                    @else
                                        <x-heroicon-s-book-open class="w-32 h-32" />
                                    @endif
                                </div>

                                {{-- Línea lateral --}}
                                <div
                                    class="absolute left-0 top-0 bottom-0 w-1.5 bg-sky-600 rounded-full scale-y-75 group-hover:scale-y-100 transition-transform duration-500">
                                </div>

                                <div class="relative pl-3 z-10">
                                    <h3
                                        class="text-xl font-black text-slate-800 group-hover:text-sky-600 transition-colors duration-300 leading-tight uppercase">
                                        {{ $link['title'] }}
                                    </h3>
                                    <p
                                        class="text-slate-400 font-bold text-[10px] mt-1 uppercase tracking-tighter group-hover:text-sky-500 transition-colors">
                                        Ver documentos →
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div id="tab2" class="tab-content hidden">
                <div class="flex flex-col gap-6 py-4 max-w-5xl mx-auto mb-12">
                    @foreach ($recientes as $reciente)
                        <x-public.card :parametro="'institucional'" :codigo="$reciente->id" :image="$reciente->ruta_caratula" :anio="$reciente->anio"
                            :title="$reciente->titulo" :resumen="$reciente->resumen" :autores="$reciente->autores_formatted" :acceso="$reciente->acceso" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-public.app-main>
