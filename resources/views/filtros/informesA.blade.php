<x-app-main>
    <div class="bg-black">
        <x-breadcrumb name="filtros.autores"></x-breadcrumb>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-2 sm:gap-4">
        <div class="container hidden md:block">
           <x-filter></x-filter>
        </div>
        <div class="md:col-span-3 flex flex-col w-full px-4">
            <!-- Sección de búsqueda -->
            <h3 class="text-3xl font-semibold py-2">Buscar</h3>
            <x-search
                :parametro="'institucional'"
                :parametro2="'index'"
                :descrip="'Buscar en todo el repositorio'"
            />
            <h2 class="text-2xl font-semibold py-2">Listar por Autor {{$nombre??null}}</h2>
            
            <div class="w-full flex py-2 ">
                <ul id="list" class="flex gap-x-4 text-blue-500">
                    <ul id="list" class="flex gap-x-4 text-blue-500">
                        @foreach(range('A', 'Z') as $letter)
                            <li class="ds-simple-list-item">
                                <a href="{{ url('filtros/autores/search?starts_with=' . $letter) }}">{{ $letter }}</a>
                            </li>
                        @endforeach
                    </ul>
                </ul>
                
            </div>
            
            <x-search
                :parametro="'filtros'"
                :parametro2="'autores'"
                :descrip="'Introduce las primeras letras'"
                :text="'IR'" 
            />
                <div class="py-2 gap-4 w-full">
                    @foreach ($informes as $informe)
                        <x-card
                            :parametro="'filtros'"
                            :codigo="$informe->id" 
                            :image="$informe->ruta_caratula"
                            :title="$informe->titulo"
                            :resumen="$informe->resumen"
                            :autores="$informe->autores"
                            :acceso="$informe->acceso"
                            :action="'showInformeAutores'"
                        />
                    @endforeach


                </div>
            <x-pagination :paginator="$informes" />
        </div>
    </div>
</x-app-main>
