@php
    $cards = [
        [
            'route' => 'admin.informes.index',
            'title' => 'Gestión de Informes',
            'desc' => 'Administración técnica de informes y proyectos registrados en el sistema.',
            'icon' => 'folder'
        ],
        [
            'route' => 'admin.publicaciones.index',
            'title' => 'Centro de Publicaciones',
            'desc' => 'Control de estados y seguimiento del repositorio institucional.',
            'icon' => 'upload'
        ],
        [
            'route' => 'admin.autores.index',
            'title' => 'Directorio de Autores',
            'desc' => 'Gestión de perfiles académicos y colaboradores registrados.',
            'icon' => 'users'
        ],
        [
            'route' => 'admin.manual',
            'title' => 'Manual de Usuario',
            'desc' => 'Guía técnica para el aprovechamiento integral de la plataforma.',
            'icon' => 'book'
        ]
    ];

    $icons = [
        'folder' => '<path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>',
        'upload' => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/>',
        'users' =>
            '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
        'book' => '<path d="M4 6h16M4 12h16M4 18h16"/>'
    ];
@endphp

<x-admin.title titulo="PANEL PRINCIPAL" subtitulo="Bienvenido al sistema. Seleccione un módulo para comenzar su sesión."
    :table="null" />

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mt-6">
    @foreach ($cards as $card)
        <a href="{{ route($card['route']) }}" hx-get="{{ route($card['route']) }}" hx-target="#main-content"
            hx-swap="innerHTML" hx-push-url="true" data-title="{{ $card['title'] }}"
            class="group relative flex flex-col rounded-xl border border-slate-200 bg-gradient-to-br from-white to-slate-50/80 p-5 
                  transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-indigo-300 hover:from-white hover:to-white
                  dark:border-slate-700 dark:from-slate-800 dark:to-slate-900/80 
                  dark:hover:border-indigo-700 dark:hover:from-slate-800 dark:hover:to-slate-800">

            {{-- Borde superior decorativo --}}
            <div
                class="absolute top-0 left-4 right-4 h-0.5 rounded-full bg-gradient-to-r from-transparent via-indigo-400 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100 dark:via-indigo-500">
            </div>

            {{-- Ícono --}}
            <div
                class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-100 to-indigo-50 text-indigo-600 
                        shadow-sm transition-all duration-300 group-hover:scale-105 group-hover:from-indigo-200 group-hover:to-indigo-100 group-hover:shadow-md
                        dark:from-indigo-950/60 dark:to-indigo-900/40 dark:text-indigo-400 
                        dark:group-hover:from-indigo-900/80 dark:group-hover:to-indigo-800/60">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    {!! $icons[$card['icon']] !!}
                </svg>
            </div>

            {{-- Título --}}
            <h3
                class="text-base font-bold text-slate-800 transition-colors duration-300 dark:text-white
                       group-hover:text-indigo-600 dark:group-hover:text-indigo-400">
                {{ $card['title'] }}
            </h3>

            {{-- Descripción --}}
            <p class="mt-2 text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                {{ $card['desc'] }}
            </p>

            <div
                class="mt-5 flex items-center gap-2 text-xs font-medium uppercase tracking-wide text-slate-400 
                        transition-all duration-300 group-hover:text-indigo-600 group-hover:gap-3
                        dark:text-slate-500 dark:group-hover:text-indigo-400">
                <span>Explorar módulo</span>
                <svg class="h-3 w-3 -translate-x-1 opacity-0 transition-all duration-300 group-hover:translate-x-0 group-hover:opacity-100"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </a>
    @endforeach
</div>

<script>
    document.dispatchEvent(new CustomEvent('page:title', {
        detail: 'Inicio'
    }));
</script>
