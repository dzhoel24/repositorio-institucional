@php
    $sections = [
        [
            'title' => 'Gestión de Informes',
            'desc' => 'Administración de informes y expedientes registrados en la plataforma institucional.',
            'icon' => 'heroicon-s-folder-plus',
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
            'items' => [
                'Validación técnica de datos previa al guardado.',
                'Estandarización de nomenclatura de archivos.',
                'Mantenimiento preventivo de la información.'
            ]
        ]
    ];
@endphp

<x-admin.title titulo="MANUAL DE PROCEDIMIENTOS"
    subtitulo="Guía técnica para la administración del repositorio institucional." :table="null" />

<div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    @foreach ($sections as $index => $section)
        @php
            $colors = [
                'from-indigo-500 to-indigo-600',
                'from-blue-500 to-blue-600',
                'from-emerald-500 to-emerald-600',
                'from-amber-500 to-amber-600'
            ];
            $gradient = $colors[$index % count($colors)];
        @endphp

        <div
            class="group relative flex flex-col rounded-2xl border border-slate-200 bg-white p-6 shadow-md 
                    transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl 
                    dark:border-slate-700 dark:bg-slate-800/90 
                    hover:border-transparent">

            {{-- Gradiente de fondo sutil en hover --}}
            <div
                class="absolute inset-0 rounded-2xl bg-gradient-to-br from-slate-50 to-white opacity-0 transition-opacity duration-300 group-hover:opacity-100 dark:from-slate-800/50 dark:to-slate-800">
            </div>

            {{-- Barra superior decorativa --}}
            <div
                class="absolute top-0 left-4 right-4 h-1 rounded-t-2xl bg-gradient-to-r {{ $gradient }} opacity-0 transition-all duration-300 group-hover:opacity-100">
            </div>

            {{-- Encabezado con ícono --}}
            <div class="relative mb-4 flex items-center gap-3">
                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br {{ $gradient }} 
                            shadow-md shadow-{{ explode(' ', $gradient)[1] }}/20
                            transition-all duration-300 group-hover:scale-105 group-hover:shadow-lg">
                    <x-dynamic-component :component="$section['icon']" class="h-6 w-6 text-white" />
                </div>
                <h2
                    class="text-lg font-bold tracking-tight text-slate-800 transition-colors duration-300 
                           group-hover:text-{{ explode(' ', $gradient)[1] }}
                           dark:text-white">
                    {{ $section['title'] }}
                </h2>
            </div>

            {{-- Descripción --}}
            <p
                class="relative mb-4 text-sm leading-relaxed text-slate-500 transition-colors duration-300 
                      group-hover:text-slate-600 dark:text-slate-400">
                {{ $section['desc'] }}
            </p>

            {{-- Separador animado --}}
            <div
                class="relative mb-5 h-px w-full bg-gradient-to-r from-transparent via-slate-200 to-transparent 
                        transition-all duration-300 group-hover:via-{{ explode(' ', $gradient)[1] }}/50 
                        dark:via-slate-700">
            </div>

            {{-- Lista de items con check animado --}}
            <ul class="relative space-y-3">
                @foreach ($section['items'] as $item)
                    <li class="flex items-start gap-3 transition-all duration-300 hover:translate-x-1.5">
                        <div
                            class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full 
                                    bg-{{ explode(' ', $gradient)[1] }}/10 text-{{ explode(' ', $gradient)[1] }}
                                    transition-all duration-300 group-hover:bg-{{ explode(' ', $gradient)[1] }}/20
                                    dark:bg-{{ explode(' ', $gradient)[1] }}/20">
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span
                            class="text-sm leading-relaxed text-slate-600 transition-colors duration-300 
                                     group-hover:text-slate-800 dark:text-slate-300 dark:group-hover:text-white">
                            {{ $item }}
                        </span>
                    </li>
                @endforeach
            </ul>

            {{-- Footer con flecha animada --}}
            <div
                class="relative mt-6 flex items-center justify-between pt-3 border-t border-slate-100 
                        transition-all duration-300 group-hover:border-{{ explode(' ', $gradient)[1] }}/20
                        dark:border-slate-700">
                <span
                    class="text-xs font-medium uppercase tracking-wider text-slate-400 transition-colors 
                             group-hover:text-{{ explode(' ', $gradient)[1] }}
                             dark:text-slate-500">
                    Documentación oficial
                </span>
                <div
                    class="flex h-7 w-7 items-center justify-center rounded-full bg-slate-100 text-slate-400 
                            transition-all duration-300 group-hover:bg-{{ explode(' ', $gradient)[1] }} 
                            group-hover:text-white group-hover:shadow-md
                            dark:bg-slate-700">
                    <svg class="h-3.5 w-3.5 transition-transform duration-300 group-hover:translate-x-0.5"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>
        </div>
    @endforeach
</div>

<script>
    document.dispatchEvent(new CustomEvent('page:title', {
        detail: 'Manual'
    }));
</script>
