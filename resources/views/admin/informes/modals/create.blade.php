<x-admin.modal-crud id='add-informe-modal' title='NUEVO INFORME' subtitle='Completa los campos' size="full"
    action="{{ route('admin.informes.store') }}" icon="heroicon-o-document-plus" text_button="Guardar"
    icon_button="heroicon-o-check-circle">

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-0">

        {{-- COLUMNA IZQUIERDA --}}
        <div class="space-y-4 lg:space-y-5 lg:border-r lg:border-slate-200 p-4 sm:p-5 dark:lg:border-slate-700">

            {{-- Clasificación --}}
            <div>
                <p class="mb-2 text-[11px] font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                    Clasificación
                </p>
                <div class="space-y-3">
                    <div>
                        <label for="tipo_informe"
                            class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">
                            Tipo de informe
                        </label>
                        <select id="tipo_informe" name="tipo_informe" required
                            class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 
                                   outline-none transition-all duration-200 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 
                                   dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/30">
                            <option disabled selected>Seleccione tipo</option>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="cajaCarrera" class="hidden">
                        <label for="carrera" class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">
                            Carrera profesional
                        </label>
                        <select id="carrera" name="carrera"
                            class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 
                                   outline-none transition-all duration-200 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 
                                   dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/30">
                            <option disabled selected>Seleccione carrera</option>
                            @foreach ($carreras as $carrera)
                                <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="cajaModulo" class="hidden">
                        <label for="modulo" class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">
                            Módulo académico
                        </label>
                        <select id="modulo" name="modulo"
                            class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 
                                   outline-none transition-all duration-200 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 
                                   dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/30">
                            <option disabled selected>Seleccione módulo</option>
                            <option value="I">Módulo I</option>
                            <option value="II">Módulo II</option>
                            <option value="III">Módulo III</option>
                            <option value="IV">Módulo IV</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Información --}}
            <div>
                <p class="mb-2 text-[11px] font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                    Información
                </p>
                <div class="space-y-3">
                    <div>
                        <label for="titulo" class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">
                            Título
                        </label>
                        <input id="titulo" type="text" name="titulo" required
                            placeholder="Ej: Sistema de gestión académica"
                            class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 
                                   outline-none transition-all duration-200 placeholder:text-slate-400 
                                   focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 
                                   dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 
                                   dark:placeholder:text-slate-500 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/30">
                    </div>

                    <div>
                        <label for="resumen" class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">
                            Resumen
                        </label>
                        <textarea id="resumen" name="resumen" rows="4" required placeholder="Describe brevemente el proyecto"
                            class="w-full resize-none rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 
                                   outline-none transition-all duration-200 placeholder:text-slate-400 
                                   focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 
                                   dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 
                                   dark:placeholder:text-slate-500 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/30"></textarea>
                    </div>

                    <div>
                        <label for="anio" class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">
                            Año
                        </label>
                        <input id="anio" type="number" name="anio" required placeholder="{{ date('Y') }}"
                            class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 
                                   outline-none transition-all duration-200 placeholder:text-slate-400 
                                   focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 
                                   dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 
                                   dark:placeholder:text-slate-500 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/30">
                    </div>
                </div>
            </div>

            {{-- Autores --}}
            <div>
                <p class="mb-2 text-[11px] font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                    Autores
                </p>
                <div class="flex flex-col sm:flex-row gap-2">
                    <label for="dni" class="sr-only">DNI del autor</label>
                    <input id="dni" type="text" placeholder="Ingrese DNI del autor"
                        class="flex-1 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 
                               outline-none transition-all duration-200 placeholder:text-slate-400 
                               focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 
                               dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 
                               dark:placeholder:text-slate-500">
                    <button type="button" id="buscar"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-slate-700 px-4 py-2 text-sm font-medium text-white 
                               transition-all duration-200 hover:bg-slate-800 active:scale-95 
                               dark:bg-slate-600 dark:hover:bg-slate-500">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Buscar
                    </button>
                </div>
                <div id="autores-container"
                    class="mt-3 min-h-[80px] rounded-lg border border-slate-200 bg-slate-50/50 p-3 text-sm text-slate-600 
                           dark:border-slate-700 dark:bg-slate-800/30 dark:text-slate-300">
                </div>
                <textarea name="autores" id="autores-crear" hidden></textarea>
            </div>
        </div>

        {{-- COLUMNA DERECHA --}}
        <div class="p-4 sm:p-5">
            <p class="mb-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                Archivos
            </p>

            <div class="space-y-4">
                {{-- PDF --}}
                <div
                    class="rounded-lg border-2 border-dashed border-slate-200 bg-slate-50/50 p-4 dark:border-slate-700 dark:bg-slate-800/30">
                    <div class="mb-2 flex flex-wrap items-center gap-2">
                        <svg class="h-5 w-5 text-rose-500 dark:text-rose-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <label for="pdf" class="text-sm font-medium text-slate-700 dark:text-slate-300">Archivo
                            PDF</label>
                        <span
                            class="rounded-md bg-rose-100 px-2 py-0.5 text-[10px] font-semibold text-rose-600 dark:bg-rose-500/20 dark:text-rose-400">Requerido</span>
                    </div>
                    <input id="pdf" type="file" name="pdf" required accept=".pdf"
                        class="w-full text-sm text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-indigo-600 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-indigo-700 dark:text-slate-400 dark:file:bg-indigo-600">
                </div>

                {{-- Carátula --}}
                <div
                    class="rounded-lg border-2 border-dashed border-slate-200 bg-slate-50/50 p-4 dark:border-slate-700 dark:bg-slate-800/30">
                    <div class="mb-2 flex flex-wrap items-center gap-2">
                        <svg class="h-5 w-5 text-indigo-500 dark:text-indigo-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <label for="caratula"
                            class="text-sm font-medium text-slate-700 dark:text-slate-300">Carátula</label>
                        <span
                            class="rounded-md bg-rose-100 px-2 py-0.5 text-[10px] font-semibold text-rose-600 dark:bg-rose-500/20 dark:text-rose-400">Requerido</span>
                    </div>
                    <input id="caratula" type="file" name="caratula" accept="image/*" required
                        onchange="previewImage(event,'#imgPreview'); document.getElementById('imgPlaceholder').classList.add('hidden'); document.getElementById('imgPreview').classList.remove('hidden');"
                        class="w-full text-sm text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-indigo-600 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-indigo-700 dark:text-slate-400 dark:file:bg-indigo-600">
                </div>

                {{-- Preview --}}
                <div
                    class="rounded-lg border border-slate-200 bg-slate-50/50 dark:border-slate-700 dark:bg-slate-800/30">
                    <p
                        class="border-b border-slate-200 px-4 py-2 text-[10px] font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                        Vista previa
                    </p>
                    <div class="flex min-h-[160px] items-center justify-center p-4">
                        <img id="imgPreview" class="hidden max-h-36 rounded-lg object-cover shadow-sm">
                        <div id="imgPlaceholder"
                            class="flex flex-col items-center gap-2 text-slate-400 dark:text-slate-600">
                            <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-xs">Sin imagen seleccionada</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin.modal-crud>
