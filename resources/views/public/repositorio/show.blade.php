<x-public.app-main :title="$informe->titulo">

    <x-public.breadcrumb name="repositorio.show" :params="[$tipo, $informe->id, $origen ?? null, $origenData ?? null]" />

    {{-- Botón para móvil --}}
    <div class="lg:hidden mt-4">
        <button type="button" onclick="toggleMobileFilter()"
            class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-white px-4 py-2.5 text-sm font-medium text-slate-700 
                   border border-slate-200 shadow-sm transition-all active:scale-95">
            <x-heroicon-s-funnel class="h-4 w-4" />
            Filtros
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:gap-8 mt-4 sm:mt-6">

        {{-- Desktop: sidebar visible --}}
        <aside class="hidden lg:block">
            <div class="sticky top-6">
                <x-public.filter />
            </div>
        </aside>

        {{-- Main content --}}
        <div class="lg:col-span-3 space-y-4">

            {{-- Botón volver --}}
            <div class="flex justify-start">
                @php
                    $previousUrl = url()->previous();
                    $currentUrl = url()->current();
                    $backUrl =
                        $previousUrl !== $currentUrl && !empty($previousUrl)
                            ? $previousUrl
                            : route('repositorio.index', ['tipo' => $tipo]);
                @endphp

                <a href="{{ $backUrl }}"
                    class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 hover:text-slate-700 transition-all duration-200">
                    <x-heroicon-s-arrow-left class="w-4 h-4" />
                    Volver
                </a>
            </div>

            {{-- Informe --}}
            <x-public.item :codigo="$informe->id" :pdf="$informe->ruta_pdf" :image="$informe->ruta_caratula" :title="$informe->titulo" :resumen="$informe->resumen"
                :autores="$informe->autores_formatted" :acceso="$informe->acceso" :anio="$informe->anio" :tipo="$informe->tipoInforme->nombre ?? 'No especificado'" />

        </div>
    </div>

</x-public.app-main>

{{-- Sidebar móvil flotante --}}
<div id="mobileFilterSidebar"
    class="fixed top-0 right-0 z-[1000] w-[85%] max-w-sm h-full bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out lg:hidden">

    <div class="flex items-center justify-between border-b border-slate-200 p-4">
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
    class="fixed inset-0 bg-black/50 z-[999] opacity-0 invisible transition-all duration-300 lg:hidden"
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

    // Cerrar con tecla ESC
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
