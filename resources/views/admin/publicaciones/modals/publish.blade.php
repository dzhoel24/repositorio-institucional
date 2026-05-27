{{-- MODALES PUBLICAR --}}
@foreach ($publicaciones as $info)
    <x-admin.modal-simple id="publicar-modal{{ $info->id }}" title="Confirmar Publicación"
        subtitle="Esta acción habilitará la visibilidad pública del registro."
        route="{{ route('admin.publicaciones.toggle', $info->id) }}" method="PATCH" type="success" buttonText="Publicar">

        <div class="space-y-5">
            {{-- DETALLES DEL REGISTRO --}}
            <div
                class="text-center rounded-xl bg-slate-100 dark:bg-slate-700/40 p-4 border border-slate-200 dark:border-slate-700">
                <span
                    class="inline-flex items-center rounded-full bg-emerald-100 dark:bg-emerald-500/20 px-3 py-0.5 text-[11px] font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400">
                    Referencia: #{{ $info->id }}
                </span>
                <p class="mt-2 text-sm font-bold uppercase leading-snug text-slate-800 dark:text-slate-100">
                    {{ $info->titulo }}
                </p>
            </div>

            {{-- NIVEL DE ACCESO --}}
            <fieldset aria-label="Opciones de nivel de acceso">
                <legend
                    class="mb-3 block text-center text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                    Nivel de acceso
                </legend>
                <div class="grid grid-cols-2 gap-3">
                    {{-- Público (Azul) --}}
                    <label class="relative cursor-pointer">
                        <input type="radio" name="acceso" value="Publico" class="peer hidden"
                            {{ $info->acceso === 'Publico' ? 'checked' : '' }}>
                        <div
                            class="flex flex-col items-center gap-2 rounded-xl border-2 p-3 transition-all 
                                    border-slate-200 bg-white
                                    peer-checked:border-blue-500 peer-checked:bg-blue-50/50 
                                    peer-focus:ring-2 peer-focus:ring-blue-300 peer-focus:ring-offset-1
                                    dark:border-slate-700 dark:bg-slate-800/50 
                                    dark:peer-checked:border-blue-500 dark:peer-checked:bg-blue-500/10">
                            <x-heroicon-o-globe-alt
                                class="h-5 w-5 text-slate-400 transition-colors 
                                        peer-checked:text-blue-600 dark:text-slate-500 dark:peer-checked:text-blue-400" />
                            <div class="text-center">
                                <span
                                    class="block text-xs font-bold uppercase tracking-wide text-slate-600 transition-colors 
                                             peer-checked:text-blue-700 dark:text-slate-400 dark:peer-checked:text-blue-400">
                                    Público
                                </span>
                                <span
                                    class="hidden text-[10px] font-medium text-slate-400 dark:text-slate-500 sm:block">
                                    Visible para todos
                                </span>
                            </div>
                        </div>
                    </label>

                    {{-- Restringido (Rojo) --}}
                    <label class="relative cursor-pointer">
                        <input type="radio" name="acceso" value="Restringido" class="peer hidden"
                            {{ $info->acceso === 'Restringido' ? 'checked' : '' }}>
                        <div
                            class="flex flex-col items-center gap-2 rounded-xl border-2 p-3 transition-all 
                                    border-slate-200 bg-white
                                    peer-checked:border-red-500 peer-checked:bg-red-50/50 
                                    peer-focus:ring-2 peer-focus:ring-red-300 peer-focus:ring-offset-1
                                    dark:border-slate-700 dark:bg-slate-800/50 
                                    dark:peer-checked:border-red-500 dark:peer-checked:bg-red-500/10">
                            <x-heroicon-o-lock-closed
                                class="h-5 w-5 text-slate-400 transition-colors 
                                        peer-checked:text-red-600 dark:text-slate-500 dark:peer-checked:text-red-400" />
                            <div class="text-center">
                                <span
                                    class="block text-xs font-bold uppercase tracking-wide text-slate-600 transition-colors 
                                             peer-checked:text-red-700 dark:text-slate-400 dark:peer-checked:text-red-400">
                                    Restringido
                                </span>
                                <span
                                    class="hidden text-[10px] font-medium text-slate-400 dark:text-slate-500 sm:block">
                                    Solo autorizado
                                </span>
                            </div>
                        </div>
                    </label>
                </div>
            </fieldset>
        </div>
    </x-admin.modal-simple>
@endforeach
