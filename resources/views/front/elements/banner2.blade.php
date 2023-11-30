@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.css">
@endpush

<section>
    <div class="relative hero">
        <!-- Slider -->
        <div id="banner-slider" class="hero-slider">
            @forelse ($banners as $banner)
                <div class="relative slide banner">
                    <img src="{{ $banner->thumbImageUrl }}" data-img="{{ $banner->largeImageUrl }}" class="block lazyload" alt="{{ $banner->name }}" width="1680" height="900">
                    <div class="absolute w-full py-4 text lg:py-6">
                        <div class="container">

                            @if ($banner->btn_link)
                                <div class="buttons">
                                    {{-- <a href="{{ route('front.trips.show', ['slug' => $banner->slug]) }}" class="btn btn-primary"> --}}
                                    <a href="{{ $banner->btn_link }}" class="btn btn-primary">
                                        View more
                                        <svg class="w-6 h-4">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}" />
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div><!-- Slider -->

        <div class="absolute bottom-0 -translate-x-1/2 left-1/2">
            <svg viewbox="0 0 40 6" class="h-12">
                <path d="M0 6 10 2 14 4 20 0 26 4 30 2 40 6 0 6" fill="#f0f0f0">
            </svg>
        </div>

        <div class="absolute left-0 right-0 bottom-8 w-full">
            <div class="max-w-5xl mx-auto px-4 mb-10">
                <h2 class="font-bold text-white text-3xl lg:text-6xl text-center">
                    <span>Find your next adventure</span>
                </h2>
            </div>
            <div class="max-w-2xl mx-auto px-4">

                <form action="{{ route('front.trips.search') }}" id="banner-search-from">
                    <div class="flex rounded-lg overflow-hidden">
                        <input id="banner-search" class="px-10 py-2 text-gray-700 placeholder-gray-500 bg-white border-0 focus:placeholder-transparent lg:text-lg w-full" type="text" name="keyword"
                            aria-label="Search site" style="min-width:0;">
                        <button class="px-4 py-3 lg:text-xl font-medium tracking-wider text-gray-100 rounded-md bg-accent hover:bg-blue-600 focus:bg-blue-600 focus:outline-none">
                            <svg class="w-6 h-6">
                                <title>Search</title>
                                <use xlink:href="https://www.naturetrail.com/assets/front/img/sprite.svg#search"></use>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- Hero -->
</section>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.js"></script>

    <script>
        const heroSlider = tns({
            mode: 'gallery',
            container: '.hero-slider',
            nav: false,
            // controlsContainer: '.hero-slider-controls .container',
            controls: false,
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true
        })
    </script>
@endpush
