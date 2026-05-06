@foreach ($autores as $autor)

<div class="fixed inset-0 z-[999] hidden modal"
     id="delete-modal{{ $autor->dni }}"
     role="dialog"
     aria-modal="true"
     aria-labelledby="delete-title-{{ $autor->dni }}">

    <!-- BACKDROP -->
    <div class="absolute inset-0 bg-black/60 modal-overlay"></div>

    <!-- CENTER -->
    <div class="relative flex items-center justify-center min-h-screen p-4 pointer-events-none">

        <!-- CARD -->
        <div class="w-full max-w-md rounded-2xl bg-white dark:bg-zinc-900 shadow-2xl overflow-hidden pointer-events-auto modal-animate">

            <!-- HEADER -->
            <div class="p-5 text-center border-b border-zinc-100 dark:border-zinc-800">

                <div class="mx-auto w-14 h-14 flex items-center justify-center rounded-full bg-red-100 dark:bg-red-500/10">
                    <i class="text-3xl text-red-500 fa-solid fa-triangle-exclamation"></i>
                </div>

                <h2 id="delete-title-{{ $autor->dni }}"
                    class="mt-3 text-lg font-semibold text-zinc-900 dark:text-white">
                    Eliminar autor
                </h2>

                <p class="text-sm text-zinc-500 mt-1">
                    Acción permanente e irreversible
                </p>

            </div>

            <!-- CONTENT -->
            <div class="px-6 py-4 text-center">

                <p class="text-sm text-zinc-600 dark:text-zinc-300">
                    ¿Seguro que deseas eliminar a:
                </p>

                <p class="mt-2 font-semibold text-zinc-900 dark:text-white">
                    {{ $autor->nombres }} {{ $autor->apellidos }}
                </p>

                <p class="text-xs text-zinc-500 mt-1">
                    DNI: {{ $autor->dni }}
                </p>

            </div>

            <!-- ACTIONS -->
            <form action="{{ route('admin.autores.destroy', $autor->dni) }}"
                  method="POST"
                  class="px-6 pb-6">

                @csrf
                @method('DELETE')

                <div class="flex gap-3">

                    <button
                        type="button"
                        data-tw-dismiss="modal"
                        class="flex-1 py-2.5 rounded-xl bg-zinc-100 dark:bg-zinc-800
                        text-zinc-700 dark:text-white text-sm font-medium
                        hover:bg-zinc-200 dark:hover:bg-zinc-700 transition">
                        Cancelar
                    </button>

                    <button
                        type="submit"
                        class="flex-1 py-2.5 rounded-xl bg-red-600 text-white text-sm font-medium
                        hover:bg-red-500 transition shadow-md hover:shadow-lg">
                        Sí, eliminar
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>

@endforeach