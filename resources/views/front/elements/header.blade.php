@push('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush


{{-- Header --}}
<header class="flex items-center w-full header fixed transition" x-data="{ mobilenavOpen: false, searchboxOpen: false }">
    <div class="container relative flex items-end justify-between w-full">
        <!-- Logo -->
        <a class="flex-shrink-0" href="{{ route('home') }}">
            <img src="{{ asset('assets/front/img/logo.png') }}" class="block h-16 brand" alt="{{ config('app.name') }}" width="318" height="197">
        </a><!-- Logo -->
        <div class="flex items-end gap-2">
            <!-- Nav -->
            @include('front.elements.navbar')
            
            {{-- Search --}}
            <button class="hidden lg:block p-2" @click="searchboxOpen=true;$refs.searchInput.focus()">
                <svg class="w-6 h-6 header-color">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#search"></use>
                </svg>
            </button>
            <div x-show="searchboxOpen" x-cloak class="absolute left-1/2 w-full max-w-5xl top-full" @click.away="searchboxOpen=false" style="transform: translateX(-50%)">
                <form action="{{ route('front.trips.search') }}" id="header-search-from">
                    <div class="flex border-2 rounded-lg bg-white">
                        <input id="header-search" x-ref="searchInput" class="flex-grow px-6 py-2 text-gray-700 placeholder-gray-500 bg-white border-0 focus:placeholder-transparent" type="text" name="keyword" placeholder="Search site" aria-label="Search site" style="box-shadow: none">
                        <button class="px-4 py-3 text-sm font-medium tracking-wider text-gray-100 rounded-md bg-primary hover:bg-blue-600">
                            <svg class="w-6 h-6 text-white">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#arrownarrowright"></use>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            {{-- Search --}}
            
            {{-- Talk to expert --}}
            <div class="hidden lg:flex items-center gap-2 header-color">
                <a href="{{ Setting::get('whatsapp') ?? '' }}" class="flex items-baseline header-color gap-1">
                    <svg class="w-6 h-6" style="color:#28d146">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#whatsapp" />
                    </svg>
                </a>
                <div class="header-color text-right">
                    Talk to an expert
                    <a href="{{ Setting::get('whatsapp') ?? '' }}" class="flex items-baseline header-color gap-1">
                        <div class="font-bold">{{ Setting::get('mobile1') ?? '' }}</div>
                    </a>
                </div>
            </div>{{-- Talk to expert --}}

            {{-- Mobile Nav Button --}}
            <div class="lg:none">
                <button class="p-2" @click="mobilenavOpen=!mobilenavOpen">
                    <svg class="w-6 h-6 header-color" x-show="!mobilenavOpen">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#menu" />
                    </svg>
                    <svg class="w-6 h-6" x-cloak x-show="mobilenavOpen">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#x" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>{{-- Header --}}
@push('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('assets/js/search-trips.js') }}"></script>
@endpush
