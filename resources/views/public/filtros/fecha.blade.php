<x-public.app-main title="Fecha de Publicación">

    <x-public.breadcrumb name="filtros.fechas.index" />

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

            {{-- Header --}}
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="h-6 w-1 bg-indigo-600 rounded-full shrink-0"></div>
                    <h2 class="text-base sm:text-lg font-bold text-slate-800 tracking-wide">
                        LISTAR POR FECHA DE PUBLICACIÓN
                    </h2>
                </div>
            </div>

            {{-- Rangos de años --}}
            <div class="w-full">
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-200 shadow-sm">
                    <h3
                        class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3 flex items-center gap-1.5">
                        <x-heroicon-s-calendar class="w-3.5 h-3.5" />
                        Rangos de años
                    </h3>

                    <div class="flex flex-wrap gap-2">
                        @php
                            $currentRange = request()->route('range') ?? request()->get('range');
                        @endphp

                        @foreach ($yearRanges as $range)
                            <a href="{{ route('filtros.fechas.rango', ['range' => $range]) }}"
                                class="px-3.5 py-2 rounded-lg text-xs sm:text-sm font-semibold transition-all duration-150 active:scale-95 border
                                {{ $currentRange == $range
                                    ? 'bg-indigo-600 text-white border-indigo-600 shadow-sm'
                                    : 'bg-white text-slate-600 border-slate-200 hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-200' }}">
                                {{ $range }}
                            </a>
                        @endforeach
                    </div>

                    @if ($currentRange)
                        <div
                            class="mt-4 pt-3 border-t border-slate-200 flex items-center justify-between flex-wrap gap-2">
                            <div class="flex items-center gap-1.5 text-xs text-slate-500">
                                <span>Filtro activo:</span>
                                <span class="px-2 py-0.5 bg-indigo-100 text-indigo-700 font-semibold rounded-md">
                                    {{ $currentRange }}
                                </span>
                            </div>
                            <a href="{{ route('filtros.fechas.index') }}"
                                class="inline-flex items-center gap-1 text-xs font-semibold text-rose-500 hover:text-rose-600 transition-colors bg-rose-50 hover:bg-rose-100 px-2.5 py-1 rounded-md">
                                <x-heroicon-s-x-mark class="w-3 h-3" />
                                Limpiar filtro
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Buscador --}}
            <div class="w-full">
                <x-public.search :route="'filtros.fechas.index'" :param="'search'" :descrip="'Introduce un año de publicación específico...'" :text="'Buscar'" />
            </div>

            {{-- Barra de control --}}
            <div class="w-full flex flex-row sm:items-center justify-between gap-3 py-2 border-b border-slate-100">
                <div class="text-xs sm:text-sm font-medium text-slate-500">
                    <x-public.count :contador="$contador" :paginator="$publi_fecha" />
                </div>
                <div class="flex items-center justify-start sm:justify-end">
                    <x-public.advanced-filter route="filtros.fechas.index" defaultSort="asc" defaultItemsPerPage="10" />
                </div>
            </div>

            {{-- Lista de documentos --}}
            <div class="w-full space-y-3">
                @forelse ($publi_fecha as $informe)
                    <x-public.card :parametro="$informe->tipo_slug ?? 'institucional'" :action="'show'" :origen="'fecha'" :codigo="$informe->id"
                        :image="$informe->ruta_caratula" :title="$informe->titulo" :anio="$informe->anio" :resumen="$informe->resumen" :autores="$informe->autores_formatted"
                        :acceso="$informe->acceso" />
                @empty
                    <div class="text-center py-12 bg-slate-50/50 rounded-xl border border-dashed border-slate-200">
                        <x-heroicon-s-calendar class="w-10 h-10 text-slate-300 mx-auto mb-3" />
                        <p class="text-sm font-medium text-slate-500 px-4">
                            No se encontraron publicaciones para este año o período.
                        </p>
                        @if ($currentRange || request('search'))
                            <a href="{{ route('filtros.fechas.index') }}"
                                class="inline-flex items-center gap-2 mt-4 px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                                <x-heroicon-s-arrow-path class="w-4 h-4" />
                                Limpiar filtros
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>

            {{-- Paginación --}}
            @if ($publi_fecha->hasPages())
                <x-public.pagination :paginator="$publi_fecha" />
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
