<nav class="flex px-5 w-full py-3 bg-black/90 backdrop-blur-sm border-b border-white/10 shadow-lg"
    aria-label="Breadcrumb">
    <ol class="inline-flex items-center flex-wrap gap-1 md:gap-2">
        @foreach ($breadcrumbs as $index => $breadcrumb)
            <li class="inline-flex items-center">
                @if ($index < count($breadcrumbs) - 1)
                    <a href="{{ $breadcrumb->url }}"
                        class="inline-flex items-center text-sm md:text-base font-medium text-gray-300 hover:text-indigo-400 transition-colors duration-150">
                        @if ($index === 0)
                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                        @endif
                        {{ $breadcrumb->title }}
                    </a>
                @else
                    <span class="inline-flex items-center text-sm md:text-base font-semibold text-white">
                        @if ($index === 0)
                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                        @endif
                        {{ $breadcrumb->title }}
                    </span>
                @endif
            </li>

            @if ($index < count($breadcrumbs) - 1)
                <li class="text-gray-500">
                    <svg class="rtl:rotate-180 block w-3.5 h-3.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
