<x-public.app-main title="Inicio" :showFilter="false">

    <x-public.breadcrumb name="home" />

    {{-- Hero Section --}}
    <div class="w-full text-center mt-12 mb-8 px-4">
        <h1 class="text-3xl md:text-5xl font-black tracking-tight text-slate-900 uppercase">
            Explora nuestro <span class="text-indigo-600">Trabajo Académico</span>
        </h1>
    </div>

    {{-- Buscador principal --}}
    <div class="flex justify-center max-w-[600px] mx-auto mb-12 px-4">
        <x-public.search route="repositorio.index" :params="['tipo' => 'institucional']" descrip="¿Qué deseas encontrar hoy?" />
    </div>

    <div class="w-full px-6 lg:px-12">
        {{-- Banner institucional --}}
        <div
            class="w-full text-center mb-12 bg-gradient-to-br from-slate-900 to-slate-800 p-10 rounded-2xl border border-slate-800 shadow-xl relative overflow-hidden">
            <div
                class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none">
            </div>
            <div class="relative z-10">
                <div class="flex justify-center mb-4">
                    <x-heroicon-s-academic-cap class="w-12 h-12 text-indigo-400" />
                </div>
                <h2 class="text-2xl md:text-3xl font-black pb-3 text-white uppercase tracking-wider">Orgullo Salazarino
                </h2>
                <p class="text-slate-400 text-sm md:text-base leading-relaxed max-w-3xl mx-auto font-medium">
                    Aquí compartimos los mejores proyectos y trabajos de investigación realizados por nuestra comunidad
                    académica.
                </p>
            </div>
        </div>

        {{-- Tabs --}}
        <div class="border-b border-slate-200 w-full mb-10">
            <ul class="flex flex-wrap justify-center gap-8 -mb-px">
                <li>
                    <button type="button" data-tab="tab1"
                        class="tab-btn inline-flex items-center gap-2.5 py-4 px-3 text-base font-bold uppercase tracking-wide transition-all duration-200 text-indigo-600 border-b-2 border-indigo-600">
                        <x-heroicon-s-squares-2x2 class="w-5 h-5" />
                        Categorías
                    </button>
                </li>
                <li>
                    <button type="button" data-tab="tab2"
                        class="tab-btn inline-flex items-center gap-2.5 py-4 px-3 text-base font-bold uppercase tracking-wide transition-all duration-200 text-slate-500 border-b-2 border-transparent hover:text-slate-700 hover:border-slate-300">
                        <x-heroicon-s-document-text class="w-5 h-5" />
                        Recientes
                    </button>
                </li>
            </ul>
        </div>

        {{-- Contenido Tabs --}}
        <div class="w-full">
            {{-- Tab 1: Categorías --}}
            <div id="tab1" class="tab-content">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    @php
                        $categorias = [
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
                                'params' => ['tipo' => 'titulacion'],
                                'title' => 'Proyectos de Titulación',
                                'icon' => 'user-group'
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
                        $iconos = [
                            'building-library' => 'heroicon-s-building-library',
                            'beaker' => 'heroicon-s-beaker',
                            'academic-cap' => 'heroicon-s-academic-cap',
                            'user-group' => 'heroicon-s-user-group',
                            'sparkles' => 'heroicon-s-sparkles',
                            'book-open' => 'heroicon-s-book-open'
                        ];
                    @endphp

                    @foreach ($categorias as $categoria)
                        <a href="{{ route($categoria['route'], $categoria['params']) }}" class="group block rounded-xl">
                            <div
                                class="h-40 relative flex flex-col justify-center p-8 bg-white border border-slate-100 rounded-xl shadow-md transition-all duration-500 hover:-translate-y-2 hover:shadow-xl hover:border-indigo-200 overflow-hidden">
                                <div
                                    class="absolute -right-6 -bottom-8 text-indigo-900 opacity-10 group-hover:opacity-20 group-hover:scale-110 group-hover:-rotate-12 transition-all duration-700 pointer-events-none">
                                    <x-dynamic-component :component="$iconos[$categoria['icon']]" class="w-32 h-32" />
                                </div>
                                <div
                                    class="absolute left-0 top-0 bottom-0 w-1.5 bg-indigo-600 rounded-full scale-y-75 group-hover:scale-y-100 transition-transform duration-500">
                                </div>
                                <div class="relative pl-3 z-10">
                                    <h3
                                        class="text-xl font-black text-slate-800 group-hover:text-indigo-600 transition-colors duration-300 leading-tight uppercase">
                                        {{ $categoria['title'] }}
                                    </h3>
                                    <p
                                        class="text-slate-400 font-bold text-[10px] mt-1 uppercase tracking-tighter group-hover:text-indigo-500 transition-colors">
                                        Ver documentos →
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Tab 2: Recientes --}}
            <div id="tab2" class="tab-content hidden">
                <div class="flex flex-col gap-6 py-4 max-w-5xl mx-auto mb-12">
                    @forelse ($recientes as $reciente)
                        <x-public.card :parametro="'institucional'" :codigo="$reciente->id" :image="$reciente->ruta_caratula" :anio="$reciente->anio"
                            :title="$reciente->titulo" :resumen="$reciente->resumen" :autores="$reciente->autores_formatted" :acceso="$reciente->acceso" />
                    @empty
                        <div class="text-center py-12 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                            <x-heroicon-s-document-text class="w-12 h-12 text-slate-300 mx-auto mb-3" />
                            <p class="text-slate-500 font-medium">No hay documentos recientes disponibles.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</x-public.app-main>
