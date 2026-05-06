<!DOCTYPE html>
<html lang="es" class="bg-slate-50 dark:bg-slate-900">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title">Repositorio | @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/htmx.org@2.0.4"></script>
    <script src="https://unpkg.com/htmx-ext-preload@2.0.1/preload.js"></script>
    <link rel="shortcut icon" href="{{ asset('images/icono-csr.ico') }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        (function() {
            const theme = localStorage.getItem('theme');
            const collapsed = localStorage.getItem('sidebar-collapsed');
            if (theme === 'dark') document.documentElement.classList.add('dark');
            if (collapsed === 'true') document.documentElement.classList.add('sidebar-collapsed');
        })();
    </script>

    <style>
        html,
        body {
            height: 100%;
            font-family: 'Outfit', system-ui, sans-serif;
        }
    </style>
</head>

<body hx-ext="preload"
    class="bg-slate-50 text-slate-900 transition-colors duration-200 dark:bg-slate-900 dark:text-slate-100">

    <div id="overlay" onclick="closeSidebar()" aria-hidden="true"
        class="sidebar-overlay fixed inset-0 z-[199] bg-black/50 backdrop-blur-sm"></div>

    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        <aside id="sidebar" role="navigation" aria-label="Menú principal"
            class="sidebar-wrapper relative left-0 top-0 z-[200] flex h-screen shrink-0 flex-col overflow-y-auto border-r border-slate-200 bg-slate-50 transition-transform duration-300 dark:border-slate-700 dark:bg-slate-900 md:relative">

            <!-- Logo -->
            <div
                class="sidebar-header flex shrink-0 items-center gap-3 border-b border-slate-200 px-4 py-4 dark:border-slate-700">
                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-slate-100 ring-1 ring-slate-200 dark:bg-slate-800 dark:ring-slate-700">
                    <img src="{{ asset('images/logo-csr.png') }}" alt="Logo CSR" class="h-7 w-7 object-contain" />
                </div>
                <div class="sidebar-text flex flex-col overflow-hidden transition-opacity duration-200">
                    <span
                        class="whitespace-nowrap text-sm font-bold text-slate-900 dark:text-slate-100">Repositorio</span>
                    <span class="whitespace-nowrap text-xs font-medium text-sky-600 dark:text-sky-400">Carlos Salazar
                        R.</span>
                </div>
            </div>

            <!-- Principal -->
            <div class="mt-4 px-3">
                <p
                    class="section-label mb-2 px-2 text-[10px] font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                    Principal</p>

                <a href="{{ route('admin.index') }}" data-route="{{ route('admin.index') }}" data-title="Inicio"
                    data-tooltip="Inicio" hx-get="{{ route('admin.index') }}" hx-target="#main-content"
                    hx-swap="innerHTML" hx-push-url="true" preload="mouseover"
                    class="nav-item group mb-1 flex cursor-pointer items-center gap-3 rounded-lg px-3 py-2.5 text-slate-600 transition-colors duration-150 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-100 [&.active]:bg-sky-50 [&.active]:text-sky-700 dark:[&.active]:bg-sky-500/10 dark:[&.active]:text-sky-400">
                    <span
                        class="active-indicator absolute left-0 h-6 w-1 rounded-r-full bg-sky-500 dark:bg-sky-400"></span>
                    <x-heroicon-s-home
                        class="nav-icon w-5 h-5 shrink-0 text-slate-400 transition-colors group-hover:text-sky-500 dark:text-slate-500 dark:group-hover:text-sky-400"
                        aria-hidden="true" />
                    <span class="nav-text flex-1 whitespace-nowrap text-sm font-medium">Inicio</span>
                </a>
            </div>

            <!-- Gestión -->
            <div class="mt-4 px-3">
                <p
                    class="section-label mb-2 px-2 text-[10px] font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                    Gestión</p>

                <!-- Proyectos -->
                <div class="nav-group relative">
                    <button type="button" onclick="toggleDropdown('sub-proyectos', 'arr-proyectos', this)"
                        aria-expanded="false" aria-controls="sub-proyectos"
                        data-parent-for="{{ route('admin.informes.index') }}" data-tooltip="Proyectos"
                        class="dropdown-trigger group mb-1 flex w-full cursor-pointer items-center gap-3 rounded-lg px-3 py-2.5 text-slate-600 transition-colors duration-150 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-100 [&.parent-active]:bg-sky-50 [&.parent-active]:text-sky-700 dark:[&.parent-active]:bg-sky-500/10 dark:[&.parent-active]:text-sky-400">
                        <span
                            class="active-indicator absolute left-0 h-6 w-1 rounded-r-full bg-sky-500 dark:bg-sky-400"></span>
                        <x-heroicon-s-folder-open
                            class="drop-icon w-5 h-5 shrink-0 text-slate-400 transition-colors group-hover:text-sky-500 dark:text-slate-500 dark:group-hover:text-sky-400"
                            aria-hidden="true" />
                        <span class="drop-text flex-1 whitespace-nowrap text-left text-sm font-medium">Proyectos</span>
                        <x-heroicon-s-chevron-right id="arr-proyectos"
                            class="drop-arrow w-3.5 h-3.5 text-slate-300 transition-transform dark:text-slate-600"
                            aria-hidden="true" />
                    </button>

                    <div class="sub-menu" id="sub-proyectos" role="region">
                        <a href="{{ route('admin.informes.index') }}" data-route="{{ route('admin.informes.index') }}"
                            data-title="Gestión de Proyectos" hx-get="{{ route('admin.informes.index') }}"
                            hx-target="#main-content" hx-swap="innerHTML" hx-push-url="true" preload="mouseover"
                            class="sub-item group mb-1 flex cursor-pointer items-center gap-2.5 rounded-lg py-2 pl-10 pr-3 text-sm text-slate-500 transition-colors duration-150 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-100 [&.active]:font-medium [&.active]:text-sky-600 dark:[&.active]:text-sky-400">
                            <span
                                class="h-1 w-1 shrink-0 rounded-full bg-slate-300 transition-colors group-hover:bg-sky-500 dark:bg-slate-600 dark:group-hover:bg-sky-400"
                                aria-hidden="true"></span>
                            <span class="sub-text whitespace-nowrap">Ver todos los proyectos</span>
                        </a>
                    </div>
                </div>

                <!-- Publicaciones -->
                <div class="nav-group relative">
                    <button type="button" onclick="toggleDropdown('sub-publicaciones', 'arr-publicaciones', this)"
                        aria-expanded="false" aria-controls="sub-publicaciones"
                        data-parent-for="{{ route('admin.publicaciones.index') }}" data-tooltip="Publicaciones"
                        class="dropdown-trigger group mb-1 flex w-full cursor-pointer items-center gap-3 rounded-lg px-3 py-2.5 text-slate-600 transition-colors duration-150 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-100 [&.parent-active]:bg-sky-50 [&.parent-active]:text-sky-700 dark:[&.parent-active]:bg-sky-500/10 dark:[&.parent-active]:text-sky-400">
                        <span
                            class="active-indicator absolute left-0 h-6 w-1 rounded-r-full bg-sky-500 dark:bg-sky-400"></span>
                        <x-heroicon-s-document-text
                            class="drop-icon w-5 h-5 shrink-0 text-slate-400 transition-colors group-hover:text-sky-500 dark:text-slate-500 dark:group-hover:text-sky-400"
                            aria-hidden="true" />
                        <span
                            class="drop-text flex-1 whitespace-nowrap text-left text-sm font-medium">Publicaciones</span>
                        <x-heroicon-s-chevron-right id="arr-publicaciones"
                            class="drop-arrow w-3.5 h-3.5 text-slate-300 transition-transform dark:text-slate-600"
                            aria-hidden="true" />
                    </button>

                    <div class="sub-menu" id="sub-publicaciones" role="region">
                        <a href="{{ route('admin.publicaciones.index') }}"
                            data-route="{{ route('admin.publicaciones.index') }}"
                            data-title="Gestión de Publicaciones" hx-get="{{ route('admin.publicaciones.index') }}"
                            hx-target="#main-content" hx-swap="innerHTML" hx-push-url="true" preload="mouseover"
                            class="sub-item group mb-1 flex cursor-pointer items-center gap-2.5 rounded-lg py-2 pl-10 pr-3 text-sm text-slate-500 transition-colors duration-150 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-100 [&.active]:font-medium [&.active]:text-sky-600 dark:[&.active]:text-sky-400">
                            <span
                                class="h-1 w-1 shrink-0 rounded-full bg-slate-300 transition-colors group-hover:bg-sky-500 dark:bg-slate-600 dark:group-hover:bg-sky-400"
                                aria-hidden="true"></span>
                            <span class="sub-text whitespace-nowrap">Ver todas las publicaciones</span>
                        </a>
                    </div>
                </div>

                <!-- Autores -->
                <a href="{{ route('admin.autores.index') }}" data-route="{{ route('admin.autores.index') }}"
                    data-title="Directorio de Autores" data-tooltip="Autores"
                    hx-get="{{ route('admin.autores.index') }}" hx-target="#main-content" hx-swap="innerHTML"
                    hx-push-url="true" preload="mouseover"
                    class="nav-item group mb-1 flex cursor-pointer items-center gap-3 rounded-lg px-3 py-2.5 text-slate-600 transition-colors duration-150 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-100 [&.active]:bg-sky-50 [&.active]:text-sky-700 dark:[&.active]:bg-sky-500/10 dark:[&.active]:text-sky-400">
                    <span
                        class="active-indicator absolute left-0 h-6 w-1 rounded-r-full bg-sky-500 dark:bg-sky-400"></span>
                    <x-heroicon-s-users
                        class="nav-icon w-5 h-5 shrink-0 text-slate-400 transition-colors group-hover:text-sky-500 dark:text-slate-500 dark:group-hover:text-sky-400"
                        aria-hidden="true" />
                    <span class="nav-text flex-1 whitespace-nowrap text-sm font-medium">Autores</span>
                </a>
            </div>

            <!-- Soporte -->
            <div class="mb-4 mt-4 px-3">
                <div class="mb-3 h-px bg-slate-200 dark:bg-slate-700"></div>
                <p
                    class="section-label mb-2 px-2 text-[10px] font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                    Soporte</p>

                <a href="{{ route('admin.manual') }}" data-route="{{ route('admin.manual') }}"
                    data-title="Manual de Usuario" data-tooltip="Manual de uso" hx-get="{{ route('admin.manual') }}"
                    hx-target="#main-content" hx-swap="innerHTML" hx-push-url="true" preload="mouseover"
                    class="nav-item group flex cursor-pointer items-center gap-3 rounded-lg px-3 py-2.5 text-slate-600 transition-colors duration-150 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-100 [&.active]:bg-sky-50 [&.active]:text-sky-700 dark:[&.active]:bg-sky-500/10 dark:[&.active]:text-sky-400">
                    <span
                        class="active-indicator absolute left-0 h-6 w-1 rounded-r-full bg-sky-500 dark:bg-sky-400"></span>
                    <x-heroicon-s-book-open
                        class="nav-icon w-5 h-5 shrink-0 text-slate-400 transition-colors group-hover:text-sky-500 dark:text-slate-500 dark:group-hover:text-sky-400"
                        aria-hidden="true" />
                    <span class="nav-text flex-1 whitespace-nowrap text-sm font-medium">Manual de uso</span>
                </a>
            </div>

            <div class="flex-1"></div>

            <!-- Footer -->
            <div class="sidebar-footer mt-auto border-t border-slate-200 px-3 py-3 dark:border-slate-700">
                <button type="button" id="collapseBtn" onclick="toggleCollapse()" aria-label="Colapsar menú"
                    class="collapse-btn group flex w-full cursor-pointer items-center gap-3 rounded-lg px-3 py-2 text-slate-500 transition-colors duration-150 hover:bg-slate-100 hover:text-slate-700 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-200">
                    <div
                        class="collapse-icon-wrapper flex w-5 h-5 shrink-0 items-center justify-center transition-transform duration-200">
                        <x-heroicon-s-chevron-double-left class="collapse-icon w-4 h-4" aria-hidden="true" />
                    </div>
                    <span class="collapse-text whitespace-nowrap text-sm font-medium">Ocultar menú</span>
                </button>
            </div>
        </aside>

        <!-- MAIN WRAPPER -->
        <div class="main-wrapper flex min-w-0 flex-1 flex-col overflow-hidden transition-all duration-200">

            <!-- TOPBAR -->
            <header
                class="z-10 flex h-16 shrink-0 items-center justify-between gap-4 border-b border-slate-200 bg-white px-4 dark:border-slate-700 dark:bg-slate-800 sm:px-6">
                <div class="flex items-center gap-3">
                    <button id="hamburger" type="button" onclick="toggleSidebar()"
                        aria-label="Abrir menú de navegación" aria-expanded="false" aria-controls="sidebar"
                        class="hamburger hidden h-9 w-9 cursor-pointer flex-col items-center justify-center gap-1 rounded-lg border border-slate-200 bg-white transition-colors duration-150 hover:bg-slate-50 dark:border-slate-600 dark:bg-slate-700 dark:hover:bg-slate-600">
                        <span class="block h-0.5 w-4 rounded-full bg-slate-500 dark:bg-slate-300"></span>
                        <span class="block h-0.5 w-4 rounded-full bg-slate-500 dark:bg-slate-300"></span>
                        <span class="block h-0.5 w-4 rounded-full bg-slate-500 dark:bg-slate-300"></span>
                    </button>

                    <nav aria-label="Ruta de navegación"
                        class="breadcrumb flex items-center gap-2 text-sm text-slate-400 dark:text-slate-500">
                        <x-heroicon-s-squares-2x2 class="w-4 h-4" aria-hidden="true" />
                        <span aria-hidden="true">/</span>
                        <span id="breadcrumb-title" class="font-semibold text-slate-700 dark:text-slate-200">
                            @yield('title', 'Inicio')
                        </span>
                    </nav>
                </div>

                <div class="flex items-center gap-2">
                    <button id="themeBtn" type="button" onclick="toggleTheme()" aria-label="Cambiar tema de color"
                        class="flex h-9 w-9 cursor-pointer items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 transition-colors duration-150 hover:bg-slate-50 hover:text-slate-700 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-300 dark:hover:bg-slate-600 dark:hover:text-slate-100">
                        <x-heroicon-s-moon class="w-5 h-5 block dark:hidden" aria-hidden="true" />
                        <x-heroicon-s-sun class="w-5 h-5 hidden dark:block" aria-hidden="true" />
                    </button>

                    <div class="h-5 w-px bg-slate-200 dark:bg-slate-600" aria-hidden="true"></div>

                    <div class="relative" id="profileArea">
                        <button type="button" onclick="toggleProfile()" aria-label="Menú de perfil de usuario"
                            aria-expanded="false" aria-controls="profileDropdown" id="profileBtn"
                            class="flex cursor-pointer items-center gap-2 rounded-lg border border-transparent px-2 py-1.5 transition-colors duration-150 hover:border-slate-200 hover:bg-slate-50 dark:hover:border-slate-600 dark:hover:bg-slate-700">
                            <div
                                class="h-8 w-8 shrink-0 overflow-hidden rounded-full ring-2 ring-sky-200 dark:ring-sky-500/30">
                                <img src="{{ asset('storage/profile/' . Auth::user()->profile_photo) }}"
                                    alt="Foto de perfil de {{ Auth::user()->full_name }}"
                                    class="h-full w-full object-cover" />
                            </div>
                            <div class="hidden flex-col text-left sm:flex">
                                <span
                                    class="text-sm font-semibold text-slate-900 dark:text-slate-100">{{ Auth::user()->username }}</span>
                                <span class="text-xs text-slate-500 dark:text-slate-400">Administrador</span>
                            </div>
                            <x-heroicon-s-chevron-down id="profileArrow"
                                class="hidden w-3 h-3 text-slate-400 transition-transform duration-150 dark:text-slate-500 sm:block"
                                aria-hidden="true" />
                        </button>

                        <div id="profileDropdown" role="menu" aria-labelledby="profileBtn"
                            class="profile-dropdown absolute right-0 top-[calc(100%+8px)] z-[300] min-w-[200px] overflow-hidden rounded-xl border border-slate-200 bg-white shadow-lg dark:border-slate-700 dark:bg-slate-800">
                            <div
                                class="flex items-center gap-3 border-b border-slate-100 bg-slate-50 px-4 py-3 dark:border-slate-700 dark:bg-slate-800/50">
                                <div
                                    class="h-10 w-10 shrink-0 overflow-hidden rounded-full ring-2 ring-sky-200 dark:ring-sky-500/30">
                                    <img src="{{ asset('storage/profile/' . Auth::user()->profile_photo) }}"
                                        alt="" aria-hidden="true" class="h-full w-full object-cover" />
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-slate-100">
                                        {{ Auth::user()->full_name }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">Administrador</p>
                                </div>
                            </div>

                            <div class="py-1" role="none">
                                <a href="{{ route('admin.perfil') }}" hx-get="{{ route('admin.perfil') }}"
                                    hx-target="#main-content" hx-swap="innerHTML" hx-push-url="true"
                                    data-title="Mi Perfil" preload="mouseover" role="menuitem"
                                    onclick="closeProfile()"
                                    class="group flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 transition-colors duration-150 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-slate-100">
                                    <x-heroicon-s-user-circle
                                        class="w-5 h-5 shrink-0 text-slate-400 transition-colors group-hover:text-sky-500 dark:text-slate-500 dark:group-hover:text-sky-400"
                                        aria-hidden="true" />
                                    Mi perfil
                                </a>
                            </div>

                            <div class="h-px bg-slate-100 dark:bg-slate-700" role="separator"></div>

                            <div class="py-1" role="none">
                                <button type="button" role="menuitem" onclick="confirmLogout()"
                                    class="group flex w-full cursor-pointer items-center gap-3 px-4 py-2.5 text-sm text-red-500 transition-colors duration-150 hover:bg-red-50 hover:text-red-600 dark:hover:bg-red-500/10">
                                    <x-heroicon-s-arrow-right-on-rectangle
                                        class="w-5 h-5 shrink-0 text-red-400 transition-colors group-hover:text-red-500"
                                        aria-hidden="true" />
                                    Cerrar sesión
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- MAIN CONTENT -->
            <main id="main-content" class="flex-1 overflow-y-auto bg-white p-4 dark:bg-slate-800 sm:p-6 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <script>
        (function() {

            function applyTheme(dark) {
                document.documentElement.classList.toggle('dark', dark);
                const btn = document.getElementById('themeBtn');
                if (btn) btn.setAttribute('aria-label', dark ? 'Cambiar a tema claro' : 'Cambiar a tema oscuro');
                localStorage.setItem('theme', dark ? 'dark' : 'light');
            }

            function toggleTheme() {
                applyTheme(!document.documentElement.classList.contains('dark'));
            }

            (function() {
                const dark = document.documentElement.classList.contains('dark');
                const btn = document.getElementById('themeBtn');
                if (btn) btn.setAttribute('aria-label', dark ? 'Cambiar a tema claro' : 'Cambiar a tema oscuro');
            })();

            function toggleCollapse() {
                const isCollapsed = document.documentElement.classList.toggle('sidebar-collapsed');
                localStorage.setItem('sidebar-collapsed', isCollapsed);
                if (isCollapsed) {
                    document.querySelectorAll('.sub-menu.open').forEach(menu => {
                        menu.classList.remove('open');
                        const arrow = document.getElementById(menu.id.replace('sub-', 'arr-'));
                        if (arrow) arrow.classList.remove('open');
                    });
                }
            }

            function updateActiveState() {
                const current = window.location.pathname;

                document.querySelectorAll('.nav-item, .sub-item, .dropdown-trigger').forEach(el => {
                    el.classList.remove('active', 'parent-active');
                    const indicator = el.querySelector('.active-indicator');
                    if (indicator) indicator.classList.remove('visible');
                });

                document.querySelectorAll('.nav-item[data-route]').forEach(el => {
                    const route = el.getAttribute('data-route').replace(window.location.origin, '');
                    const isActive = (route === '/' || route === '/admin') ?
                        current === route :
                        (current === route || current.startsWith(route + '/'));
                    el.classList.toggle('active', isActive);
                    if (isActive) {
                        const indicator = el.querySelector('.active-indicator');
                        if (indicator) indicator.classList.add('visible');
                    }
                });

                document.querySelectorAll('.sub-item[data-route]').forEach(el => {
                    const route = el.getAttribute('data-route').replace(window.location.origin, '');
                    const isActive = current === route || current.startsWith(route + '/');
                    el.classList.toggle('active', isActive);
                    if (isActive) {
                        const submenu = el.closest('.sub-menu');
                        if (submenu) {
                            submenu.classList.add('open');
                            const arrow = document.getElementById(submenu.id.replace('sub-', 'arr-'));
                            if (arrow) arrow.classList.add('open');
                            const trigger = document.querySelector(`[aria-controls="${submenu.id}"]`);
                            if (trigger) {
                                trigger.classList.add('parent-active');
                                trigger.setAttribute('aria-expanded', 'true');
                                const indicator = trigger.querySelector('.active-indicator');
                                if (indicator) indicator.classList.add('visible');
                            }
                            saveDropdownState(submenu.id, true);
                        }
                    }
                });
            }
            // ── Inicializar breadcrumb al cargar ──
            function initBreadcrumb() {
                const current = window.location.pathname;
                const breadcrumb = document.getElementById('breadcrumb-title');
                if (!breadcrumb) return;

                // Busca en todos los links del sidebar el que coincida con la URL actual
                const allLinks = document.querySelectorAll('[data-route][data-title]');
                let title = null;

                allLinks.forEach(el => {
                    const route = el.getAttribute('data-route').replace(window.location.origin, '');
                    const isMatch = (route === '/' || route === '/admin/dashboard') ?
                        current === route :
                        (current === route || current.startsWith(route + '/'));
                    if (isMatch) title = el.getAttribute('data-title');
                });

                if (title) {
                    breadcrumb.textContent = title;
                    document.title = 'Repositorio | ' + title;
                }
            }
            // ── Actualiza breadcrumb Y pestaña del navegador ──
            function updatePageMeta(title) {
                if (!title) return;
                const breadcrumb = document.getElementById('breadcrumb-title');
                if (breadcrumb) breadcrumb.textContent = title;
                document.title = 'Repositorio | ' + title;
            }

            function saveDropdownState(menuId, open) {
                try {
                    const states = JSON.parse(sessionStorage.getItem('sidebar-dropdowns') || '{}');
                    states[menuId] = open;
                    sessionStorage.setItem('sidebar-dropdowns', JSON.stringify(states));
                } catch (_) {}
            }

            function restoreDropdownStates() {
                try {
                    const states = JSON.parse(sessionStorage.getItem('sidebar-dropdowns') || '{}');
                    Object.entries(states).forEach(([menuId, open]) => {
                        if (!open) return;
                        const submenu = document.getElementById(menuId);
                        if (!submenu || submenu.classList.contains('open')) return;
                        submenu.classList.add('open');
                        const arrow = document.getElementById(menuId.replace('sub-', 'arr-'));
                        if (arrow) arrow.classList.add('open');
                        const trigger = document.querySelector(`[aria-controls="${menuId}"]`);
                        if (trigger) trigger.setAttribute('aria-expanded', 'true');
                    });
                } catch (_) {}
            }

            function toggleDropdown(menuId, arrowId, triggerEl) {
                if (document.documentElement.classList.contains('sidebar-collapsed')) {
                    toggleCollapse();
                    setTimeout(() => {
                        const menu = document.getElementById(menuId);
                        menu.classList.add('open');
                        document.getElementById(arrowId).classList.add('open');
                        triggerEl.setAttribute('aria-expanded', 'true');
                        saveDropdownState(menuId, true);
                    }, 250);
                    return;
                }
                const menu = document.getElementById(menuId);
                const arrow = document.getElementById(arrowId);
                const isOpen = menu.classList.toggle('open');
                arrow.classList.toggle('open', isOpen);
                triggerEl.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                saveDropdownState(menuId, isOpen);
            }

            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('overlay');
                const hamburger = document.getElementById('hamburger');
                const isOpen = sidebar.classList.toggle('open');
                hamburger.classList.toggle('open', isOpen);
                hamburger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                overlay.classList.toggle('visible', isOpen);
                overlay.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
            }

            function closeSidebar() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('overlay');
                const hamburger = document.getElementById('hamburger');
                sidebar.classList.remove('open');
                overlay.classList.remove('visible');
                hamburger.classList.remove('open');
                hamburger.setAttribute('aria-expanded', 'false');
                overlay.setAttribute('aria-hidden', 'true');
            }

            let resizeFrame;
            window.addEventListener('resize', () => {
                if (resizeFrame) cancelAnimationFrame(resizeFrame);
                resizeFrame = requestAnimationFrame(() => {
                    if (window.innerWidth > 900) closeSidebar();
                });
            }, {
                passive: true
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    if (document.getElementById('sidebar')?.classList.contains('open')) closeSidebar();
                    if (document.getElementById('profileDropdown')?.classList.contains('open')) closeProfile();
                }
            });

            function toggleProfile() {
                const dropdown = document.getElementById('profileDropdown');
                const btn = document.getElementById('profileBtn');
                const arrow = document.getElementById('profileArrow');
                const isOpen = dropdown.classList.toggle('open');
                btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                if (arrow) arrow.style.transform = isOpen ? 'rotate(180deg)' : '';
            }

            function closeProfile() {
                const dropdown = document.getElementById('profileDropdown');
                const btn = document.getElementById('profileBtn');
                const arrow = document.getElementById('profileArrow');
                if (dropdown) dropdown.classList.remove('open');
                if (btn) btn.setAttribute('aria-expanded', 'false');
                if (arrow) arrow.style.transform = '';
            }

            document.addEventListener('click', (e) => {
                if (!document.getElementById('profileArea')?.contains(e.target)) closeProfile();
            }, {
                passive: true
            });

            function confirmLogout() {
                closeProfile();
                const dark = document.documentElement.classList.contains('dark');
                Swal.fire({
                    title: '¿Cerrar sesión?',
                    text: 'Se cerrará tu sesión actual.',
                    icon: 'warning',
                    background: dark ? '#1e293b' : '#ffffff',
                    color: dark ? '#f1f5f9' : '#0f172a',
                    showCancelButton: true,
                    confirmButtonColor: '#0ea5e9',
                    cancelButtonColor: dark ? '#475569' : '#e2e8f0',
                    confirmButtonText: 'Sí, salir',
                    cancelButtonText: 'Cancelar',
                    customClass: {
                        popup: 'rounded-xl'
                    }
                }).then((r) => {
                    if (r.isConfirmed) document.getElementById('logout-form').submit();
                });
            }

            document.addEventListener('htmx:afterSwap', function(e) {
                const bar = document.getElementById('progress-bar');
                if (bar) {
                    bar.style.width = '100%';
                    setTimeout(() => {
                        bar.classList.remove('active');
                        bar.style.width = '0%';
                    }, 200);
                }

                updateActiveState();
                closeProfile();
                initBreadcrumb(); // ← agrega esta línea

                // Actualiza breadcrumb y título de pestaña

                document.dispatchEvent(new CustomEvent('app:init'));
                if (window.innerWidth <= 900) closeSidebar();
            });
            // ── Paginación con htmx ──
            document.addEventListener('click', function(e) {
                const link = e.target.closest('#main-content a[href]');
                if (!link) return;

                const url = link.href;
                if (!url.includes('page=')) return;

                e.preventDefault();

                htmx.ajax('GET', url, {
                    target: '#main-content',
                    swap: 'innerHTML',
                    pushUrl: true
                });
            });
            document.addEventListener('submit', (e) => {
                if (e.target?.id === 'searchFormAdmin') {
                    const btn = e.target.querySelector('#btnBuscarAdmin');
                    const content = e.target.querySelector('#btnContentAdmin');
                    const loader = e.target.querySelector('#btnLoaderAdmin');
                    if (btn) {
                        btn.disabled = true;
                        btn.classList.add('opacity-70', 'cursor-not-allowed');
                    }
                    if (content) content.classList.add('invisible', 'opacity-0');
                    if (loader) loader.classList.remove('hidden');
                }
            });

            updateActiveState();
            restoreDropdownStates();

            window.toggleTheme = toggleTheme;
            window.toggleCollapse = toggleCollapse;
            window.toggleSidebar = toggleSidebar;
            window.closeSidebar = closeSidebar;
            window.toggleProfile = toggleProfile;
            window.closeProfile = closeProfile;
            window.confirmLogout = confirmLogout;
            window.toggleDropdown = toggleDropdown;
            window.updateActiveState = updateActiveState;

        })();
    </script>

    @stack('scripts')
</body>

</html>
