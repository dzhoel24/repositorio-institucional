@foreach ($publicaciones as $info)
    <div class="modal fixed inset-0 z-[999] hidden" id="despublicar-modal{{ $info->id }}" role="dialog"
        aria-modal="true" aria-labelledby="unpublish-title-{{ $info->id }}">

        <div class="modal-overlay absolute inset-0 bg-slate-900/50 backdrop-blur-sm transition-all duration-200"></div>

        <div class="pointer-events-none relative flex min-h-screen items-center justify-center p-4">

            <div class="modal-animate pointer-events-auto w-full max-w-md scale-95 overflow-hidden rounded-2xl border border-slate-200 bg-white opacity-0 shadow-2xl transition-all duration-200 
                        dark:border-slate-700 dark:bg-slate-900">

                {{-- HEADER con botón cerrar X --}}
                <div class="relative pt-8 text-center">
                    <button type="button" data-tw-dismiss="modal"
                        class="absolute right-4 top-4 flex h-8 w-8 items-center justify-center rounded-full text-slate-400 transition-all duration-200 
                               hover:bg-slate-100 hover:text-slate-600 
                               dark:text-slate-500 dark:hover:bg-slate-700 dark:hover:text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border border-amber-200 bg-amber-50 
                                dark:border-amber-500/30 dark:bg-amber-500/20">
                        <svg class="h-8 w-8 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </div>

                    <h2 id="unpublish-title-{{ $info->id }}" class="mt-5 text-xl font-bold uppercase tracking-tight text-slate-800 dark:text-white">
                        Retirar Publicación
                    </h2>

                    <p class="mt-2 px-8 text-sm font-medium text-slate-500 dark:text-slate-400">
                        Esta acción ocultará el registro del repositorio público.
                    </p>
                </div>

                {{-- DETALLES DEL REGISTRO --}}
                <div class="mx-6 my-6 rounded-xl border border-slate-100 bg-slate-50/50 p-4 text-center 
                            dark:border-slate-700 dark:bg-slate-800/50">
                    <p class="mb-1 text-[11px] font-black uppercase tracking-widest text-amber-600 dark:text-amber-400">
                        Referencia: #{{ $info->id }}
                    </p>
                    <p class="text-sm font-bold uppercase leading-snug text-slate-800 dark:text-slate-100">
                        {{ $info->titulo }}
                    </p>
                </div>

                {{-- FORMULARIO --}}
                <form id="unpublish-form-{{ $info->id }}" action="{{ route('admin.publicaciones.toggle', $info->id) }}" method="POST" class="px-6 pb-8">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="acceso" value="{{ $info->acceso }}">

                    <div class="flex flex-col gap-2 sm:flex-row sm:gap-3">
                        <button type="button" data-tw-dismiss="modal"
                                class="flex-1 rounded-xl border-2 border-slate-200 bg-white py-3 text-[11px] font-black uppercase tracking-widest text-slate-600 
                                       transition-all duration-200 hover:border-slate-300 hover:bg-slate-50 active:scale-95 
                                       dark:border-slate-600 dark:bg-slate-700 dark:text-slate-300 dark:hover:bg-slate-600 sm:py-3.5">
                            Cancelar
                        </button>
                        <button type="submit" form="unpublish-form-{{ $info->id }}"
                                class="flex-1 rounded-xl bg-amber-600 py-3 text-[11px] font-black uppercase tracking-widest text-white shadow-lg 
                                       transition-all duration-200 hover:bg-amber-700 active:scale-95 
                                       dark:bg-amber-600 dark:hover:bg-amber-700 sm:py-3.5">
                            <div class="flex items-center justify-center gap-1 sm:gap-2">
                                <svg class="h-3.5 w-3.5 sm:h-4 sm:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                <span class="text-[10px] sm:text-[11px]">Retirar</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach