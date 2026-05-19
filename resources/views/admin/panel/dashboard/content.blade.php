@php
    $cards = [
        [
            'route' => 'admin.informes.index',
            'title' => 'Gestión de Informes',
            'desc' => 'Administración técnica de informes y proyectos registrados en el sistema.',
            'icon' => 'folder',
            'color' => 'indigo'
        ],
        [
            'route' => 'admin.publicaciones.index',
            'title' => 'Centro de Publicaciones',
            'desc' => 'Control de estados y seguimiento del repositorio institucional.',
            'icon' => 'upload',
            'color' => 'blue'
        ],
        [
            'route' => 'admin.autores.index',
            'title' => 'Directorio de Autores',
            'desc' => 'Gestión de perfiles académicos y colaboradores registrados.',
            'icon' => 'users',
            'color' => 'emerald'
        ],
        [
            'route' => 'admin.manual',
            'title' => 'Manual de Usuario',
            'desc' => 'Guía técnica para el aprovechamiento integral de la plataforma.',
            'icon' => 'book',
            'color' => 'amber'
        ]
    ];

    $colorMap = [
        'indigo' => [
            'bg' => 'bg-indigo-50 dark:bg-indigo-950/30',
            'ico' => 'text-indigo-600 dark:text-indigo-400',
            'border' => 'hover:border-indigo-300 dark:hover:border-indigo-600',
            'text' => 'group-hover:text-indigo-600 dark:group-hover:text-indigo-400',
            'shadow' => 'shadow-indigo-100/50 dark:shadow-indigo-950/30'
        ],
        'blue' => [
            'bg' => 'bg-blue-50 dark:bg-blue-950/30',
            'ico' => 'text-blue-600 dark:text-blue-400',
            'border' => 'hover:border-blue-300 dark:hover:border-blue-600',
            'text' => 'group-hover:text-blue-600 dark:group-hover:text-blue-400',
            'shadow' => 'shadow-blue-100/50 dark:shadow-blue-950/30'
        ],
        'emerald' => [
            'bg' => 'bg-emerald-50 dark:bg-emerald-950/30',
            'ico' => 'text-emerald-600 dark:text-emerald-400',
            'border' => 'hover:border-emerald-300 dark:hover:border-emerald-600',
            'text' => 'group-hover:text-emerald-600 dark:group-hover:text-emerald-400',
            'shadow' => 'shadow-emerald-100/50 dark:shadow-emerald-950/30'
        ],
        'amber' => [
            'bg' => 'bg-amber-50 dark:bg-amber-950/30',
            'ico' => 'text-amber-600 dark:text-amber-400',
            'border' => 'hover:border-amber-300 dark:hover:border-amber-600',
            'text' => 'group-hover:text-amber-600 dark:group-hover:text-amber-400',
            'shadow' => 'shadow-amber-100/50 dark:shadow-amber-950/30'
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
    badgeColor="indigo" />

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mt-6">
    @foreach ($cards as $card)
        @php $c = $colorMap[$card['color']]; @endphp

        <a href="{{ route($card['route']) }}" hx-get="{{ route($card['route']) }}" hx-target="#main-content"
            hx-swap="innerHTML" hx-push-url="true" data-title="{{ $card['title'] }}"
            class="group relative flex flex-col rounded-2xl border border-slate-200 bg-white p-5 shadow-md transition-all duration-300 
                  hover:-translate-y-1.5 hover:shadow-lg 
                  dark:border-slate-700 dark:bg-slate-900/50 
                  {{ $c['border'] }} {{ $c['shadow'] }}">

            {{-- Borde superior decorativo --}}
            <div
                class="absolute top-0 left-4 right-4 h-0.5 rounded-full bg-gradient-to-r from-transparent via-{{ $card['color'] }}-500 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100 dark:via-{{ $card['color'] }}-400">
            </div>

            {{-- Ícono --}}
            <div
                class="{{ $c['bg'] }} {{ $c['ico'] }} mb-4 flex h-12 w-12 items-center justify-center rounded-xl transition-all duration-300 group-hover:scale-105 group-hover:shadow-sm">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    {!! $icons[$card['icon']] !!}
                </svg>
            </div>

            {{-- Título --}}
            <h3
                class="text-base font-bold text-slate-800 transition-colors duration-300 dark:text-white {{ $c['text'] }}">
                {{ $card['title'] }}
            </h3>

            {{-- Descripción --}}
            <p class="mt-2 text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                {{ $card['desc'] }}
            </p>

            {{-- Footer con flecha --}}
            <div
                class="mt-5 flex items-center gap-2 text-[11px] font-semibold uppercase tracking-wide text-slate-400 transition-colors duration-300 dark:text-slate-500 {{ $c['text'] }}">
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
