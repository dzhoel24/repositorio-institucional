<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Repositorio | Login</title>
    <link rel="shortcut icon" href="{{ asset('images/icono-csr.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f6fe559650.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        .input-field:focus {
            border-color: #111;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.06);
            outline: none;
        }

        .input-field::placeholder {
            color: #c0c0c0;
        }

        .btn-login:hover {
            background-color: #000;
            transform: translateY(-1px);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        @media (max-width: 680px) {
            .login-card {
                flex-direction: column;
            }

            .panel-form {
                width: 100% !important;
                padding: 36px 28px 32px !important;
            }

            .panel-brand {
                width: 100% !important;
                padding: 22px 28px !important;
            }

            .brand-inner {
                width: 100%;
                display: flex;
                align-items: center !important;
                gap: 14px !important;
                text-align: left !important;
                justify-content: space-between;
            }

            .brand-logo-wrap {
                width: 44px !important;
                height: 44px !important;
                border-radius: 12px !important;
                margin: 0 !important;
                flex-shrink: 0;
            }

            .brand-logo-wrap img {
                width: 28px !important;
                height: 28px !important;
            }

            .brand-divider,
            .brand-tags {
                display: none !important;
            }

            .brand-title {
                font-size: 13px !important;
                letter-spacing: .08em !important;
            }

            .brand-name {
                font-size: 12px !important;
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-6 bg-[#f2f2f2]">

    <div
        class="login-card flex w-full max-w-[860px] min-h-[500px] rounded-[22px] overflow-hidden border border-black/[.06] shadow-[0_24px_60px_rgba(0,0,0,0.1)]">

        {{-- ── Panel form ── --}}
        <section class="panel-form w-[52%] bg-white px-12 py-[52px] flex flex-col justify-center">

            <form method="POST" action="{{ route('login') }}" id="login-form" autocomplete="on">
                @csrf

                {{-- Badge --}}
                <span
                    class="inline-flex items-center gap-[7px] bg-[#f2f2f2] text-[#555] text-[11.5px] font-semibold tracking-[.05em] px-[14px] py-[6px] rounded-full mb-8 w-fit">
                    <span class="block w-[6px] h-[6px] rounded-full bg-[#111]"></span>
                    Acceso institucional
                </span>

                <h1 class="text-[34px] font-bold text-[#111] leading-[1.15] mb-[10px]">
                    Bienvenido<br>de vuelta
                </h1>
                <p class="text-[15px] text-[#aaa] mb-9 leading-relaxed">
                    Ingresa tus credenciales para continuar
                </p>

                {{-- Usuario --}}
                <div class="mb-[18px]">
                    <label for="username"
                        class="block text-[11.5px] font-bold text-[#aaa] tracking-[.08em] uppercase mb-2">
                        Usuario
                    </label>
                    <div class="relative">
                        <input type="text" id="username" name="username" placeholder="Tu nombre de usuario"
                            autocomplete="username" required
                            class="input-field w-full px-4 pr-[46px] py-[14px] border-[1.5px] border-[#ebebeb] rounded-[14px] bg-[#f9f9f9] text-[16px] text-[#111] transition-all duration-200" />
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[#ccc] pointer-events-none">
                            <i class="fa-solid fa-user text-[14px]"></i>
                        </span>
                    </div>
                </div>

                {{-- Contraseña --}}
                <div class="mb-[10px]">
                    <label for="login-password"
                        class="block text-[11.5px] font-bold text-[#aaa] tracking-[.08em] uppercase mb-2">
                        Contraseña
                    </label>
                    <div class="relative">
                        <input type="password" id="login-password" name="password" placeholder="••••••••"
                            autocomplete="current-password" required
                            class="input-field w-full px-4 pr-[46px] py-[14px] border-[1.5px] border-[#ebebeb] rounded-[14px] bg-[#f9f9f9] text-[16px] text-[#111] transition-all duration-200" />
                        <button type="button" id="toggle-password" aria-label="Mostrar u ocultar contraseña"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-[#ccc] text-[14px] bg-transparent border-0 p-0 cursor-pointer hover:text-[#111] transition-colors duration-200">
                            <i id="toggle-icon" class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" id="btn-submit"
                    class="btn-login w-full py-4 rounded-[14px] bg-[#111] text-white text-[16px] font-bold tracking-[.02em] border-0 cursor-pointer flex items-center justify-center gap-[10px] transition-all duration-200">
                    Ingresar <i class="fa-solid fa-arrow-right text-[13px]"></i>
                </button>

            </form>
        </section>

        {{-- ── Panel branding ── --}}
        <aside class="panel-brand w-[48%] bg-[#111] flex items-center justify-center px-11 py-12">

            <div class="brand-inner text-center">

                <div
                    class="brand-logo-wrap w-[72px] h-[72px] rounded-[18px] bg-[#222] flex items-center justify-center mx-auto mb-7 overflow-hidden">
                    <img src="{{ asset('images/logo-csr.png') }}" alt="Logo CSR"
                        class="w-[46px] h-[46px] object-contain" />
                </div>

                <p class="brand-title text-[22px] font-bold text-white tracking-[.14em] mb-1">REPOSITORIO</p>

                <div class="brand-divider w-10 h-[1px] bg-[#333] mx-auto my-5"></div>

                <p class="brand-name text-[15px] text-[#555] leading-relaxed">
                    <span class="block text-[#888]">Repositorio Institucional</span>
                    <span class="block mt-1">"Carlos Salazar Romero"</span>
                </p>

                <div class="brand-tags flex gap-2 mt-7 justify-center flex-wrap">
                    <span
                        class="px-[13px] py-[5px] rounded-full border border-[#2a2a2a] text-[#555] text-[13px] bg-[#1a1a1a]">Proyectos</span>
                    <span
                        class="px-[13px] py-[5px] rounded-full border border-[#2a2a2a] text-[#555] text-[13px] bg-[#1a1a1a]">Publicaciones</span>
                    <span
                        class="px-[13px] py-[5px] rounded-full border border-[#2a2a2a] text-[#555] text-[13px] bg-[#1a1a1a]">Autores</span>
                </div>

            </div>
        </aside>

    </div>

    {{-- Toggle contraseña --}}
    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            const input = document.getElementById('login-password');
            const icon = document.getElementById('toggle-icon');
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            icon.classList.toggle('fa-eye', !show);
            icon.classList.toggle('fa-eye-slash', show);
        });

        // Prevenir doble submit
        document.getElementById('login-form').addEventListener('submit', function() {
            const btn = document.getElementById('btn-submit');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin text-sm"></i> Ingresando…';
        });
    </script>

    <x-alerts />

</body>

</html>
