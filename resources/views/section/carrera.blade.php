<x-app-main title="Modulo">
    <div class="bg-black">
        <x-breadcrumb name="item.index" :programa="$carreraN"></x-breadcrumb>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-2 sm:gap-4">
        <div class="container hidden md:block">
           <x-filter></x-filter>
        </div>
        <div class="md:col-span-3 flex flex-col w-full px-4">
            <h3 class="text-3xl font-semibold py-2">Buscar</h3>
            <x-search
                :parametro="'institucional'"
                :parametro2="'index'"
                :descrip="'Buscar en todo el repositorio'"
            />
            <div class="w-full flex justify-between py-2">
                <x-count :contador="$contador" :paginator="$items" />
                <x-advanced-filter-carrera route="carrera.index" :params="isset($carrera) ? ['carrera' => $carrera] : []" defaultSort="asc" defaultItemsPerPage="10" />
            </div>
            <div class="py-2">
                <form class="max-w-lg w-full" method="GET" action="{{ route('carrera.index', ['carrera' => $carrera ?? 1]) }}">
                    <div class="relative flex items-center w-full">
                        <input 
                            type="search" 
                            id="search-dropdown" 
                            name="search" 
                            class="block w-full p-3 pl-10 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                            placeholder="O introducir las primeras letras" 
                            required />
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <button 
                            type="submit" 
                            class="absolute right-0 top-0 bottom-0 p-3 text-sm font-medium text-white bg-blue-700 rounded-r-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            IR
                        </button>
                    </div>
                </form>
                
            </div>
            <div class="py-2 gap-4 w-full ">
                @foreach ($items as $item)
                    <a href="{{ route('carrera.show', ['id' => $item->id]) }}" class="flex items-center w-full mb-2 bg-zinc-200 border border-gray-300 rounded-lg shadow-lg md:flex-row md:w-full hover:bg-zinc-300 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <img class="border border-black object-cover rounded-lg w-48 h-48 md:h-48 md:w-48 md:rounded-none md:rounded-s-lg" src="{{ asset($item->ruta_caratula) }}" alt="">
                        <div class="w-full flex flex-col justify-between px-4 leading-normal">
                            <h5 class="mb-1 text-2xl font-bold tracking-tight text-black dark:text-white">{{ $item->titulo }}</h5>
                            <p class="text-sm text-black">{{ $item->autores->implode(', ') }}</p>
                            <p class="{{ $item->acceso === 'Publico' ? 'text-green-600' : 'text-red-600' }} font-semibold">
                                <box-icon name="{{ $item->acceso === 'Publico' ? 'lock-open-alt' : 'lock-alt' }}" type="solid" color="{{ $item->acceso === 'Publico' ? 'green' : 'red' }}" style="width: 20px; height: 20px;"></box-icon>
                                {{ $item->acceso }}
                            </p>
                            <p class="w-full mb-3 font-normal text-black dark:text-gray-400">{{ $item->resumen }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <x-pagination :paginator="$items" />

        </div>

    </div>
</x-app-main>
