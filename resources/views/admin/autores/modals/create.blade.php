<x-admin.modal-create id='add-modal' title='AÑADIR AUTOR' subtitle='Registra un nuevo autor en el sistema' size="sm"
    action="{{ route('admin.autores.store') }}">

    <div class="space-y-1.5">
        <label for="dni"
            class="block text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
            DNI
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <x-heroicon-o-identification class="h-5 w-5 text-slate-400 dark:text-slate-500" />
            </div>
            <input id="dni" type="text" name="dni" placeholder="12345678" required
                class="w-full rounded-lg border border-slate-200 bg-white pl-10 pr-4 py-2 text-sm text-slate-700 outline-none transition-all duration-200 
                       placeholder:text-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 
                       dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-500 
                       dark:focus:border-indigo-500 dark:focus:ring-indigo-500/30">
        </div>
    </div>

    <div class="space-y-1.5">
        <label for="nombres"
            class="block text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
            Nombres
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <x-heroicon-o-user class="h-5 w-5 text-slate-400 dark:text-slate-500" />
            </div>
            <input id="nombres" type="text" name="nombres" placeholder="Juan Carlos" required
                class="w-full rounded-lg border border-slate-200 bg-white pl-10 pr-4 py-2 text-sm text-slate-700 outline-none transition-all duration-200 
                       placeholder:text-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 
                       dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-500 
                       dark:focus:border-indigo-500 dark:focus:ring-indigo-500/30">
        </div>
    </div>

    <div class="space-y-1.5">
        <label for="apellidos"
            class="block text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
            Apellidos
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <x-heroicon-o-users class="h-5 w-5 text-slate-400 dark:text-slate-500" />
            </div>
            <input id="apellidos" type="text" name="apellidos" placeholder="Pérez García" required
                class="w-full rounded-lg border border-slate-200 bg-white pl-10 pr-4 py-2 text-sm text-slate-700 outline-none transition-all duration-200 
                       placeholder:text-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 
                       dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-500 
                       dark:focus:border-indigo-500 dark:focus:ring-indigo-500/30">
        </div>
    </div>

</x-admin.modal-create>
