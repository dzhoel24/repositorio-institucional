@foreach ($informes as $info)
    <div class="modal fixed inset-0 z-[999] hidden" id="edit-modal{{ $info->id }}">
        <div class="modal-overlay absolute inset-0 bg-slate-950/70 backdrop-blur-sm"></div>

        <div class="relative flex min-h-screen items-center justify-center p-4">
            <div
                class="modal-animate flex max-h-[92vh] w-full max-w-5xl flex-col overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-[#0f0f13]">

                {{-- HEADER --}}
                <div
                    class="flex shrink-0 items-center justify-between border-b border-slate-100 bg-slate-50 px-8 py-5 dark:border-zinc-800 dark:bg-[#1a1a22]">
                    <div class="flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-500">
                            <i class="fa-solid fa-pen-to-square text-sm text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-base font-black uppercase tracking-wide text-slate-900 dark:text-white">
                                Editar Proyecto</h2>
                            <p class="max-w-sm truncate text-sm text-slate-400">{{ $info->titulo }}</p>
                        </div>
                    </div>
                    <button type="button" data-tw-dismiss="modal"
                        class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 hover:bg-slate-200 hover:text-slate-600 dark:hover:bg-zinc-700">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <form action="{{ route('admin.informes.update', $info->id) }}" method="POST"
                    enctype="multipart/form-data" class="overflow-y-auto">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 lg:grid-cols-2">

                        {{-- COLUMNA IZQUIERDA --}}
                        <div
                            class="space-y-6 border-b border-slate-100 p-8 lg:border-b-0 lg:border-r dark:border-zinc-800">

                            {{-- Clasificación --}}
                            <div>
                                <p
                                    class="mb-3 text-[11px] font-black uppercase tracking-widest text-slate-400 dark:text-zinc-500">
                                    Clasificación</p>
                                <div class="space-y-3">
                                    <div>
                                        <label for="tipo_informe_{{ $info->id }}"
                                            class="mb-1.5 block text-sm font-semibold text-slate-600 dark:text-zinc-400">Tipo
                                            de informe</label>
                                        <select id="tipo_informe_{{ $info->id }}" name="tipo_informe" required
                                            class="tipo-select w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white"
                                            data-id="{{ $info->id }}">
                                            @foreach ($tipos as $tipo)
                                                <option value="{{ $tipo->id }}"
                                                    {{ $info->tipo_informe_id == $tipo->id ? 'selected' : '' }}>
                                                    {{ $tipo->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="caja-carrera" data-id="{{ $info->id }}">
                                        <label for="carrera_{{ $info->id }}"
                                            class="mb-1.5 block text-sm font-semibold text-slate-600 dark:text-zinc-400">Carrera
                                            profesional</label>
                                        <select id="carrera_{{ $info->id }}" name="carrera"
                                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-slate-400 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                                            <option disabled selected>Seleccione carrera</option>
                                            @foreach ($carreras as $carrera)
                                                <option value="{{ $carrera->id }}"
                                                    {{ $info->carrera_id == $carrera->id ? 'selected' : '' }}>
                                                    {{ $carrera->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="caja-modulo" data-id="{{ $info->id }}">
                                        <label for="modulo_{{ $info->id }}"
                                            class="mb-1.5 block text-sm font-semibold text-slate-600 dark:text-zinc-400">Módulo
                                            académico</label>
                                        <select id="modulo_{{ $info->id }}" name="modulo"
                                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-slate-400 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                                            <option disabled selected>Seleccione módulo</option>
                                            @foreach (['I', 'II', 'III', 'IV'] as $m)
                                                <option value="{{ $m }}"
                                                    {{ $info->modulo == $m ? 'selected' : '' }}>{{ $m }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Información --}}
                            <div>
                                <p
                                    class="mb-3 text-[11px] font-black uppercase tracking-widest text-slate-400 dark:text-zinc-500">
                                    Información</p>
                                <div class="space-y-3">
                                    <div>
                                        <label for="titulo_{{ $info->id }}"
                                            class="mb-1.5 block text-sm font-semibold text-slate-600 dark:text-zinc-400">Título
                                            del proyecto</label>
                                        <input id="titulo_{{ $info->id }}" type="text" name="titulo" required
                                            value="{{ $info->titulo }}"
                                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                                    </div>
                                    <div>
                                        <label for="resumen_{{ $info->id }}"
                                            class="mb-1.5 block text-sm font-semibold text-slate-600 dark:text-zinc-400">Resumen</label>
                                        <textarea id="resumen_{{ $info->id }}" name="resumen" rows="4" required
                                            class="w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">{{ $info->resumen }}</textarea>
                                    </div>
                                    <div>
                                        <label for="anio_{{ $info->id }}"
                                            class="mb-1.5 block text-sm font-semibold text-slate-600 dark:text-zinc-400">Año</label>
                                        <input id="anio_{{ $info->id }}" type="number" name="anio" required
                                            value="{{ $info->anio }}"
                                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-slate-400 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                                    </div>
                                </div>
                            </div>

                            {{-- Autores --}}
                            <div>
                                <p
                                    class="mb-3 text-[11px] font-black uppercase tracking-widest text-slate-400 dark:text-zinc-500">
                                    Autores</p>
                                <div class="flex gap-2">
                                    <label for="dni_{{ $info->id }}" class="sr-only">DNI del autor</label>
                                    <input type="text" id="dni_{{ $info->id }}"
                                        class="dni-input flex-1 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-slate-400 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white"
                                        data-id="{{ $info->id }}" placeholder="Ingrese DNI del autor">
                                    <button type="button"
                                        class="btn-buscar rounded-xl bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-700 dark:bg-indigo-600 dark:hover:bg-indigo-500"
                                        data-id="{{ $info->id }}">
                                        <i class="fa-solid fa-magnifying-glass mr-1"></i> Buscar
                                    </button>
                                </div>
                                <div class="autores-container mt-3 min-h-[80px] overflow-y-auto rounded-xl border border-slate-200 bg-slate-50 p-3 text-sm text-slate-700 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"
                                    data-id="{{ $info->id }}">
                                </div>
                                <textarea name="autores" class="autores-hidden hidden" data-id="{{ $info->id }}"
                                    data-autores="{{ json_encode($info->autores->map(fn($a) => ['dni' => $a->dni, 'nombres' => $a->nombres, 'apellidos' => $a->apellidos])) }}"></textarea>
                            </div>

                        </div>

                        {{-- COLUMNA DERECHA --}}
                        <div class="p-8">
                            <p
                                class="mb-4 text-[11px] font-black uppercase tracking-widest text-slate-400 dark:text-zinc-500">
                                Archivos</p>

                            <div class="space-y-4">
                                {{-- PDF --}}
                                <div
                                    class="rounded-xl border border-dashed border-slate-300 bg-slate-50 p-5 dark:border-zinc-700 dark:bg-zinc-800/50">
                                    <div class="mb-1 flex items-center gap-2">
                                        <i class="fa-solid fa-file-pdf text-rose-500"></i>
                                        <label for="pdf_{{ $info->id }}"
                                            class="text-sm font-bold text-slate-600 dark:text-zinc-400">Archivo
                                            PDF</label>
                                    </div>
                                    <p class="mb-3 truncate text-[11px] text-slate-400 dark:text-zinc-500">
                                        Actual: {{ $info->ruta_pdf }}
                                    </p>
                                    <input id="pdf_{{ $info->id }}" type="file" name="pdf"
                                        class="w-full text-sm text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-sm file:font-bold file:text-white hover:file:bg-slate-700 dark:text-zinc-400 dark:file:bg-indigo-600 dark:hover:file:bg-indigo-500">
                                </div>

                                {{-- Carátula --}}
                                <div
                                    class="rounded-xl border border-dashed border-slate-300 bg-slate-50 p-5 dark:border-zinc-700 dark:bg-zinc-800/50">
                                    <div class="mb-3 flex items-center gap-2">
                                        <i class="fa-solid fa-image text-indigo-500"></i>
                                        <label for="caratula_{{ $info->id }}"
                                            class="text-sm font-bold text-slate-600 dark:text-zinc-400">Carátula</label>
                                    </div>
                                    <input id="caratula_{{ $info->id }}" type="file" name="caratula"
                                        accept="image/*"
                                        onchange="previewImage(event, '{{ $info->id }}'); document.getElementById('imgPlaceholder{{ $info->id }}').classList.add('hidden'); document.getElementById('imgPreview{{ $info->id }}').classList.remove('hidden');"
                                        class="w-full text-sm text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-sm file:font-bold file:text-white hover:file:bg-slate-700 dark:text-zinc-400 dark:file:bg-indigo-600 dark:hover:file:bg-indigo-500">
                                </div>

                                {{-- Preview --}}
                                <div
                                    class="overflow-hidden rounded-xl border border-slate-200 bg-slate-50 dark:border-zinc-700 dark:bg-zinc-800">
                                    <p
                                        class="border-b border-slate-200 px-4 py-2.5 text-[11px] font-black uppercase tracking-widest text-slate-400 dark:border-zinc-700 dark:text-zinc-500">
                                        Vista previa</p>
                                    <div class="flex min-h-[180px] items-center justify-center p-4">
                                        <img id="imgPreview{{ $info->id }}"
                                            src="{{ $info->ruta_caratula ? asset('storage/caratulas/' . $info->ruta_caratula) : asset('img/default.png') }}"
                                            class="max-h-44 rounded-lg object-cover shadow-md">
                                        <div id="imgPlaceholder{{ $info->id }}"
                                            class="hidden flex-col items-center gap-2 text-slate-300 dark:text-zinc-600">
                                            <i class="fa-solid fa-image text-5xl"></i>
                                            <span class="text-sm">Sin imagen seleccionada</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- FOOTER --}}
                    <div
                        class="flex shrink-0 items-center justify-end gap-3 border-t border-slate-100 bg-slate-50 px-8 py-5 dark:border-zinc-800 dark:bg-[#1a1a22]">
                        <button type="button" data-tw-dismiss="modal"
                            class="rounded-xl border border-slate-200 bg-white px-6 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="rounded-xl bg-amber-500 px-6 py-2.5 text-sm font-bold text-white shadow-md transition hover:bg-amber-600 active:scale-95">
                            <i class="fa-solid fa-floppy-disk mr-2"></i> Guardar Cambios
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endforeach
