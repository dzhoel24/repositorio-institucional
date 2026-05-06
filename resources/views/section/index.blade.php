<x-app-main title="Sectiones">
    <div class="bg-black">
        <x-breadcrumb name="section.index"></x-breadcrumb>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-2 sm:gap-4">
        <div class="container hidden md:block">
            <x-filter></x-filter>
        </div>
        <div class="md:col-span-3 flex flex-col w-full px-4">
            <table class="my-11">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left text-xl">Programas de Estudio</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <a href="{{ route('carrera.index', ['carrera' => '1']) }}" class="hover:underline">
                                Contabilidad
                            </a>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <a href="{{ route('carrera.index', ['carrera' => '2']) }}" class="hover:underline">
                                Desarrollo de Sistemas de Información
                            </a>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <a href="{{ route('carrera.index', ['carrera' => '5']) }}" class="hover:underline">
                                Electricidad Industrial
                            </a>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <a href="{{ route('carrera.index', ['carrera' => '6']) }}" class="hover:underline">
                                Electrónica Industrial
                            </a>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <a href="{{ route('carrera.index', ['carrera' => '4']) }}" class="hover:underline">
                                Enfermería Técnica
                            </a>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <a href="{{ route('carrera.index', ['carrera' => '8']) }}" class="hover:underline">
                                Mecánica de Producción Automotriz
                            </a>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <a href="{{ route('carrera.index', ['carrera' => '7']) }}" class="hover:underline">
                                Mecatrónica Automotriz
                            </a>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <a href="{{ route('carrera.index', ['carrera' => '3']) }}" class="hover:underline">
                                Química
                            </a>
                        </td>
                    </tr>
                </tbody>


            </table>

        </div>

    </div>
</x-app-main>
