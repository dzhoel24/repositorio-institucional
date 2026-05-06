<div class="flex w-full flex-col items-center justify-center py-4">
    <div class="w-full max-w-[800px]">

        <x-header-admin titulo="CONFIGURACION DE PERFIL" subtitulo="Informacion del usuario." />

        <div
            class="grid grid-cols-1 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-white/[.08] dark:bg-[#1a1a23] md:grid-cols-[280px_1fr]">

            {{-- Panel Izquierdo --}}
            <div
                class="flex flex-col items-center justify-center gap-4 border-b border-slate-100 bg-slate-50/50 px-6 py-10 text-center dark:border-white/[.05] dark:bg-[#12121a] md:border-b-0 md:border-r">
                <div class="group relative">
                    <img src="{{ $user->profile_photo_url }}" onerror="this.src='{{ asset('images/default.png') }}'"
                        alt="Avatar de {{ $user->username }}"
                        class="h-28 w-28 rounded-full border-4 border-white object-cover shadow-md transition-transform group-hover:scale-105 dark:border-[#1a1a23]">
                </div>

                <div class="space-y-1">
                    <p class="text-[20px] font-extrabold leading-tight text-slate-900 dark:text-slate-100">
                        {{ $user->username }}
                    </p>
                    <p class="text-[15px] font-medium text-slate-500 dark:text-slate-400">
                        {{ $user->full_name }}
                    </p>
                </div>

                <div
                    class="inline-flex items-center gap-2 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-4 py-1.5 text-[12px] font-bold text-emerald-600 dark:text-emerald-400">
                    <span class="h-2 w-2 animate-pulse rounded-full bg-emerald-500"></span>
                    Cuenta Activa
                </div>
            </div>

            {{-- Panel Derecho --}}
            <div class="flex flex-col justify-center p-8 lg:p-10">
                <div class="mb-5">
                    <h3 class="text-[17px] font-bold text-slate-900 dark:text-slate-100">
                        Seguridad de la Cuenta
                    </h3>
                    <p class="mt-1 text-[14px] text-slate-500 dark:text-slate-400">
                        Actualice su credencial de acceso para garantizar la integridad de su perfil.
                    </p>
                </div>

                <form method="POST" action="{{ route('profile.password.update') }}">
                    @csrf

                    <div class="space-y-1.5">
                        <label for="password" class="block text-[13px] font-bold text-slate-700 dark:text-slate-300">
                            Nueva contraseña
                        </label>
                        <div class="group relative">
                            <input id="password" type="password" name="password" placeholder="••••••••" required
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 pr-12 text-[14px] shadow-sm transition-all focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:border-white/10 dark:bg-[#0f0f13] dark:text-slate-100" />
                            <button type="button"
                                class="toggle-password absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 transition-colors hover:text-indigo-500"
                                data-target="password">
                                <i class="fa-solid fa-eye text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mt-4 space-y-1.5">
                        <label for="password_confirmation"
                            class="block text-[13px] font-bold text-slate-700 dark:text-slate-300">
                            Confirmar nueva contraseña
                        </label>
                        <div class="group relative">
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                placeholder="••••••••" required
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 pr-12 text-[14px] shadow-sm transition-all focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:border-white/10 dark:bg-[#0f0f13] dark:text-slate-100" />
                            <button type="button"
                                class="toggle-password absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 transition-colors hover:text-indigo-500"
                                data-target="password_confirmation">
                                <i class="fa-solid fa-eye text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <div class="pt-5">
                        <button type="submit"
                            class="flex w-full items-center justify-center gap-3 rounded-xl bg-slate-900 py-3.5 text-[14px] font-bold text-white transition-all hover:bg-indigo-600 hover:shadow-lg hover:shadow-indigo-500/20 active:scale-[0.98] dark:bg-indigo-600 dark:hover:bg-indigo-500">
                            <i class="fa-solid fa-shield-check text-sm"></i>
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        document.querySelectorAll('.toggle-password').forEach(btn => {
            btn.addEventListener('click', function() {
                const input = document.getElementById(this.dataset.target);
                const icon = this.querySelector('i');
                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                icon.classList.toggle('fa-eye', !isPassword);
                icon.classList.toggle('fa-eye-slash', isPassword);
            });
        });
    })();
</script>
