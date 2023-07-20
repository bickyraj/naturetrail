@extends('layouts.front')
@section('content')
    <!-- Slider -->
    @include('front.elements.banner')

     <!-- About and reviews-->
    <div class="py-10 bg-gray">
        <div class="container">
            <div class="grid gap-10 lg:grid-cols-11">
                <div class="lg:col-span-6">

                    <div class="mb-4">
                        <p class="mb-2 text-2xl text-center font-handwriting text-primary">About Us</p>
                    <div class="flex justify-center mb-8">
                        <h2 class="relative px-10 text-3xl font-bold text-gray-600 uppercase lg:text-3xl font-display">
                            {{ Setting::get('homePage')['welcome']['title'] ?? '' }}
                            <div class="absolute left-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                            <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                        </h2>
                    </div>
                </div>
    
                    <?= Setting::get('homePage')['welcome']['content'] ?? '' ?>

                   <div class="grid gap-4 lg:grid-cols-2">
                        <div class="flex">
                             <svg class="flex-shrink-0 w-10 h-10 mr-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M256 40a10 10 0 00-1 20 10 10 0 101-20z" />
                                <path fill="currentColor"
                                    d="M456 60a50 50 0 01-50-50 10 10 0 00-10-10H116a10 10 0 00-10 10 50 50 0 01-50 50 10 10 0 00-10 10v163.2a290.5 290.5 0 00207.1 278.4 10 10 0 005.8 0A290.5 290.5 0 00466 233.2V70a10 10 0 00-10-10zm-10 173.2a269 269 0 01-190 258.3A270.4 270.4 0 0166 233.2v-154A70.2 70.2 0 00125.3 20h261.4A70.2 70.2 0 00446 79.3v153.9z" />
                                <path fill="currentColor"
                                    d="M420 92.5A90 90 0 01373.5 46a10 10 0 00-9.1-6H296a10 10 0 000 20h62a110 110 0 0048 48v125.2c0 97.9-58.7 182.3-150 216a227.8 227.8 0 01-150-216V108a110 110 0 0048-48h62a10 10 0 000-20h-68.3a10 10 0 00-9.2 6A90 90 0 0192 92.5a10 10 0 00-6 9.2v131.5a249 249 0 00166.7 236.2 10 10 0 006.6 0A249 249 0 00426 233.2V101.7c0-4-2.4-7.6-6-9.2z" />
                                <path fill="currentColor" d="M256 146a90.1 90.1 0 000 180 90.1 90.1 0 000-180zm0 160a70 70 0 11.2-140.2A70 70 0 01256 306z" />
                                <path fill="currentColor" d="M303 209a10 10 0 00-14 0l-43 42.9-13-13a10 10 0 00-14 14.2l20 20c1.9 2 4.4 2.9 7 2.9s5.1-1 7-3l50-50a10 10 0 000-14z" />
                            </svg>
                            <div>
                                <h2 class="font-bold">+25yrs’ of Expertise, best offers</h2>
                                <p>Nature Trail holding almost 2 decades of experiences in tourism. Also since its’s establishment.</p>
                            </div>
                        </div>
                        <div class="flex">
                            <svg class="flex-shrink-0 w-10 h-10 mr-4 text-primary" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                <path fill="currentColor"
                                    d="M437.1 0H74.9A75 75 0 000 74.9v290.3a7.5 7.5 0 1015 0V75A60 60 0 0174.9 15h362.2A60 60 0 01497 74.9v362.2a60 60 0 01-59.9 59.9H74.9A60 60 0 0115 437.1v-41.9a7.5 7.5 0 10-15 0v41.9A75 75 0 0074.9 512h362.2a75 75 0 0074.9-74.9V74.9A75 75 0 00437.1 0z" />
                                <path fill="currentColor"
                                    d="M103.3 69.6a35 35 0 00-35 35v17.7h-1.6a37 37 0 000 74h1.6v211.1a35 35 0 0070 0V196.3h1.6a37 37 0 000-74h-1.6v-17.7a35 35 0 00-35-35zm-20 35a20 20 0 0140 0v17.7h-40v-17.7zm40 302.8a20 20 0 01-40 0V196.3h40v211.1zm38.6-248.1a22 22 0 01-22 22H66.7a22 22 0 010-44H140a22 22 0 0122 22zM280.7 79.9a35 35 0 00-59.7 24.7V289h-1.6a37 37 0 000 74h1.6v44.4a35 35 0 0070 0V363h1.6a37 37 0 000-74H291V104.6c0-9.3-3.7-18.1-10.3-24.7zM236 104.6a20 20 0 0140 0V289h-40zm40 302.8a20 20 0 01-40 0V363h40v44.4zm38.6-81.4a22 22 0 01-22 22h-73.2a22 22 0 010-44h73.2a22 22 0 0122 22zM436.2 132.4c4.1 0 7.5-3.4 7.5-7.5v-20.3a35 35 0 00-70 0V195h-1.6a37 37 0 000 74h1.6v138.3a35 35 0 0070 0V269.1h1.6a37 37 0 000-74h-1.6v-40.2a7.5 7.5 0 10-15 0V195h-40v-90.5a20 20 0 0140 0v20.3c0 4.1 3.3 7.5 7.5 7.5zm-7.5 275a20 20 0 01-40 0V269.1h40v138.3zm38.6-175.3a22 22 0 01-22 22H372a22 22 0 010-44h73.2a22 22 0 0122 22z" />
                            </svg>
                            <div>
                                <h2 class="font-bold">Excellent services, reasonable Price</h2>
                                <p>We at Nature Trail, provide wide varieties of activities with quality services in best price</p>
                            </div>
                        </div>
                        <div class="flex">
                            <svg class="flex-shrink-0 w-10 h-10 mr-4 text-primary" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                <path fill="currentColor"
                                    d="M398.6 449.2a7.5 7.5 0 00-10.6.7l-30.9 35.4c-3.3 3.7-7.8 5.9-12.8 6-5 .2-9.6-1.6-13.2-5.2l-23.8-23.8v-15.7a7.5 7.5 0 10-15 0V504.5a7.5 7.5 0 1015 0v-21l13.2 13.3a33 33 0 0048-1.7l30.8-35.3a7.5 7.5 0 00-.7-10.6zM87.1 439a7.5 7.5 0 00-7.5 7.5v57.9a7.5 7.5 0 1015 0v-58c0-4-3.3-7.4-7.5-7.4zm415.4-320.2l-50.3-40.8a11.4 11.4 0 00-12.2-1.5c-4 2-6.5 5.9-6.5 10.4V305L358 391.2l-24-44.7a78.8 78.8 0 00-56.3-40.3l-41.2-6.7c-6.2-1-10.7-6.3-10.7-12.6V278a93.7 93.7 0 0043.6-78.9V196h3a27.8 27.8 0 0027.4-27.5c0-7.9-3.5-15.2-9.1-20.3a23.8 23.8 0 00-9.7-35.5l-2.4-1v-54A57.6 57.6 0 00221.1 0h-89.5a57.6 57.6 0 00-57.5 57.5v54l-2.4 1a23.8 23.8 0 00-9.7 35.6 27.6 27.6 0 00-9 20.3A27.7 27.7 0 0080.3 196h2.9v3.2a93.1 93.1 0 0043.6 78.9v10.4c0 5.8-4 10.8-9.5 12.1L55 316a67.4 67.4 0 00-51.4 65.5v123.1a7.5 7.5 0 1015 0v-123a52.4 52.4 0 0140-51l48.2-12a81.7 81.7 0 00140.2-2.1l28.1 4.6a63.7 63.7 0 0145.6 32.6l24.2 45.2a14.6 14.6 0 0023.8 2.7l51.4-58.5 32.6 32.6h.1l-41.8 48a7.5 7.5 0 0011.3 9.8l69-78.9a38 38 0 00-42.9-60.4V187l54-44a15.5 15.5 0 000-24.1zm-217.7 49.5c0 6.8-5.7 12.5-12.5 12.5h-2.9V158c2.9.2 5.7 0 8.4-.9 4.2 2.1 7 6.4 7 11.2zM83.3 181h-3c-6.7 0-12.4-5.7-12.4-12.5 0-4.8 2.8-9 7-11.2a24 24 0 008.4 1v22.7zm1.8-38.5a9 9 0 01-11.5-4 8.8 8.8 0 014.2-12.1A242.8 242.8 0 01209 107.6a7.5 7.5 0 002-14.9 257.8 257.8 0 00-122 12.9v-48C89 34 108 15 131.6 15h89.5c23.5 0 42.5 19 42.5 42.5v48c-5.7-2-11.5-3.8-17.4-5.5a7.5 7.5 0 00-4 14.5c11.1 3 22.1 7 32.7 11.8 4.5 2 6.5 7.6 4.2 12a9 9 0 01-11.5 4.1 231.6 231.6 0 00-182.5 0zm13.2 56.7v-45.9c50-20 106.1-20 156.2 0v46c0 20.8-8.2 40.4-23 55.2a78.2 78.2 0 01-133.3-55.2zm78 143a66.7 66.7 0 01-54-27.4 28 28 0 0019.6-29 92.6 92.6 0 0069 0c-.8 12.9 8 24.6 20.2 27.9a66.4 66.4 0 01-54.7 28.5zm300.8-30.6c10 8 11.5 23.5 3 33.2l-17.3 19.7-32.7-32.8 15.3-17.3a23 23 0 0131.7-2.8zm16-180l-44.6 36.1V94.3l44.5 36.2c.3.2.3.8 0 1zm-275.4 62c4 0 7.5-3.4 7.5-7.5v-16.6a7.5 7.5 0 10-15 0V186c0 4.1 3.3 7.5 7.5 7.5zM135 161.9a7.5 7.5 0 00-7.5 7.5V186a7.5 7.5 0 1015 0v-16.6c0-4.1-3.4-7.5-7.5-7.5zm64.3 68.9c-2-3.7-6.5-5-10.1-3a27 27 0 01-25.9 0 7.5 7.5 0 10-7.2 13.1 42 42 0 0040.3 0c3.6-2 5-6.5 3-10.1z" />
                            </svg>
                            <div>
                                <h2 class="font-bold">Best fit for your tastes</h2>
                                <p>Most of the tours we organize are tailor-made, that fits your test and interest…</p>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="flex flex-col gap-6 lg:col-span-5">
                    @forelse ($reviews as $review)
                        <div class="p-6 bg-white rounded-lg review">
                            <div class="review__content">
                                <h2 class="mb-4 text-2xl font-display text-primary">{{ $review->title }}</h2>
                                <p>{{ $review->review }}</p>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        <img src="{{ $review->thumbImageUrl }}" alt="">
                                    </div>
                                    <div>
                                        <div class="font-bold">{{ ucfirst($review->review_name) }}</div>
                                        <div class="text-sm text-gray">{{ $review->review_country }}</div>
                                        @for ($i = 0; $i < 5; $i++)
                                            <svg class="w-4 h-4 text-accent">
                                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#star" />
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-10 h-10 text-light" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM7.194 6.766a1.688 1.688 0 0 0-.227-.272 1.467 1.467 0 0 0-.469-.324l-.008-.004A1.785 1.785 0 0 0 5.734 6C4.776 6 4 6.746 4 7.667c0 .92.776 1.666 1.734 1.666.343 0 .662-.095.931-.26-.137.389-.39.804-.81 1.22a.405.405 0 0 0 .011.59c.173.16.447.155.614-.01 1.334-1.329 1.37-2.758.941-3.706a2.461 2.461 0 0 0-.227-.4zM11 9.073c-.136.389-.39.804-.81 1.22a.405.405 0 0 0 .012.59c.172.16.446.155.613-.01 1.334-1.329 1.37-2.758.942-3.706a2.466 2.466 0 0 0-.228-.4 1.686 1.686 0 0 0-.227-.273 1.466 1.466 0 0 0-.469-.324l-.008-.004A1.785 1.785 0 0 0 10.07 6c-.957 0-1.734.746-1.734 1.667 0 .92.777 1.666 1.734 1.666.343 0 .662-.095.931-.26z" />
                                </svg>
                            </div>
                        </div>
                    @empty
                    @endforelse
                    
                    <a href="{{ route('front.reviews.index') }}" class="text-accent">
                        View all
                        <svg class="w-4 h-4">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#chevronright') }}" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- About -->
    
    {{-- Activities --}}
    <div class="py-10 activities">
        <div class="container">
             <div class="items-center justify-between gap-20 mb-4 lg:flex">
                <div>
                    <p class="mb-2 text-2xl font-handwriting text-primary">Choose your activity</p>
                    <div class="flex">
                        <h2 class="relative pr-10 mb-8 text-3xl font-bold text-gray-600 uppercase lg:text-5xl font-display">
                            Things To Do
                            <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                        </h2>
                    </div>
                </div>
                <div class="flex gap-10 activities-slider-controls">
                    <button>
                        <svg class="w-6 h-6 text-accent">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowleft') }}" />
                        </svg>
                    </button>
                    <button>
                        <svg class="w-6 h-6 text-accent">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="activities-slider">

                @foreach ($activities as $activity)
                    @include('front.elements.activity-card', ['activity' => $activity])
                @endforeach
            </div>
        </div>
    </div>{{-- Activities --}}


     <!-- Destinations -->
    <div class="py-10 destinations">
        <div class="container">
            <div class="mb-4">
                <p class="mb-2 text-2xl text-center font-handwriting text-primary">Where do you want to go?</p>
            <div class="flex justify-center mb-10">
                <h2 class="relative px-10 text-3xl font-bold text-gray-600 uppercase lg:text-5xl font-display">
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
    <div class="py-10 featured bg-gray">
        <div class="container">

            <div class="flex justify-center">
                <div>
                    <p class="mb-2 text-2xl text-center text-primary font-handwriting">The best of what we offer</p>
                    <h2 class="relative px-10 mb-16 text-3xl font-bold text-center text-gray-600 uppercase lg:text-5xl font-display">
                        {{ Setting::get('homePage')['trip_block_2']['title'] ?? '' }}
                        <div class="absolute left-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                        <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                    </h2>
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3 md:gap-8">

                @forelse ($block_2_trips as $block_2_tour)
                    @include('front.elements.tour-card', ['tour' => $block_2_tour])
                @empty
                @endforelse
            </div>
        </div>
    </div> <!-- Popular right now -->


    <!-- Trip of the month -->
    <div class="py-10 text-white bg-primary">
        <div class="container">
        
         <p class="mb-2 text-2xl text-white font-handwriting">This doesn't get any better</p>

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
    <div class="py-20 text-white bg-primary">
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
    <div class="py-20 blog bg-gray">
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
                    <a href="{{ route('front.blogs.show', $blog->slug) }}">
                        <div class="article">
                            <div class="image">
                                <img src="{{ $blog->imageUrl }}" alt="">
                            </div>
                            <div class="content">
                                <h2>{{ $blog->name }}</h2>
                                <div class="flex items-center text-xs text-gray"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ formatDate($blog->blog_date) }}
                                </div>
                                <p class="text-sm">
                                    {{ truncate(strip_tags($blog->description)) }}
                                </p>
                            </div>
                        </div>
                    </a>
                    
                @empty
                @endforelse
            </div>
            <a href="https://www.naturetrail.com/blogs" class="theme">Go to blog
                <svg>
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg#arrownarrowright') }}" />
                </svg>
            </a>
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
                autoplayButtonOutput: false
            })
        });
    </script>
@endpush
