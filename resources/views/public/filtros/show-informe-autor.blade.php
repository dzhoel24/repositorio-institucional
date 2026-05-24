<x-public.app-main title="Informes por Autor">
    <x-public.breadcrumb name="filtros.autores.informes" :params="[$autor]" />

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
        <main class="md:col-span-3 flex flex-col w-full px-2 sm:px-4 space-y-5">

            {{-- Buscador --}}
            <div class="py-2">
                <x-public.search :route="'filtros.autores.informes'" :params="['autor' => $autor->dni]" :descrip="'Buscar por título del documento...'" :text="'Buscar'"
                    :param="'search'" />
            </div>

            {{-- Header del autor (responsivo: vertical en móvil, horizontal en desktop) --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-200 pb-3">
                <div class="flex items-start sm:items-center gap-2.5 min-w-0 flex-1">
                    <div class="h-6 w-1 bg-indigo-600 rounded-full shrink-0 mt-0.5 sm:mt-0"></div>
                    <div class="min-w-0 flex-1">
                        <h2 class="text-base sm:text-lg font-bold text-slate-800">
                            Publicaciones de:
                        </h2>
                        <p
                            class="text-indigo-600 font-extrabold break-words text-base sm:text-lg sm:inline sm:ml-1 mt-0.5 sm:mt-0">
                            {{ trim(($autor->nombres ?? '') . ' ' . ($autor->apellidos ?? '')) }}
                        </p>
                    </div>
                </div>

                <div class="bg-indigo-50 rounded-full px-3 py-1 w-fit shrink-0">
                    <span class="text-xs font-semibold text-indigo-600">
                        <span class="font-bold">{{ $informes->total() }}</span> publicaciones
                    </span>
                </div>
            </div>

            {{-- Barra de utilidades --}}
            <div class="w-full flex flex-row items-center justify-between gap-3 border-b border-slate-100">
                <div class="text-xs sm:text-sm font-medium text-slate-500">
                    <x-public.count :contador="$informes->total()" :paginator="$informes" />
                </div>
                <div class="flex items-center justify-start sm:justify-end">
                    <x-public.advanced-filter route="filtros.autores.informes" :params="['autor' => $autor->dni]" defaultSort="asc"
                        defaultItemsPerPage="10" />
                </div>
            </div>

            {{-- Lista de informes --}}
            <div class="flex flex-col gap-4 w-full pt-1">
                @forelse ($informes as $informe)
                    <x-public.card :parametro="$informe->tipo_slug" :action="'show'" :codigo="$informe->id" :image="$informe->ruta_caratula"
                        :title="$informe->titulo" :resumen="$informe->resumen" :anio="$informe->anio" :autores="$informe->autores_formatted" :acceso="$informe->acceso"
                        :origen="'autor'" :origenId="$autor->dni" />
                @empty
                    <div class="text-center py-12 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                        <x-heroicon-s-user class="w-12 h-12 text-slate-300 mx-auto mb-3" />
                        <p class="text-sm font-medium text-slate-500">
                            @if (request('search'))
                                No se encontraron publicaciones que coincidan con "{{ request('search') }}"
                            @else
                                No se encontraron publicaciones para este autor.
                            @endif
                        </p>
                        <div class="flex items-center justify-center gap-3 mt-4 flex-wrap">
                            <a href="{{ route('filtros.autores.index') }}"
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                                <x-heroicon-s-arrow-left class="w-4 h-4" />
                                Volver a autores
                            </a>
                            @if (request('search'))
                                <a href="{{ route('filtros.autores.informes', ['autor' => $autor]) }}"
                                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">
                                    <x-heroicon-s-x-mark class="w-4 h-4" />
                                    Limpiar búsqueda
                                </a>
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Paginación --}}
            @if ($informes->hasPages())
                <x-public.pagination :paginator="$informes" />
            @endif

        </main>
    </div>

</x-public.app-main>

{{-- Sidebar móvil flotante --}}
<div id="mobileFilterSidebar"
    class="fixed top-0 right-0 z-[1000] w-[85%] max-w-sm h-full bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out md:hidden">

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
