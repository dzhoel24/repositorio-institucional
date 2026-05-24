<x-public.app-main title="Programas de Estudio">

    <x-public.breadcrumb name="filtros.carreras.index" />

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
        <main class="md:col-span-3 flex flex-col w-full px-0 space-y-5">

            {{-- Header --}}
            <div class="flex flex-row sm:items-center justify-between gap-3 border-b border-slate-200 pb-4">
                <div class="flex items-center gap-2.5 min-w-0 flex-wrap">
                    <div class="h-6 w-1 bg-indigo-600 rounded-full shrink-0"></div>
                    <h2 class="text-base sm:text-lg font-bold text-slate-800 tracking-wide">
                        ESPECIALIDADES ACADÉMICAS
                    </h2>
                </div>

                <div class="bg-indigo-50 rounded-full px-3 py-1 shrink-0 w-fit">
                    <span class="text-xs font-semibold text-indigo-600">
                        <span class="font-bold">{{ $carreras->count() }}</span>
                        <span class="hidden sm:inline"> programas</span>
                    </span>
                </div>
            </div>

            {{-- Lista de carreras --}}
            @if ($carreras->isEmpty())
                <div class="text-center py-12 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                    <x-heroicon-s-academic-cap class="w-12 h-12 text-slate-300 mx-auto mb-3" />
                    <p class="text-sm font-medium text-slate-500">
                        No se encontraron programas de estudio registrados.
                    </p>
                </div>
            @else
                <div class="flex flex-col gap-2 w-full">
                    @foreach ($carreras as $index => $carrera)
                        <a href="{{ route('repositorio.index', [
                            'tipo' => 'institucional',
                            'origen' => 'carrera',
                            'carrera_id' => $carrera->id
                        ]) }}"
                            class="group flex items-center justify-between p-3.5 sm:p-4 bg-white border border-slate-200 rounded-xl hover:border-indigo-300 hover:bg-indigo-50/5 hover:shadow-sm transition-all duration-200 active:scale-[0.995] focus:outline-none focus:ring-2 focus:ring-indigo-200">

                            <div class="flex items-center gap-3.5 pr-4 min-w-0">
                                <span
                                    class="text-xs font-mono font-bold text-slate-300 group-hover:text-indigo-400 transition-colors shrink-0 w-6">
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
