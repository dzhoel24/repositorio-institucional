<x-public.app-main title="Índice de Autores">
    <x-public.breadcrumb name="filtros.autores.index" />

    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-6 lg:gap-8 mt-4 sm:mt-6">

        <aside class="hidden md:block md:col-span-1">
            <div class="sticky top-6">
                <x-public.filter />
            </div>
        </aside>

        <main class="md:col-span-3 flex flex-col w-full px-2 sm:px-4 space-y-4">

            <div class="flex items-center justify-between border-b border-slate-200 dark:border-gray-800 pb-3 mb-2">
                <div class="flex items-center gap-2.5">
                    <div class="h-6 w-1 bg-indigo-600 dark:bg-indigo-400 rounded-full"></div>
                    <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100 tracking-wide">
                        Listar por: {{ $nombre ?? 'Todos los autores' }}
                    </h2>
                </div>
                <div class="bg-slate-100 dark:bg-slate-800 rounded-full px-3 py-1">
                    <span class="text-xs font-semibold text-slate-600 dark:text-slate-400">
                        <span class="text-indigo-600 dark:text-indigo-400">{{ $autores->total() }}</span> autores
                    </span>
                </div>
            </div>

            <div class="w-full pb-1">
                <ul id="list"
                    class="flex items-center gap-1 overflow-x-auto pb-2 scrollbar-thin scrollbar-thumb-slate-200 dark:scrollbar-thumb-gray-800">

                    @php
                        $isAll = !request('starts_with');
                    @endphp
                    <li class="shrink-0">
                        <a href="{{ url('filtros/autores') }}"
                            class="flex items-center justify-center min-w-[48px] h-8 px-3 text-xs font-bold uppercase rounded transition-all duration-150
                           {{ $isAll
                               ? 'bg-indigo-600 text-white shadow-sm'
                               : 'bg-slate-100 dark:bg-gray-800 text-slate-600 dark:text-slate-400 hover:bg-indigo-50 dark:hover:bg-indigo-950/40 hover:text-indigo-600 dark:hover:text-indigo-400 border border-slate-200/40 dark:border-gray-700/50' }}">
                            Todos
                        </a>
                    </li>

                    @foreach (range('A', 'Z') as $letter)
                        @php
                            $isCurrent = request('starts_with') === $letter;
                        @endphp
                        <li class="shrink-0">
                            <a href="{{ url('filtros/autores?starts_with=' . $letter) }}"
                                class="flex items-center justify-center min-w-[32px] h-8 px-2 text-xs font-bold uppercase rounded transition-all duration-150
                               {{ $isCurrent
                                   ? 'bg-indigo-600 text-white shadow-sm'
                                   : 'bg-slate-100 dark:bg-gray-800 text-slate-600 dark:text-slate-400 hover:bg-indigo-50 dark:hover:bg-indigo-950/40 hover:text-indigo-600 dark:hover:text-indigo-400 border border-slate-200/40 dark:border-gray-700/50' }}">
                                {{ $letter }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="w-full pt-1">
                <x-public.search :parametro="'filtros'" :parametro2="'autores'" :descrip="'Introduce las primeras letras del autor...'" :text="'Buscar'" />
            </div>

            <div class="w-full">
                @if ($autores->isEmpty())
                    <div
                        class="text-center py-12 bg-slate-50/50 dark:bg-gray-900/30 rounded-lg border border-dashed border-slate-200 dark:border-gray-800">
                        <svg class="w-8 h-8 text-slate-300 dark:text-gray-600 mx-auto mb-3" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="text-sm font-medium text-slate-500 dark:text-gray-400">
                            Lo sentimos, no se encontraron autores registrados con esos criterios.
                        </p>
                    </div>
                @else
                    <div class="overflow-hidden border border-slate-200 dark:border-gray-800 rounded-lg shadow-sm">
                        <div class="overflow-x-auto ">
                            <table class="min-w-full bg-white border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left text-xl">Nombre de los autores</th>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @foreach ($autores as $autor)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                <a href="{{ route('filtros.autores.informes', ['autor' => $autor]) }}"
                                                    class="hover:underline">
                                                    {{ $autor->apellidos . ' ' . $autor->nombres }}
                                                    [{{ $autor->informes_count }}]
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                @endif
            </div>

            <x-public.pagination :paginator="$autores" />

        </main>
    </div>
</x-public.app-main>
