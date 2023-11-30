@extends('layouts.front')
@section('content')
    <!-- Slider -->
    @include('front.elements.banner2')

    <div class="bg-gray py-10 lg:py-20">
        <div class="container">
            <div class="flex justify-center mb-4">
                <h2 class="relative px-10 text-3xl font-bold text-gray-600 uppercase lg:text-3xl font-display">
                    Reviews
                    <div class="absolute left-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                    <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                </h2>
            </div>
            <div class="text-xl text-center mb-8">
                <div class="mb-2">
                    <svg class="h-6 text-accent" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 80 16" fill="none">
                        <clipPath id="stars">
                            <path
                                d="m2.864 14.354.001-.002.83-4.728L.172 6.268c-.329-.314-.158-.888.283-.95l4.898-.696L7.537.294a.512.512 0 0 1 .927 0l2.184 4.327 4.898.696c.442.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592l-4.389-2.256-4.39 2.256c-.386.197-.823-.148-.747-.591Zm16.001 0v-.002l.83-4.728-3.523-3.356c-.329-.314-.158-.888.283-.95l4.898-.696L23.537.294a.514.514 0 0 1 .927 0l2.184 4.327 4.898.696c.442.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592l-4.389-2.256-4.39 2.256c-.385.197-.823-.148-.746-.591Zm16 0v-.002l.83-4.728-3.523-3.356c-.329-.314-.158-.888.283-.95l4.898-.696L39.537.294a.513.513 0 0 1 .927 0l2.184 4.327 4.898.696c.442.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592l-4.389-2.256-4.39 2.256c-.385.197-.822-.148-.746-.591Zm16 0 .001-.002.83-4.728-3.523-3.356c-.329-.314-.158-.888.283-.95l4.898-.696L55.538.294a.512.512 0 0 1 .927 0l2.184 4.327 4.898.696c.442.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592l-4.389-2.256-4.39 2.256c-.386.197-.823-.148-.747-.591Zm16.001 0v-.002l.83-4.728-3.523-3.356c-.329-.314-.158-.888.283-.95l4.898-.696L71.538.294a.514.514 0 0 1 .927 0l2.184 4.327 4.898.696c.442.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592l-4.389-2.256-4.39 2.256c-.386.197-.823-.148-.746-.591Z" />
                        </clipPath>
                        <rect id="fill" x="0" y="0" width="{{ ($avg_rating / 5) * 80 }}" height="16" />
                        <path
                            d="m2.864 14.354.001-.002.83-4.728L.172 6.268c-.329-.314-.158-.888.283-.95l4.898-.696L7.537.294a.512.512 0 0 1 .927 0l2.184 4.327 4.898.696c.442.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592l-4.389-2.256-4.39 2.256c-.386.197-.823-.148-.747-.591Zm16.001 0v-.002l.83-4.728-3.523-3.356c-.329-.314-.158-.888.283-.95l4.898-.696L23.537.294a.514.514 0 0 1 .927 0l2.184 4.327 4.898.696c.442.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592l-4.389-2.256-4.39 2.256c-.385.197-.823-.148-.746-.591Zm16 0v-.002l.83-4.728-3.523-3.356c-.329-.314-.158-.888.283-.95l4.898-.696L39.537.294a.513.513 0 0 1 .927 0l2.184 4.327 4.898.696c.442.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592l-4.389-2.256-4.39 2.256c-.385.197-.822-.148-.746-.591Zm16 0 .001-.002.83-4.728-3.523-3.356c-.329-.314-.158-.888.283-.95l4.898-.696L55.538.294a.512.512 0 0 1 .927 0l2.184 4.327 4.898.696c.442.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592l-4.389-2.256-4.39 2.256c-.386.197-.823-.148-.747-.591Zm16.001 0v-.002l.83-4.728-3.523-3.356c-.329-.314-.158-.888.283-.95l4.898-.696L71.538.294a.514.514 0 0 1 .927 0l2.184 4.327 4.898.696c.442.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592l-4.389-2.256-4.39 2.256c-.386.197-.823-.148-.746-.591Z"
                            stroke="currentColor" stroke-width="1" />
                        <use clip-path="url(#stars)" href="#fill" fill="currentColor">
                    </svg>
                </div>

                {{ $avg_rating }} out of 5 ({{ $review_count }} reviews)
            </div>

            <div class="overflow-x-auto">
                <div class="flex lg:grid grid-cols-3 gap-6 mb-8">
                    @foreach ($reviews as $review)
                        <div class="p-6 bg-white rounded-lg review basis-72 flex-grow flex-shrink-0">
                            <div class="review__content">
                                <h3 class="mb-4 text-2xl font-display">{{ $review->title }}</h3>
                                <p>{{ $review->review }}</p>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        <img src="{{ $review->thumbImageUrl }}" alt="" class="flex-shrink-0">
                                    </div>
                                    <div>
                                        <div class="font-bold">{{ ucfirst($review->review_name) }}</div>
                                        <div class="text-sm text-gray">{{ $review->review_country }}</div>
                                        @for ($i = 0; $i < 5; $i++)
                                            <svg class="w-5 h-5 text-accent">
                                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#star" />
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="hidden lg:block w-10 h-10 text-light" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM7.194 6.766a1.688 1.688 0 0 0-.227-.272 1.467 1.467 0 0 0-.469-.324l-.008-.004A1.785 1.785 0 0 0 5.734 6C4.776 6 4 6.746 4 7.667c0 .92.776 1.666 1.734 1.666.343 0 .662-.095.931-.26-.137.389-.39.804-.81 1.22a.405.405 0 0 0 .011.59c.173.16.447.155.614-.01 1.334-1.329 1.37-2.758.941-3.706a2.461 2.461 0 0 0-.227-.4zM11 9.073c-.136.389-.39.804-.81 1.22a.405.405 0 0 0 .012.59c.172.16.446.155.613-.01 1.334-1.329 1.37-2.758.942-3.706a2.466 2.466 0 0 0-.228-.4 1.686 1.686 0 0 0-.227-.273 1.466 1.466 0 0 0-.469-.324l-.008-.004A1.785 1.785 0 0 0 10.07 6c-.957 0-1.734.746-1.734 1.667 0 .92.777 1.666 1.734 1.666.343 0 .662-.095.931-.26z" />
                                </svg>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('front.reviews.index') }}" class="btn btn-primary">
                    More reviews
                    <svg class="w-6 h-6 text-white">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    {{-- About --}}
    <div class="py-10 lg:py-20">
        <div class="container">
            <div>
                <div class="lg:col-span-6">

                    <div class="mb-4">
                        <p class="mb-2 text-2xl text-center font-handwriting text-primary">Why Nature Trail?</p>

                        <div class="flex justify-center mb-8">
                            <h1 class="relative px-10 text-3xl font-bold text-gray-600 text-center uppercase lg:text-3xl font-display">
                                {{ Setting::get('homePage')['welcome']['title'] ?? '' }}
                                <div class="absolute left-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                                <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                            </h1>
                        </div>
                    </div>

                    <div class="mb-8"><?= Setting::get('homePage')['welcome']['content'] ?? '' ?></div>

                    <div class="mb-4 grid lg:grid-cols-3 gap-4">
                        <div class="flex gap-4">
                            <img src="{{ asset('assets/front/img/experience.webp') }}" class="flex-shrink-0 w-24 h-24" alt="">
                            <div>
                                <h2 class="font-bold">28+ Years of Expertise</h2>
                                <p>Experience excellence with our unparalleled 25+ years of expertise in the travel industry</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <img src="{{ asset('assets/front/img/best-price.webp') }}" class="flex-shrink-0 w-24 h-24" alt="">
                            <div>
                                <h2 class="font-bold">Best Price Guarantee </h2>
                                <p>Experience peace of mind knowing you're getting the best prices with our unbeatable Best Price Guarantee.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <img src="{{ asset('assets/front/img/tailor-made.webp') }}" class="flex-shrink-0 w-24 h-24" alt="">
                            <div>
                                <h2 class="font-bold">Tailor-made Trip</h2>
                                <p>Most of the trips we organize are tailor-made to fit your taste and interests.</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="{{ url('/about-us') }}" class="btn btn-primary">
                            Read more
                            <svg class="w-6 h-6 text-white">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- About --}}

    {{-- Activities --}}
    <div class="py-10 lg:py-20 bg-gray activities">
        <div class="container">
            <div class="items-center justify-between gap-20 mb-4 lg:flex">
                <div>
                    <p class="mb-2 text-2xl font-handwriting text-primary text-center lg:text-left">Choose your activity</p>
                    <div class="flex justify-center">
                        <h2 class="relative pl-10 lg:pl-0 pr-10 mb-8 text-3xl font-bold text-gray-600 uppercase lg:text-5xl font-display">
                            Things To Do
                            <div class="lg:hidden absolute left-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                            <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                        </h2>
                    </div>
                </div>
                <div class="flex justify-end gap-4 activities-slider-controls">
                    <button class="p-2 rounded-lg bg-light">
                        <svg class="w-6 h-6 text-accent">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowleft') }}" />
                        </svg>
                    </button>
                    <button class="p-2 rounded-lg bg-light">
                        <svg class="w-6 h-6 text-accent">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="activities-slider">

                @foreach ($activities as $activity)
                    <div>
                        @include('front.elements.activity-card', ['activity' => $activity])
                    </div>
                @endforeach
            </div>
        </div>
    </div>{{-- Activities --}}


    <!-- Destinations -->
    <div class="py-10 lg:py-20 destinations">
        <div class="container">
            <div class="mb-4">
                <p class="mb-2 text-2xl text-center font-handwriting text-primary">Where do you want to go?</p>
                <div class="flex justify-center mb-10">
                    <h2 class="relative px-10 text-3xl font-bold text-center text-gray-600 uppercase lg:text-5xl font-display">
                        AWESOME DESTINATIONS
                        <div class="absolute left-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                        <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                    </h2>
                </div>
            </div>
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                @forelse ($destinations as $destination)
                    @include('front.elements.destination_card', ['destination' => $destination])
                @empty
                @endforelse
            </div>
        </div>
    </div><!-- Destinations -->

    <!-- Popular right now -->
    <div class="py-10 lg:py-20 featured bg-gray">
        <div class="container">

            <div class="flex justify-center">
                <div>
                    <p class="mb-2 text-2xl text-center text-primary font-handwriting">Most travelers prefer to explore</p>
                    <h2 class="relative px-10 mb-16 text-3xl font-bold text-center text-gray-600 uppercase lg:text-5xl font-display">
                        {{ Setting::get('homePage')['trip_block_2']['title'] ?? '' }}
                        <div class="absolute left-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                        <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                    </h2>
                </div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse ($block_2_trips as $block_2_tour)
                    @include('front.elements.tour-card', ['tour' => $block_2_tour])
                @empty
                @endforelse
            </div>
        </div>
    </div> <!-- Popular right now -->


    <!-- Trip of the month -->
    <div class="py-10 lg:py-20">
        <div class="container">

            <p class="mb-2 text-2xl font-handwriting text-primary">This doesn't get any better</p>

            <div class="md:flex justify-between gap-10 mb-10">

                <div class="flex">
                    <h2 class="relative pr-10 text-3xl font-bold uppercase lg:text-5xl font-display">
                        {{ Setting::get('homePage')['trip_block_3']['title'] ?? '' }}
                        <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                    </h2>
                </div>

                <div class="flex justify-end gap-4 trips-month-slider-controls">
                    <button class="p-2 rounded-lg bg-light">
                        <svg class="w-6 h-6 text-accent">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowleft') }}" />
                        </svg>
                    </button>
                    <button class="p-2 rounded-lg bg-light">
                        <svg class="w-6 h-6 text-accent">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="trips-month-slider">
                @forelse ($block_3_trips as $block3tour)
                    @include('front.elements.tour_card_slider', ['tour' => $block3tour])
                @empty
                @endforelse
            </div>
        </div>
    </div>

    {{--
    <!-- Departure Dates -->
    <div class="py-10 departure-dates">
        <div class="container">
            <div class="items-center justify-between mb-4 lg:flex">
                <div>
                    <h1 class="text-4xl uppercase lg:text-5xl font-display text-primary">Upcoming Departures
                    </h1>
                    <div class="mb-6 underline bg-accent"></div>
                </div>

                <form id="filter-trip-departure-form" action="" method="GET">
                    <div class="form-group">
                        <select name="month" id="select-trip-departure-filter" class="bg-gray">
                            <option selected disabled>Choose Month & Year</option>
                            @php
                                $current_date = \Carbon\Carbon::now();
                            @endphp
                            <option value="{{ $current_date->format('n') }}">{{ $current_date->format('M Y') }}</option>
                            @for ($i = 0; $i < 3; $i++)
                                @php
                                    $current_date->add('1 month')->format('M Y');
                                @endphp
                                <option value="{{ $current_date->format('n') }}">{{ $current_date->format('M Y') }}</option>
                            @endfor
                        </select>
                    </div>
                </form>
            </div>
            <div id="departure-card-block" class="grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-5">
                @forelse ($departures as $departure)
                    @include('front.elements.tour_departure_card', $departure)
                @empty
                @endforelse
            </div>
        </div>
    </div><!-- Departure Dates -->

--}}

    {{-- Why Travel with us --}}
    {{--
    <div class="py-10 lg:py-20 text-white bg-primary">
        <div class="container grid lg:grid-cols-3 ">
            <div class="col-span-2 p-10">
                <h1 class="mb-2 text-4xl text-white uppercase lg:text-5xl font-display">Why Travel With Us</h1>
                <div class="mb-6 underline bg-accent"></div>
                <ul class="list-style columns">
                    <li class="flex mb-2"><svg class="flex-shrink-0 w-6 h-6 mr-2 text-accent" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>25 years of experience in the trekking industry
                    </li>
                    <li class="flex mb-2"><svg class="flex-shrink-0 w-6 h-6 mr-2 text-accent" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>Affordable price on all tour trips without cutting corners in our excellent services.</li>
                    <li class="flex mb-2"><svg class="flex-shrink-0 w-6 h-6 mr-2 text-accent" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>Dedicated, hardworking qualified guides and staff.</li>
                    <li class="flex mb-2"><svg class="flex-shrink-0 w-6 h-6 mr-2 text-accent" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>Our company offers customizable itineraries, allowing clients to tailor their trekking experience to their interests, fitness level and schedule</li>
                 
                    <li class="flex mb-2"><svg class="flex-shrink-0 w-6 h-6 mr-2 text-accent" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>Providing top-notch equipment and gear for all trekkers ensures the safety and comfort of our clients on their journey.</li>
                    <li class="flex mb-2"><svg class="flex-shrink-0 w-6 h-6 mr-2 text-accent" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>Providing full information and details of every trip chosen from our brochure or websites.</li>
                      <li class="flex mb-2"><svg class="flex-shrink-0 w-6 h-6 mr-2 text-accent" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>Good-condition vehicles for easy and smooth transportation according to the size of a group.</li>
                      <li class="flex mb-2"><svg class="flex-shrink-0 w-6 h-6 mr-2 text-accent" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>Using the best hotels in Kathmandu, Pokhara, and Nepalgunj, including local lodges on treks as per the itineraries.</li>
                      <li class="flex mb-2"><svg class="flex-shrink-0 w-6 h-6 mr-2 text-accent" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>The Company takes good care, of the welfare of staff, guides, and porters with good wages, health / medical care, and insurance for all field staff on all our trips.</li>
                      <li class="flex mb-2"><svg class="flex-shrink-0 w-6 h-6 mr-2 text-accent" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>Providing 24/7 support for clients during their trek</li>
                </ul>
            </div>
            <div class="p-10">
               
            </div>
        </div>
    </div>
    --}}{{-- Why Travel with us --}}

    <!-- Blog -->
    <div class="py-10 lg:py-20 blog bg-gray">
        <div class="container">

            <div class="flex justify-center">
                <h2 class="relative px-10 mb-16 text-3xl font-bold text-center text-gray-600 uppercase lg:text-5xl font-display">
                    Latest travel blog
                    <div class="absolute left-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                    <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                </h2>
            </div>

            <div class="grid gap-2 lg:grid-cols-3 lg:gap-6">
                @forelse ($blogs as $blog)
                    @include('front.elements.blog-card')
                @empty
                @endforelse
            </div>
            <div class="text-center">
                <a href="{{ route('front.blogs.index') }}" class="btn btn-primary">More blog
                    <svg class="w-6 h-6">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}" />
                    </svg>
                </a>
            </div>
        </div>
    </div><!-- Blog -->



    @include('front.elements.plan_trip')

    {{-- @include('front.elements.search_widget') --}}
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#select-trip-departure-filter").on('change', function(event) {
                event.preventDefault();
                let url = "{!! route('front.trip-departures.filter') !!}";
                let e = $(this);
                let month = e.children("option:selected").val();

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        month: month
                    },
                    async: false,
                    success: function(response) {
                        if (response.data != "") {
                            $("#departure-card-block").html(response.data);
                        } else {
                            $("#departure-card-block").html('No data to show.');
                        }
                    }
                });
            });

            $("#banner-slider>.slide").each(function(i, v) {
                let img = new Image();
                let image_src = $(v).find('img').data('img');
                img.onload = function() {
                    $(v).find('img').attr('src', image_src);
                }
                img.src = image_src;
                if (img.complete) img.onload();
            });

            const activitiesSlider = tns({
                container: '.activities-slider',
                nav: false,
                controlsContainer: '.activities-slider-controls',
                items: 2,
                gutter: 16,
                rewind: true,
                responsive: {
                    768: {
                        items: 3
                    },
                    992: {
                        items: 5
                    }
                }
            })

            const monthSlider = tns({
                container: '.trips-month-slider',
                nav: false,
                controlsContainer: '.trips-month-slider-controls',
                autoplay: true,
                autoplayButtonOutput: false,
                autoplayHoverPause: true
            })
        });
    </script>
@endpush
