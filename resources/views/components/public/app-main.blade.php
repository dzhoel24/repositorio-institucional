<!DOCTYPE html>
<html lang="es" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repositorio | {{ $title ?? 'Salazar Romero' }}</title>
    <link rel="shortcut icon" href="{{ asset('images/icono-csr.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css'])
    <script src="https://unpkg.com/flowbite@1.6.4/dist/flowbite.js"></script>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        * {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased flex flex-col min-h-full">

    <header
        class="bg-white/80 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-[100] h-20 flex items-center px-6 lg:px-12 justify-between transition-all">
        <a href="/" class="group focus:outline-none">
            <div class="flex items-center gap-3">
                <div
                    class="relative overflow-hidden rounded-xl bg-slate-100 p-1 group-hover:scale-105 transition-transform duration-300">
                    <img class="w-10 h-10 md:w-11 md:h-11 object-contain" src="{{ asset('images/icono-csr.ico') }}"
                        alt="Logo">
                </div>
                <div class="flex flex-col">
                    <h1 class="text-base md:text-lg font-black leading-none tracking-tight uppercase text-slate-900">
                        Repositorio <span class="text-sky-600 group-hover:text-sky-500 transition-colors">Digital</span>
                    </h1>
                    <span class="text-[10px] md:text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">
                        Carlos Salazar Romero
                    </span>
                </div>
            </div>
        </a>
        <a href="{{ route('login') }}"
            class="group inline-flex items-center gap-2 px-5 py-2 text-sm font-bold uppercase tracking-wider text-sky-700 bg-sky-50/60 hover:bg-sky-100/80 rounded-xl border border-sky-200/60 hover:border-sky-300/80 shadow-sm shadow-sky-100/40 transition-all duration-200 ease-out">
            <span>Ingresar</span>
            <x-heroicon-s-arrow-right-on-rectangle
                class="w-4 h-4 text-sky-600/80 group-hover:text-sky-700 group-hover:translate-x-0.5 transition-all duration-200 ease-out" />
        </a>
    </header>

    <main class="flex-grow">
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>

    <footer class="bg-white border-t border-slate-200/60 py-6 mt-auto">
        <div
            class="max-w-[90rem] mx-auto px-6 text-center text-slate-400 font-medium text-xs uppercase tracking-widest">
            &copy; {{ date('Y') }} I.E.S.T.P "Carlos Salazar Romero"
        </div>
    </footer>

    @vite(['resources/js/tabs.js'])
</body>

</html>
