<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title">Repositorio | @yield('title', 'Inicio')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/htmx.org@2.0.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/modules/form-add.js', 'resources/js/modules/form-edit.js'])
    <link rel="shortcut icon" href="{{ asset('images/icono-csr.ico') }}" />
    <script>
        (function() {
            const theme = localStorage.getItem('theme');
            const collapsed = localStorage.getItem('sidebar-collapsed');
            if (theme === 'dark') document.documentElement.classList.add('dark');
            if (collapsed === 'true') document.documentElement.classList.add('sidebar-collapsed');
        })();
    </script>
</head>

<body class="bg-slate-50 text-slate-900 transition-colors duration-200 dark:bg-slate-900 dark:text-slate-100">

    <div id="overlay" onclick="closeSidebar()" aria-hidden="true" class="sidebar-overlay"></div>

    <div class="flex h-screen overflow-hidden">

        <!-- ===== SIDEBAR ===== -->
        <aside id="sidebar" role="navigation" aria-label="Menú principal" class="sidebar-wrapper">

            <!-- Logo -->
            <div class="sidebar-header">
                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-indigo-50 ring-1 ring-indigo-200 dark:bg-indigo-500/10 dark:ring-indigo-500/30">
                    <img src="{{ asset('images/logo-csr.png') }}" alt="Logo CSR" class="h-7 w-7 object-contain" />
                </div>
                <div class="sidebar-text flex flex-col overflow-hidden">
                    <span
                        class="whitespace-nowrap text-sm font-bold tracking-wide text-slate-900 dark:text-slate-100">REPOSITORIO</span>
                    <span class="whitespace-nowrap text-xs font-medium text-indigo-600 dark:text-indigo-400">Carlos
                        Salazar Romero</span>
                </div>
            </div>

            <!-- PRINCIPAL -->
            <div class="mt-4 px-3">
                <p class="section-label">Principal</p>

                <div class="nav-group">
                    <a href="{{ route('admin.index') }}" data-route="{{ route('admin.index') }}" data-title="Inicio"
                        data-tooltip="Inicio" hx-get="{{ route('admin.index') }}" hx-target="#main-content"
                        hx-swap="innerHTML" hx-push-url="true" class="nav-item group">
                        <span class="active-indicator"></span>
                        <x-heroicon-s-home class="nav-icon" aria-hidden="true" />
                        <span class="nav-text">Inicio</span>
                    </a>
                </div>
            </div>

            <!-- GESTIÓN -->
            <div class="mt-4 px-3">
                <p class="section-label">Gestión</p>

                <!-- Informes -->
                <div class="nav-group">
                    <button type="button" onclick="toggleDropdown('sub-informes', 'arr-informes')"
                        aria-expanded="false" aria-controls="sub-informes" data-tooltip="Informes"
                        class="dropdown-trigger group">
                        <span class="active-indicator"></span>
                        <x-heroicon-s-folder-open class="drop-icon" aria-hidden="true" />
                        <span class="drop-text">Informes</span>
                        <x-heroicon-s-chevron-right id="arr-informes" class="drop-arrow" aria-hidden="true" />
                    </button>

                    <div class="sub-menu" id="sub-informes" role="region">
                        <div>
                            <a href="{{ route('admin.informes.index') }}"
                                data-route="{{ route('admin.informes.index') }}" data-title="Gestión de Informes"
                                hx-get="{{ route('admin.informes.index') }}" hx-target="#main-content"
                                hx-swap="innerHTML" hx-push-url="true" class="sub-item group">
                                <span class="sub-dot" aria-hidden="true"></span>
                                <span class="sub-text">Ver todos los informes</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Publicaciones -->
                <div class="nav-group">
                    <button type="button" onclick="toggleDropdown('sub-publicaciones', 'arr-publicaciones')"
                        aria-expanded="false" aria-controls="sub-publicaciones" data-tooltip="Publicaciones"
                        class="dropdown-trigger group">
                        <span class="active-indicator"></span>
                        <x-heroicon-s-document-text class="drop-icon" aria-hidden="true" />
                        <span class="drop-text">Publicaciones</span>
                        <x-heroicon-s-chevron-right id="arr-publicaciones" class="drop-arrow" aria-hidden="true" />
                    </button>

                    <div class="sub-menu" id="sub-publicaciones" role="region">
                        <div>
                            <a href="{{ route('admin.publicaciones.index') }}"
                                data-route="{{ route('admin.publicaciones.index') }}"
                                data-title="Gestión de Publicaciones" hx-get="{{ route('admin.publicaciones.index') }}"
                                hx-target="#main-content" hx-swap="innerHTML" hx-push-url="true"
                                class="sub-item group">
                                <span class="sub-dot" aria-hidden="true"></span>
                                <span class="sub-text">Ver todas las publicaciones</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Autores -->
                <div class="nav-group">
                    <a href="{{ route('admin.autores.index') }}" data-route="{{ route('admin.autores.index') }}"
                        data-title="Directorio de Autores" data-tooltip="Autores"
                        hx-get="{{ route('admin.autores.index') }}" hx-target="#main-content" hx-swap="innerHTML"
                        hx-push-url="true" class="nav-item group">
                        <span class="active-indicator"></span>
                        <x-heroicon-s-users class="nav-icon" aria-hidden="true" />
                        <span class="nav-text">Autores</span>
                    </a>
                </div>
            </div>

            <!-- SOPORTE -->
            <div class="mt-4 px-3">
                <div class="sidebar-divider mb-3"></div>
                <p class="section-label">Soporte</p>

                <div class="nav-group">
                    <a href="{{ route('admin.manual') }}" data-route="{{ route('admin.manual') }}"
                        data-title="Manual de Usuario" data-tooltip="Manual de uso"
                        hx-get="{{ route('admin.manual') }}" hx-target="#main-content" hx-swap="innerHTML"
                        hx-push-url="true" class="nav-item group">
                        <span class="active-indicator"></span>
                        <x-heroicon-s-book-open class="nav-icon" aria-hidden="true" />
                        <span class="nav-text">Manual de uso</span>
                    </a>
                </div>
            </div>

            <!-- Footer -->
            <div class="sidebar-footer">
                <button type="button" id="collapseBtn" onclick="toggleCollapse()" aria-label="Colapsar menú"
                    class="collapse-btn group">
                    <div class="collapse-icon-wrapper">
                        <x-heroicon-s-chevron-double-left class="collapse-icon h-4 w-4" aria-hidden="true" />
                    </div>
                    <span class="collapse-text">Ocultar menú</span>
                </button>
            </div>
        </aside>

        <!-- ===== MAIN WRAPPER ===== -->
        <div class="flex min-w-0 flex-1 flex-col overflow-hidden">

            <!-- TOPBAR -->
            <header
                class="topbar flex h-16 shrink-0 items-center justify-between gap-4 border-b border-slate-200 bg-white px-4 dark:border-slate-800 dark:bg-slate-900 sm:px-6">
                <div class="flex items-center gap-3">
                    <button id="hamburger" type="button" onclick="toggleSidebar()"
                        aria-label="Abrir menú de navegación" aria-expanded="false" aria-controls="sidebar"
                        class="hamburger">
                        <span class="block h-0.5 w-4 rounded-full bg-slate-500 dark:bg-slate-400"></span>
                        <span class="block h-0.5 w-4 rounded-full bg-slate-500 dark:bg-slate-400"></span>
                        <span class="block h-0.5 w-4 rounded-full bg-slate-500 dark:bg-slate-400"></span>
                    </button>

                    <nav aria-label="Ruta de navegación" class="breadcrumb">
                        <x-heroicon-s-squares-2x2 class="h-4 w-4" aria-hidden="true" />
                        <span aria-hidden="true">/</span>
                        <span id="breadcrumb-title" class="font-semibold text-slate-700 dark:text-slate-200">
                            @yield('title', 'Inicio')
                        </span>
                    </nav>
                </div>

                <div class="flex items-center gap-2">
                    <button id="themeBtn" type="button" onclick="toggleTheme()" aria-label="Cambiar tema de color"
                        class="flex h-9 w-9 cursor-pointer items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 transition-colors duration-150 hover:bg-slate-50 hover:text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100">
                        <x-heroicon-s-moon class="h-5 w-5 block dark:hidden" aria-hidden="true" />
                        <x-heroicon-s-sun class="h-5 w-5 hidden dark:block" aria-hidden="true" />
                    </button>

                    <div class="h-5 w-px bg-slate-200 dark:bg-slate-700" aria-hidden="true"></div>

                    <!-- Perfil -->
                    <div class="relative" id="profileArea">
                        @php $photo = Auth::user()->profile_photo ?? 'default.png'; @endphp
                        <button type="button" onclick="toggleProfile()" aria-label="Menú de perfil de usuario"
                            aria-expanded="false" aria-controls="profileDropdown" id="profileBtn"
                            class="flex cursor-pointer items-center gap-2 rounded-lg border border-transparent px-2 py-1.5 transition-colors duration-150 hover:border-slate-200 hover:bg-slate-50 dark:hover:border-slate-700 dark:hover:bg-slate-800">
                            <div
                                class="h-8 w-8 shrink-0 overflow-hidden rounded-full ring-2 ring-indigo-200 dark:ring-indigo-500/30">
                                <img src="{{ asset('profile/' . $photo) }}"
                                    alt="Foto de perfil de {{ Auth::user()->full_name }}"
                                    class="h-full w-full object-cover"
                                    onerror="this.src='{{ asset('images/default-avatar.png') }}'" />
                            </div>
                            <div class="hidden flex-col text-left sm:flex">
                                <span
                                    class="text-sm font-semibold text-slate-900 dark:text-slate-100">{{ Auth::user()->username }}</span>
                                <span class="text-xs text-slate-500 dark:text-slate-400">Administrador</span>
                            </div>
                            <x-heroicon-s-chevron-down
                                class="hidden h-3 w-3 text-slate-400 dark:text-slate-500 sm:block"
                                aria-hidden="true" />
                        </button>

                        <div id="profileDropdown" role="menu" aria-labelledby="profileBtn"
                            class="profile-dropdown">
                            <div
                                class="flex items-center gap-3 border-b border-slate-100 bg-slate-50 px-4 py-3 dark:border-slate-700 dark:bg-slate-800/50">
                                <div
                                    class="h-10 w-10 shrink-0 overflow-hidden rounded-full ring-2 ring-indigo-200 dark:ring-indigo-500/30">
                                    <img src="{{ asset('profile/' . $photo) }}" alt="" aria-hidden="true"
                                        class="h-full w-full object-cover"
                                        onerror="this.src='{{ asset('images/default-avatar.png') }}'" />
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
                                    data-title="Mi Perfil" role="menuitem" onclick="closeProfile()"
                                    class="group flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 transition-colors duration-150 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-slate-100">
                                    <x-heroicon-s-user-circle
                                        class="h-5 w-5 shrink-0 text-slate-400 transition-colors group-hover:text-indigo-500 dark:text-slate-500 dark:group-hover:text-indigo-400"
                                        aria-hidden="true" />
                                    Mi perfil
                                </a>
                            </div>

                            <div class="h-px bg-slate-200 dark:bg-slate-700" role="separator"></div>

                            <div class="py-1" role="none">
                                <button type="button" role="menuitem" onclick="confirmLogout()"
                                    class="group flex w-full cursor-pointer items-center gap-3 px-4 py-2.5 text-sm text-red-500 transition-colors duration-150 hover:bg-red-50 hover:text-red-600 dark:hover:bg-red-500/10">
                                    <x-heroicon-s-arrow-right-on-rectangle
                                        class="h-5 w-5 shrink-0 text-red-400 transition-colors group-hover:text-red-500"
                                        aria-hidden="true" />
                                    Cerrar sesión
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- MAIN CONTENT -->
            <main id="main-content"
                class="main-content flex-1 overflow-y-auto bg-white p-4 dark:bg-slate-900 sm:p-6 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    @stack('scripts')
</body>

</html>
