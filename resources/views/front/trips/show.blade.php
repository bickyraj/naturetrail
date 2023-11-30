<?php
$mapImageUrl = $trip->mapImageUrl;
if (session()->has('success_message')) {
    $session_success_message = session('success_message');
    session()->forget('success_message');
}

if (session()->has('error_message')) {
    $session_error_message = session('error_message');
    session()->forget('error_message');
}
?>
@extends('layouts.front_inner')
@section('meta_og_title'){!! $trip->trip_seo->meta_title ?? '' !!}@stop
@section('meta_description'){!! $trip->trip_seo->meta_description ?? '' !!}@stop
@section('meta_keywords'){!! $trip->trip_seo->meta_keywords ?? '' !!}@stop
@section('meta_og_url'){!! $trip->trip_seo->canonical_url ?? '' !!}@stop
@section('meta_og_description'){!! $trip->trip_seo->meta_description ?? '' !!}@stop
@section('meta_og_image'){!! $trip->trip_seo->ogImageUrl ?? '' !!}@stop
    @push('styles')
        <script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.css">
        <style>
            .blocker {
                z-index: 10000 !important;
            }

            .embed-container {
                position: relative;
                padding-bottom: 56.25%;
                height: 0;
                overflow: hidden;
                max-width: 100%;
            }

            .embed-container iframe,
            .embed-container object,
            .embed-container embed {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }
        </style>
        <style type="text/css">
            .modal {
                z-index: 99999 !important;
            }

            .map-image-modal {
                cursor: zoom-in;
                object-fit: cover;
                /*width: 200px;*/
            }

            .trip-faq-description ul li {
                list-style-type: inherit !important;
            }

            .modal-body {
                /* 100% = dialog height, 120px = header + footer */
                /*height: 70vh;*/
                /*overflow-y: scroll;*/
            }

            .trip-map-iframe {
                display: flex;
            }
        </style>
    @endpush
