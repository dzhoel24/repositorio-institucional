<div class=" p-2 grid grid-cols-4 w-full gap-2 sm:gap-4">
    <div class="col-span-4 ">
        <h2 class="text-3xl font-semibold">{{$title}}</h1>
        <hr>
    </div>
    <div class="col-span-1 flex flex-col ">
        <img class="w-72 h-auto" src="{{ asset($image) }}" alt="">
        <div class="flex flex-col justify-center py-2 gap-4 items-center">
            <button class="p-2 bg-blue-500 w-auto text-white rounded hover:bg-blue-700">Descargar Documento</button>
            <button class="p-2 bg-blue-500 w-auto text-white rounded hover:bg-blue-700">Descargar Documento</button>
        </div>
    </div>
    <div class="col-span-3">
        <p class="w-full text-sm font-semibold">{{$resumen}}</p>
        <div class="flex flex-col pt-4">
            <div>
                <span class="text-lg font-semibold">
                    Autor(es):
                </span>
                <p>{{$autores}}</p>
            </div>
            <div>
                <span class="text-lg font-semibold">
                    Año. Creación:
                </span>
                <p>{{ $anio ?? 'Año no disponible' }}</p>
            </div>
            <div>
                <span class="text-lg font-semibold">
                    Tipo de acceso:
                </span>
                <p>{{ $acceso}}</p>
            </div>
        </div>
    </div>
</div>
