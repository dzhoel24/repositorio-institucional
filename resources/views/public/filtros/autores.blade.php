<x-public.app-main title="Índice de Autores">

    <x-public.breadcrumb name="filtros.autores.index" />

    {{-- Botón para móvil --}}
    <div class="md:hidden mt-4">
        <button type="button" onclick="toggleMobileFilter()"
            class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-white px-4 py-2.5 text-sm font-medium text-slate-700 
                   border border-slate-200 shadow-sm transition-all active:scale-95">
            <x-heroicon-s-funnel class="h-4 w-4" />
            Filtros
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-6 lg:gap-8 mt-4 sm:mt-6">

        {{-- Desktop: sidebar visible --}}
        <aside class="hidden md:block md:col-span-1">
            <div class="sticky top-6">
                <x-public.filter />
            </div>
        </aside>

        {{-- Main content --}}
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
                            } elseif (request('starts_with')) {
                                $filterText = 'Letra: ' . e(request('starts_with'));
                            }
                        @endphp

                        @if ($hasFilter && $filterText)
                            <span
                                class="inline-flex items-center gap-1.5 bg-indigo-50 text-indigo-700 text-xs sm:text-sm font-semibold px-3 py-1.5 rounded-full border border-indigo-200">
                                <x-heroicon-s-magnifying-glass class="w-3.5 h-3.5" />
                                {{ $filterText }}
                            </span>
                            <a href="{{ route('filtros.autores.index') }}"
                                class="text-xs text-slate-400 hover:text-red-500 transition-colors flex items-center gap-1">
                                <x-heroicon-s-x-mark class="w-3.5 h-3.5" />
                                Limpiar
                            </a>
                        @else
                            <span class="text-slate-400 text-xs sm:text-sm font-normal">(Todos los autores)</span>
                        @endif
                    </div>
                </div>

                <div class="bg-indigo-50 rounded-full px-3 py-1 shrink-0 w-fit">
                    <span class="text-xs font-semibold text-indigo-600">
                        <span class="font-bold">{{ $autores->total() }}</span> autores
                    </span>
                </div>
            </div>

            {{-- Filtro alfabético --}}
            <div class="w-full">
                <ul class="flex items-center gap-1.5 overflow-x-auto pb-2.5 scrollbar-thin scrollbar-thumb-slate-200">
                    @php $isAll = !request('starts_with') && !request('search'); @endphp

                    <li class="shrink-0">
                        <a href="{{ route('filtros.autores.index') }}"
                            class="flex items-center justify-center min-w-[54px] h-8 px-3 text-xs font-bold uppercase rounded-lg transition-all duration-150 active:scale-95
                            {{ $isAll ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 border border-slate-200' }}">
                            Todos
                        </a>
                    </li>

                    @foreach (range('A', 'Z') as $letter)
                        <li class="shrink-0">
                            <a href="{{ route('filtros.autores.index', ['starts_with' => $letter]) }}"
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
                <x-public.search :route="'filtros.autores.index'" :param="'search'" :descrip="'Introduce las primeras letras del autor...'" />
            </div>

            {{-- Barra de control --}}
            <div class="w-full flex flex-row items-center justify-between gap-3 py-2 border-b border-slate-100">
                <div class="text-xs sm:text-sm font-medium text-slate-500">
                    <x-public.count :contador="$autores->total()" :paginator="$autores" />
                </div>
                <div class="flex items-center justify-start sm:justify-end">
                    <x-public.advanced-filter route="filtros.autores.index" defaultSort="asc"
                        defaultItemsPerPage="10" />
                </div>
            </div>

            {{-- Lista de autores --}}
            @if ($autores->isEmpty())
                <div class="text-center py-12 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                    <x-heroicon-s-users class="w-12 h-12 text-slate-300 mx-auto mb-3" />
                    <p class="text-sm font-medium text-slate-500">
                        No se encontraron autores con esos criterios.
                    </p>
                    @if ($hasFilter)
                        <a href="{{ route('filtros.autores.index') }}"
                            class="inline-flex items-center gap-2 mt-4 px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                            <x-heroicon-s-arrow-path class="w-4 h-4" />
                            Limpiar filtros
                        </a>
                    @endif
                </div>
            @else
                <div class="flex flex-col gap-2 w-full">
                    @foreach ($autores as $autor)
                        <a href="{{ route('filtros.autores.informes', ['autor' => $autor]) }}"
                            class="group flex items-center justify-between p-3.5 sm:p-4 bg-white border border-slate-200 rounded-xl hover:border-indigo-300 hover:bg-indigo-50/5 hover:shadow-sm transition-all duration-200 active:scale-[0.995] focus:outline-none focus:ring-2 focus:ring-indigo-200">

                            <div class="flex items-center gap-3 min-w-0 pr-4">
                                <div
                                    class="p-2 bg-slate-50 rounded-lg text-slate-400 group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-colors shrink-0">
                                    <x-heroicon-s-user class="w-4 h-4" />
                                </div>
                                <span
                                    class="text-sm font-semibold text-slate-700 group-hover:text-indigo-600 transition-colors break-words line-clamp-1">
                                    {{ trim($autor->apellidos . ' ' . $autor->nombres) }}
                                </span>
                            </div>

                            <div class="flex items-center gap-2 shrink-0 ml-auto pl-2">
                                <span
                                    class="inline-flex items-center justify-center px-2.5 py-1 text-xs font-bold rounded-md bg-slate-100 text-slate-500 group-hover:bg-indigo-100 group-hover:text-indigo-600 transition-colors">
                                    {{ $autor->informes_count }}
                                    {{ $autor->informes_count === 1 ? 'documento' : 'documentos' }}
                                </span>
                                <x-heroicon-s-arrow-right
                                    class="w-4 h-4 text-slate-400 md:opacity-0 md:-translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-indigo-600 transition-all duration-200" />
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

            {{-- Paginación --}}
            @if ($autores->hasPages())
                <x-public.pagination :paginator="$autores" />
            @endif

        </main>
    </div>

</x-public.app-main>

{{-- Sidebar móvil flotante --}}
<div id="mobileFilterSidebar"
    class="fixed top-0 right-0 z-[1000] w-[85%] max-w-sm h-full bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out md:hidden">

    <div class="flex items-center justify-between border-b border-slate-200 p-4">
        <h3 class="font-semibold text-slate-800">Filtros</h3>
        <button type="button" onclick="toggleMobileFilter()" class="text-slate-400 hover:text-slate-600">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div class="overflow-y-auto h-full pb-20">
        <div class="p-4">
            <x-public.filter />
        </div>
    </div>
</div>

{{-- Overlay --}}
<div id="mobileFilterOverlay"
    class="fixed inset-0 bg-black/50 z-[999] opacity-0 invisible transition-all duration-300 md:hidden"
    onclick="toggleMobileFilter()"></div>

<script>
    function toggleMobileFilter() {
        const sidebar = document.getElementById('mobileFilterSidebar');
        const overlay = document.getElementById('mobileFilterOverlay');

        if (!sidebar) return;

        const isOpen = sidebar.classList.contains('translate-x-0');

        if (isOpen) {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('translate-x-full');
            overlay.classList.remove('opacity-100', 'visible');
            overlay.classList.add('opacity-0', 'invisible');
            document.body.style.overflow = '';
        } else {
            sidebar.classList.remove('translate-x-full');
            sidebar.classList.add('translate-x-0');
            overlay.classList.remove('opacity-0', 'invisible');
            overlay.classList.add('opacity-100', 'visible');
            document.body.style.overflow = 'hidden';
        }
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const sidebar = document.getElementById('mobileFilterSidebar');
            const overlay = document.getElementById('mobileFilterOverlay');
            if (sidebar && sidebar.classList.contains('translate-x-0')) {
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('translate-x-full');
                overlay.classList.remove('opacity-100', 'visible');
                overlay.classList.add('opacity-0', 'invisible');
                document.body.style.overflow = '';
            }
        }
    });
</script>
