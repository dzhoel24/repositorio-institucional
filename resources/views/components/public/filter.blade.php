<div class="w-full space-y-5">
    {{-- EXPLORAR --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center gap-2 bg-slate-800 px-4 py-2.5 text-slate-200">
            <x-heroicon-s-squares-2x2 class="w-4 h-4 text-indigo-400 shrink-0" />
            <h4 class="text-xs font-bold uppercase tracking-wider">Explorar</h4>
        </div>
        <nav class="flex flex-col">
            <a href="{{ route('filtros.autores.index') }}"
                class="block text-sm text-slate-600 px-4 py-3 border-b border-slate-100 hover:bg-slate-50 transition-colors">Autores</a>
            <a href="{{ route('filtros.fechas.index') }}"
                class="block text-sm text-slate-600 px-4 py-3 border-b border-slate-100 hover:bg-slate-50 transition-colors">Fecha
                de publicación</a>
            <a href="{{ route('filtros.titulos.index') }}"
                class="block text-sm text-slate-600 px-4 py-3 border-b border-slate-100 hover:bg-slate-50 transition-colors">Títulos</a>
            <a href="{{ route('filtros.carreras.index') }}"
                class="block text-sm text-slate-600 px-4 py-3 hover:bg-slate-50 transition-colors">Programas de
                estudio</a>
        </nav>
    </div>

    {{-- FILTRAR POR TIPO --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center gap-2 bg-slate-800 px-4 py-2.5 text-slate-200">
            <x-heroicon-s-tag class="w-4 h-4 text-indigo-400 shrink-0" />
            <h4 class="text-xs font-bold uppercase tracking-wider">Filtrar por tipo</h4>
        </div>
        <nav class="flex flex-col">
            @php
                $tipos = [
                    'institucional' => 'Todos los documentos',
                    'investigacion' => 'Investigación',
                    'modulo' => 'Prácticas modulares',
                    'titulacion' => 'Titulación',
                    'feria' => 'Feria tecnológica'
                ];
            @endphp
            @foreach ($tipos as $key => $label)
                <a href="{{ route('repositorio.index', ['tipo' => $key]) }}"
                    class="block text-sm text-slate-600 px-4 py-3 {{ !$loop->first ? 'border-t border-slate-100' : '' }} hover:bg-slate-50 transition-colors">
                    {{ $label }}
                </a>
            @endforeach
        </nav>
    </div>

    {{-- AUTORES DESTACADOS --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center gap-2 bg-slate-800 px-4 py-2.5 text-slate-200">
            <x-heroicon-s-users class="w-4 h-4 text-indigo-400 shrink-0" />
            <h4 class="text-xs font-bold uppercase tracking-wider">Autores destacados</h4>
        </div>
        <nav class="flex flex-col">
            @forelse ($topAutors as $autor)
                <a href="{{ route('filtros.autores.informes', ['autor' => $autor['dni']]) }}"
                    class="flex items-center justify-between text-sm text-slate-600 px-4 py-3 border-b border-slate-100 hover:bg-slate-50 transition-colors group">
                    <span class="truncate pr-2 group-hover:text-indigo-600 transition-colors">{{ $autor['apellidos'] }},
                        {{ $autor['nombre'] }}</span>
                    <span
                        class="px-2 py-0.5 text-xs rounded-full bg-slate-100 text-slate-500 shrink-0 group-hover:bg-indigo-100 group-hover:text-indigo-600 transition-colors">{{ $autor['count'] }}</span>
                </a>
            @empty
                <div class="text-sm text-slate-500 px-4 py-6 text-center">No hay autores destacados</div>
            @endforelse
            <a href="{{ route('filtros.autores.index') }}"
                class="block text-center text-sm text-indigo-600 px-4 py-3 hover:bg-indigo-50 transition-colors font-medium">Ver
                todos los autores →</a>
        </nav>
    </div>
</div>
