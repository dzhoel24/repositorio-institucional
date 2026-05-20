<x-public.app-main title="Índice de Títulos">

    <x-public.breadcrumb name="filtros.titulos.index"></x-public.breadcrumb>

    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-6 lg:gap-8 mt-4 sm:mt-6">

        <aside class="hidden md:block md:col-span-1">
            <x-public.filter></x-public.filter>
        </aside>

        <main class="md:col-span-3 flex flex-col w-full px-0 md:px-4 space-y-5">

            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-200 pb-3 mb-1">
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
                                class="text-xs text-slate-400 hover:text-red-500 transition-colors flex items-center gap-1"
                                title="Limpiar filtros">
                                <x-heroicon-s-x-mark class="w-3.5 h-3.5" />
                                Limpiar
                            </a>
                        @else
                            <span class="text-slate-400 text-xs sm:text-sm font-normal">(Todos los documentos)</span>
                        @endif
                    </div>
                </div>

                <div class="bg-slate-100 rounded-full px-3 py-1 shrink-0 w-fit">
                    <span class="text-xs font-semibold text-slate-600">
                        <span class="text-indigo-600 font-bold">{{ $informes->total() }}</span> documentos
                    </span>
                </div>
            </div>

            <div class="w-full">
                <ul id="list"
                    class="flex items-center gap-1.5 overflow-x-auto pb-2.5 scrollbar-thin scrollbar-thumb-slate-200">
                    @php $isAll = !request('starts_with') && !request('search'); @endphp
                    <li class="shrink-0">
                        <a href="{{ route('filtros.titulos.index') }}"
                            class="flex items-center justify-center min-w-[54px] h-8 px-3 text-xs font-bold uppercase rounded-lg transition-all duration-150 active:scale-95
                           {{ $isAll
                               ? 'bg-indigo-600 text-white shadow-sm shadow-indigo-100'
                               : 'bg-slate-100 text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 border border-slate-200/60' }}">
                            Todos
                        </a>
                    </li>

                    @php $isNumericCurrent = request('starts_with') === '0-9'; @endphp
                    <li class="shrink-0">
                        <a href="{{ route('filtros.titulos.index', ['starts_with' => '0-9']) }}"
                            class="flex items-center justify-center min-w-[44px] h-8 px-2.5 text-xs font-bold rounded-lg transition-all duration-150 active:scale-95
                           {{ $isNumericCurrent
                               ? 'bg-indigo-600 text-white shadow-sm shadow-indigo-100'
                               : 'bg-slate-100 text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 border border-slate-200/60' }}">
                            0-9
                        </a>
                    </li>

                    @foreach (range('A', 'Z') as $letter)
                        @php $isCurrent = request('starts_with') === $letter; @endphp
                        <li class="shrink-0">
                            <a href="{{ route('filtros.titulos.index', ['starts_with' => $letter]) }}"
                                class="flex items-center justify-center min-w-[34px] h-8 px-2 text-xs font-bold uppercase rounded-lg transition-all duration-150 active:scale-95
                               {{ $isCurrent
                                   ? 'bg-indigo-600 text-white shadow-sm shadow-indigo-100'
                                   : 'bg-slate-100 text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 border border-slate-200/60' }}">
                                {{ $letter }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="w-full">
                <x-public.search :route="'filtros.titulos.index'" :descrip="'Introducir las primeras letras del título...'" :text="'Buscar'" :param="'search'" />
            </div>

            <div
                class="w-full flex flex-col sm:flex-row sm:items-center justify-between gap-3.5 py-2 border-b border-slate-100">
                <div class="text-xs sm:text-sm font-medium text-slate-500 min-w-0">
                    <x-public.count :contador="$informes->total()" :paginator="$informes" />
                </div>
                <div class="flex items-center justify-start sm:justify-end shrink-0">
                    <x-public.advanced-filter route="filtros.titulos.index" :params="[]" defaultSort="asc"
                        defaultItemsPerPage="10" />
                </div>
            </div>

            <div class="w-full pt-1">
                @if ($informes->isEmpty())
                    <div class="text-center py-8 md:py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                        <div class="flex flex-col items-center gap-2 px-4">
                            <x-heroicon-s-folder-open class="w-10 h-10 md:w-12 md:h-12 text-gray-400" />
                            <p class="text-gray-500 text-sm md:text-base">No se encontraron resultados</p>
                            <p class="text-xs text-gray-400">Intenta con otros términos o revisa los filtros</p>
                        </div>
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

            <x-public.pagination :paginator="$informes" />

        </main>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Feedback visual al hacer clic en filtros
                const filterLinks = document.querySelectorAll('#list a');
                const searchInput = document.querySelector('input[name="search"]');
                const searchForm = document.querySelector('form[action*="filtros.titulos.index"]');

                filterLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        if (!this.classList.contains('bg-indigo-600')) {
                            this.style.transform = 'scale(0.95)';
                            setTimeout(() => {
                                this.style.transform = '';
                            }, 150);
                        }
                    });
                });

                if (searchForm) {
                    searchForm.addEventListener('submit', function() {
                        const searchValue = searchInput?.value.trim();
                        if (searchValue) {
                            const titleBadge = document.querySelector('.inline-flex.items-center.gap-1\\.5');
                            if (titleBadge) {
                                titleBadge.style.opacity = '0.7';
                                setTimeout(() => {
                                    titleBadge.style.opacity = '1';
                                }, 300);
                            }
                        }
                    });
                }

                const filterContainer = document.querySelector('#list');
                if (filterContainer) {
                    const savedScrollLeft = sessionStorage.getItem('filterScrollLeft');
                    if (savedScrollLeft) {
                        filterContainer.scrollLeft = parseInt(savedScrollLeft);
                        sessionStorage.removeItem('filterScrollLeft');
                    }

                    filterLinks.forEach(link => {
                        link.addEventListener('click', function() {
                            sessionStorage.setItem('filterScrollLeft', filterContainer.scrollLeft);
                        });
                    });
                }
            });
        </script>
    @endpush

</x-public.app-main>
