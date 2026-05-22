<x-public.app-main title="Índice de Títulos">

    <x-public.breadcrumb name="filtros.titulos.index" />

    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-6 lg:gap-8 mt-4 sm:mt-6">

        <aside class="hidden md:block md:col-span-1">
            <x-public.filter />
        </aside>

        <main class="md:col-span-3 flex flex-col w-full px-0 md:px-4 space-y-5">

            {{-- Header con filtro activo --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-200 pb-3">
                <div class="flex items-center gap-2.5 min-w-0 flex-wrap">
                    <div class="h-6 w-1 bg-indigo-600 rounded-full shrink-0"></div>

                    <div class="flex items-center gap-2 flex-wrap">
                        <h2 class="text-base sm:text-lg font-bold text-slate-800 tracking-wide">
                            LISTAR POR:
                        </h2>

                        @php
                            $hasFilter = request('starts_with') || request('search');
                            $filterText = '';

                            if (request('search')) {
                                $filterText = 'Búsqueda: "' . e(request('search')) . '"';
                            } elseif (request('starts_with') === '0-9') {
                                $filterText = 'Números (0-9)';
                            } elseif (request('starts_with') && ctype_alpha(request('starts_with'))) {
                                $filterText = 'Letra: ' . e(request('starts_with'));
                            }
                        @endphp

                        @if ($hasFilter && $filterText)
                            <span
                                class="inline-flex items-center gap-1.5 bg-indigo-50 text-indigo-700 text-xs sm:text-sm font-semibold px-3 py-1.5 rounded-full border border-indigo-200">
                                @if (request('search'))
                                    <x-heroicon-s-magnifying-glass class="w-3.5 h-3.5" />
                                @elseif(request('starts_with') === '0-9')
                                    <x-heroicon-s-numbered-list class="w-3.5 h-3.5" />
                                @else
                                    <x-heroicon-s-book-open class="w-3.5 h-3.5" />
                                @endif
                                {{ $filterText }}
                            </span>
                            <a href="{{ route('filtros.titulos.index') }}"
                                class="text-xs text-slate-400 hover:text-red-500 transition-colors flex items-center gap-1">
                                <x-heroicon-s-x-mark class="w-3.5 h-3.5" />
                                Limpiar
                            </a>
                        @else
                            <span class="text-slate-400 text-xs sm:text-sm font-normal">(Todos los documentos)</span>
                        @endif
                    </div>
                </div>

                <div class="bg-indigo-50 rounded-full px-3 py-1 shrink-0 w-fit">
                    <span class="text-xs font-semibold text-indigo-600">
                        <span class="font-bold">{{ $informes->total() }}</span> documentos
                    </span>
                </div>
            </div>

            {{-- Filtro alfabético --}}
            <div class="w-full">
                <ul class="flex items-center gap-1.5 overflow-x-auto pb-2.5 scrollbar-thin scrollbar-thumb-slate-200">
                    @php $isAll = !request('starts_with') && !request('search'); @endphp
                    <li class="shrink-0">
                        <a href="{{ route('filtros.titulos.index') }}"
                            class="flex items-center justify-center min-w-[54px] h-8 px-3 text-xs font-bold uppercase rounded-lg transition-all duration-150 active:scale-95
                            {{ $isAll ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 border border-slate-200' }}">
                            Todos
                        </a>
                    </li>

                    <li class="shrink-0">
                        <a href="{{ route('filtros.titulos.index', ['starts_with' => '0-9']) }}"
                            class="flex items-center justify-center min-w-[44px] h-8 px-2.5 text-xs font-bold rounded-lg transition-all duration-150 active:scale-95
                            {{ request('starts_with') === '0-9' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 border border-slate-200' }}">
                            0-9
                        </a>
                    </li>

                    @foreach (range('A', 'Z') as $letter)
                        <li class="shrink-0">
                            <a href="{{ route('filtros.titulos.index', ['starts_with' => $letter]) }}"
                                class="flex items-center justify-center min-w-[34px] h-8 px-2 text-xs font-bold uppercase rounded-lg transition-all duration-150 active:scale-95
                                {{ request('starts_with') === $letter ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 border border-slate-200' }}">
                                {{ $letter }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Buscador --}}
            <div class="w-full">
                <x-public.search :route="'filtros.titulos.index'" :param="'search'" :descrip="'Introducir las primeras letras del título...'" :text="'Buscar'" />
            </div>

            {{-- Barra de control --}}
            <div class="w-full flex flex-row sm:items-center justify-between gap-3 py-2 border-b border-slate-100">
                <div class="text-xs sm:text-sm font-medium text-slate-500">
                    <x-public.count :contador="$informes->total()" :paginator="$informes" />
                </div>
                <div class="flex items-center justify-start sm:justify-end">
                    <x-public.advanced-filter route="filtros.titulos.index" defaultSort="asc"
                        defaultItemsPerPage="10" />
                </div>
            </div>

            {{-- Lista de documentos --}}
            <div class="w-full space-y-3">
                @if ($informes->isEmpty())
                    <div class="text-center py-12 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                        <x-heroicon-s-folder-open class="w-12 h-12 text-slate-300 mx-auto mb-3" />
                        <p class="text-slate-500 font-medium">No se encontraron documentos</p>
                        @if ($hasFilter)
                            <a href="{{ route('filtros.titulos.index') }}"
                                class="inline-flex items-center gap-2 mt-3 px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                                <x-heroicon-s-arrow-path class="w-4 h-4" />
                                Limpiar filtros
                            </a>
                        @endif
                    </div>
                @else
                    <div class="flex flex-col gap-3 w-full">
                        @foreach ($informes as $informe)
                            <x-public.card :parametro="$informe->tipo_slug ?? 'institucional'" :action="'show'" :origen="'titulo'" :codigo="$informe->id"
                                :image="$informe->ruta_caratula" :title="$informe->titulo" :anio="$informe->anio" :resumen="$informe->resumen"
                                :autores="$informe->autores_formatted" :acceso="$informe->acceso" />
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Paginación --}}
            @if ($informes->hasPages())
                <x-public.pagination :paginator="$informes" />
            @endif

        </main>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const filterLinks = document.querySelectorAll('ul a');
                const filterContainer = document.querySelector('ul');

                // Feedback visual
                filterLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        if (!this.classList.contains('bg-indigo-600')) {
                            this.style.transform = 'scale(0.95)';
                            setTimeout(() => this.style.transform = '', 150);
                        }
                    });
                });

                // Guardar scroll
                if (filterContainer) {
                    const savedScroll = sessionStorage.getItem('filterScroll');
                    if (savedScroll) {
                        filterContainer.scrollLeft = parseInt(savedScroll);
                        sessionStorage.removeItem('filterScroll');
                    }
                    filterLinks.forEach(link => {
                        link.addEventListener('click', () => {
                            sessionStorage.setItem('filterScroll', filterContainer.scrollLeft);
                        });
                    });
                }
            });
        </script>
    @endpush

</x-public.app-main>
