<a href="{{ $url }}"
    class="group flex flex-col sm:flex-row w-full mb-5 bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 overflow-hidden focus:outline-none focus:ring-1 focus:ring-indigo-400/40 focus:border-indigo-300">

    <div
        class="relative overflow-hidden sm:w-44 md:w-56 shrink-0 aspect-video sm:aspect-square bg-gradient-to-br from-slate-100 to-slate-200">
        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
            src="{{ Storage::disk('r2')->url('caratulas/' . $image) }}" alt="{{ $title }}" loading="lazy"
            onerror="this.src='{{ asset('images/default-cover.jpg') }}'">

        <div class="absolute top-2 left-2 sm:top-3 sm:left-3">
            <div
                class="inline-flex items-center gap-1 px-1.5 py-0.5 sm:px-2 sm:py-1 bg-black/60 backdrop-blur-sm rounded-md text-white text-[10px] sm:text-[11px] font-medium">
                <x-heroicon-s-calendar class="w-2.5 h-2.5 sm:w-3 sm:h-3" />
                <span>{{ $anio }}</span>
            </div>
        </div>

        <div class="absolute bottom-2 right-2 sm:bottom-3 sm:right-3">
            <div
                class="inline-flex items-center gap-1 px-1.5 py-0.5 sm:px-2 sm:py-1 rounded-md text-[9px] sm:text-[10px] font-semibold uppercase shadow-sm
                {{ $acceso === 'Publico' ? 'bg-emerald-600 text-white' : 'bg-rose-600 text-white' }}">
                @if ($acceso === 'Publico')
                    <x-heroicon-s-lock-open class="w-2 h-2 sm:w-2.5 sm:h-2.5" />
                @else
                    <x-heroicon-s-lock-closed class="w-2 h-2 sm:w-2.5 sm:h-2.5" />
                @endif
                <span class="text-[9px] sm:text-[10px]">{{ $acceso === 'Publico' ? 'Público' : 'Restringido' }}</span>
            </div>
        </div>
    </div>

    <div class="flex-1 p-3 sm:p-5">
        <h3
            class="text-sm sm:text-base md:text-lg font-bold text-slate-800 line-clamp-2 group-hover:text-indigo-600 transition-colors">
            {{ $title }}
        </h3>

        <div class="flex items-center gap-1.5 mt-1.5 sm:mt-2 text-slate-500">
            <x-heroicon-s-users class="w-3 h-3 sm:w-3.5 sm:h-3.5 shrink-0" />
            <span class="text-xs sm:text-sm line-clamp-1">
                {{ $autores ?: 'Autor no especificado' }}
            </span>
        </div>

        <p class="mt-1.5 sm:mt-2 text-xs sm:text-sm text-slate-600 line-clamp-2 md:line-clamp-3 leading-relaxed">
            {{ $resumen ?: 'Sin resumen disponible.' }}
        </p>

        <div class="mt-2 sm:mt-3 pt-1.5 sm:pt-2 border-t border-slate-100">
            <span
                class="inline-flex items-center gap-1 text-xs sm:text-sm font-medium text-indigo-600 group-hover:gap-1.5 transition-all">
                Leer más
                <x-heroicon-s-arrow-right
                    class="w-3 h-3 sm:w-3.5 sm:h-3.5 transition-transform group-hover:translate-x-0.5" />
            </span>
        </div>
    </div>
</a>
