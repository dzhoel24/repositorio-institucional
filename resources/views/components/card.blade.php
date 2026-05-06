<a href="{{ $generateRoute($parametro, $action, $codigo) }}" class="flex items-center w-full mb-2 bg-zinc-200 border border-gray-300 rounded-lg shadow-lg md:flex-row md:w-full hover:bg-zinc-300 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
    <img class="border border-black object-cover rounded-lg w-48 h-48 md:h-48 md:w-48 md:rounded-none md:rounded-s-lg" src="{{ asset('storage/caratulas/'.$image) }}" alt="">
    <div class="w-full flex flex-col justify-between px-4 leading-normal">
        <h5 class="mb-1 text-2xl font-bold tracking-tight text-black dark:text-white">{{ $title }}</h5>
        <p class="text-sm text-black">{{ $autores }}</p>
        <p class="{{ $getColor() }} font-semibold ">
            <box-icon name="{{ $getIcon() }}" type="solid" color="{{ $getColor() }}" style="width: 20px; height: 20px;"></box-icon>
            {{ $acceso }}
            
        </p>
        <p class="w-full mb-3 font-normal text-black dark:text-gray-400">{{ $resumen }}</p>
    </div>
</a>
