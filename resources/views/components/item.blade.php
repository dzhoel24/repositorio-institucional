<div class="p-2 grid grid-cols-1 lg:grid-cols-4 w-full gap-4 sm:gap-6">

    {{-- Título --}}
    <div class="col-span-1 lg:col-span-4">
        <h2 class="text-2xl md:text-3xl font-bold text-slate-800 dark:text-white">{{ $title }}</h2>
        <hr class="my-2 border-slate-200 dark:border-slate-700">
    </div>

    {{-- Imagen y botones --}}
    <div class="col-span-1 flex flex-col gap-4">
        <img class="w-full max-w-xs rounded-lg shadow-md object-cover mx-auto"
            src="{{ asset('storage/caratulas/' . $image) }}" alt="{{ $title }}">

        <div class="flex flex-col gap-3">

            {{-- Botón descargar PDF --}}
            @if ($acceso === 'Publico')
                <a href="{{ asset('storage/pdfs/' . $pdf) }}" download
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">

                    <x-heroicon-o-arrow-down-tray class="w-5 h-5" />

                    Descargar PDF
                </a>
            @else
                <button disabled
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-slate-400 text-white rounded-lg cursor-not-allowed opacity-70">

                    <x-heroicon-o-lock-closed class="w-5 h-5" />

                    Acceso restringido
                </button>
            @endif

        </div>
    </div>

    {{-- Información del proyecto --}}
    <div class="col-span-1 lg:col-span-3">

        <p class="text-sm md:text-base text-slate-700 dark:text-slate-300 leading-relaxed">
            {{ $resumen }}
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-5 pt-3 border-t border-slate-100 dark:border-slate-700">

            {{-- Autores --}}
            <div>
                <span class="text-sm font-semibold text-slate-600 dark:text-slate-400 flex items-center gap-1">

                    <x-heroicon-o-users class="w-4 h-4" />

                    Autor(es):
                </span>

                <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                    {{ $autores }}
                </p>
            </div>

            {{-- Año --}}
            <div>
                <span class="text-sm font-semibold text-slate-600 dark:text-slate-400 flex items-center gap-1">

                    <x-heroicon-o-calendar-days class="w-4 h-4" />

                    Año de creación:
                </span>

                <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                    {{ $anio ?? 'No disponible' }}
                </p>
            </div>

            {{-- Tipo de acceso --}}
            <div>
                <span class="text-sm font-semibold text-slate-600 dark:text-slate-400 flex items-center gap-1">

                    <x-heroicon-o-shield-check class="w-4 h-4" />

                    Tipo de acceso:
                </span>

                <p class="text-sm mt-1">
                    <span
                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium
                        {{ $acceso === 'Publico'
                            ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400'
                            : 'bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-400' }}">

                        @if ($acceso === 'Publico')
                            <x-heroicon-s-lock-open class="w-4 h-4" />
                        @else
                            <x-heroicon-s-lock-closed class="w-4 h-4" />
                        @endif

                        {{ $acceso === 'Publico' ? 'Público' : 'Restringido' }}
                    </span>
                </p>
            </div>

        </div>
    </div>

</div>
