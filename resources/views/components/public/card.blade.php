<a href="{{ $url }}"
    class="group flex flex-col sm:flex-row w-full mb-6 bg-white dark:bg-gray-900 border border-slate-100 dark:border-gray-800 rounded-2xl shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 ease-out overflow-hidden focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 dark:focus:ring-offset-gray-950">

    <div
        class="relative overflow-hidden sm:w-48 md:w-56 shrink-0 aspect-video sm:aspect-square bg-slate-50 dark:bg-gray-950">
        <img class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
            src="{{ asset('storage/caratulas/' . $image) }}" alt="{{ $title }}" loading="lazy">

        <div class="absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-transparent pointer-events-none">
        </div>

        <div
            class="absolute top-3 left-3 backdrop-blur-sm bg-slate-900/60 dark:bg-black/50 rounded-lg px-2.5 py-1.5 border border-white/5 shadow-sm">
            <span
                class="flex items-center justify-center gap-1.5 text-white text-[11px] font-semibold tracking-wide whitespace-nowrap leading-none">
                <x-heroicon-s-calendar class="w-3.5 h-3.5 text-indigo-300 shrink-0" />
                {{ $anio }}
            </span>
        </div>

        {{-- Badge acceso flotante (Colores mejorados) --}}
        <div class="absolute bottom-3 right-3">
            <span
                class="flex items-center justify-center gap-1.5 px-2.5 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-wider shadow-sm whitespace-nowrap leading-none
                {{ $acceso === 'Publico'
                    ? 'bg-emerald-500/90 dark:bg-emerald-600 text-white'
                    : 'bg-rose-500/90 dark:bg-rose-600 text-white' }}">
                @if ($acceso === 'Publico')
                    <x-heroicon-s-lock-open class="w-3 h-3 shrink-0" />
                @else
                    <x-heroicon-s-lock-closed class="w-3 h-3 shrink-0" />
                @endif
                {{ $acceso === 'Publico' ? 'Público' : 'Restringido' }}
            </span>
        </div>
    </div>

    <div class="flex flex-col justify-between flex-1 p-5 sm:p-6">
        <div>
            <h3
                class="text-lg md:text-xl font-bold text-slate-900 dark:text-slate-100 line-clamp-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors duration-200">
                {{ $title }}
            </h3>

            <div class="flex items-center gap-2 mt-2.5 text-slate-600 dark:text-slate-400">
                <x-heroicon-s-users class="w-4 h-4 text-indigo-400/80 dark:text-indigo-500/80 shrink-0" />
                <span class="text-xs font-medium line-clamp-1">
                    {{ $autores }}
                </span>
            </div>

            <p class="mt-3 text-sm text-slate-700 dark:text-slate-300 line-clamp-2 md:line-clamp-3 leading-relaxed">
                {{ $resumen }}
            </p>
        </div>

        <div class="mt-4 pt-3.5 border-t border-slate-100 dark:border-gray-800/60">
            <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                <span
                    class="relative pb-0.5 after:absolute after:bottom-0 after:left-0 after:h-[1.5px] after:w-0 group-hover:after:w-full after:bg-indigo-600 dark:after:bg-indigo-400 after:transition-all after:duration-300 after:ease-in-out">
                    Leer más
                </span>
                <x-heroicon-s-arrow-right
                    class="w-4 h-4 transition-transform duration-300 ease-out group-hover:translate-x-1" />
            </span>
        </div>
    </div>
</a>
