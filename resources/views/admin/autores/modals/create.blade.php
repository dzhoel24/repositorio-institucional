<x-admin.modal-crud id="add-modal" title="AÑADIR AUTOR" subtitle="Registra un nuevo autor en el sistema"
    action="{{ route('admin.autores.store') }}" icon="heroicon-o-document-plus" buttonText="Guardar"
    buttonIcon="heroicon-o-check-circle">

    <div class="space-y-4">
        <div class="space-y-1.5">
            <label
                class="block text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">DNI</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-heroicon-o-identification class="h-5 w-5 text-slate-400 dark:text-slate-500" />
                </div>
                <input type="text" name="dni" placeholder="12345678" required
                    class="w-full rounded-lg border border-slate-200 bg-white pl-10 pr-4 py-2 text-sm text-slate-700 outline-none transition-all duration-200 
                           placeholder:text-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 
                           dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-500 
                           dark:focus:border-indigo-500 dark:focus:ring-indigo-500/30">
            </div>
        </div>

        <div class="space-y-1.5">
            <label
                class="block text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Nombres</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-heroicon-o-user class="h-5 w-5 text-slate-400 dark:text-slate-500" />
                </div>
                <input type="text" name="nombres" placeholder="Juan Carlos" required
                    class="w-full rounded-lg border border-slate-200 bg-white pl-10 pr-4 py-2 text-sm text-slate-700 outline-none transition-all duration-200 
                           placeholder:text-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 
                           dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-500 
                           dark:focus:border-indigo-500 dark:focus:ring-indigo-500/30">
            </div>
        </div>

        <div class="space-y-1.5">
            <label
                class="block text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Apellidos</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-heroicon-o-users class="h-5 w-5 text-slate-400 dark:text-slate-500" />
                </div>
                <input type="text" name="apellidos" placeholder="Pérez García" required
                    class="w-full rounded-lg border border-slate-200 bg-white pl-10 pr-4 py-2 text-sm text-slate-700 outline-none transition-all duration-200 
                           placeholder:text-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 
                           dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-500 
                           dark:focus:border-indigo-500 dark:focus:ring-indigo-500/30">
            </div>
        </div>
    </div>
</x-admin.modal-crud>
