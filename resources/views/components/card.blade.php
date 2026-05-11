<a href="{{ $generateRoute($parametro, $action, $codigo) }}"
    class="group flex flex-col md:flex-row w-full mb-6 bg-white border border-gray-200 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 dark:bg-gray-800 dark:border-gray-700 overflow-hidden">

    <!-- Contenedor de imagen con efecto hover -->
    <div class="relative overflow-hidden md:w-48 h-48 md:h-auto bg-gray-100 dark:bg-gray-700">
        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
            src="{{ asset('storage/caratulas/' . $image) }}" alt="{{ $title }}">

        <!-- Badfloating badge opcional (ej: año o tipo) -->
        @if (isset($anio))
            <div class="absolute top-2 left-2 bg-black/70 backdrop-blur-sm text-white text-xs px-2 py-1 rounded-full">
                {{ $anio }}
            </div>
        @endif
    </div>

    <!-- Contenido principal -->
    <div class="flex flex-col flex-1 p-5">
        <!-- Título -->
        <h5
            class="text-xl md:text-2xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
            {{ $title }}
        </h5>

        <!-- Autores -->
        <div class="flex items-center gap-2 mt-2 text-sm text-gray-600 dark:text-gray-400">
            @svg('heroicon-s-users', 'w-4 h-4')
            <span>{{ $autores }}</span>
        </div>

        <!-- Badge de acceso con diseño mejorado -->
        <div class="mt-3">
            <span
                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $getColor() }} bg-opacity-10 {{ str_replace('text-', 'bg-', $getColor()) }} bg-opacity-10">
                @svg('heroicon-s-' . $getIcon(), 'w-4 h-4')
                {{ $acceso }}
            </span>
        </div>

        <!-- Resumen con límite de líneas -->
        <p class="mt-3 text-sm text-gray-700 dark:text-gray-300 line-clamp-3 leading-relaxed">
            {{ $resumen }}
        </p>

        <!-- Footer con enlace de lectura -->
        <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700">
            <span
                class="inline-flex items-center text-sm font-medium text-blue-600 dark:text-blue-400 group-hover:gap-2 transition-all">
                Leer más
                @svg('heroicon-s-arrow-right', 'w-4 h-4 ml-1 transition-transform group-hover:translate-x-1')
            </span>
        </div>
    </div>
</a>
