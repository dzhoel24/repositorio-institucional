@foreach ($autores as $autor)
    <div class="fixed inset-0 z-[999] hidden modal" id="edit-modal{{ $autor->dni }}" role="dialog" aria-modal="true"
        aria-labelledby="edit-title-{{ $autor->dni }}">

        <!-- BACKDROP -->
        <div class="absolute inset-0 bg-black/60 modal-overlay"></div>

        <!-- CENTER -->
        <div class="relative flex items-center justify-center min-h-screen p-4 pointer-events-none">

            <!-- CARD -->
            <div
                class="w-full max-w-md rounded-2xl bg-white dark:bg-zinc-900 shadow-2xl overflow-hidden pointer-events-auto modal-animate">

                <!-- HEADER -->
                <div class="p-5 text-center border-b border-zinc-100 dark:border-zinc-800">

                    <h2 id="edit-title-{{ $autor->dni }}" class="text-lg font-semibold text-zinc-900 dark:text-white">
                        Editar autor
                    </h2>

                    <p class="text-sm text-zinc-500 mt-1">
                        Autor:
                        <span class="font-medium text-zinc-700 dark:text-zinc-300">
                            {{ $autor->nombres }} {{ $autor->apellidos }}
                        </span>
                    </p>

                    <p class="text-xs text-zinc-500 mt-1">
                        DNI: {{ $autor->dni }}
                    </p>

                </div>

                <!-- FORM -->
                <form action="{{ route('admin.autores.update', $autor->dni) }}" method="POST"
                    class="px-6 py-5 space-y-4">

                    @csrf
                    @method('PUT')

                    <!-- NOMBRES -->
                    <div>
                        <label for="nombres-{{ $autor->dni }}" class="text-xs text-zinc-500 mb-1 block">
                            Nombres
                        </label>

                        <input id="nombres-{{ $autor->dni }}" type="text" name="nombres"
                            value="{{ $autor->nombres }}" required
                            class="w-full rounded-xl border border-zinc-200 dark:border-zinc-700
                        bg-zinc-50 dark:bg-zinc-800 text-zinc-900 dark:text-white
                        px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500
                        focus:outline-none transition">
                    </div>

                    <!-- APELLIDOS -->
                    <div>
                        <label for="apellidos-{{ $autor->dni }}" class="text-xs text-zinc-500 mb-1 block">
                            Apellidos
                        </label>

                        <input id="apellidos-{{ $autor->dni }}" type="text" name="apellidos"
                            value="{{ $autor->apellidos }}" required
                            class="w-full rounded-xl border border-zinc-200 dark:border-zinc-700
                        bg-zinc-50 dark:bg-zinc-800 text-zinc-900 dark:text-white
                        px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500
                        focus:outline-none transition">
                    </div>

                    <!-- ACTIONS -->
                    <div class="flex gap-3 pt-2">

                        <button type="button" data-tw-dismiss="modal"
                            class="flex-1 py-2.5 rounded-xl bg-zinc-100 dark:bg-zinc-800
                        text-zinc-700 dark:text-white text-sm font-medium
                        hover:bg-zinc-200 dark:hover:bg-zinc-700 transition">
                            Cancelar
                        </button>

                        <button type="submit"
                            class="flex-1 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-medium
                        hover:bg-blue-500 transition shadow-md hover:shadow-lg">
                            Guardar cambios
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
@endforeach
