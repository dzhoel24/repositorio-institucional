<!DOCTYPE html>
<html lang="es" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repositorio | {{ $title ?? 'Carlos Salazar Romero' }}</title>
    <link rel="shortcut icon" href="{{ asset('images/icono-csr.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased flex flex-col min-h-full">

    <header
        class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50 flex items-center justify-between h-16 sm:h-20 px-4 sm:px-6 lg:px-8 transition-all">
        <a href="/" class="group rounded-lg">
            <div class="flex items-center gap-2 sm:gap-3">
                <div
                    class="relative overflow-hidden rounded-xl bg-slate-100 p-1 transition-transform duration-300 group-hover:scale-105">
                    <img class="w-8 h-8 sm:w-10 sm:h-10 md:w-11 md:h-11 object-contain"
                        src="{{ asset('images/icono-csr.ico') }}" alt="Logo Institucional" loading="lazy">
                </div>
                <div class="flex flex-col">
                    <h1
                        class="text-sm sm:text-base md:text-lg font-black leading-none tracking-tight uppercase text-slate-900">
                        Repositorio <span
                            class="text-indigo-600 transition-colors group-hover:text-indigo-500">Digital</span>
                    </h1>
                    <span
                        class="text-[9px] sm:text-[10px] md:text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">
                        Carlos Salazar Romero
                    </span>
                </div>
            </div>
        </a>

        <div class="flex items-center gap-2">
            {{-- Botón filtros móvil (solo cuando showFilter es true) --}}
            @if ($showFilter)
                <button type="button" onclick="toggleMobileFilter()"
                    class="lg:hidden inline-flex items-center justify-center gap-2 rounded-lg bg-white px-3 py-2 text-sm font-medium text-slate-700 border border-slate-200 shadow-sm transition-all active:scale-95">
                    <x-heroicon-s-funnel class="h-4 w-4" />
                    <span class="hidden sm:inline">Filtros</span>
                </button>
            @endif

            <a href="{{ route('login') }}"
                class="group inline-flex items-center gap-1.5 sm:gap-2 px-3 sm:px-5 py-1.5 sm:py-2 text-xs sm:text-sm font-bold uppercase tracking-wider text-indigo-700 bg-indigo-50/60 rounded-xl border border-indigo-200/60 shadow-sm transition-all duration-200 hover:bg-indigo-100/80 hover:border-indigo-300/80 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <span>Ingresar</span>
                <x-heroicon-s-arrow-right-on-rectangle
                    class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-indigo-600/80 transition-all duration-200 group-hover:text-indigo-700 group-hover:translate-x-0.5" />
            </a>
        </div>
    </header>

    <main class="flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if ($showFilter)
                {{-- Layout con sidebar --}}
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:gap-8 mt-4 sm:mt-6">

                    <aside class="hidden lg:block">
                        <div class="sticky top-6">
                            <x-public.filter />
                        </div>
                    </aside>

                    <div class="lg:col-span-3">
                        {{ $slot }}
                    </div>
                </div>

                {{-- Sidebar móvil flotante --}}
                <div id="mobileFilterSidebar"
                    class="fixed top-0 right-0 z-[1000] w-[85%] max-w-sm h-full bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out lg:hidden">
                    <div class="flex items-center justify-between border-b border-slate-200 p-4">
                        <span class="font-bold text-slate-700">Filtros</span>
                        <button type="button" onclick="toggleMobileFilter()"
                            class="text-slate-400 hover:text-slate-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
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
            @else
                {{-- Layout sin sidebar --}}
                <div class="mt-4 sm:mt-6">
                    {{ $slot }}
                </div>
            @endif

        </div>
    </main>

    <footer class="bg-white border-t border-slate-200 py-6 mt-8">
        <div class="max-w-7xl mx-auto px-6 text-center text-slate-400 font-medium text-xs uppercase tracking-widest">
            &copy; {{ date('Y') }} I.E.S.T.P "Carlos Salazar Romero" - Todos los derechos reservados
        </div>
    </footer>

    @vite(['resources/js/tabs.js'])

    @if ($showFilter)
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
                    if (sidebar && sidebar.classList.contains('translate-x-0')) {
                        toggleMobileFilter();
                    }
                }
            });
        </script>
    @endif

</body>

</html>
