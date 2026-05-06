<div class="overflow-x-auto ">
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left text-xl">Nombre de los autores</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach ($autores as $autor)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <a href="{{ route('filtros.informesA', ['autor' => $autor]) }}" class="hover:underline">
                            {{ $autor->apellidos . ' ' . $autor->nombre }} [{{ $autor->informes_count }}]
                        </a>                                              
                    </td>
                </tr>
            @endforeach
        </tbody>       
    </table>
</div>
