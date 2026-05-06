<div class="w-full bg-gray-200 px-2 pb-2 sm:grid">
    <h3 class="text-black font-medium py-2 pl-2">Mostrar en lista</h3>
    <div>
        <h1 class="text-normal font-normal text-start bg-gray-800 text-white rounded-t-md pl-2 py-2">Todo el repositorio</h1>

        <a href="{{ route('institucional.index') }}" class="block hover:bg-gray-300 hover:shadow-lg transition-shadow duration-300 ease-in-out text-base text-start cursor-pointer text-black p-2 border-gray-300 border">Todo el repositorio</a>
        <a href="{{ route('filtros.autores') }}" class="block hover:bg-gray-300 hover:shadow-lg transition-shadow duration-300 ease-in-out text-base text-start cursor-pointer text-black p-2 border-gray-300 border">Autores</a>
        <a href="{{ route('filtros.fechaP') }}" class="block hover:bg-gray-300 hover:shadow-lg transition-shadow duration-300 ease-in-out text-base text-start cursor-pointer text-black p-2 border-gray-300 border">Por fecha de publicación</a>
        <a href="{{ route('filtros.listTitle') }}" class="block hover:bg-gray-300 hover:shadow-lg transition-shadow duration-300 ease-in-out text-base text-start cursor-pointer text-black p-2 border-gray-300 border">Títulos</a>
        <a href="{{ route('filtros.category') }}" class="block hover:bg-gray-300 hover:shadow-lg transition-shadow duration-300 ease-in-out text-base text-start cursor-pointer text-black p-2 border-gray-300 border">Programas de Estudio</a>

    </div>

    <div>
        <h3 class="text-black font-medium py-2 pl-2">Filtrar búsqueda</h3>
        <h2 class="text-normal font-normal text-start bg-gray-800 text-white rounded-t-md pl-2 py-2">Autor</h2>
        @foreach ($topAutors as $autor)
            <a href="{{ route('filtros.showAutor', $autor['dni']) }}" class="block hover:bg-gray-300 hover:shadow-lg transition-shadow duration-300 ease-in-out text-base text-start cursor-pointer text-black p-2 border-gray-300 border">
                {{ $autor['apellidos'] }} {{ $autor['nombre'] }} ({{ $autor['count'] }})
            </a>
        @endforeach

        <a href="{{ route('filtros.autores') }}" class="block hover:bg-gray-300 hover:shadow-lg transition-shadow duration-300 ease-in-out text-base text-start cursor-pointer text-black p-2 border-gray-300 border">
            Más ...
        </a>
    </div>
    <div>
        <h3 class="text-black font-medium py-2 pl-2">Filtrar</h3>
        <h2 class="text-normal font-normal text-start bg-gray-800 text-white rounded-t-md pl-2 py-2">Fecha</h2>

        @foreach ($yearRanges as $range)
            <a href="{{route('filtros.rangeYear', $range)}}" class="block hover:bg-gray-300 hover:shadow-lg transition-shadow duration-300 ease-in-out text-base text-start cursor-pointer text-black p-2 border-gray-300 border">{{ $range }}</a>
        @endforeach
    </div>

</div>
