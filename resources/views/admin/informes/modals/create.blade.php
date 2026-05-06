<div class="modal fixed inset-0 z-[999] hidden" id="add-informe-modal">
    <div class="modal-overlay absolute inset-0 bg-slate-950/70 backdrop-blur-sm"></div>

    <div class="relative flex min-h-screen items-center justify-center p-4">
        <div
            class="modal-animate flex max-h-[92vh] w-full max-w-5xl flex-col overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-[#0f0f13]">

            {{-- HEADER --}}
            <div
                class="flex shrink-0 items-center justify-between border-b border-slate-100 bg-slate-50 px-8 py-5 dark:border-zinc-800 dark:bg-[#1a1a22]">
                <div class="flex items-center gap-4">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900 dark:bg-indigo-600">
                        <i class="fa-solid fa-folder-plus text-sm text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-black uppercase tracking-wide text-slate-900 dark:text-white">Nuevo
                            Proyecto</h2>
                        <p class="text-sm text-slate-400">Completa los campos para registrar un informe académico</p>
                    </div>
                </div>
                <button type="button" data-tw-dismiss="modal"
                    class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 hover:bg-slate-200 hover:text-slate-600 dark:hover:bg-zinc-700">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form action="{{ route('admin.informes.store') }}" method="POST" enctype="multipart/form-data"
                class="overflow-y-auto">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-2">

                    {{-- COLUMNA IZQUIERDA --}}
                    <div class="space-y-6 border-b border-slate-100 p-8 lg:border-b-0 lg:border-r dark:border-zinc-800">

                        {{-- Clasificación --}}
                        <div>
                            <p
                                class="mb-3 text-[11px] font-black uppercase tracking-widest text-slate-400 dark:text-zinc-500">
                                Clasificación</p>
                            <div class="space-y-3">
                                <div>
                                    <label for="tipo_informe"
                                        class="mb-1.5 block text-sm font-semibold text-slate-600 dark:text-zinc-400">Tipo
                                        de informe</label>
                                    <select id="tipo_informe" name="tipo_informe" required
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                                        <option disabled selected>Seleccione tipo</option>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="cajaCarrera" class="hidden">
                                    <label for="carrera"
                                        class="mb-1.5 block text-sm font-semibold text-slate-600 dark:text-zinc-400">Carrera
                                        profesional</label>
                                    <select id="carrera" name="carrera"
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-slate-400 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                                        <option disabled selected>Seleccione carrera</option>
                                        @foreach ($carreras as $carrera)
                                            <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="cajaModulo" class="hidden">
                                    <label for="modulo"
                                        class="mb-1.5 block text-sm font-semibold text-slate-600 dark:text-zinc-400">Módulo
                                        académico</label>
                                    <select id="modulo" name="modulo"
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-slate-400 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                                        <option disabled selected>Seleccione módulo</option>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
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
                                    <label for="titulo"
                                        class="mb-1.5 block text-sm font-semibold text-slate-600 dark:text-zinc-400">Título
                                        del proyecto</label>
                                    <input id="titulo" type="text" name="titulo" required
                                        placeholder="Ej: Sistema de gestión académica"
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                                </div>
                                <div>
                                    <label for="resumen"
                                        class="mb-1.5 block text-sm font-semibold text-slate-600 dark:text-zinc-400">Resumen</label>
                                    <textarea id="resumen" name="resumen" rows="4" required placeholder="Describe brevemente el proyecto"
                                        class="w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white"></textarea>
                                </div>
                                <div>
                                    <label for="anio"
                                        class="mb-1.5 block text-sm font-semibold text-slate-600 dark:text-zinc-400">Año</label>
                                    <input id="anio" type="number" name="anio" required
                                        placeholder="{{ date('Y') }}"
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
                                <label for="dni" class="sr-only">DNI del autor</label>
                                <input type="text" id="dni" placeholder="Ingrese DNI del autor"
                                    class="flex-1 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-slate-400 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                                <button type="button" id="buscar"
                                    class="rounded-xl bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-700 dark:bg-indigo-600 dark:hover:bg-indigo-500">
                                    <i class="fa-solid fa-magnifying-glass mr-1"></i> Buscar
                                </button>
                            </div>
                            <div id="autores-container"
                                class="mt-3 min-h-[80px] overflow-y-auto rounded-xl border border-slate-200 bg-slate-50 p-3 text-sm text-slate-700 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                            </div>
                            <textarea name="autores" id="autores-crear" hidden></textarea>
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
                                <div class="mb-3 flex items-center gap-2">
                                    <i class="fa-solid fa-file-pdf text-rose-500"></i>
                                    <label for="pdf"
                                        class="text-sm font-bold text-slate-600 dark:text-zinc-400">Archivo PDF</label>
                                    <span
                                        class="rounded-md bg-rose-100 px-2 py-0.5 text-[11px] font-bold text-rose-600 dark:bg-rose-500/20 dark:text-rose-400">Requerido</span>
                                </div>
                                <input id="pdf" type="file" name="pdf" required
                                    class="w-full text-sm text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-sm file:font-bold file:text-white hover:file:bg-slate-700 dark:text-zinc-400 dark:file:bg-indigo-600 dark:hover:file:bg-indigo-500">
                            </div>

                            {{-- Carátula --}}
                            <div
                                class="rounded-xl border border-dashed border-slate-300 bg-slate-50 p-5 dark:border-zinc-700 dark:bg-zinc-800/50">
                                <div class="mb-3 flex items-center gap-2">
                                    <i class="fa-solid fa-image text-indigo-500"></i>
                                    <label for="caratula"
                                        class="text-sm font-bold text-slate-600 dark:text-zinc-400">Carátula</label>
                                    <span
                                        class="rounded-md bg-rose-100 px-2 py-0.5 text-[11px] font-bold text-rose-600 dark:bg-rose-500/20 dark:text-rose-400">Requerido</span>
                                </div>
                                <input id="caratula" type="file" name="caratula" accept="image/*" required
                                    onchange="previewImage(event,'#imgPreview'); document.getElementById('imgPlaceholder').classList.add('hidden'); document.getElementById('imgPreview').classList.remove('hidden');"
                                    class="w-full text-sm text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-sm file:font-bold file:text-white hover:file:bg-slate-700 dark:text-zinc-400 dark:file:bg-indigo-600 dark:hover:file:bg-indigo-500">
                            </div>

                            {{-- Preview --}}
                            <div
                                class="overflow-hidden rounded-xl border border-slate-200 bg-slate-50 dark:border-zinc-700 dark:bg-zinc-800">
                                <p
                                    class="border-b border-slate-200 px-4 py-2.5 text-[11px] font-black uppercase tracking-widest text-slate-400 dark:border-zinc-700 dark:text-zinc-500">
                                    Vista previa</p>
                                <div class="flex min-h-[180px] items-center justify-center p-4">
                                    <img id="imgPreview" class="hidden max-h-44 rounded-lg object-cover shadow-md">
                                    <div id="imgPlaceholder"
                                        class="flex flex-col items-center gap-2 text-slate-300 dark:text-zinc-600">
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
                        class="rounded-xl bg-slate-900 px-6 py-2.5 text-sm font-bold text-white shadow-md transition hover:bg-slate-700 active:scale-95 dark:bg-indigo-600 dark:hover:bg-indigo-500">
                        <i class="fa-solid fa-floppy-disk mr-2"></i> Guardar Proyecto
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
