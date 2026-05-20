<nav class="flex px-4 sm:px-5 w-full py-2.5 bg-black/90 backdrop-blur-sm border-b border-white/10 shadow-lg"
    aria-label="Breadcrumb">
    <ol class="inline-flex items-center flex-wrap gap-1 md:gap-2">
        @foreach ($breadcrumbs as $index => $breadcrumb)
            <li class="inline-flex items-center">
                @if ($index < count($breadcrumbs) - 1)
                    <a href="{{ $breadcrumb->url }}"
                        class="group inline-flex items-center text-sm md:text-base font-medium text-gray-300 hover:text-indigo-400 transition-all duration-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400/50">
                        @if ($index === 0)
                            <x-heroicon-s-home class="w-4 h-4 mr-1.5 transition-transform group-hover:scale-105" />
                        @endif
                        <span class="line-clamp-1 max-w-[150px] sm:max-w-[200px] md:max-w-none">
                            {{ $breadcrumb->title }}
                        </span>
                    </a>
                @else
                    <span class="inline-flex items-center text-sm md:text-base font-semibold text-white cursor-default">
                        @if ($index === 0)
                            <x-heroicon-s-home class="w-4 h-4 mr-1.5" />
                        @endif
                        <span class="line-clamp-1 max-w-[200px] sm:max-w-[300px] md:max-w-none">
                            {{ $breadcrumb->title }}
                        </span>
                    </span>
                @endif
            </li>

            @if ($index < count($breadcrumbs) - 1)
                <li class="text-gray-500" aria-hidden="true">
                    <x-heroicon-s-chevron-right class="w-3.5 h-3.5" />
                </li>
            @endif
        @endforeach
    </ol>
</nav>
