@php
    $sections = [
        [
            'title' => 'Gestión de Informes',
            'desc' => 'Administración de informes y expedientes registrados en la plataforma institucional.',
            'icon' => 'heroicon-s-folder-plus',
            'color' => 'indigo',
            'items' => [
                'Registro de nuevos informes y metadatos técnicos.',
                'Actualización dinámica de información y estados.',
                'Depuración de registros y gestión de vigencia.'
            ]
        ],
        [
            'title' => 'Centro de Publicaciones',
            'desc' => 'Control del ciclo de vida de los documentos dentro del repositorio digital.',
            'icon' => 'heroicon-s-cloud-arrow-up',
            'color' => 'blue',
            'items' => [
                'Carga de documentos en formatos estandarizados.',
                'Gestión de estados: Pendiente, Revisión y Publicado.',
                'Auditoría de cambios y trazabilidad por publicación.'
            ]
        ],
        [
            'title' => 'Directorio de Autores',
            'desc' => 'Base de datos consolidada de perfiles académicos y colaboradores.',
            'icon' => 'heroicon-s-academic-cap',
            'color' => 'emerald',
            'items' => [
                'Vinculación de autores con datos académicos oficiales.',
                'Edición de perfiles y actualización de roles.',
                'Control de actividad y bajas en el sistema.'
            ]
        ],
        [
            'title' => 'Buenas Prácticas',
            'desc' => 'Protocolos para garantizar la integridad y calidad del repositorio.',
            'icon' => 'heroicon-s-shield-check',
            'color' => 'amber',
            'items' => [
                'Validación técnica de datos previa al guardado.',
                'Estandarización de nomenclatura de archivos.',
                'Mantenimiento preventivo de la información.'
            ]
        ]
    ];

    $colorMap = [
        'indigo' => [
            'bg' => 'bg-indigo-50 dark:bg-indigo-500/10',
            'ico' => 'text-indigo-600 dark:text-indigo-400',
            'dot' => 'bg-indigo-500',
            'border' => 'hover:border-indigo-200 dark:hover:border-indigo-500/30',
            'ring' => 'ring-indigo-200 dark:ring-indigo-500/30'
        ],
        'blue' => [
            'bg' => 'bg-blue-50 dark:bg-blue-500/10',
            'ico' => 'text-blue-600 dark:text-blue-400',
            'dot' => 'bg-blue-500',
            'border' => 'hover:border-blue-200 dark:hover:border-blue-500/30',
            'ring' => 'ring-blue-200 dark:ring-blue-500/30'
        ],
        'emerald' => [
            'bg' => 'bg-emerald-50 dark:bg-emerald-500/10',
            'ico' => 'text-emerald-600 dark:text-emerald-400',
            'dot' => 'bg-emerald-500',
            'border' => 'hover:border-emerald-200 dark:hover:border-emerald-500/30',
            'ring' => 'ring-emerald-200 dark:ring-emerald-500/30'
        ],
        'amber' => [
            'bg' => 'bg-amber-50 dark:bg-amber-500/10',
            'ico' => 'text-amber-600 dark:text-amber-400',
            'dot' => 'bg-amber-500',
            'border' => 'hover:border-amber-200 dark:hover:border-amber-500/30',
            'ring' => 'ring-amber-200 dark:ring-amber-500/30'
        ]
    ];
@endphp

<x-admin.title titulo="MANUAL DE PROCEDIMIENTOS"
    subtitulo="Guía técnica para la administración del repositorio institucional." badgeColor="indigo" />

<div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    @foreach ($sections as $section)
        @php $c = $colorMap[$section['color']]; @endphp

        <div
            class="group flex flex-col rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md 
                    dark:border-slate-700 dark:bg-slate-900 dark:hover:border-slate-600 {{ $c['border'] }}">

            {{-- Encabezado con ícono --}}
            <div class="mb-4 flex items-center gap-3">
                <div
                    class="{{ $c['bg'] }} {{ $c['ico'] }} flex h-10 w-10 items-center justify-center rounded-xl transition-all duration-300 group-hover:scale-105">
                    <x-dynamic-component :component="$section['icon']" class="h-5 w-5" />
                </div>
                <h2 class="text-base font-bold tracking-tight text-slate-800 dark:text-white">
                    {{ $section['title'] }}
                </h2>
            </div>

            {{-- Descripción --}}
            <p class="mb-4 text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                {{ $section['desc'] }}
            </p>

            {{-- Separador --}}
            <div
                class="mb-4 h-px w-full bg-gradient-to-r from-transparent via-slate-200 to-transparent dark:via-slate-700">
            </div>

            {{-- Lista de items --}}
            <ul class="space-y-2.5">
                @foreach ($section['items'] as $item)
                    <li class="flex items-start gap-3 transition-all duration-200 hover:translate-x-1">
                        <span
                            class="{{ $c['dot'] }} mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full ring-1 {{ $c['ring'] }}"></span>
                        <span
                            class="text-sm leading-relaxed text-slate-600 transition-colors group-hover:text-slate-800 
                                     dark:text-slate-300 dark:group-hover:text-white">
                            {{ $item }}
                        </span>
                    </li>
                @endforeach
            </ul>

            {{-- Footer sutil --}}
            <div class="mt-5 pt-2 text-right">
                <span class="text-[10px] font-medium uppercase tracking-wider text-slate-300 dark:text-slate-600">
                    {{ $section['title'] }}
                </span>
            </div>
        </div>
    @endforeach
</div>

<script>
    document.dispatchEvent(new CustomEvent('page:title', {
        detail: 'Manual'
    }));
</script>
