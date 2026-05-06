@foreach ($publicaciones as $info)
    <div class="modal fixed inset-0 z-[999] hidden" id="despublicar-modal{{ $info->id }}" role="dialog"
        aria-modal="true" aria-labelledby="unpublish-title-{{ $info->id }}">

        <!-- BACKDROP (Efecto de profundidad profesional) -->
        <div class="modal-overlay absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

        <!-- CONTENEDOR CENTRAL -->
        <div class="pointer-events-none relative flex min-h-screen items-center justify-center p-4">

            <!-- CARD (Diseño Robusto) -->
            <div
                class="modal-animate pointer-events-auto w-full max-w-md scale-95 overflow-hidden rounded-xl border border-slate-200 bg-white opacity-0 shadow-2xl transition-all duration-200 dark:border-zinc-800 dark:bg-[#111114]">

                <!-- HEADER CON ICONO DE ADVERTENCIA -->
                <div class="pt-8 text-center">
                    <div
                        class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border border-amber-100 bg-amber-50 dark:border-amber-500/20 dark:bg-amber-500/10">
                        <i class="fa-solid fa-triangle-exclamation text-2xl text-amber-600 dark:text-amber-500"></i>
                    </div>

                    <h2 id="unpublish-title-{{ $info->id }}"
                        class="mt-5 text-xl font-bold uppercase tracking-tight text-slate-900 dark:text-zinc-100">
                        Confirmar Retiro
                    </h2>

                    <p class="mt-2 px-10 text-[14px] font-medium text-slate-500 dark:text-zinc-400">
                        Esta acción restringirá la visibilidad de la publicación en el repositorio institucional.
                    </p>
                </div>

                <!-- DETALLES DEL REGISTRO (Bloque de Enfoque) -->
                <div
                    class="mx-6 my-6 rounded-xl border border-slate-100 bg-slate-50 p-4 text-center dark:border-zinc-800 dark:bg-zinc-800/50">
                    <p class="mb-1 text-[11px] font-black uppercase tracking-widest text-amber-600 dark:text-amber-500">
                        Estatus Actual: Publicado
                    </p>
                    <p class="text-[15px] font-bold uppercase leading-snug text-slate-800 dark:text-zinc-200">
                        {{ $info->titulo }}
                    </p>
                    <p class="mt-2 text-xs font-medium text-slate-400">ID de Registro: {{ $info->id }}</p>
                </div>

                <!-- ACCIONES TÉCNICAS -->
                <form action="{{ route('admin.publicaciones.toggle', $info->id) }}" method="POST" class="px-6 pb-8">
                    @csrf
                    @method('PATCH')

                    <div class="flex gap-3">
                        {{-- Cancelar: Estilo Outline --}}
                        <button type="button" data-tw-dismiss="modal"
                            class="flex-1 rounded-xl border-2 border-slate-200 bg-white py-3.5 text-[11px] font-black uppercase tracking-widest text-slate-600 transition-all hover:border-slate-300 hover:bg-slate-50 active:scale-95 dark:border-zinc-800 dark:bg-transparent dark:text-zinc-400 dark:hover:bg-zinc-800">
                            Cancelar
                        </button>

                        {{-- Retirar: Rojo Sólido (Acción de Advertencia) --}}
                        <button type="submit"
                            class="flex-1 rounded-xl bg-rose-600 py-3.5 text-[11px] font-black uppercase tracking-widest text-white shadow-lg shadow-rose-100 transition-all hover:bg-rose-700 active:scale-95 dark:shadow-none">
                            Retirar Registro
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