@section('content')

    <section>
        {{-- Sticky Nav --}}
        <div class="text-white tdb bg-primary-dark sticky-top" style="top:5rem;z-index:98">
            <div class="container flex items-center">
                <nav class="flex items-center justify-center tour-details-tabs" id="secondnav">
                    <ul class="flex flex-wrap py-1 nav gap-1">
                        <li>
                            <a href="#overview" class="flex items-center p-2 hover:bg-white hover:text-primary">
                                <svg class="w-6 h-6 md:mr-2">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#viewgrid" />
                                </svg>
                                <span class="none md:block">Overview</span>
                            </a>
                        </li>
                        @if (!$trip->trip_itineraries->isEmpty())
                            <li>
                                <a href="#itinerary" class="flex items-center p-2 hover:bg-white hover:text-primary">
                                    <svg class="w-6 h-6 md:mr-2">
                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#clock" />
                                    </svg>
                                    <span class="none md:block">Itinerary</span></a>
                            </li>
                        @endif

                        @if ($trip->trip_include_exclude)
                            <li>
                                <a href="#inclusions" class="flex items-center p-2 hover:bg-white hover:text-primary">
                                    <svg class="w-6 h-6 md:mr-2">
                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#archive" />
                                    </svg>
                                    <span class="none md:block">Includes</span>
                                </a>
                            </li>
                        @endif

                        @if (!$trip->trip_departures->isEmpty())
                            <li>
                                <a href="#date-price" class="flex items-center p-2 hover:bg-white hover:text-primary">
                                    <svg class="w-6 h-6 md:mr-2">
                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#calendar" />
                                    </svg>
                                    <span class="none md:block">Dates & Prices</span>
                                </a>
                            </li>
                        @endif

                        {{-- @if ($trip->trip_seo->about_leader)
                            <li>
                                <a href="#equipment-list" class="flex items-center p-2 hover:bg-white hover:text-primary">
                                    <svg class="w-6 h-6 md:mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"></path>
                                    </svg>
                                    <span class="none md:block">Equipment List</span>
                                </a>
                            </li>
                        @endif --}}

                        @if (!$trip->trip_faqs->isEmpty())
                            <li>
                                <a href="#faqs" class="flex items-center p-2 hover:bg-white hover:text-primary">
                                    <svg class="w-6 h-6 md:mr-2">
                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#questionmarkcircle" />
                                    </svg>
                                    <span class="none md:block">FAQs</span>
                                </a>
                            </li>
                        @endif

                        @if (!$trip->trip_reviews->isEmpty())
                            <li>
                                <a href="#reviews" class="flex items-center p-2 hover:bg-white hover:text-primary">
                                    <svg class="w-6 h-6 md:mr-2">
                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#chat" />
                                    </svg>
                                    <span class="none md:block">Reviews</span>
                                </a>
                            </li>
                        @endif

                    </ul>
                </nav>
            </div>
            <div id="tourDetailsBarIO"></div>
        </div>
        {{-- Sticky Nav --}}

        <div class="container pb-20 pt-20 mt-2">

            <div class="grid gap-2 lg:grid-cols-3 lg:gap-10 xl:gap-20">

                <div class="tour-details lg:col-span-2">

                    <div class="breadcrumb-wrapper none md:block pt-10 mb-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb fs-sm wrap">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('front.trips.listing') }}">Trips</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $trip->name }}</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="w-full mb-6">
                        <div class="flex flex-wrap justify-center lg:justify-between gap-10 lg:gap-20">
                            <div>
                                <h1 class="font-bold">
                                    <span class="text-3xl">{{ $trip->name }}</span>
                                    <span class="text-xl">- {{ $trip->duration }} days</span>
                                </h1>
                            </div>

                            @if ($trip->reviews_count)
                                <div class="ratings bg-white rounded-lg">
                                    <div class="flex items-center gap-4">
                                        <div class="flex gap-1">
                                            @for ($i = 0; $i < $trip->rating; $i++)
                                                <svg class="w-6 h-6 text-accent">
                                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#star" />
                                                </svg>
                                            @endfor
                                            @for ($i = 0; $i < 5 - $trip->rating; $i++)
                                                <svg class="w-6 h-6 text-accent" viewbox="0 0 20 20" stroke="currentColor" fill="none">
                                                    <path stroke-linecap="round" stroke-width="1.5"
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                    </path>
                                                </svg>
                                            @endfor
                                        </div>
                                        <div class="px-2 py-1 rounded-xl bg-primary text-white">
                                            {{ number_format($trip->rating, 1) }}
                                        </div>
                                    </div>
                                    <a href="#reviews" class="block text-sm text-right">from {{ $trip->reviews_count }} reviews</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Hero --}}
                    <section class="relative tdh">
                        <div id="hero-slider" class="hero-slider">
                            @if (iterator_count($trip->trip_galleries))
                                @foreach ($trip->trip_galleries as $gallery)
                                    <div class="slide">
                                        <img src="{{ $gallery->largeImageUrl }}" class="block rounded-xl" alt="">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div id="slider-controls">
                            <button class="absolute left-0 top-1/2 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-8 h-8 text-white" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                </svg>
                            </button>
                            <button class="absolute right-0 top-1/2 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-8 h-8 text-white" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </button>
                        </div>
                        <div id="slider-nav" class="absolute left-0 right-0 bottom-4 flex justify-center">
                            @if (iterator_count($trip->trip_galleries))
                                @foreach ($trip->trip_galleries as $gallery)
                                    <button>
                                        <img src="{{ $gallery->thumbImageUrl }}" class="h-12 border border-white" alt="">
                                    </button>
                                @endforeach
                            @endif
                        </div>

                        @push('scripts')
                            <script src="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.js"></script>
                            <script>
                                const heroSlider = tns({
                                    container: '.hero-slider',
                                    navContainer: '#slider-nav',
                                    controlsContainer: '#slider-controls',
                                    autoplay: true,
                                    autoplayTimeout: 6000,
                                    autoplayButtonOutput: false,
                                    mode: 'gallery'
                                })
                            </script>
                        @endpush

                    </section>
                    {{-- Hero --}}

                    <div class="lg:none">
                        @include('front.elements.price_card')
                    </div>

                    <div id="overview" class="pt-10 pb-4 mb-4 tds">
                        <div>
                            <div class="grid gap-6 mb-10 md:grid-cols-2 lg:grid-cols-3">
                                <div class="flex aic">
                                    <div class="mr-4">
                                        <svg class="w-10 h-10 text-light-gray">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#maxelevation" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm text-light-gray">
                                            Max. Elevation
                                        </div>
                                        <div>
                                            {{ $trip->max_altitude }}m
                                        </div>
                                    </div>
                                </div>

                                <div class="flex aic">
                                    <div class="mr-4">
                                        <svg class="w-10 h-10 text-light-gray">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#groupsize" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm text-light-gray">
                                            Group size
                                        </div>
                                        <div>
                                            {{ $trip->group_size }}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex aic">
                                    <div class="mr-4">
                                        <svg class="w-10 h-10 text-light-gray p-1" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="1.5" clip-rule="evenodd"
                                            viewBox="0 0 34 34">
                                            <g transform="translate(-235.242 -9.167)">
                                                <path fill="none" stroke="currentColor" stroke-width="1.6704975"
                                                    d="M266.698 19.5a15.938 15.938 0 0 1 1.377 6.5c0 8.83-7.17 16-16 16-8.831 0-16-7.17-16-16s7.169-16 16-16c2.313 0 4.514.493 6.5 1.377" />
                                                <path fill="none" stroke="currentColor" stroke-width="1.6681169"
                                                    d="M252.075 38c-6.623 0-12-5.377-12-12s5.377-12 12-12c1.735 0 3.385.37 4.875 1.033" />
                                                <path fill="none" stroke="currentColor" stroke-width="1.6678668" d="M252.075 38v-3.556" />
                                                <circle cx="252.075" cy="26" r="3.823" fill="none" stroke="currentColor" stroke-width="1.67" />
                                                <path fill="none" stroke="currentColor" stroke-width="1.67" d="m264.575 13.5-9.765 9.83" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm text-light-gray">
                                            Trip grade
                                        </div>
                                        <div>
                                            {{ ucfirst(strtolower($trip->difficulty_grade_value)) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex aic">
                                    <div class="mr-4">
                                        <svg class="w-10 h-10 text-light-gray">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#transportation" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm text-light-gray">
                                            Transportation
                                        </div>
                                        <div>
                                            {!! $trip->trip_info->transportation ?? '' !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex aic">
                                    <div class="mr-4">
                                        <svg class="w-10 h-10 text-light-gray" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="1.5" clip-rule="evenodd"
                                            viewBox="0 0 42 40">
                                            <path fill="none" stroke="currentColor" stroke-width="1.67"
                                                d="M10.532 31.818h26.5c7.044-4.976 1.105-13.203-3.786-12-2.383-12.045-17.888-12.198-19.5-.5-7.902.176-10.214 9.228-3.214 12.5ZM8.246 17.318c-3.057-6.696 3.817-11.542 9-9.036M5.429 17.318.833 19.6M5.442 10.818.833 8.572M10.532 5.646 8.246 1.064M17.246 5.545l2-4.712" />
                                            <circle cx="186.464" cy="36.945" r="1" fill="currentColor" transform="translate(-234.568 -12.996) scale(1.33333)" />
                                            <circle cx="186.464" cy="36.945" r="1" fill="currentColor" transform="translate(-225.373 -12.996) scale(1.33333)" />
                                            <circle cx="186.464" cy="36.945" r="1" fill="currentColor" transform="translate(-216.177 -12.996) scale(1.33333)" />
                                            <circle cx="186.464" cy="36.945" r="1" fill="currentColor" transform="translate(-229.873 -10.94) scale(1.33333)" />
                                            <circle cx="186.464" cy="36.945" r="1" fill="currentColor" transform="translate(-220.677 -10.94) scale(1.33333)" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm text-light-gray">
                                            Best Season
                                        </div>
                                        <div>
                                            {{ $trip->trip_info->best_season ?? '' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex aic">
                                    <div class="mr-4">
                                        <svg class="w-10 h-10 text-light-gray">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#accomodation" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm text-light-gray">
                                            Accomodation
                                        </div>
                                        <div>
                                            {!! $trip->trip_info->accomodation ?? '' !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex aic">
                                    <div class="mr-4">
                                        <svg class="w-10 h-10 text-light-gray" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="1.5" clip-rule="evenodd"
                                            viewBox="0 0 42 37">
                                            <path fill="none" stroke="currentColor" stroke-width="1.67"
                                                d="M35.554 21.333c-1.39 6.843-7.448 12-14.699 12-6.64 0-12.278-4.324-14.25-10.307a14.728 14.728 0 0 1-.5-1.954v-5.478c.195-1.055.501-2.072.904-3.037a2.511 2.511 0 0 0 1.36-2.454l-.007-.07c2.69-4.037 7.282-6.7 12.493-6.7 5.738 0 10.728 3.23 13.25 7.967v10.033h1.45Z" />
                                            <circle cx="25" cy="25" r="15" fill="none" stroke="currentColor" stroke-width="2.27" transform="matrix(.73333 0 0 .73333 2.522 0)" />
                                            <path fill="none" stroke="currentColor" stroke-width="1.67"
                                                d="M6.605 21.333h-4v12.51c0 1.098.892 1.99 1.991 1.99h.018a1.992 1.992 0 0 0 1.991-1.99v-12.51ZM1.605 1.333l-.763 8.77a2.512 2.512 0 0 0 2.503 2.73m2.52 0c.402 0 .793-.096 1.144-.276m1.353-2.524-.757-8.7m-6 0-.763 8.77a2.512 2.512 0 0 0 2.503 2.73M37.105 21.333v12.51c0 1.098.892 1.99 1.991 1.99h.018a1.992 1.992 0 0 0 1.991-1.99v-12.51h-4ZM4.605 1.333v9M34.105 21.333v-13.5a6.999 6.999 0 0 1 7-7v20.5h-7Z" />
                                            <path fill="none" stroke="currentColor" stroke-width="1.67" d="M3.105 12.833h3v8.5h-3z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm text-light-gray">
                                            Meals
                                        </div>
                                        <div>
                                            {!! $trip->trip_info->meals ?? '' !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex aic">
                                    <div class="mr-4">
                                        <svg class="w-10 h-10 text-light-gray">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#startsat" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm text-light-gray">
                                            Starts at
                                        </div>
                                        <div>
                                            {{ $trip->starting_point }}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex table-item aic">
                                    <div class="mr-4">
                                        <svg class="w-10 h-10 text-light-gray">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#endsat" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm text-light-gray">
                                            Ends at
                                        </div>
                                        <div>
                                            {{ $trip->ending_point }}
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div>
                                <h3 class="mb-6 text-2xl font-display text-gray-600">Highlights</h3>
                                <ul class="mb-4 highlights">
                                    {!! $trip->trip_info ? $trip->trip_info->highlights : '' !!}
                                </ul>

                                <div id="overview-text" x-data="{ expanded: false }" class="mb-4 relative">
                                    <div x-show="expanded" class="pb-20" x-collapse.min.200px><?= $trip->trip_info ? $trip->trip_info->overview : '' ?></div>
                                    <div class="flex justify-center absolute bottom-0 w-full py-4" style="background: linear-gradient(to top, rgba(255,255,255,1), rgba(255,255,255,0));"><button
                                            class="text-xs bg-light rounded-full px-4 py-2" x-on:click="expanded=!expanded" x-text="expanded?'Show less':'Show more'">Show more</button></div>
                                </div>

                                @if ($trip->trip_info && trim($trip->trip_info->important_note))
                                    <div class="p-4 mb-3 bg-light">
                                        <h3 class="mb-2 text-xl font-display text-gray-600">Important Note</h3>
                                        <p class="mb-0 text-sm">
                                            {!! $trip->trip_info->important_note !!}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Itinerary --}}
                    <div id="itinerary" class="pt-10 pb-4 mb-4 tds" x-data="{ showOutline: true, @for ($i = 0; $i < $trip->trip_itineraries->count() ; $i++) day{{ $i + 1 }}Open:false, @endfor }">
                        <div class="flex flex-wrap gap-10 items-end justify-between mb-4">
                            <h2 class="text-2xl uppercase lg:text-3xl font-display text-gray-600">Trip Itinerary</h2>
                            <div>
                                <button class="mb-2 btn btn-sm btn-primary expand-all" x-show="showOutline" x-cloak
                                    x-on:click="@for ($i = 0; $i < $trip->trip_itineraries->count() ; $i++) day{{ $i + 1 }}Open = true; @endfor showOutline=false">
                                    Show Details
                                </button>
                                <button class="mb-2 btn btn-sm btn-primary expand-all" x-show="!showOutline" x-cloak
                                    x-on:click="@for ($i = 0; $i < $trip->trip_itineraries->count() ; $i++) day{{ $i + 1 }}Open = false; @endfor showOutline=true">
                                    Show Outline
                                </button>
                            </div>
                        </div>

                        <div class="mb-4 itinerary">
                            @foreach ($trip->trip_itineraries as $i => $itinerary)
                                <div>
                                    <button type="button" class="flex items-center w-full text-left py-3 border-t border-gray-100" x-on:click="day{{ $i + 1 }}Open = !day{{ $i + 1 }}Open ">
                                        <div class="flex items-center mr-4">
                                            <div class=" text-xl mr-2 font-display">Day</div>
                                            <div class="text-xl font-display">
                                                {{ $itinerary->day }} :
                                            </div>
                                        </div>
                                        <div class="flex justify-between flex-grow-1">
                                            <h3 class="text-xl font-display text-gray-600">{{ $itinerary->name }}</h3>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="transition flex-shrink-0 w-6 h-6" x-bind:class="{'rotate-180': day{{ $i + 1 }}Open}" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        </div>
                                    </button>

                                    <div class="pt-6 pb-10" x-cloak x-show.transition="day{{ $i + 1 }}Open">
                                        <div class="">
                                            @if (isset($itinerary->image_name) && !empty($itinerary->image_name))
                                                <img src="{{ $itinerary->imageUrl }}" alt="" class="mt-2 mb-2 xl:w-1/2 {{ $i % 2 == 0 ? 'xl:float-left mr-4' : 'xl:float-right ml-4' }}"
                                                    loading="lazy">
                                            @endif
                                            <div>
                                                {!! $itinerary->description !!}
                                            </div>
                                        </div>
                                        {{-- icons --}}
                                        <div class="clear-both flex flex-col gap-10 md:flex-row">
                                            @if (trim($itinerary->max_altitude) !== '')
                                                <div class="flex gap-2">
                                                    <img src="{{ asset('assets/front/img/elevation.png') }}" alt="" class="w-6 h-6">
                                                    <div>
                                                        <h4 class="uppercase font-display text-sm">Max. altitude</h4>
                                                        <div class="">{{ number_format($itinerary->max_altitude) }}m / {{ number_format($itinerary->max_altitude * 3.28084) }} ft.</div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (trim($itinerary->accomodation) !== '')
                                                <div class="flex gap-2">
                                                    <img src="{{ asset('assets/front/img/accomodation.png') }}" alt="" class="w-6 h-6">
                                                    <div>
                                                        <h4 class="uppercase font-display text-sm">Accommodation</h4>
                                                        <div class="">{{ $itinerary->accomodation }}</div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (trim($itinerary->meals) !== '')
                                                <div class="flex gap-2">
                                                    <img src="{{ asset('assets/front/img/meal.png') }}" alt="" class="w-6 h-6">
                                                    <div>
                                                        <h4 class="uppercase font-display text-sm">Meals</h4>
                                                        <div class="">{{ $itinerary->meals }}</div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <!--</div>-->
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>{{-- Itinerary --}}

                    @if ($canMakeChart)
                        <div class="py-10">
                            <figure>
                                <canvas id="ctx"></canvas>
                                <figcaption class="mt-6 text-center">Elevation Chart</figcaption>
                            </figure>
                        </div>
                        @push('scripts')
                            <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
                            <script>
                                const ctx = document.getElementById('ctx');

                                new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: [{{ implode(',', range(1, count($elevations))) }}],
                                        datasets: [{
                                            label: 'Max. elevation (metres)',
                                            data: [{{ implode(',', $elevations) }}],
                                            borderWidth: 2,
                                            borderColor: '#93cd06',
                                            pointBackgroundColor: '#93cd06',
                                        }]
                                    },
                                    options: {
                                        plugins:{
                                            legend: {
                                                display: false
                                            },
                                        },
                                        scales: {
                                            x: {
                                                title: {
                                                    display: true,
                                                    text: 'Days'
                                                }
                                            },
                                            y: {
                                                beginAtZero: true,
                                                title: {
                                                    display: true,
                                                    text: 'Max. Elevation (metres)'
                                                }
                                            }
                                        }
                                    }
                                });
                            </script>
                        @endpush
                    @endif


                    {{-- Not satisfied --}}
                    <div class="items-center justify-between lg:flex">
                        <div>
                            Not satisfied with this itinerary? <b class="text-primary">Make your own</b>.
                        </div>
                        <a href="{{ route('front.plantrip.createfortrip', $trip->slug) }}" class="btn btn-sm btn-primary">Plan My Trip</a>
                    </div>{{-- Not satisfied --}}

                    {{-- Includes/Excludes --}}
                    @if ($trip->trip_include_exclude)
                        <div id="inclusions" class="py-10 tds">
                            <div class="grid gap-4 lg:grid-cols-2">
                                <div>
                                    <h2 class="text-2xl uppercase lg:text-3xl font-display text-gray-600">Includes</h2>
                                    <ul class="includes">
                                        <?= $trip->trip_include_exclude->include ?>
                                    </ul>
                                </div>

                                <div>
                                    <h2 class="text-2xl uppercase lg:text-3xl font-display text-gray-600">Doesn't Include</h2>
                                    <ul class="excludes">
                                        <?= $trip->trip_include_exclude->exclude ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif{{-- Includes/Excludes --}}

                    {{-- Departure dates --}}
                    @if (!$trip->trip_departures->isEmpty())
                        <div id="date-price" class="tds py-10">
                            <h2 class="text-2xl uppercase lg:text-3xl font-display text-gray-600">Upcoming Departure Dates
                            </h2>
                            <div class="table-wrapper-scroll">
                                <table class="table mb-2">
                                    <thead>
                                        <tr class="bg-gray">
                                            <th class="p-2 text-left">{{ $trip->name }}</th>
                                            <th class="p-2 text-left">Price</th>
                                            <th class="p-2 text-left">Seats Left</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($trip->trip_departures as $departure)
                                            <tr class="@if ($loop->even) bg-gray @endif">
                                                <td>
                                                    <div class="flex items-center gap-2 p-1">
                                                        <svg class="w-5 h-5 text-primary">
                                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#calendar') }}" />
                                                        </svg>
                                                        {{ formatDate($departure->from_date) }} — {{ formatDate($departure->to_date) }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="flex items-center gap-2 p-1">
                                                        <svg class="w-5 h-5 text-primary">
                                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#tag') }}" />
                                                        </svg>
                                                        <div>
                                                            <small class="text-red"><s>US $ {{ number_format($trip->cost) }}</s></small><br>
                                                            <span class="text-gray-600">US $ {{ number_format($departure->price) }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="flex items-center gap-2">
                                                        <svg class="w-5 h-5 text-primary">
                                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg#users') }}" />
                                                        </svg>
                                                        {{ $departure->seats }}
                                                    </div>
                                                </td>
                                                <td><a href="{{ route('front.trips.departure-booking', ['slug' => $trip->slug, 'id' => $departure->id]) }}" class="btn btn-sm btn-accent">Join Group</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- <p class="text-center"><button id="more-dates" class="btn btn-sm btn-gray">See more dates</button></p> -->
                            </div>
                        </div>
                    @endif{{-- Departure dates --}}

                    {{-- Equipment List --}}
                    @if ($trip->trip_seo->about_leader)
                        <div id="equipment-list" class="pt-10 pb-4 mb-4 tds">
                            <h2 class="text-2xl uppercase lg:text-3xl font-display text-gray-600">Equipment List</h2>
                            <div class="prose">
                                {!! $trip->trip_seo->about_leader !!}
                            </div>
                        </div>
                    @endif
                    {{-- Equipment List --}}

                    {{-- FAQS --}}
                    @if (!$trip->trip_faqs->isEmpty())
                        <div id="faqs" class="pt-10 pb-4 mb-4 tds">
                            <h2 class="mb-4 text-2xl uppercase lg:text-3xl font-display text-gray-600">Frequently Asked Questions</h2>

                            <div class="mb-4" x-data="{ active: 'none' }">
                                @foreach ($trip->trip_faqs as $i => $faq)
                                    <div class="mb-2">
                                        <button class="flex items-center justify-between w-full py-2 text-left" @click="active = (active === {{ $i }} ? 'none' : {{ $i }})">
                                            <h3 class="text-xl font-display text-gray-600">{{ $faq->title }}</h3>

                                            <svg class="flex-shrink-0 w-6 h-6 text-primary" x-show="active!=={{ $i }}">
                                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#plus" />
                                            </svg>
                                            <svg class="flex-shrink-0 w-6 h-6 text-primary" x-show="active==={{ $i }}">
                                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#minus" />
                                            </svg>
                                        </button>
                                        <div x-cloak x-show.transition="active==={{ $i }}">
                                            <div class="mb-0">
                                                {!! $faq->description !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- <a href="#" class="mb-2 text-primary">Read more FAQs</a> --}}
                        </div>
                    @endif
                    {{-- FAQS --}}

                    {{-- Trip reviews --}}
                    @if (iterator_count($trip->trip_reviews))
                        <div id="reviews" class="pt-10 pb-4 mb-4 tds">
                            <div class="items-center justify-between mb-4 lg:flex">
                                <h2 class="text-2xl uppercase text-3xl font-display text-gray-600">Reviews
                                </h2>

                                <div>
                                    <a href="{{ route('front.reviews.create') }}" class="mr-1 btn btn-primary btn-sm" data-toggle="modal" data-target="#review-modal">
                                        Write a review</a>
                                </div>
                            </div>

                            <div class="flex justify-center items-center gap-6 mb-10">
                                <div class="flex">
                                    @for ($i = 0; $i < $trip->rating; $i++)
                                        <svg class="w-8 h-8 text-accent">
                                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#star" />
                                        </svg>
                                    @endfor
                                    @for ($i = 0; $i < 5 - $trip->rating; $i++)
                                        <svg class="w-8 h-8 text-accent" viewbox="0 0 20 20" stroke="currentColor" fill="none">
                                            <path stroke-linecap="round" stroke-width="1.5"
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    @endfor
                                </div>
                                <a href="#reviews" class="block text-sm text-center">from {{ $trip->reviews_count }} reviews</a>
                            </div>

                            <div class="mb-10 grid gap-10 lg:grid-cols-1 lg:gap-3">

                                @foreach ($trip->trip_reviews()->where('status', 1)->get() as $review)
                                    <div class="review">
                                        <div class="review__content">
                                            <h2 class="mb-1 text-2xl font-display text-gray-600">{{ $review->title }}</h2>
                                            <p>{{ $review->review }}</p>
                                        </div>
                                        <div class="flex justify-between items-center gap-10">
                                            <div class="flex items-center gap-4">
                                                <img src="{{ $review->thumbImageUrl }}" alt="">
                                                <div>
                                                    <div class="font-bold">{{ $review->review_name }}</div>
                                                    <div class="text-sm text-gray">{{ $review->review_country }}</div>

                                                    <div class="flex">
                                                        @for ($i = 0; $i < $review->rating; $i++)
                                                            <svg class="w-6 h-6 text-accent">
                                                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#star" />
                                                            </svg>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <a href="{{ route('front.reviews.index') }}" class="text-primary">See more reviews</a>
                        </div>
                    @endif{{-- Trip reviews --}}

                    {{-- Button --}}
                    <div class="flex flex-wrap justify-between mb-4">
                        <div class="flex mb-2">
                            <a href="{{ route('front.trips.booking', $trip->slug) }}" class="mr-2 btn btn-accent">Book Now</a>
                            <a href="{{ route('front.plantrip.createfortrip', $trip->slug) }}" class="btn btn-primary">
                                <svg class="w-6 h-6 mr-2">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#adjustments" />
                                </svg>
                                Plan My Trip
                            </a>
                        </div>

                        <div class="flex">
                            <a href="{{ route('front.trips.print', ['slug' => $trip->slug]) }}" class="flex items-center p-1 mr-2 text-accent" title="Print tour details">
                                <svg class="flex-shrink-0 w-6 h-6 mr-2">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#printer" />
                                </svg>
                                <span>Print Tour Details</span>
                            </a>
                            <a href="#" class="flex items-center p-1 text-accent" title="">
                                <svg class="flex-shrink-0 w-6 h-6 mr-2">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#download" />
                                </svg>
                                <span>Download Tour Brochure</span>
                            </a>
                        </div>
                    </div>{{-- Button --}}

                    {{-- Share this tour --}}
                    <div>
                        <h2 class="mb-2 uppercase lg:text-xl font-display text-gray-600">Share this tour</h2>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('front.trips.show', ['slug' => $trip->slug]) }}" class="text-gray-400 hover:text-accent mr-2">
                            <svg class="w-6 h-6">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#facebook" />
                            </svg>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ route('front.trips.show', ['slug' => $trip->slug]) }}&text=" class="text-gray-400 hover:text-accent mr-2">
                            <svg class="w-6 h-6">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#twitter" />
                            </svg>
                        </a>
                        <a href="{{ Setting::get('instagram') }}" class="text-gray-400 hover:text-accent">
                            <svg class="w-6 h-6">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#instagram" />
                            </svg>
                        </a>
                    </div>{{-- Share this tour --}}
                </div>

                {{-- aside --}}
                <aside class="pt-10">

                    <div class="sticky" style="top: 10rem;  ">
                        @include('front.elements.price_card')
                        <div class="mb-10">@include('front.elements.enquiry')</div>
                    </div>


                    {{-- <!-- Route Map -->
                        @if ($trip->map_file_name)
                        <div class="mb-8">
                            <div class="card-header">
                                <h2 class="mb-2 text-2xl uppercase font-display text-primary">Map & Route</h2>
                            </div>
                            <div class="card-body p-0">
                                <!-- Link to open the modal -->
                                <a href="#ex1" rel="modal:open">
                                    <img class="img-fluid" src="{{ $trip->mapImageUrl }}" alt="{{ $trip->name }}">
                                </a>
                            </div>
                        </div>
                    @endif --}}

                    {{-- @if (!empty($trip->iframe))
                        <div class="mb-8">
                            <div class="card-body p-0">
                                <!-- Link to open the modal -->
                                <div class="trip-map-iframe">
                                    {!! $trip->iframe !!}
                                </div>
                            </div>
                        </div>
                    @endif --}}




                    {{-- <div class="px-2 py-10 text-white experts-card bg-primary">
                        <div class="grid grid-cols-3">
                            <div class="col-span-2">
                                <p class="mb-0">Still confused?</p>
                                <h3 class="mb-2">Talk to our experts</h3>
                            </div>
                            <div>
                                <svg class="w-20 h-20">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#customersupport" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex mb-1 experts-phone">
                            <a href="{{ Setting::get('mobile1') }}" class="flex aic">
                                <svg class="w-6 h-6 mr-1">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#phone" />
                                </svg>
                                {{ Setting::get('mobile1') }}
                            </a>
                        </div>
                        <div class="flex mb-3 experts-phone">
                            <a href="mailto:{{ Setting::get('email') }}" class="flex aic">
                                <svg class="w-6 h-6 mr-1">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#mail" />
                                </svg>
                                {{ Setting::get('email') }}
                            </a>
                        </div>
                    </div> --}}

                    {{-- <div class="p-2 mb-8 bg-light">
                        <a href="{{ Setting::get('facebook') }}" class="mr-1 text-primary hover:text-accent">
                            <svg class="w-6 h-6">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#facebookmessenger" />
                            </svg>
                        </a>
                        <a href="{{ Setting::get('viber') }}" class="mr-1 text-primary hover:text-accent">
                            <svg class="w-6 h-6">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#viber" />
                            </svg>
                        </a>
                        <a href="{{ Setting::get('whatsapp') }}" class="mr-1 text-primary hover:text-accent">
                            <svg class="w-6 h-6">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#whatsapp" />
                            </svg>
                        </a>
                        <a href="{{ Setting::get('skype') }}" class="mr-1 text-primary hover:text-accent">
                            <svg class="w-6 h-6">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#skype" />
                            </svg>
                        </a>
                        <a href="{{ Setting::get('weixin') }}" class="mr-1 text-primary hover:text-accent">
                            <svg class="w-6 h-6">
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#weixin" />
                            </svg>
                        </a>
                    </div> --}}

                    {{-- @include('front.elements.essential_trip_information') --}}


                    {{-- @if (iterator_count($trip->addon_trips))
                        <div class="mb-8">
                            <h2 class="mb-2 text-2xl uppercase font-display text-primary">Additional Tours</h2>
                            @forelse ($trip->addon_trips as $addon_trip)
                                @include('front.elements.addon_trip', ['trip' => $addon_trip])
                            @empty
                            @endforelse
                        </div>
                    @endif --}}

                    {{-- <div class="sticky-top sticky-price none lg:block" style="top: 9rem;">
                        @include('front.elements.price_card')
                    </div> --}}

                </aside>
            </div>
        </div>

        <!-- Similar -->
        @if (!$trip->similar_trips->isEmpty())
            <div class="py-10 bg-light ">
                <div class="container">
                    <h2 class="mb-10 text-2xl uppercase lg:text-3xl font-display text-gray-600">Similar Tours</h2>
                    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3 md:gap-8">
                        @forelse ($trip->similar_trips as $trip)
                            @include('front.elements.tour-card', ['tour' => $trip])
                        @empty
                        @endforelse
                    </div>
                </div>
            </div> <!-- Similar -->
        @endif
    </section>

    <div class="fixed bottom-0 left-0 right-0 px-4 py-2 bg-white shadow-sm lg:none">
        <a href="" class="w-full mb-2 btn btn-primary">Book Now</a>
    </div>

    <div id="ex1" class="modal" style="max-width: 70%;">
        <p>
            <img class="map-image-modal" src="{{ $trip->mapImageUrl }}" alt="map">
        </p>
    </div>
