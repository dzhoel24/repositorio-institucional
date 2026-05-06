@foreach ($publicaciones as $info)
    <div class="modal fixed inset-0 z-[999] hidden" id="publicar-modal{{ $info->id }}" role="dialog" aria-modal="true"
        aria-labelledby="publish-title-{{ $info->id }}">

        <!-- BACKDROP (Fondo sutil pero definido) -->
        <div class="modal-overlay absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

        <!-- CONTENEDOR CENTRAL -->
        <div class="pointer-events-none relative flex min-h-screen items-center justify-center p-4">

            <!-- CARD (Diseño Robusto y Limpio) -->
            <div
                class="modal-animate pointer-events-auto w-full max-w-md scale-95 overflow-hidden rounded-2xl border border-slate-200 bg-white opacity-0 shadow-2xl transition-all duration-200 dark:border-zinc-800 dark:bg-[#111114]">

                <!-- HEADER CON ICONO TÉCNICO -->
                <div class="pt-8 text-center">
                    <div
                        class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border border-emerald-100 bg-emerald-50 dark:border-emerald-500/20 dark:bg-emerald-500/10">
                        <i class="fa-solid fa-cloud-arrow-up text-2xl text-emerald-600 dark:text-emerald-500"></i>
                    </div>

                    <h2 id="publish-title-{{ $info->id }}"
                        class="mt-5 text-xl font-bold uppercase tracking-tight text-slate-900 dark:text-zinc-100">
                        Confirmar Publicación
                    </h2>

                    <p class="mt-2 px-10 text-[14px] font-medium text-slate-500 dark:text-zinc-400">
                        Esta acción habilitará la visibilidad pública del registro en el repositorio institucional.
                    </p>
                </div>

                <!-- DETALLES DEL REGISTRO -->
                <div
                    class="mx-6 my-6 rounded-xl border border-slate-100 bg-slate-50 p-4 text-center dark:border-zinc-800 dark:bg-zinc-800/50">
                    <p
                        class="mb-1 text-[11px] font-black uppercase tracking-widest text-indigo-600 dark:text-indigo-400">
                        Referencia: #{{ $info->id }}
                    </p>
                    <p class="text-[15px] font-bold uppercase leading-snug text-slate-800 dark:text-zinc-200">
                        {{ $info->titulo }}
                    </p>
                </div>

                <!-- ACCIONES (Botones Sólidos y Equilibrados) -->
                <form action="{{ route('admin.publicaciones.toggle', $info->id) }}" method="POST" class="px-6 pb-8">
                    @csrf
                    @method('PATCH')

                    {{-- Selector de Acceso --}}
                    <div class="mb-4">
                        <label
                            class="mb-2 block text-[11px] font-black uppercase tracking-widest text-slate-500 dark:text-zinc-400">
                            Acceso al publicar
                        </label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="acceso" value="Publico" class="peer hidden"
                                    {{ $info->acceso === 'Publico' ? 'checked' : '' }}>
                                <div
                                    class="flex flex-col items-center gap-2 rounded-xl border-2 border-slate-200 bg-slate-50 p-4 transition-all peer-checked:border-indigo-500 peer-checked:bg-indigo-50 dark:border-zinc-700 dark:bg-zinc-800/50 peer-checked:dark:border-indigo-500 peer-checked:dark:bg-indigo-500/10">
                                    <i
                                        class="fa-solid fa-globe-americas text-xl text-slate-400 peer-checked:text-indigo-600 dark:text-zinc-500"></i>
                                    <span
                                        class="text-[12px] font-black uppercase tracking-wider text-slate-500 peer-checked:text-indigo-700 dark:text-zinc-400 peer-checked:dark:text-indigo-400">Público</span>
                                    <span
                                        class="text-center text-[10px] font-medium text-slate-400 dark:text-zinc-500">Visible
                                        para todos</span>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="acceso" value="Restringido" class="peer hidden"
                                    {{ $info->acceso === 'Restringido' ? 'checked' : '' }}>
                                <div
                                    class="flex flex-col items-center gap-2 rounded-xl border-2 border-slate-200 bg-slate-50 p-4 transition-all peer-checked:border-rose-400 peer-checked:bg-rose-50 dark:border-zinc-700 dark:bg-zinc-800/50 peer-checked:dark:border-rose-500 peer-checked:dark:bg-rose-500/10">
                                    <i
                                        class="fa-solid fa-shield-halved text-xl text-slate-400 peer-checked:text-rose-600 dark:text-zinc-500"></i>
                                    <span
                                        class="text-[12px] font-black uppercase tracking-wider text-slate-500 peer-checked:text-rose-700 dark:text-zinc-400 peer-checked:dark:text-rose-400">Restringido</span>
                                    <span
                                        class="text-center text-[10px] font-medium text-slate-400 dark:text-zinc-500">Solo
                                        autorizado</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" data-tw-dismiss="modal"
                            class="flex-1 rounded-xl border-2 border-slate-200 bg-white py-3.5 text-[11px] font-black uppercase tracking-widest text-slate-600 transition-all hover:border-slate-300 hover:bg-slate-50 active:scale-95 dark:border-zinc-800 dark:bg-transparent dark:text-zinc-400 dark:hover:bg-zinc-800">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="flex-1 rounded-xl bg-indigo-700 py-3.5 text-[11px] font-black uppercase tracking-widest text-white shadow-lg shadow-indigo-100 transition-all hover:bg-indigo-800 active:scale-95 dark:shadow-none">
                            Publicar Registro
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
