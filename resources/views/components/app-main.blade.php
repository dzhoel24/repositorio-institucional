<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repositorio | {{ $title ?? 'Salazar Romero' }}</title>
    <link rel="shortcut icon" href="{{ asset('images/icono-csr.ico') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <script src="https://unpkg.com/flowbite@1.6.4/dist/flowbite.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 antialiased">
    <header
        class="bg-white border-b border-slate-200 sticky top-0 z-[100] h-20 flex items-center px-6 lg:px-12 justify-between">
        <a href="/" class="group">
            <div class="flex items-center gap-3">
                <img class="w-10 h-10 md:w-12 md:h-12" src="{{ asset('images/icono-csr.ico') }}" alt="Logo">
                <div class="flex flex-col">
                    <h1 class="text-lg md:text-xl font-black leading-none tracking-tighter uppercase">
                        Repositorio <span class="text-sky-600">Digital</span>
                    </h1>
                    <span class="text-[10px] md:text-xs font-bold text-slate-400 uppercase tracking-widest">Carlos
                        Salazar Romero</span>
                </div>
            </div>
        </a>
        <a href="{{ route('login') }}"
            class="group relative inline-flex items-center justify-center px-7 py-2.5 font-extrabold text-white transition-all duration-300 bg-sky-600 rounded-xl 
          hover:bg-sky-700 hover:shadow-[0_8px_25px_-5px_rgba(2,132,199,0.4)] 
          active:scale-95 overflow-hidden">

            {{-- Efecto de brillo que cruza el botón al pasar el mouse --}}
            <div
                class="absolute inset-0 w-full h-full transition-all duration-500 scale-0 group-hover:scale-100 group-hover:bg-white/10 rounded-xl">
            </div>

            <div class="relative flex items-center gap-2">
                {{-- Icono de Boxicons (Usando la clase CSS que instalamos) --}}
                <i class='bx bx-log-in-circle text-xl transition-transform duration-300 group-hover:translate-x-1'></i>

                <span class="text-sm uppercase tracking-wider">
                    Ingresar
                </span>
            </div>

            {{-- Borde de luz inferior decorativo --}}
            <div
                class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
            </div>
        </a>
    </header>

    <main class="min-h-screen">
        <div class="max-w-[90rem] mx-auto px-10">
            {{ $slot }}
        </div>
    </main>

    <footer class="bg-white border-t border-slate-200 py-8 mt-5">
        <div
            class="max-w-[90rem] mx-auto px-6 text-center text-slate-400 font-bold text-[13px] uppercase tracking-widest">
            &copy; {{ date('Y') }} I.S.T. Carlos Salazar Romero
        </div>
    </footer>
    @vite(['resources/js/tabs.js'])
</body>

</html>
