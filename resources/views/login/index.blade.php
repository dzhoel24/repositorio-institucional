<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Repositorio | Acceso Institucional</title>
    <link rel="shortcut icon" href="{{ asset('images/icono-csr.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css'])
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4 sm:p-6 bg-gradient-to-br from-slate-100 to-slate-200">
    <div class="flex w-full max-w-[900px] rounded-2xl overflow-hidden shadow-2xl flex-col sm:flex-row">

        {{-- Panel izquierdo: Branding --}}
        <div
            class="w-full sm:w-[45%] bg-gradient-to-br from-slate-800 to-slate-900 flex flex-col items-center justify-center px-6 py-8 sm:px-8 sm:py-12 relative overflow-hidden">

            <div class="absolute -top-20 -right-20 w-56 h-56 rounded-full bg-indigo-500/10"></div>
            <div class="absolute -bottom-16 -left-16 w-40 h-40 rounded-full bg-indigo-500/10"></div>

            <div class="relative z-10 mb-5">
                <div
                    class="w-20 h-20 rounded-2xl bg-white/10 border border-white/15 flex items-center justify-center shadow-xl backdrop-blur-sm transition-transform duration-300 hover:scale-105">
                    <img src="{{ asset('images/logo-csr.png') }}" alt="Logo CSR" class="w-12 h-12 object-contain" />
                </div>
            </div>

            <div class="relative z-10 text-center">
                <h2 class="text-white text-xl font-bold mb-1">Repositorio Institucional</h2>
                <p class="text-indigo-300 text-base font-medium">"Carlos Salazar Romero"</p>

                <div class="w-12 h-px bg-indigo-400/30 mx-auto my-5"></div>

                <div class="flex flex-wrap gap-3 justify-center">
                    <span
                        class="px-3 py-1.5 rounded-full bg-white/5 border border-white/10 text-slate-300 text-sm font-medium">
                        Proyectos
                    </span>
                    <span
                        class="px-3 py-1.5 rounded-full bg-white/5 border border-white/10 text-slate-300 text-sm font-medium">
                        Publicaciones
                    </span>
                    <span
                        class="px-3 py-1.5 rounded-full bg-white/5 border border-white/10 text-slate-300 text-sm font-medium">
                        Autores
                    </span>
                </div>
            </div>
        </div>

        {{-- Panel derecho: Formulario --}}
        <div class="flex-1 bg-white px-6 py-8 sm:px-10 sm:py-12">

            <div
                class="inline-flex items-center gap-2 bg-indigo-50 border border-indigo-100 text-indigo-600 text-xs font-semibold px-3 py-1.5 rounded-full mb-6">
                <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                Acceso institucional
            </div>

            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800 mb-2">Bienvenido de vuelta</h1>
            <p class="text-slate-400 text-sm mb-7">Ingresa tus credenciales para continuar</p>

            <form method="POST" action="{{ route('login') }}" id="login-form">
                @csrf

                {{-- Campo Usuario --}}
                <div class="mb-5">
                    <label for="username" class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">
                        Usuario
                    </label>
                    <div class="relative">
                        <input type="text" id="username" name="username" placeholder="Tu nombre de usuario"
                            autocomplete="username" required
                            class="w-full px-4 pr-12 py-3 border border-slate-200 rounded-xl
                                   bg-slate-50 text-slate-800 text-sm
                                   focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100
                                   transition-all duration-200 outline-none" />
                        <i class="fas fa-user absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    </div>
                </div>

                {{-- Campo Contraseña --}}
                <div class="mb-6">
                    <label for="login-password"
                        class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">
                        Contraseña
                    </label>
                    <div class="relative">
                        <input type="password" id="login-password" name="password" placeholder="Ingresa tu contraseña"
                            required
                            class="w-full px-4 pr-12 py-3 border border-slate-200 rounded-xl
                                   bg-slate-50 text-slate-800 text-sm
                                   focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100
                                   transition-all duration-200 outline-none" />
                        <button type="button"
                            class="toggle-password absolute right-4 top-1/2 -translate-y-1/2 
                                   text-slate-400 hover:text-indigo-600 transition-colors"
                            data-target="login-password">
                            <i class="fas fa-eye-slash text-sm"></i>
                        </button>
                    </div>
                </div>

                {{-- Botón Ingresar --}}
                <button type="submit" id="btn-submit"
                    class="w-full py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-700
                           text-white text-sm font-semibold
                           flex items-center justify-center gap-3
                           active:scale-[0.98] transition-all duration-200
                           shadow-md hover:shadow-lg mb-5
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <i class="fas fa-lock-open text-sm" id="btn-icon-start"></i>
                    <span id="btn-text">Ingresar</span>
                    <i class="fas fa-arrow-right text-sm" id="btn-icon-end"></i>
                </button>

                {{-- Separador --}}
                <div class="flex items-center gap-3 mb-5">
                    <span class="flex-1 h-px bg-slate-100"></span>
                    <span class="text-xs text-slate-400 font-medium">o</span>
                    <span class="flex-1 h-px bg-slate-100"></span>
                </div>

                {{-- Botón Explorar --}}
                <a href="{{ route('home') }}"
                    class="w-full py-3 rounded-xl border border-slate-200 bg-white
                          text-slate-600 text-sm font-medium
                          flex items-center justify-center gap-2
                          hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-600
                          transition-all duration-200
                          focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:ring-offset-2">
                    <i class="fas fa-globe-americas text-sm"></i>
                    Explorar repositorio público
                </a>
            </form>
        </div>
    </div>

    <x-admin.alerts />

    <script>
        (function() {
            'use strict';

            // Toggle password visibility
            const toggleButtons = document.querySelectorAll(".toggle-password");
            toggleButtons.forEach((button) => {
                button.addEventListener("click", (e) => {
                    e.preventDefault();
                    const input = document.getElementById(button.dataset.target);
                    if (input) {
                        const isPassword = input.type === "password";
                        input.type = isPassword ? "text" : "password";
                        const icon = button.querySelector("i");
                        if (icon) {
                            icon.classList.remove("fa-eye", "fa-eye-slash");
                            icon.classList.add(isPassword ? "fa-eye" : "fa-eye-slash");
                        }
                    }
                });
            });

            // Form submission with loading state
            const form = document.getElementById('login-form');
            const submitBtn = document.getElementById('btn-submit');
            const btnText = document.getElementById('btn-text');
            const btnIconStart = document.getElementById('btn-icon-start');
            const btnIconEnd = document.getElementById('btn-icon-end');

            if (form) {
                form.addEventListener('submit', (e) => {
                    const username = document.getElementById('username')?.value.trim();
                    const password = document.getElementById('login-password')?.value.trim();

                    if (!username || !password) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: 'Campos vacíos',
                            text: 'Por favor, completa tu usuario y contraseña',
                            confirmButtonColor: '#6366f1'
                        });
                        return;
                    }

                    submitBtn.disabled = true;
                    btnText.textContent = 'Ingresando';
                    btnIconEnd.style.display = 'none';

                    btnIconStart.outerHTML = `
                        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    `;

                    setTimeout(() => {
                        form.submit();
                    }, 200);
                });
            }
        })();
    </script>
</body>

</html>
