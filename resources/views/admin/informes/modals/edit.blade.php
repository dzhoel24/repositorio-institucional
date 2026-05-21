@foreach ($informes as $info)
    <x-admin.modal-edit id="edit-modal{{ $info->id }}" title="EDITAR INFORME" subtitle="{{ $info->titulo }}"
        action="{{ route('admin.informes.update', $info->id) }}" size="full">

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-0">

            {{-- COLUMNA IZQUIERDA --}}
            <div class="space-y-3 lg:space-y-5 lg:border-r lg:border-slate-200 dark:lg:border-slate-700 p-4 sm:p-5">

                {{-- Clasificación --}}
                <div>
                    <p class="mb-3 text-[11px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">
                        Clasificación
                    </p>
                    <div class="space-y-3">
                        <div>
                            <label for="tipo_informe_{{ $info->id }}"
                                class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-600 dark:text-slate-300">
                                Tipo de informe
                            </label>
                            <select id="tipo_informe_{{ $info->id }}" name="tipo_informe" required
                                class="tipo-select w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 sm:px-4 sm:py-3 text-sm text-slate-800 
                                           outline-none transition-all duration-200 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/20 
                                           dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:focus:border-indigo-500"
                                data-id="{{ $info->id }}">
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->id }}"
                                        {{ $info->tipo_informe_id == $tipo->id ? 'selected' : '' }}>
                                        {{ $tipo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="caja-carrera hidden" data-id="{{ $info->id }}">
                            <label for="carrera_{{ $info->id }}"
                                class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-600 dark:text-slate-300">
                                Carrera profesional
                            </label>
                            <select id="carrera_{{ $info->id }}" name="carrera"
                                class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 sm:px-4 sm:py-3 text-sm text-slate-800 
                                           outline-none transition-all duration-200 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/20 
                                           dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:focus:border-indigo-500">
                                <option disabled selected>Seleccione carrera</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}"
                                        {{ $info->carrera_id == $carrera->id ? 'selected' : '' }}>
                                        {{ $carrera->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="caja-modulo hidden" data-id="{{ $info->id }}">
                            <label for="modulo_{{ $info->id }}"
                                class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-600 dark:text-slate-300">
                                Módulo académico
                            </label>
                            <select id="modulo_{{ $info->id }}" name="modulo"
                                class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 sm:px-4 sm:py-3 text-sm text-slate-800 
                                           outline-none transition-all duration-200 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/20 
                                           dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:focus:border-indigo-500">
                                <option disabled selected>Seleccione módulo</option>
                                @foreach (['I', 'II', 'III', 'IV'] as $m)
                                    <option value="{{ $m }}" {{ $info->modulo == $m ? 'selected' : '' }}>
                                        {{ $m }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Información --}}
                <div>
                    <p class="mb-3 text-[11px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">
                        Información
                    </p>
                    <div class="space-y-3">
                        <div>
                            <label for="titulo_{{ $info->id }}"
                                class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-600 dark:text-slate-300">
                                Título
                            </label>
                            <input id="titulo_{{ $info->id }}" type="text" name="titulo" required
                                value="{{ $info->titulo }}"
                                class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 sm:px-4 sm:py-3 text-sm text-slate-800 
                                          outline-none transition-all duration-200 placeholder:text-slate-400 
                                          focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/20 
                                          dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 
                                          dark:placeholder:text-slate-500 dark:focus:border-indigo-500">
                        </div>

                        <div>
                            <label for="resumen_{{ $info->id }}"
                                class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-600 dark:text-slate-300">
                                Resumen
                            </label>
                            <textarea id="resumen_{{ $info->id }}" name="resumen" rows="4" required
                                class="w-full resize-none rounded-xl border border-slate-200 bg-white px-3 py-2.5 sm:px-4 sm:py-3 text-sm text-slate-800 
                                             outline-none transition-all duration-200 placeholder:text-slate-400 
                                             focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/20 
                                             dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 
                                             dark:placeholder:text-slate-500 dark:focus:border-indigo-500">{{ $info->resumen }}</textarea>
                        </div>

                        <div>
                            <label for="anio_{{ $info->id }}"
                                class="mb-1.5 block text-xs sm:text-sm font-semibold text-slate-600 dark:text-slate-300">
                                Año
                            </label>
                            <input id="anio_{{ $info->id }}" type="number" name="anio" required
                                value="{{ $info->anio }}"
                                class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 sm:px-4 sm:py-3 text-sm text-slate-800 
                                          outline-none transition-all duration-200 placeholder:text-slate-400 
                                          focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/20 
                                          dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 
                                          dark:placeholder:text-slate-500 dark:focus:border-indigo-500">
                        </div>
                    </div>
                </div>

                {{-- Autores --}}
                <div>
                    <p class="mb-3 text-[11px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">
                        Autores
                    </p>
                    <div class="flex flex-col sm:flex-row gap-2">
                        <label for="dni_{{ $info->id }}" class="sr-only">DNI del autor</label>
                        <input id="dni_{{ $info->id }}" type="text"
                            class="dni-input flex-1 rounded-xl border border-slate-200 bg-white px-3 py-2.5 sm:px-4 sm:py-3 text-sm text-slate-800 
                                      outline-none transition-all duration-200 placeholder:text-slate-400 
                                      focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/20 
                                      dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 
                                      dark:placeholder:text-slate-500"
                            data-id="{{ $info->id }}" placeholder="Ingrese DNI del autor">
                        <button type="button"
                            class="btn-buscar inline-flex items-center justify-center gap-2 rounded-xl bg-slate-800 px-4 py-2.5 text-sm font-bold text-white 
                                       transition-all duration-200 hover:bg-slate-900 active:scale-95 
                                       dark:bg-indigo-600 dark:hover:bg-indigo-500"
                            data-id="{{ $info->id }}">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Buscar
                        </button>
                    </div>
                    <div id="autores-container-{{ $info->id }}"
                        class="autores-container mt-3 min-h-[80px] rounded-xl border border-slate-200 bg-slate-50 p-3 text-sm text-slate-700 
                                dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300"
                        data-id="{{ $info->id }}">
                    </div>
                    <textarea name="autores" class="autores-hidden hidden" data-id="{{ $info->id }}"
                        data-autores="{{ json_encode($info->autores->map(fn($a) => ['dni' => $a->dni, 'nombres' => $a->nombres, 'apellidos' => $a->apellidos])) }}"></textarea>
                </div>
            </div>

            {{-- COLUMNA DERECHA --}}
            <div class="p-4 sm:p-5">
                <p class="mb-4 text-[11px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">
                    Archivos
                </p>

                <div class="space-y-4">
                    {{-- PDF --}}
                    <div
                        class="rounded-xl border-2 border-dashed border-slate-200 bg-slate-50/50 p-4 dark:border-slate-700 dark:bg-slate-800/30">
                        <div class="mb-2 flex flex-wrap items-center gap-2">
                            <svg class="h-5 w-5 text-rose-500 dark:text-rose-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            <label for="pdf_{{ $info->id }}"
                                class="text-sm font-bold text-slate-600 dark:text-slate-300">Archivo PDF</label>
                        </div>
                        <p class="mb-2 truncate text-[11px] text-slate-400 dark:text-slate-500">
                            Actual: {{ $info->ruta_pdf }}
                        </p>
                        <input id="pdf_{{ $info->id }}" type="file" name="pdf" accept=".pdf"
                            class="w-full text-sm text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-indigo-600 file:px-4 file:py-2 file:text-sm file:font-bold file:text-white hover:file:bg-indigo-700 dark:text-slate-400 dark:file:bg-indigo-600">
                    </div>

                    {{-- Carátula --}}
                    <div
                        class="rounded-xl border-2 border-dashed border-slate-200 bg-slate-50/50 p-4 dark:border-slate-700 dark:bg-slate-800/30">
                        <div class="mb-2 flex flex-wrap items-center gap-2">
                            <svg class="h-5 w-5 text-indigo-500 dark:text-indigo-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <label for="caratula_{{ $info->id }}"
                                class="text-sm font-bold text-slate-600 dark:text-slate-300">Carátula</label>
                        </div>
                        <input id="caratula_{{ $info->id }}" type="file" name="caratula" accept="image/*"
                            onchange="previewImage(event, '{{ $info->id }}'); document.getElementById('imgPlaceholder{{ $info->id }}')?.classList.add('hidden'); document.getElementById('imgPreview{{ $info->id }}')?.classList.remove('hidden');"
                            class="w-full text-sm text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-indigo-600 file:px-4 file:py-2 file:text-sm file:font-bold file:text-white hover:file:bg-indigo-700 dark:text-slate-400 dark:file:bg-indigo-600">
                    </div>

                    {{-- Preview --}}
                    <div
                        class="rounded-xl border border-slate-200 bg-slate-50/50 dark:border-slate-700 dark:bg-slate-800/30">
                        <p
                            class="border-b border-slate-200 px-4 py-2.5 text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">
                            Vista previa
                        </p>
                        <div class="flex min-h-[160px] items-center justify-center p-4">
                            <img id="imgPreview{{ $info->id }}"
                                src="{{ $info->ruta_caratula ? asset('caratulas/' . $info->ruta_caratula) : '' }}"
                                class="max-h-36 rounded-lg object-cover shadow-md {{ $info->ruta_caratula ? '' : 'hidden' }}">
                            <div id="imgPlaceholder{{ $info->id }}"
                                class="flex flex-col items-center gap-2 text-slate-300 dark:text-slate-600 {{ $info->ruta_caratula ? 'hidden' : '' }}">
                                <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    </x-admin.modal-edit>
@endforeach
