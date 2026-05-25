@foreach ($autores as $autor)
    <x-admin.modal-edit id="edit-modal{{ $autor->dni }}" action="{{ route('admin.autores.update', $autor->dni) }}"
        title="EDITAR AUTOR" subtitle="Modifica los datos del autor" size="sm">

        <div class="space-y-1.5">
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                DNI
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-heroicon-o-identification class="h-5 w-5 text-slate-400 dark:text-slate-500" />
                </div>
                <input type="text" value="{{ $autor->dni }}" disabled
                    class="w-full rounded-lg border border-slate-200 bg-slate-100 pl-10 pr-4 py-2 text-sm text-slate-500 
                           dark:border-slate-700 dark:bg-slate-700 dark:text-slate-400">
            </div>
            <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-0.5">
                El DNI no puede ser modificado
            </p>
        </div>

        <div class="space-y-1.5">
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                Nombres
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-heroicon-o-user class="h-5 w-5 text-slate-400 dark:text-slate-500" />
                </div>
                <input type="text" name="nombres" value="{{ $autor->nombres }}" required
                    class="w-full rounded-lg border border-slate-200 bg-white pl-10 pr-4 py-2 text-sm text-slate-700 
                           outline-none transition-all duration-200 placeholder:text-slate-400 
                           focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 
                           dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 
                           dark:placeholder:text-slate-500 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/30">
            </div>
        </div>

        <div class="space-y-1.5">
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                Apellidos
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-heroicon-o-users class="h-5 w-5 text-slate-400 dark:text-slate-500" />
                </div>
                <input type="text" name="apellidos" value="{{ $autor->apellidos }}" required
                    class="w-full rounded-lg border border-slate-200 bg-white pl-10 pr-4 py-2 text-sm text-slate-700 
                           outline-none transition-all duration-200 placeholder:text-slate-400 
                           focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 
                           dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 
                           dark:placeholder:text-slate-500 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/30">
            </div>
        </div>

    </x-admin.modal-edit>
@endforeach
