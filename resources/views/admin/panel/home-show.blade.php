 @php
     $cards = [
         [
             'route' => 'admin.informes.index',
             'title' => 'Gestión de Proyectos',
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
             'bg' => 'bg-indigo-50 dark:bg-indigo-500/10',
             'ico' => 'text-indigo-600 dark:text-indigo-400',
             'hover' =>
                 'hover:border-indigo-400 hover:shadow-indigo-500/10 dark:hover:border-indigo-500/40 group-hover:text-indigo-600 dark:group-hover:text-indigo-400'
         ],
         'blue' => [
             'bg' => 'bg-blue-50 dark:bg-blue-500/10',
             'ico' => 'text-blue-600 dark:text-blue-400',
             'hover' =>
                 'hover:border-blue-400 hover:shadow-blue-500/10 dark:hover:border-blue-500/40 group-hover:text-blue-600 dark:group-hover:text-blue-400'
         ],
         'emerald' => [
             'bg' => 'bg-emerald-50 dark:bg-emerald-500/10',
             'ico' => 'text-emerald-600 dark:text-emerald-400',
             'hover' =>
                 'hover:border-emerald-400 hover:shadow-emerald-500/10 dark:hover:border-emerald-500/40 group-hover:text-emerald-600 dark:group-hover:text-emerald-400'
         ],
         'amber' => [
             'bg' => 'bg-amber-50 dark:bg-amber-500/10',
             'ico' => 'text-amber-600 dark:text-amber-400',
             'hover' =>
                 'hover:border-amber-400 hover:shadow-amber-500/10 dark:hover:border-amber-500/40 group-hover:text-amber-600 dark:group-hover:text-amber-400'
         ]
     ];

     $icons = [
         'folder' => '<path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>',
         'upload' =>
             '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>',
         'users' =>
             '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
         'book' =>
             '<path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>'
     ];
 @endphp

 <x-header-admin titulo="PANEL PRINCIPAL"
     subtitulo="Bienvenido al sistema. Seleccione un módulo para comenzar su sesión." />

 <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
     @foreach ($cards as $card)
         @php $c = $colorMap[$card['color']]; @endphp

         <a href="{{ route($card['route']) }}" hx-get="{{ route($card['route']) }}" hx-target="#main-content"
             hx-swap="innerHTML" hx-push-url="true" data-title="{{ $card['title'] }}"
             class="group flex flex-col rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl dark:border-white/[.08] dark:bg-[#16161d] {{ $c['hover'] }}">

             {{-- Ícono --}}
             <div
                 class="{{ $c['bg'] }} {{ $c['ico'] }} mb-5 flex h-12 w-12 items-center justify-center rounded-xl transition-all duration-300 group-hover:rotate-3 group-hover:scale-110">
                 <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                     {!! $icons[$card['icon']] !!}
                 </svg>
             </div>

             {{-- Texto --}}
             <div class="space-y-2">
                 <h3
                     class="text-[16px] font-bold text-slate-800 transition-colors dark:text-slate-100 {{ $c['hover'] }}">
                     {{ $card['title'] }}
                 </h3>
                 <p class="text-[14px] leading-snug text-slate-500 dark:text-slate-400">
                     {{ $card['desc'] }}
                 </p>
             </div>

             {{-- Footer --}}
             <div
                 class="mt-6 flex items-center gap-2 text-[12px] font-bold uppercase tracking-wider text-slate-400 transition-colors dark:text-slate-600 {{ $c['hover'] }}">
                 Explorar módulo
                 <i
                     class="fa-solid fa-arrow-right-long -translate-x-2 opacity-0 transition-all group-hover:translate-x-0 group-hover:opacity-100"></i>
             </div>
         </a>
     @endforeach
 </div>