@endsection

@push('scripts')
    <!--<script src="{{ asset('assets/front/js/tour-details.js') }}"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/wheelzoom@4.0.1/wheelzoom.min.js"></script>
    {{-- <script>
        jQuery.noConflict(true);
    </script> --}}
    <script>
        wheelzoom(document.querySelector('.wheelzoom'))
    </script>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            
            // const monthSlider = tns({
            //     container: '.trips-month-slider',
            //     nav: false,
            //     controlsContainer: '.trips-month-slider-controls',
            //     autoplay: true,
            //     autoplayButtonOutput: false
            // });


            // For scrollspy functionality
            const tdb = document.querySelector('.tdb')
            if (tdb) {
                const sections = document.querySelectorAll('.tds')
                const sectionScrollObserver = new IntersectionObserver((entries, observer) => {
                    if (entries) {
                        entries.forEach(entry => {
                            const link = tdb.querySelector(`[href="#${entry.target.id}"]`)
                            if (link != null) {
                                if (entry.isIntersecting) {
                                    link.classList.add('bg-accent')
                                } else {
                                    link.classList.remove('bg-accent')
                                }
                            }
                        })
                    }
                }, {
                    rootMargin: "-19% 0px -80% 0px"
                })
                sections.forEach(section => {
                    sectionScrollObserver.observe(section)
                })
            }

        })
        window.onload = function() {

            var session_success_message = '{{ $session_success_message ?? '' }}';
            var session_error_message = '{{ $session_error_message ?? '' }}';
            if (session_success_message) {
                toastr.success(session_success_message);
            }

            if (session_error_message) {
                toastr.danger(session_error_message);
            }

            // Hero Slider
            //   $(".tour-details-hero .owl-carousel").owlCarousel({
            //     items: 1,
            //     dots: false,
            //     // autoplay: true,
            //     // autoplayTimeout: 8000,
            //     loop: true,
            //     animateOut: 'fadeOut'
            //   });

            // $("#review-modal").modal('show');

            //Display user image upon select
            const showImage = (src, target) => {
                var fr = new FileReader();
                // when image is loaded, set the src of the image where you want to display it
                fr.onload = function(e) {
                    target.src = this.result;
                };
                src.addEventListener("change", function() {
                    // fill fr with image data
                    fr.readAsDataURL(src.files[0]);
                });
            }
            const src = document.getElementById("photo-input");
            const target = document.getElementById("write-review-photo");
        }
        $(function() {
            $('#ex1').on($.modal.OPEN, function(event, modal) {
                setTimeout(function() {
                    $('.map-image-modal').attr('src', "{{ $mapImageUrl }}");
                    $('.map-image-modal').show();
                    wheelzoom($('.map-image-modal'));
                }, 500);
            });

            $('#ex1').on($.modal.AFTER_CLOSE, function(event, modal) {
                $('.map-image-modal').attr('src', "");
                $('.map-image-modal').hide();
                $('.map-image-modal').trigger('wheelzoom.reset');
            });
            $('#map-modal').on('show.bs.modal', function(e) {
                setTimeout(function() {
                    let img = '<img class="img-fluid map-image-modal" src="{{ $mapImageUrl }}" alt="">';
                    $("#map-modal").find(".modal-body").html(img);
                    wheelzoom($('.map-image-modal'));
                }, 500);
            });
            // $(".similar-trip-rating").rating();
            // $("#review-rating").rating();
        });
    </script>
    <script>
        $(function() {
            var enquiry_validator = $("#enquiry-form").validate({
                ignore: "",
                rules: {
                    'name': 'required',
                    'email': 'required',
                    'country': 'required',
                    'phone': 'required',
                    'message': 'required',
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element.closest('.flex'));
                    // error.append(element.closest('.form-group'));
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    $(form).find('#redirect-url').val('{!! route('front.trips.show', $trip->slug) !!}');
                    if (grecaptcha.getResponse(0)) {
                        var btn = $(form).find('button[type=submit]').attr('disabled', true).html('Sending...');
                        setTimeout(() => {
                            form.submit();
                        }, 500);
                    } else {
                        grecaptcha.reset(enquiry_captcha);
                        grecaptcha.execute(enquiry_captcha);
                    }
                },
            });
        });

        function onSubmitReview(token) {
            $("#review-form").submit();
            return true;
        }

        function onSubmitEnquiry(token) {
            $("#enquiry-form").submit();
            return true;
        }

        let enquiry_captcha;
        let review_captcha;
        var CaptchaCallback = function() {
            enquiry_captcha = grecaptcha.render('inquiry-g-recaptcha', {
                'sitekey': '{!! config('constants.recaptcha.sitekey') !!}'
            });
            // review_captcha = grecaptcha.render('review-g-recaptcha', {'sitekey' : '{!! config('constants.recaptcha.sitekey') !!}'});
        };
    </script>
@endpush
