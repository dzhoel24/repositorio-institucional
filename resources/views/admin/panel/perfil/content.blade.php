<div class="flex w-full flex-col items-center justify-center mt-3">
    <div class="w-full max-w-[900px]">

        <x-admin.title titulo="CONFIGURACIÓN DE PERFIL" subtitulo="Información y seguridad de tu cuenta de usuario."
            :table="null" />

        <div
            class="grid grid-cols-1 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm 
                    dark:border-slate-700 dark:bg-slate-800 md:grid-cols-[280px_1fr]">

            <div
                class="flex flex-col items-center justify-center gap-4 border-b border-slate-200 bg-slate-50/50 
                        px-6 py-8 text-center dark:border-slate-700 dark:bg-slate-800/50 
                        md:border-b-0 md:border-r">

                <div class="group relative">
                    <img src="{{ $user->profile_photo_url ?? asset('images/default.png') }}"
                        onerror="this.src='{{ asset('images/default.png') }}'" alt="Avatar de {{ $user->username }}"
                        class="h-24 w-24 rounded-full border-4 border-white object-cover shadow-md transition-all duration-300 
                               group-hover:scale-105 group-hover:shadow-lg dark:border-slate-700">

                    <div class="absolute bottom-1 right-1 rounded-full bg-indigo-500 p-1.5 shadow-md">
                        <svg class="h-3 w-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </div>
                </div>

                <div>
                    <p class="text-lg font-bold text-slate-800 dark:text-white">
                        {{ $user->username }}
                    </p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        {{ $user->full_name }}
                    </p>
                </div>

                <div
                    class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-medium text-emerald-700 
                            dark:bg-emerald-500/10 dark:text-emerald-400">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    Activo
                </div>
            </div>

            {{-- Formulario --}}
            <div class="p-6 sm:p-8">
                <div class="mb-6">
                    <h3 class="text-base font-semibold text-slate-800 dark:text-white">
                        Seguridad de la Cuenta
                    </h3>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Actualiza tu contraseña para mantener tu cuenta segura
                    </p>
                </div>

                <form method="POST" action="{{ route('profile.password.update') }}">
                    @csrf

                    <div class="space-y-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                Nueva contraseña
                            </label>
                            <div class="relative mt-1">
                                <input type="password" id="password" name="password"
                                    placeholder="Ingresa nueva contraseña" required
                                    class="h-10 w-full rounded-lg border border-slate-300 bg-white pl-3 pr-10 text-sm text-slate-700 
                                           outline-none transition-all duration-200 placeholder:text-slate-400 
                                           focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                                           dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100 
                                           dark:placeholder:text-slate-500 dark:focus:border-indigo-500 
                                           dark:focus:ring-indigo-500/30">
                                <button type="button"
                                    class="absolute right-2 top-1/2 -translate-y-1/2 text-slate-400 transition-colors hover:text-indigo-600"
                                    onclick="togglePassword(this)" data-target="password">
                                    <i class="fas fa-eye-slash text-sm"></i>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                Confirmar contraseña
                            </label>
                            <div class="relative mt-1">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    placeholder="Confirma tu nueva contraseña" required
                                    class="h-10 w-full rounded-lg border border-slate-300 bg-white pl-3 pr-10 text-sm text-slate-700 
                                           outline-none transition-all duration-200 placeholder:text-slate-400 
                                           focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                                           dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100 
                                           dark:placeholder:text-slate-500 dark:focus:border-indigo-500 
                                           dark:focus:ring-indigo-500/30">
                                <button type="button"
                                    class="absolute right-2 top-1/2 -translate-y-1/2 text-slate-400 transition-colors hover:text-indigo-600"
                                    onclick="togglePassword(this)" data-target="password_confirmation">
                                    <i class="fas fa-eye-slash text-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white 
                                   transition-all duration-200 hover:bg-indigo-700 active:scale-[0.98]
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                                   dark:bg-indigo-500 dark:hover:bg-indigo-600 sm:w-auto sm:px-5">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3M12 3v9m0 0l-3-2.5M12 12l3-2.5" />
                            </svg>
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
        const input = document.getElementById(button.getAttribute('data-target'));
        if (input) {
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            button.innerHTML = isPassword ? '<i class="fas fa-eye text-sm"></i>' :
                '<i class="fas fa-eye-slash text-sm"></i>';
        }
    }

    document.dispatchEvent(new CustomEvent('page:title', {
        detail: 'Perfil'
    }));
</script>
