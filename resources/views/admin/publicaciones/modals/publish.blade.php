@foreach ($publicaciones as $info)
    <div class="modal fixed inset-0 z-[999] hidden" id="publicar-modal{{ $info->id }}" role="dialog" aria-modal="true"
        aria-labelledby="publish-title-{{ $info->id }}">

        <div class="modal-overlay absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

        <div class="pointer-events-none relative flex min-h-screen items-center justify-center p-4">

            <div
                class="modal-animate pointer-events-auto w-full max-w-md scale-95 overflow-hidden rounded-2xl bg-white opacity-0 shadow-2xl transition-all duration-200 
                         dark:bg-slate-900">

                {{-- HEADER con botón cerrar X --}}
                <div class="relative pt-8 text-center">
                    <button type="button" data-tw-dismiss="modal"
                        class="absolute right-4 top-4 flex h-8 w-8 items-center justify-center rounded-full text-slate-400 transition-all duration-200 
                               hover:bg-slate-100 hover:text-slate-600 
                               dark:text-slate-500 dark:hover:bg-slate-700 dark:hover:text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div
                        class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border border-emerald-100 bg-emerald-50 
                                dark:border-emerald-500/30 dark:bg-emerald-500/20">
                        <svg class="h-7 w-7 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M6 14h3m-3 4h12M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z" />
                        </svg>
                    </div>

                    <h2 id="publish-title-{{ $info->id }}"
                        class="mt-5 text-xl font-bold uppercase tracking-tight text-slate-800 dark:text-white">
                        Confirmar Publicación
                    </h2>

                    <p class="mt-2 px-10 text-sm font-medium text-slate-500 dark:text-slate-400">
                        Esta acción habilitará la visibilidad pública del registro.
                    </p>
                </div>

                {{-- DETALLES DEL REGISTRO --}}
                <div
                    class="mx-6 my-6 rounded-xl border border-slate-100 bg-slate-50 p-4 text-center 
                            dark:border-slate-700 dark:bg-slate-800/50">
                    <p
                        class="mb-1 text-[11px] font-black uppercase tracking-widest text-indigo-600 dark:text-indigo-400">
                        Referencia: #{{ $info->id }}
                    </p>
                    <p class="text-sm font-bold uppercase leading-snug text-slate-800 dark:text-slate-100">
                        {{ $info->titulo }}
                    </p>
                </div>

                {{-- FORMULARIO --}}
                <form id="publish-form-{{ $info->id }}"
                    action="{{ route('admin.publicaciones.toggle', $info->id) }}" method="POST" class="px-6 pb-8">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <fieldset>
                            <legend
                                class="mb-2 block text-[11px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-400">
                                Acceso al publicar
                            </legend>
                            <div class="grid grid-cols-2 gap-2 sm:gap-3">
                                {{-- Público --}}
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="acceso" value="Publico" class="peer hidden"
                                        {{ $info->acceso === 'Publico' ? 'checked' : '' }}>
                                    <div
                                        class="flex flex-col items-center gap-1 rounded-xl border-2 border-slate-200 bg-slate-50 p-3 transition-all 
                                                peer-checked:border-indigo-500 peer-checked:bg-indigo-50 
                                                dark:border-slate-600 dark:bg-slate-800/50 
                                                dark:peer-checked:border-indigo-500 dark:peer-checked:bg-indigo-500/20 sm:p-4">
                                        <svg class="h-4 w-4 text-slate-400 transition-colors peer-checked:text-indigo-600 dark:text-slate-500 dark:peer-checked:text-indigo-400 sm:h-5 sm:w-5"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span
                                            class="text-[10px] font-black uppercase tracking-wider text-slate-500 transition-colors peer-checked:text-indigo-700 
                                                     dark:text-slate-400 dark:peer-checked:text-indigo-400 sm:text-xs">
                                            Público
                                        </span>
                                        <span
                                            class="hidden text-center text-[9px] font-medium text-slate-400 dark:text-slate-500 sm:inline">
                                            Visible para todos
                                        </span>
                                    </div>
                                </label>

                                {{-- Restringido --}}
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="acceso" value="Restringido" class="peer hidden"
                                        {{ $info->acceso === 'Restringido' ? 'checked' : '' }}>
                                    <div
                                        class="flex flex-col items-center gap-1 rounded-xl border-2 border-slate-200 bg-slate-50 p-3 transition-all 
                                                peer-checked:border-rose-400 peer-checked:bg-rose-50 
                                                dark:border-slate-600 dark:bg-slate-800/50 
                                                dark:peer-checked:border-rose-500 dark:peer-checked:bg-rose-500/20 sm:p-4">
                                        <svg class="h-4 w-4 text-slate-400 transition-colors peer-checked:text-rose-600 dark:text-slate-500 dark:peer-checked:text-rose-400 sm:h-5 sm:w-5"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        <span
                                            class="text-[10px] font-black uppercase tracking-wider text-slate-500 transition-colors peer-checked:text-rose-700 
                                                     dark:text-slate-400 dark:peer-checked:text-rose-400 sm:text-xs">
                                            Restringido
                                        </span>
                                        <span
                                            class="hidden text-center text-[9px] font-medium text-slate-400 dark:text-slate-500 sm:inline">
                                            Solo autorizado
                                        </span>
                                    </div>
                                </label>
                            </div>
                        </fieldset>
                    </div>

                    <div class="flex flex-col gap-2 sm:flex-row sm:gap-3">
                        <button type="button" data-tw-dismiss="modal"
                            class="flex-1 rounded-xl border-2 border-slate-200 bg-white py-3 text-[11px] font-black uppercase tracking-widest text-slate-600 
                                       transition-all hover:border-slate-300 hover:bg-slate-50 active:scale-95 
                                       dark:border-slate-600 dark:bg-slate-700 dark:text-slate-300 dark:hover:bg-slate-600 sm:py-3.5">
                            Cancelar
                        </button>
                        <button type="submit" form="publish-form-{{ $info->id }}"
                            class="flex-1 rounded-xl bg-indigo-600 py-3 text-[11px] font-black uppercase tracking-widest text-white shadow-lg 
                                       transition-all hover:bg-indigo-700 active:scale-95 
                                       dark:bg-indigo-600 dark:hover:bg-indigo-500 sm:py-3.5">
                            <div class="flex items-center justify-center gap-1 sm:gap-2">
                                <svg class="h-3.5 w-3.5 sm:h-4 sm:w-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-[10px] sm:text-[11px]">Publicar</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
