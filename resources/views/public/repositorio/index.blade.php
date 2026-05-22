<x-public.app-main :title="$config['titulo']">

    <x-public.breadcrumb name="repositorio.index" :params="[$tipo, $origen ?? null, $origenModel ?? null]" />

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:gap-8 mt-6">

        <aside class="hidden lg:block">
            <x-public.filter />
        </aside>

        <main class="lg:col-span-3 flex flex-col space-y-5">

            @php
                // Colores institucionales sobrios (unificados)
                $styles = [
                    'institucional' => [
                        'border' => 'border-indigo-600',
                        'bg' => 'from-indigo-50/30',
                        'icon' => 'text-indigo-700'
                    ],
                    'investigacion' => [
                        'border' => 'border-indigo-600',
                        'bg' => 'from-indigo-50/30',
                        'icon' => 'text-indigo-700'
                    ],
                    'modulo' => [
                        'border' => 'border-indigo-600',
                        'bg' => 'from-indigo-50/30',
                        'icon' => 'text-indigo-700'
                    ],
                    'titulacion' => [
                        'border' => 'border-indigo-600',
                        'bg' => 'from-indigo-50/30',
                        'icon' => 'text-indigo-700'
                    ],
                    'feria' => [
                        'border' => 'border-indigo-600',
                        'bg' => 'from-indigo-50/30',
                        'icon' => 'text-indigo-700'
                    ]
                ];
                $style = $styles[$tipo] ?? $styles['institucional'];
            @endphp

            {{-- Header institucional --}}
            <div
                class="bg-gradient-to-r {{ $style['bg'] }} to-white rounded-xl p-5 border-l-4 {{ $style['border'] }} shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                    <div class="flex items-start gap-3 flex-1 min-w-0">
                        <div class="mt-0.5 shrink-0">
                            @if ($origen === 'carrera' && isset($carreraModel))
                                <x-heroicon-s-academic-cap class="w-6 h-6 md:w-7 md:h-7 {{ $style['icon'] }}" />
                            @else
                                <x-heroicon-s-document-text class="w-6 h-6 md:w-7 md:h-7 {{ $style['icon'] }}" />
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <h1 class="text-xl md:text-2xl font-bold text-slate-800 break-words tracking-tight">
                                @if ($origen === 'carrera' && isset($carreraModel))
                                    {{ $carreraModel->nombre }}
                                @else
                                    {{ $config['titulo'] }}
                                @endif
                            </h1>
                            <p class="text-sm text-slate-500 mt-1.5 leading-relaxed">
                                @if ($origen === 'carrera' && isset($carreraModel))
                                    Documentos académicos y producción investigativa de la carrera
                                @else
                                    {{ Str::limit($config['descripcion'] ?? 'Consulta y accede a la producción académica e investigativa del repositorio institucional', 140) }}
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center shrink-0 justify-end">
                        <x-public.advanced-filter route="repositorio.index" :params="['tipo' => $tipo]" defaultSort="asc"
                            defaultItemsPerPage="10" />
                    </div>
                </div>
            </div>

            {{-- Buscador --}}
            <div class="w-full">
                <x-public.search :route="'repositorio.index'" :params="['tipo' => $tipo]" :descrip="'Buscar por título, autor o palabra clave...'" />
            </div>

            {{-- Contador --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 py-2 border-b border-slate-100">
                <div class="text-xs sm:text-sm font-medium text-slate-500">
                    <x-public.count :contador="$informes->total()" :paginator="$informes" />
                </div>
            </div>

            {{-- Lista de documentos --}}
            <div class="flex flex-col gap-4 w-full">
                @forelse ($informes as $informe)
                    @php
                        $cardParams = [
                            'tipo' => $tipo,
                            'id' => $informe->id
                        ];

                        if ($origen === 'carrera' && isset($carreraModel)) {
                            $cardParams['origen'] = 'carrera';
                            $cardParams['origenId'] = $carreraModel->id;
                        }

                        if ($origen === 'autor' && isset($autorModel)) {
                            $cardParams['origen'] = 'autor';
                            $cardParams['origenId'] = $autorModel->id;
                        }

                        $cardUrl = route('repositorio.show', $cardParams);
                    @endphp

                    <x-public.card :url="$cardUrl" :parametro="$tipo" :codigo="$informe->id" :image="$informe->ruta_caratula"
                        :title="$informe->titulo" :resumen="$informe->resumen" :anio="$informe->anio" :autores="$informe->autores_formatted"
                        :acceso="$informe->acceso" />
                @empty
                    <div
                        class="text-center py-12 md:py-16 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                        <div class="flex flex-col items-center gap-3 px-4">
                            <div class="p-3 bg-slate-100 rounded-full">
                                <x-heroicon-s-folder-open class="w-12 h-12 text-slate-400" />
                            </div>
                            <div>
                                <p class="text-slate-600 font-medium text-base">No se encontraron resultados</p>
                                <p class="text-sm text-slate-400 mt-1">
                                    @if (request('search'))
                                        No hay documentos que coincidan con "{{ request('search') }}"
                                    @else
                                        Ajusta los filtros de búsqueda para encontrar más documentos
                                    @endif
                                </p>
                            </div>
                            @if (request('search') || request('sort') || request('per_page'))
                                <a href="{{ route('repositorio.index', ['tipo' => $tipo]) }}"
                                    class="mt-4 inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                                    <x-heroicon-s-arrow-path class="w-4 h-4" />
                                    Limpiar filtros
                                </a>
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Paginación --}}
            @if ($informes->hasPages())
                <div class="pt-4">
                    <x-public.pagination :paginator="$informes" />
                </div>
            @endif

        </main>
    </div>
</x-public.app-main>
