<div class="fixed inset-0 z-[999] hidden modal" id="add-modal" role="dialog" aria-modal="true"
    aria-labelledby="add-author-title">

    <!-- BACKDROP -->
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm modal-overlay"></div>

    <!-- CENTER -->
    <div class="relative flex items-center justify-center min-h-screen p-4 pointer-events-none">

        <!-- CARD -->
        <div
            class="w-full max-w-md rounded-md bg-white dark:bg-zinc-900 shadow-2xl overflow-hidden modal-animate pointer-events-auto">

            <!-- HEADER -->
            <div class="px-6 pt-6 pb-4 text-center border-b border-zinc-100 dark:border-zinc-800">

                <h2 id="add-author-title" class="text-xl font-semibold text-zinc-900 dark:text-white">
                    Añadir autor
                </h2>

                <p class="text-sm text-zinc-500 mt-1">
                    Registra un nuevo autor en el sistema
                </p>

            </div>

            <!-- FORM -->
            <form action="{{ route('admin.autores.store') }}" method="POST" class="px-6 py-6 space-y-4">
                @csrf

                <!-- DNI -->
                <div>
                    <label for="dni" class="text-xs text-zinc-500 mb-1 block">
                        DNI
                    </label>

                    <input id="dni" type="text" name="dni" placeholder="Ej: 12345678" required
                        class="w-full rounded-xl border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800
                        text-zinc-900 dark:text-white px-4 py-3 text-sm
                        focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                </div>

                <!-- NOMBRES -->
                <div>
                    <label for="nombres" class="text-xs text-zinc-500 mb-1 block">
                        Nombres
                    </label>

                    <input id="nombres" type="text" name="nombres" placeholder="Ej: Juan Carlos" required
                        class="w-full rounded-xl border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800
                        text-zinc-900 dark:text-white px-4 py-3 text-sm
                        focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                </div>

                <!-- APELLIDOS -->
                <div>
                    <label for="apellidos" class="text-xs text-zinc-500 mb-1 block">
                        Apellidos
                    </label>

                    <input id="apellidos" type="text" name="apellidos" placeholder="Ej: Pérez García" required
                        class="w-full rounded-xl border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800
                        text-zinc-900 dark:text-white px-4 py-3 text-sm
                        focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                </div>

                <!-- ACTIONS -->
                <div class="flex gap-3 pt-2">

                    <button type="button" data-tw-dismiss="modal"
                        class="flex-1 py-2.5 rounded-md bg-zinc-100 dark:bg-zinc-800
                        text-zinc-700 dark:text-white text-sm font-medium
                        hover:bg-zinc-200 dark:hover:bg-zinc-700 transition">
                        Cancelar
                    </button>

                    <button type="submit"
                        class="flex-1 py-2.5 rounded-md bg-blue-600 text-white text-sm font-medium
                        hover:bg-blue-500 transition shadow-md hover:shadow-lg">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
