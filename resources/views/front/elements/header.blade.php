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
            <div x-show="searchboxOpen" class="absolute right-0 top-full" @click.away="searchboxOpen=false">
                <form action="">
                    <div class="flex border-2 rounded-lg bg-white">
                        <input x-ref="searchInput" class="px-6 py-2 text-gray-700 placeholder-gray-500 bg-white border-0 focus:placeholder-transparent" type="text" name="email" placeholder="Search site" aria-label="Search site" style="box-shadow: none">
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
            <div class="hidden lg:block">
                <div class="flex items-center justify-end gap-1 header-color">
                    <span class="text-xs">Talk to an expert</span>
                    <a href="{{ Setting::get('viber') ?? '' }}" style="color:#d766ff">
                        <svg class="w-5 h-5">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#viber" />
                        </svg>
                    </a>
                    <a href="{{ Setting::get('whatsapp') ?? '' }}" style="color:#28d146">
                        <svg class="w-5 h-5">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#whatsapp" />
                        </svg>
                    </a>
                </div>
                <div>
                    <a href="tel:{{ Setting::get('mobile1') ?? '' }}" class="flex items-center header-color">
                        <svg class="w-4 h-4">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#phone" />
                        </svg>
                        <div>{{ Setting::get('mobile1') ?? '' }}</div>
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
    {{--<script src="{{ asset('assets/js/search-trips.js') }}"></script>--}}
@endpush
