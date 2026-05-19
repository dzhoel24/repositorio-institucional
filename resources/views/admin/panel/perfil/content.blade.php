<div class="flex w-full flex-col items-center justify-center mt-3">
    <div class="w-full max-w-[900px]">

        <x-admin.title titulo="CONFIGURACIÓN DE PERFIL" subtitulo="Información y seguridad de tu cuenta de usuario."
            badgeColor="indigo" />

        <div
            class="grid grid-cols-1 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm 
                    dark:border-slate-700 dark:bg-slate-900 md:grid-cols-[280px_1fr]">

            <div
                class="flex flex-col items-center justify-center gap-4 border-b border-slate-100 bg-slate-100/30 px-6 py-10 text-center 
                        dark:border-slate-700 dark:bg-slate-800/50 md:border-b-0 md:border-r">

                <div class="group relative">
                    <img src="{{ $user->profile_photo_url }}" onerror="this.src='{{ asset('images/default.png') }}'"
                        alt="Avatar de {{ $user->username }}"
                        class="h-28 w-28 rounded-full border-4 border-white object-cover shadow-md transition-all duration-300 
                                group-hover:scale-105 group-hover:shadow-lg dark:border-slate-700">

                    <div class="absolute bottom-1 right-1 rounded-full bg-indigo-500 p-1.5 shadow-md">
                        <svg class="h-3 w-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </div>
                </div>

                <div class="space-y-1">
                    <p class="text-xl font-extrabold leading-tight text-slate-800 dark:text-white">
                        {{ $user->username }}
                    </p>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                        {{ $user->full_name }}
                    </p>
                </div>

                <div
                    class="inline-flex items-center gap-2 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-4 py-1.5 text-xs font-bold text-emerald-600 
                            dark:border-emerald-500/30 dark:bg-emerald-500/10 dark:text-emerald-400">
                    <span class="h-2 w-2 animate-pulse rounded-full bg-emerald-500"></span>
                    Cuenta Activa
                </div>
            </div>

            <div class="flex flex-col justify-center p-6 sm:p-8 lg:p-10">
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white">
                        Seguridad de la Cuenta
                    </h3>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Actualiza tu contraseña para mantener tu cuenta segura
                    </p>
                </div>

                <form method="POST" action="{{ route('profile.password.update') }}">
                    @csrf

                    <div class="space-y-1.5 mb-4">
                        <label for="password"
                            class="block text-xs font-bold uppercase tracking-wide text-slate-600 dark:text-slate-300">
                            Nueva contraseña
                        </label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Ingresa nueva contraseña"
                                required
                                class="h-11 w-full rounded-xl border border-slate-200 bg-white pl-4 pr-11 text-sm text-slate-700 
                                       outline-none transition-all duration-200 placeholder:text-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100
                                       dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-500 
                                       dark:focus:border-indigo-500 dark:focus:ring-indigo-500/20">
                            <button type="button"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-indigo-500 transition-colors"
                                onclick="togglePassword(this)" data-target="password">
                                <i class="fas fa-eye-slash text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <div class="space-y-1.5 mb-6">
                        <label for="password_confirmation"
                            class="block text-xs font-bold uppercase tracking-wide text-slate-600 dark:text-slate-300">
                            Confirmar nueva contraseña
                        </label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Confirma tu nueva contraseña" required
                                class="h-11 w-full rounded-xl border border-slate-200 bg-white pl-4 pr-11 text-sm text-slate-700 
                                       outline-none transition-all duration-200 placeholder:text-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100
                                       dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-500 
                                       dark:focus:border-indigo-500 dark:focus:ring-indigo-500/20">
                            <button type="button"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-indigo-500 transition-colors"
                                onclick="togglePassword(this)" data-target="password_confirmation">
                                <i class="fas fa-eye-slash text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="group flex w-full items-center justify-center gap-2 rounded-xl bg-slate-700 py-3 text-sm font-bold text-white 
                                   shadow-md transition-all duration-200 hover:bg-indigo-600 hover:shadow-lg active:scale-[0.98]
                                   dark:bg-indigo-600 dark:hover:bg-indigo-500">
                            <i class="fas fa-save text-sm"></i>
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(button) {
        var input = document.getElementById(button.getAttribute('data-target'));
        if (input) {
            if (input.type === 'password') {
                input.type = 'text';
                button.innerHTML = '<i class="fas fa-eye text-sm"></i>';
            } else {
                input.type = 'password';
                button.innerHTML = '<i class="fas fa-eye-slash text-sm"></i>';
            }
        }
    }

    document.dispatchEvent(new CustomEvent('page:title', {
        detail: 'Perfil'
    }));
</script>
