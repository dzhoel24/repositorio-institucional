<div class="p-4 sm:p-6 md:p-8 bg-white rounded-xl shadow-sm border border-slate-100">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8">

        <div class="md:col-span-5 lg:col-span-4 space-y-4 sm:space-y-5">

            <div class="relative group rounded-xl overflow-hidden bg-slate-50 border border-slate-200 shadow-sm">
                <img class="w-full aspect-[4/3] object-cover transition-transform duration-500 group-hover:scale-105"
                    src="{{ asset('storage/caratulas/' . $image) }}" alt="{{ $title }}" loading="lazy"
                    onerror="this.src='{{ asset('images/default-cover.jpg') }}'">

                <div
                    class="absolute inset-0 bg-gradient-to-b from-black/20 via-transparent to-black/40 pointer-events-none">
                </div>

                <div class="absolute top-3 right-3">
                    <span
                        class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-md text-[11px] font-bold uppercase tracking-wider backdrop-blur-md shadow-sm text-white
                        {{ $acceso === 'Publico' ? 'bg-emerald-600/90' : 'bg-rose-600/90' }}">
                        @if ($acceso === 'Publico')
                            <x-heroicon-s-lock-open class="w-3.5 h-3.5 shrink-0" />
                        @else
                            <x-heroicon-s-lock-closed class="w-3.5 h-3.5 shrink-0" />
                        @endif
                        {{ $acceso === 'Publico' ? 'Acceso Libre' : 'Restringido' }}
                    </span>
                </div>

                @if ($anio)
                    <div class="absolute bottom-3 left-3">
                        <span
                            class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-md bg-black/70 backdrop-blur-sm text-white text-[11px] font-semibold">
                            <x-heroicon-s-calendar class="w-3.5 h-3.5 text-indigo-300 shrink-0" />
                            {{ $anio }}
                        </span>
                    </div>
                @endif
            </div>

            <div class="space-y-2.5 sm:space-y-3">
                @if ($acceso === 'Publico' && $pdf)
                    <a href="{{ asset('storage/pdfs/' . $pdf) }}" download
                        class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-indigo-600 hover:bg-indigo-700 active:scale-[0.99] text-white rounded-lg font-semibold text-sm transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 shadow-sm">
                        <x-heroicon-s-arrow-down-tray class="w-4 h-4" />
                        Descargar PDF
                    </a>

                    <button onclick="navigator.clipboard.writeText(window.location.href); showToast('Enlace copiado')"
                        class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-slate-50 text-slate-700 border border-slate-200 rounded-lg font-medium text-sm hover:bg-slate-100 transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-slate-400">
                        <x-heroicon-s-share class="w-4 h-4 text-slate-400" />
                        Compartir enlace
                    </button>
                @else
                    <div
                        class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-slate-50 text-slate-400 border border-slate-200 rounded-lg font-medium text-sm cursor-not-allowed">
                        <x-heroicon-s-lock-closed class="w-4 h-4" />
                        Descarga no disponible
                    </div>
                @endif
            </div>
        </div>

        <div class="md:col-span-7 lg:col-span-8 space-y-5 sm:space-y-6">

            <div class="space-y-3">
                <h1
                    class="text-xl sm:text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight break-words">
                    {{ $title }}
                </h1>

                <div
                    class="flex items-center gap-2 text-sm text-slate-600 bg-slate-50 w-fit px-3 py-1.5 rounded-md border border-slate-200">
                    <x-heroicon-s-users class="w-4 h-4 text-indigo-500 shrink-0" />
                    <span class="font-semibold text-xs sm:text-sm">{{ $autores ?: 'Autor no especificado' }}</span>
                </div>
            </div>

            <div class="bg-slate-50/60 border-l-4 border-indigo-600 p-4 sm:p-5 rounded-r-xl">
                <h3 class="text-[10px] sm:text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">
                    Resumen / Sinopsis
                </h3>
                <p class="text-xs sm:text-sm font-medium text-slate-700 leading-relaxed text-left sm:text-justify">
                    {{ $resumen ?: 'Sin resumen disponible.' }}
                </p>
            </div>

            <div class="grid grid-cols-2 sm:flex sm:flex-wrap gap-3 sm:gap-4 pt-1">

                <div
                    class="flex items-center gap-2.5 sm:gap-3 bg-white border border-slate-200 p-2.5 sm:px-3.5 sm:py-2 rounded-lg shadow-sm">
                    <div class="p-1.5 sm:p-2 bg-indigo-50 rounded-md">
                        <x-heroicon-s-document-text class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-indigo-600" />
                    </div>
                    <div>
                        <p class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-slate-400">Tipo</p>
                        <p class="text-xs sm:text-sm font-bold text-slate-700">{{ $tipo ?? 'Documento' }}</p>
                    </div>
                </div>

                <div
                    class="flex items-center gap-2.5 sm:gap-3 bg-white border border-slate-200 p-2.5 sm:px-3.5 sm:py-2 rounded-lg shadow-sm">
                    <div class="p-1.5 sm:p-2 {{ $acceso === 'Publico' ? 'bg-emerald-50' : 'bg-rose-50' }} rounded-md">
                        @if ($acceso === 'Publico')
                            <x-heroicon-s-lock-open class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-emerald-600" />
                        @else
                            <x-heroicon-s-lock-closed class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-rose-600" />
                        @endif
                    </div>
                    <div>
                        <p class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-slate-400">Condición
                        </p>
                        <p
                            class="text-xs sm:text-sm font-bold {{ $acceso === 'Publico' ? 'text-emerald-600' : 'text-rose-600' }}">
                            {{ $acceso === 'Publico' ? 'Público' : 'Restringido' }}
                        </p>
                    </div>
                </div>

                @if ($anio)
                    <div
                        class="flex items-center gap-2.5 sm:gap-3 bg-white border border-slate-200 p-2.5 sm:px-3.5 sm:py-2 rounded-lg shadow-sm">
                        <div class="p-1.5 sm:p-2 bg-amber-50 rounded-md">
                            <x-heroicon-s-calendar class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-amber-600" />
                        </div>
                        <div>
                            <p class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                Publicado</p>
                            <p class="text-xs sm:text-sm font-bold text-slate-700">{{ $anio }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function showToast(message) {
        const toast = document.createElement('div');
        toast.className =
            'fixed bottom-4 right-4 bg-slate-800 text-white text-sm px-4 py-2 rounded-lg shadow-lg z-50 animate-in fade-in slide-in-from-bottom-2';
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.remove();
        }, 2000);
    }
</script>

<style>
    @keyframes fade-in {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes slide-in-from-bottom-2 {
        from {
            transform: translateY(0.5rem);
        }

        to {
            transform: translateY(0);
        }
    }

    .animate-in {
        animation: fade-in 0.2s ease-out, slide-in-from-bottom-2 0.2s ease-out;
    }
</style>
