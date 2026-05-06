@foreach ($informes as $info)
    <div class="fixed inset-0 z-[999] hidden modal" id="delete-modal{{ $info->id }}" role="dialog" aria-modal="true"
        aria-labelledby="delete-title-{{ $info->id }}">

        <!-- BACKDROP -->
        <div class="absolute inset-0 bg-black/60 modal-overlay"></div>

        <!-- CENTER -->
        <div class="relative flex items-center justify-center min-h-screen p-4">

            <!-- CARD -->
            <div
                class="modal-animate w-full max-w-md rounded-2xl
                    bg-white dark:bg-zinc-900 shadow-2xl overflow-hidden
                    opacity-0 scale-95 transition-all duration-200">

                <!-- HEADER -->
                <div
                    class="flex flex-col items-center text-center px-6 pt-8 pb-5
                        border-b border-zinc-100 dark:border-zinc-800">

                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-full
                            bg-red-100 dark:bg-red-500/10">

                        <i class="fa-solid fa-triangle-exclamation text-3xl text-red-500"></i>

                    </div>

                    <h2 id="delete-title-{{ $info->id }}"
                        class="mt-4 text-lg font-semibold text-zinc-900 dark:text-white">

                        Eliminar proyecto

                    </h2>

                    <p class="mt-1 text-sm text-zinc-500">
                        Esta acción no se puede deshacer
                    </p>

                </div>

                <!-- CONTENT -->
                <div class="px-6 py-5 text-center">

                    <p class="text-sm text-zinc-600 dark:text-zinc-300">
                        ¿Seguro que deseas eliminar este proyecto?
                    </p>

                    <p class="mt-2 text-sm font-semibold text-zinc-900 dark:text-white">
                        {{ $info->titulo }}
                    </p>

                    <p class="text-xs text-zinc-500 mt-1">
                        ID: {{ $info->id }}
                    </p>

                </div>

                <!-- ACTIONS -->
                <div class="px-6 pb-6 flex gap-3">

                    <!-- CANCELAR -->
                    <button type="button" data-tw-dismiss="modal"
                        class="flex-1 py-2.5 rounded-xl bg-zinc-100 dark:bg-zinc-800
                               text-zinc-700 dark:text-white text-sm font-medium
                               hover:bg-zinc-200 dark:hover:bg-zinc-700 transition">

                        Cancelar

                    </button>

                    <!-- DELETE -->
                    <form action="{{ route('admin.informes.destroy', $info->id) }}" method="POST" class="flex-1">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="w-full py-2.5 rounded-xl bg-red-600 text-white text-sm font-medium
                                   hover:bg-red-500 transition shadow-md hover:shadow-lg">

                            Eliminar

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>
@endforeach
