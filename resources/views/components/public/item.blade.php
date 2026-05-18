<div class="p-4 md:p-6 bg-white dark:bg-gray-900 rounded-lg">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        {{-- Columna izquierda: Imagen y acciones (4 columnas) --}}
        <div class="lg:col-span-4 space-y-5">

            {{-- Imagen Contenedor --}}
            <div
                class="relative group rounded-lg overflow-hidden bg-slate-50 dark:bg-gray-950 border border-slate-150 dark:border-gray-800 shadow-sm">
                <img class="w-full aspect-[4/3] object-cover transition-transform duration-750 ease-out group-hover:scale-102"
                    src="{{ asset('storage/caratulas/' . $image) }}" alt="{{ $title }}" loading="lazy">

                {{-- Sutil degradado protector de legibilidad para los badges --}}
                <div
                    class="absolute inset-0 bg-gradient-to-b from-black/20 via-transparent to-black/30 pointer-events-none">
                </div>

                {{-- Badge acceso --}}
                <div class="absolute top-3 right-3">
                    <span
                        class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded text-[11px] font-bold uppercase tracking-wider backdrop-blur-md shadow-sm
                        {{ $acceso === 'Publico' ? 'bg-emerald-600/95 text-white' : 'bg-rose-600/95 text-white' }}">
                        @if ($acceso === 'Publico')
                            <x-heroicon-s-lock-open class="w-3.5 h-3.5 shrink-0" />
                        @else
                            <x-heroicon-s-lock-closed class="w-3.5 h-3.5 shrink-0" />
                        @endif
                        {{ $acceso === 'Publico' ? 'Acceso Libre' : 'Restringido' }}
                    </span>
                </div>

                {{-- Badge año --}}
                @if ($anio)
                    <div class="absolute bottom-3 left-3">
                        <span
                            class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded bg-slate-900/75 dark:bg-black/60 backdrop-blur-sm text-white text-[11px] font-semibold tracking-medium border border-white/10">
                            <x-heroicon-s-calendar class="w-3.5 h-3.5 text-indigo-300 shrink-0" />
                            {{ $anio }}
                        </span>
                    </div>
                @endif
            </div>

            {{-- Botones de acción --}}
            <div class="space-y-3">
                @if ($acceso === 'Publico' && $pdf)
                    <a href="{{ asset('storage/pdfs/' . $pdf) }}" download
                        class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md font-semibold text-sm transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 shadow-sm">
                        <x-heroicon-s-arrow-down-tray class="w-4 h-4" />
                        Descargar documento (PDF)
                    </a>

                    <button onclick="navigator.clipboard.writeText(window.location.href); alert('Enlace copiado')"
                        class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-slate-50 dark:bg-gray-800/60 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-gray-700 rounded-md font-medium text-sm hover:bg-slate-100 dark:hover:bg-gray-800 hover:text-slate-900 dark:hover:text-white transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-slate-400">
                        <x-heroicon-s-share class="w-4 h-4 text-slate-400 dark:text-gray-500" />
                        Compartir enlace
                    </button>
                @else
                    <div
                        class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-slate-50 dark:bg-gray-800/40 text-slate-400 dark:text-gray-600 border border-slate-150 dark:border-gray-800/80 rounded-md font-medium text-sm cursor-not-allowed">
                        <x-heroicon-s-lock-closed class="w-4 h-4" />
                        Descarga no disponible
                    </div>
                @endif
            </div>
        </div>

        {{-- Columna derecha: Contenido (8 columnas) --}}
        <div class="lg:col-span-8 space-y-6">

            {{-- Título Principal --}}
            <div class="space-y-3">
                <h1
                    class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                    {{ $title }}
                </h1>

                {{-- Autores --}}
                <div
                    class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400 bg-slate-50 dark:bg-gray-800/30 w-fit px-3 py-1.5 rounded border border-slate-150 dark:border-gray-800/60">
                    <x-heroicon-s-users class="w-4 h-4 text-indigo-500 dark:text-indigo-400 shrink-0" />
                    <span class="font-semibold">{{ $autores }}</span>
                </div>
            </div>

            {{-- Resumen (Estilo Editorial Tipo Cita) --}}
            <div
                class="bg-slate-50/60 dark:bg-gray-900/50 border-l-4 border-indigo-600 dark:border-indigo-500 p-5 rounded-r-md">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-gray-500 mb-2">
                    Resumen / Sinopsis
                </h3>
                <p class="text-sm font-medium text-slate-700 dark:text-slate-300 leading-relaxed text-justify">
                    {{ $resumen }}
                </p>
            </div>

            {{-- Fichas de Metadatos Inferiores --}}
            <div class="flex flex-wrap gap-4 pt-2">

                {{-- Metadato: Tipo --}}
                <div
                    class="flex items-center gap-3 bg-white dark:bg-gray-900 border border-slate-200 dark:border-gray-800 px-3.5 py-2 rounded-md shadow-sm min-w-[140px]">
                    <div class="p-2 bg-indigo-50 dark:bg-indigo-950/40 rounded">
                        <x-heroicon-s-document-text class="w-4 h-4 text-indigo-600 dark:text-indigo-400" />
                    </div>
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Tipo</p>
                        <p class="text-sm font-bold text-slate-700 dark:text-slate-300">
                            {{ $tipo ?? 'Documento' }}
                        </p>
                    </div>
                </div>

                {{-- Metadato: Acceso --}}
                <div
                    class="flex items-center gap-3 bg-white dark:bg-gray-900 border border-slate-200 dark:border-gray-800 px-3.5 py-2 rounded-md shadow-sm min-w-[140px]">
                    <div
                        class="p-2 {{ $acceso === 'Publico' ? 'bg-emerald-50 dark:bg-emerald-950/40' : 'bg-rose-50 dark:bg-rose-950/40' }} rounded">
                        @if ($acceso === 'Publico')
                            <x-heroicon-s-lock-open class="w-4 h-4 text-emerald-600 dark:text-emerald-400" />
                        @else
                            <x-heroicon-s-lock-closed class="w-4 h-4 text-rose-600 dark:text-rose-400" />
                        @endif
                    </div>
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Condición</p>
                        <p
                            class="text-sm font-bold {{ $acceso === 'Publico' ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                            {{ $acceso === 'Publico' ? 'Público' : 'Restringido' }}
                        </p>
                    </div>
                </div>

                {{-- Metadato: Año --}}
                @if ($anio)
                    <div
                        class="flex items-center gap-3 bg-white dark:bg-gray-900 border border-slate-200 dark:border-gray-800 px-3.5 py-2 rounded-md shadow-sm min-w-[140px]">
                        <div class="p-2 bg-amber-50 dark:bg-amber-950/40 rounded">
                            <x-heroicon-s-calendar class="w-4 h-4 text-amber-600 dark:text-amber-400" />
                        </div>
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Publicado</p>
                            <p class="text-sm font-bold text-slate-700 dark:text-slate-300">
                                {{ $anio }}
                            </p>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
