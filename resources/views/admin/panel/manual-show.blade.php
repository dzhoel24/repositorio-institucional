@php
    $sections = [
        [
            'title' => 'Gestión de Proyectos',
            'desc' => 'Administración de informes y expedientes registrados en la plataforma institucional.',
            'icon' => 'heroicon-s-folder-plus',
            'color' => 'indigo',
            'items' => [
                'Registro de nuevos proyectos y metadatos técnicos.',
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
            'dot' => 'bg-indigo-500'
        ],
        'blue' => [
            'bg' => 'bg-blue-50 dark:bg-blue-500/10',
            'ico' => 'text-blue-600 dark:text-blue-400',
            'dot' => 'bg-blue-500'
        ],
        'emerald' => [
            'bg' => 'bg-emerald-50 dark:bg-emerald-500/10',
            'ico' => 'text-emerald-600 dark:text-emerald-400',
            'dot' => 'bg-emerald-500'
        ],
        'amber' => [
            'bg' => 'bg-amber-50 dark:bg-amber-500/10',
            'ico' => 'text-amber-600 dark:text-amber-400',
            'dot' => 'bg-amber-500'
        ]
    ];
@endphp

<x-header-admin titulo="MANUAL DE PROCEDIMIENTOS"
    subtitulo="Guía técnica para la administración del repositorio institucional." />

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    @foreach ($sections as $section)
        @php $c = $colorMap[$section['color']]; @endphp

        <div
            class="flex flex-col rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition-colors hover:border-slate-300 dark:border-white/[.08] dark:bg-[#16161d] dark:hover:border-white/20">

            <div class="mb-3 flex items-center gap-3">
                <div
                    class="{{ $c['bg'] }} {{ $c['ico'] }} flex h-9 w-9 shrink-0 items-center justify-center rounded-lg">
                    <x-dynamic-component :component="$section['icon']" class="w-5 h-5" />
                </div>
                <h2 class="text-[16px] font-bold tracking-tight text-slate-800 dark:text-slate-200">
                    {{ $section['title'] }}
                </h2>
            </div>

            <p class="mb-4 text-[14px] leading-relaxed text-slate-500 dark:text-slate-400">
                {{ $section['desc'] }}
            </p>

            <div class="mb-4 h-px w-full bg-slate-50 dark:bg-white/5"></div>

            <ul class="space-y-2.5">
                @foreach ($section['items'] as $item)
                    <li class="group flex items-start gap-3">
                        <span class="{{ $c['dot'] }} mt-2 h-1.5 w-1.5 shrink-0 rounded-full"></span>
                        <span
                            class="text-[14px] leading-tight text-slate-600 transition-colors group-hover:text-slate-900 dark:text-slate-300 dark:group-hover:text-white">
                            {{ $item }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
