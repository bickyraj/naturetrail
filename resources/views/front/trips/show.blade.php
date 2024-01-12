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
        canvas#ctx{
            background: center / cover url({{ asset('assets/front/img/mountain.jpg') }});
        }
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

            <div class="lg:grid gap-2 lg:grid-cols-3 lg:gap-10 xl:gap-20">

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
                                        <img src="{{ $gallery->mediumImageUrl }}" class="block rounded-xl" alt="">
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
                                    autoplay: false,
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

                        <div class="mb-4 itinerary relative">
                            <div class="absolute top-8 bottom-8 border-l border-gray-100 border-dashed"></div>
                            @foreach ($trip->trip_itineraries as $i => $itinerary)
                                <div class="pl-4 relative">
                                    @if($loop->last)
                                        <div class="absolute top-8 bottom-8 left-0 border-l border-white"></div>
                                    @endif
                                    <button type="button" class="flex items-center w-full text-left py-3 @if(!$loop->first) border-t @endif border-gray-300 hover:text-primary relative" x-on:click="day{{ $i + 1 }}Open = !day{{ $i + 1 }}Open ">
                                        <div class="absolute -left-6 top-2 w-4 h-4 bg-white border-2 border-primary rounded-full"></div>
                                        <div class="flex items-center mr-4">
                                            <div class=" text-xl mr-2 font-display">Day</div>
                                            <div class="text-xl font-display">
                                                {{ $itinerary->day }} :
                                            </div>
                                        </div>
                                        <div class="flex justify-between flex-grow-1">
                                            <h3 class="text-xl font-display">{{ $itinerary->name }}</h3>
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
                                                        <div class="">{{ number_format((float)$itinerary->max_altitude) }}m / {{ number_format((float)$itinerary->max_altitude * 3.28084) }} ft.</div>
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
                            <figure class="border border-gray-100">
                                <figcaption class="mt-6 text-center">Elevation Chart</figcaption>
                                <div style="overflow-x: scroll;">
                                    <div id="chart-wrapper">
                                        <canvas id="ctx"></canvas>
                                    </div>
                                </div>
                            </figure>
                        </div>
                        @push('scripts')
                            <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
                            <script>
                                const ctx = document.getElementById('ctx');

                                Chart.register(ChartDataLabels);

                                // const labels = ['Kathmandu', 'Kathmandu', 'Phakding', 'Namche Bazar', 'Namche Bazar', 'Tyangboche', 'Dingboche', 'Chukung', 'Lobuche', 'Gorakshep', 'Pheriche', 'Kyangjuma', 'Monjo', 'Lukla', 'Kathmandu'];
                                const labels = [{{ implode(',', range(1, count($elevations))) }}];

                                const chartWrapper = document.getElementById('chart-wrapper');

                                chartWrapper.style.height = '400px';
                                if (labels.length > 10) {
                                    chartWrapper.style.width = labels.length * 70 + 'px';
                                    chartWrapper.style.maxWidth = labels.length * 70 + 'px';
                                }

                                new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Max. elevation (metres)',
                                            data: [{{ implode(',', $elevations) }}],
                                            fill: true,
                                            backgroundColor: '#93cd0620',
                                            borderWidth: 1,
                                            borderColor: '#3eb368',
                                            pointBackgroundColor: '#3eb368',
                                        }]
                                    },
                                    options: {
                                        animation: false,
                                        maintainAspectRatio: false,
                                        layout: {
                                            padding: {
                                                left: 40,
                                                right: 40,
                                                bottom: 0
                                            }
                                        },
                                        plugins:{
                                            tooltip: {
                                                enabled: false
                                            },
                                            datalabels: {
                                                color: '#3eb368',
                                                align: 'top',
                                                offset: 10,
                                                formatter: function(value, ctx) {
                                                  return 'Day ' + ctx.chart.data.labels[ctx.dataIndex]+ '\n' + value + ' m';
                                                //   return `${value} m`;
                                                },
                                            },
                                            legend: {
                                                display: false
                                            },
                                        },
                                        scales: {
                                            x: {
                                                display: false
                                            },
                                            y: {
                                                display: false,
                                                max: 6500
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
                                    <h2 class="mb-4 text-2xl uppercase lg:text-3xl font-display text-gray-600">Includes</h2>
                                    <ul class="includes">
                                        <?= $trip->trip_include_exclude->include ?>
                                    </ul>
                                </div>

                                <div>
                                    <h2 class="mb-4 text-2xl uppercase lg:text-3xl font-display text-gray-600">Doesn't Include</h2>
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
                            <div class="mb-4 flex flex-wrap justify-between items-center gap-10">
                                <h2 class="text-2xl uppercase lg:text-3xl font-display text-gray-600">Upcoming Departure Dates
                                </h2>
                                <div class="flex gap-2">
                                    <button id="group-departure" class="flex items-center gap-2 border border-gray-100 p-2 text-sm rounded hover:text-primary hover:border-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                                          <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                                        </svg>
                                        Group departures
                                    </button>
                                    <button id="private-departure" class="flex items-center gap-2 border border-gray-100 p-2 text-sm rounded hover:text-primary hover:border-primary border-primary text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                                          <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z"/>
                                        </svg>
                                        Private departures
                                    </button>
                                </div>
                            </div>
                            <?php
                            $currentYear = date('Y');
                                    $currentMonth = date('n');
                                    $monthsArray = array();
                                    for ($i = 0; $i < 12; $i++) {
                                        $year = $currentYear;
                                        $month = $currentMonth + $i;
                                        if ($month > 12) {
                                            $month -= 12;
                                            $year++;
                                        }
                                        //  $monthsArray[] = date('M Y', );
                                        $monthsArray[] = strtotime("$year-$month-01");
                                    }

                            ?>
                            <div class="mb-4 grid grid-cols-4 md:grid-cols-6 lg:grid-cols-9 gap-2">
                                <button id="all-departure-filter" class="p-2 border border-primary bg-primary text-white px-4 py-2 text-center rounded font-bold"> All <br> Dep</button>
                                @foreach($monthsArray as $month)
                                    <button data-date="{{ $month }}" class="select-date-departure p-2 border border-gray-100 px-4 py-2 text-center rounded font-bold hover:border-primary hover:text-primary">{{ Str::replaceFirst('-', '<br>', date('M Y', $month)) }}</button>
                                @endforeach
                            </div>

                            <div class="mb-6 grid gap-4">
                                <?php $trip_departures = $trip->trip_departures;?>
                                <div id="departure-filter-block">
                                    @foreach ($trip_departures as $departure)
                                        <div class="grid grid-cols-2 lg:grid-cols-5 lg:place-items-center gap-4 relative p-4 border border-gray-100 rounded hover:border-primary">
                                            <div class="absolute top-0 left-4 border border-gray-100 bg-white px-1 rounded-full text-xs text-gray-400" style="translate: 0 -50%;">Group</div>
                                            <div class="absolute top-0 right-0 w-10 h-10 rounded overflow-hidden">
                                                <div class="bg-red-600 w-16 text-white text-xs px-1 pt-4 text-center" style="rotate: 45deg; margin-top: -8px">-10%</div>
                                            </div>
                                            <div>
                                                <div class="font-bold">{{ formatDate($departure->from_date) }}</div>
                                                <div class="text-sm text-gray-400">From {{ $trip->starting_point }}</div>
                                            </div>
                                            <div>
                                                <div class="font-bold">{{ formatDate($departure->to_date) }}</div>
                                                <div class="text-sm text-gray-400">To {{ $trip->starting_point }}</div>
                                            </div>
                                            <div>
                                                <div class="font-bold">{{ $departure->seats }}</div>
                                                <div class="text-sm text-gray-400">people booked</div>
                                            </div>
                                            <div>
                                                <div class="font-bold">From <span class="text-red"><s>US $ {{ number_format($trip->cost) }}</s></span></div>
                                                <div class="font-bold text-lg">US$ {{ number_format($departure->price) }}</div>
                                                <div class="text-sm"><span class="text-gray-400">Saving </span>US$ {{ number_format($trip->cost - $departure->price ) }}</div>
                                            </div>
                                            <div class="flex items-center">
                                                <a href="{{ route('front.trips.departure-booking', ['slug' => $trip->slug, 'id' => $departure->id]) }}" class="border border-primary py-2 px-3 text-sm text-primary rounded hover:bg-primary hover:text-white">Book Now</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {{-- bicky --}}
                                <div style=" display: flex; justify-content: center;">
                                    <button id="show-more-departure-button" style="display: none;" class="text-xs bg-light rounded-full px-4 py-2">Show more</button>
                                </div>
                            </div>

                            {{-- <div class="table-wrapper-scroll">
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
                            </div> --}}
                        </div>
                    @endif{{-- Departure dates --}}

                    {{-- Why book --}}
                    <div class="p-4 bg-light border border-primary" x-data="{isExpanded: false}">
                        <div class="mb-2 font-display text-xl uppercase">Why Book with Nature Trail</div>
                        <ul class="mb-2 grid grid-cols-2 gap-2">
                            <li class="relative pl-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 text-primary absolute top-1 left-0" viewBox="0 0 16 16">
                                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>
                                Earn <b class="font-bold">US$ 39+</b> in travel credits.</li>
                            <li class="relative pl-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 text-primary absolute top-1 left-0" viewBox="0 0 16 16">
                                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>
                                Excellent customer service. Our travel experts are ready to help you 24/7.</li>
                            <li class="relative pl-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 text-primary absolute top-1 left-0" viewBox="0 0 16 16">
                                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>
                                Best price guaranteed.</li>
                            <li class="relative pl-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 text-primary absolute top-1 left-0" viewBox="0 0 16 16">
                                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>
                                No credit card or booking fees.</li>
                            <li class="relative pl-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 text-primary absolute top-1 left-0" viewBox="0 0 16 16">
                                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>
                                100% financial protection. </li>
                            <li class="relative pl-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 text-primary absolute top-1 left-0" viewBox="0 0 16 16">
                                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>
                                Carbon neutral tours.</li>
                            {{-- li elements after the 6th --}}
                            <div class="col-span-2" x-show="isExpanded">
                                <li class="relative pl-6 pb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 text-primary absolute top-1 left-0" viewBox="0 0 16 16">
                                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                    25,000+ trip reviews, with an average rating of 4.8 out of 5.</li>
                            </div>
                        </ul>
                        <div class="text-sm text-primary">
                            <button x-on:click="isExpanded=true" x-show="!isExpanded">Read more reasons to book with Nature Trail</button>
                            <button x-on:click="isExpanded=false" x-show="isExpanded">Read less</button>
                        </div>
                    </div>
                    {{-- Why book --}}

                    {{-- Equipment List --}}
                    @if ($trip->trip_seo->about_leader)
                        <div id="equipment-list" class="pt-10 pb-4 mb-4 tds">
                            <h2 class="mb-4 text-2xl uppercase lg:text-3xl font-display text-gray-600">Equipment List</h2>
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
                            <div class="items-center justify-between mb-4 lg:flex gap-4">
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

                    <div id="aside-contents">

                        <div>
                            @include('front.elements.price_card')
                            <div class="mb-10">@include('front.elements.enquiry')</div>
                        </div>

                        <div class="price-card border border-gray-100">
                        <div class="p-8">
                            <div class="font-bold mb-4">
                                Tour with Flexible Booking Policy
                            </div>
                            <ul>
                                <li class="flex gap-2 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="flex-shrink-0 w-8 h-8 text-primary -mt-1" viewBox="0 0 16 16">
                                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                    </svg>
                                    <div class="prose text-sm">
                                        <div class="font-bold">
                                            Change dates
                                        </div>
                                        It is free to change your tour start date prior to 30 days of departure.
                                    </div>
                                </li>
                                <li class="flex gap-2 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="flex-shrink-0 w-8 h-8 text-primary -mt-1" viewBox="0 0 16 16">
                                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                    </svg>
                                    <div class="prose text-sm">
                                        <div class="font-bold">
                                            Choose a different tour
                                        </div>
                                        You can select a new tour run by the same operator up to 30 days before departure.
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>

                    </div>

                    <div id="sticky-price" class="hidden sticky" style="top:10rem;">
                        @include('front.elements.price_card')
                    </div>


                    @push('scripts')
                        <script>
                            const stickyPrice = document.querySelector('#sticky-price');
                            const asideIO = new IntersectionObserver(
                                (entries, observer) => {
                                    if(!entries[0].isIntersecting) {
                                        stickyPrice.classList.add('lg:block');
                                    } else {
                                        stickyPrice.classList.remove('lg:block');
                                    };
                                },
                                {}
                            );
                            asideIO.observe(document.querySelector('#aside-contents'));
                        </script>
                    @endpush
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
                        @forelse ($trip->similar_trips as $similar_trip)
                            @include('front.elements.tour-card', ['tour' => $similar_trip])
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
            let groupDepartureStatus = true;
            let privateDepartureList = [];
            let groupDepartureList = [];
            $(".select-date-departure").on('click', function(event) {
                const dateStr = $(this).data('date');
                filterDepartureByMonth(dateStr);
            });
            const trip_departures = @json($trip_departures ?? []);
            const trip = @json($trip);

            $("#group-departure").on('click', function(event) {
                document.getElementById("private-departure").classList.remove('text-primary', 'border-primary');
                document.getElementById("group-departure").classList.add('text-primary', 'border-primary');
                showGroupDeparture();
                groupDepartureStatus = true;
            });

            $("#private-departure").on('click', function(event) {
                document.getElementById("group-departure").classList.remove('text-primary', 'border-primary');
                document.getElementById("private-departure").classList.add('text-primary', 'border-primary');
                showPrivateDeparture();
                groupDepartureStatus = false;
            });

            function showGroupDeparture() {
                $('#show-more-departure-button').hide();
                let html = "";
                let filteredDepartures = trip_departures;
                if (filteredDepartures.length > 0) {
                    groupDepartureList = trip_departures;
                    $("#departure-filter-block").html(html);
                    displayMoreGroupDepartureItems(groupDepartureList, 10);
                } else {
                    html = "No departures found.";
                    $("#departure-filter-block").html(html);
                }
            }

            function showPrivateDeparture(month = 1) {
                const trip_days = {!! json_encode($trip->duration) !!};
                const dateList = [];
                let next = true;
                let startDate = convertToTimestamp(`2024-0${month}-01`);
                while (next) {
                    const generateDate = getDateRangeForGap(startDate, parseInt(trip_days));
                    dateList.push(generateDate);
                    startDate = getNextDayTimestamp(generateDate.start);
                    if (!isTimestampInMonth(startDate, month)) {
                        next = false;
                    }
                }
                privateDepartureList = dateList;
                let html = "";
                $("#departure-filter-block").html(html);
                displayMorePrivateDepartureItems(privateDepartureList, 10);
            }

            function displayMoreGroupDepartureItems(items, limit) {
                const itemsContainer = document.getElementById('departure-filter-block');
                // Display the first 'limit' items
                for (let i = 0; i < limit && i < items.length; i++) {
                    const item = items[i];
                    let urlroute = `{{ route('front.trips.departure-booking', ['slug' => 'TRIP_SLUG', 'id' => 'DEPARTURE_ID']) }}`;
                        urlroute = urlroute.replace('TRIP_SLUG', trip.slug);
                        urlroute = urlroute.replace('DEPARTURE_ID', item.id);
                        listItem = `<div class="grid grid-cols-2 lg:grid-cols-5 lg:place-items-center gap-4 relative p-4 border border-gray-100 rounded hover:border-primary">
                            <div class="absolute top-0 left-4 border border-gray-100 bg-white px-1 rounded-full text-xs text-gray-400" style="translate: 0 -50%;">Group</div>
                            <div class="absolute top-0 right-0 w-10 h-10 rounded overflow-hidden">
                                <div class="bg-red-600 w-16 text-white text-xs px-1 pt-4 text-center" style="rotate: 45deg; margin-top: -8px">-10%</div>
                            </div>
                            <div>
                                <div class="font-bold">${formatDate(item.from_date)}</div>
                                <div class="text-sm text-gray-400">From ${trip.starting_point}</div>
                            </div>
                            <div>
                                <div class="font-bold">${formatDate(item.to_date)}</div>
                                <div class="text-sm text-gray-400">To ${trip.ending_point}</div>
                            </div>
                            <div>
                                <div class="font-bold">${item.seats}</div>
                                <div class="text-sm text-gray-400">people booked</div>
                            </div>
                            <div>
                                <div class="font-bold">From <span class="text-red"><s>US $ ${numberFormatFromString(trip.cost)}</s></span></div>
                                <div class="font-bold text-lg">US$ ${numberFormatFromString(item.price)}</div>
                                <div class="text-sm"><span class="text-gray-400">Saving </span>US$ ${numberFormatFromString(trip.cost - item.price)}</div>
                            </div>
                            <div class="flex items-center">
                                <a href="${urlroute}" class="border border-primary py-2 px-3 text-sm text-primary rounded hover:bg-primary hover:text-white">Book Now</a>
                            </div>
                        </div>`;
                    $(itemsContainer).append(listItem);
                }

                // If there are more items, add a "Show More" button
                if (items.length > limit) {
                    groupDepartureList = groupDepartureList.slice(limit);
                    $('#show-more-departure-button').show();
                } else {
                    $('#show-more-departure-button').hide();
                }
            }

            function displayMorePrivateDepartureItems(items, limit) {
                const itemsContainer = document.getElementById('departure-filter-block');
                // Display the first 'limit' items
                for (let i = 0; i < limit && i < items.length; i++) {
                    const item = items[i];
                    let urlroute = `{{ route('front.trips.private-departure-booking', ['slug' => 'TRIP_SLUG', 'date' => 'DEPARTURE_DATE']) }}`;
                    urlroute = urlroute.replace('TRIP_SLUG', trip.slug);
                    urlroute = urlroute.replace('DEPARTURE_DATE', item.start);
                    const listItem = `<div class="grid grid-cols-2 lg:grid-cols-5 lg:place-items-center gap-4 relative p-4 border border-gray-100 rounded hover:border-primary">
                            <div class="absolute top-0 left-4 border border-gray-100 bg-white px-1 rounded-full text-xs text-gray-400" style="translate: 0 -50%;">Private</div>
                            <div class="absolute top-0 right-0 w-10 h-10 rounded overflow-hidden">
                                <div class="bg-red-600 w-16 text-white text-xs px-1 pt-4 text-center" style="rotate: 45deg; margin-top: -8px">-10%</div>
                            </div>
                            <div>
                                <div class="font-bold">${convertToFormattedDate(item.start)}</div>
                                <div class="text-sm text-gray-400">From ${trip.starting_point}</div>
                            </div>
                            <div>
                                <div class="font-bold">${convertToFormattedDate(item.end)}</div>
                                <div class="text-sm text-gray-400">To ${trip.ending_point}</div>
                            </div>
                            <div>
                                <div class="font-bold text-lg">US$ ${numberFormatFromString(((trip.offer_price != "")? trip.offer_price: trip.cost))}</div>
                            </div>
                            <div class="flex items-center">
                                <a href="${urlroute}" class="border border-primary py-2 px-3 text-sm text-primary rounded hover:bg-primary hover:text-white">Book Now</a>
                            </div>
                        </div>`;
                    $(itemsContainer).append(listItem);
                }

                // If there are more items, add a "Show More" button
                if (items.length > limit) {
                    privateDepartureList = privateDepartureList.slice(limit);
                    $('#show-more-departure-button').show();
                } else {
                    $('#show-more-departure-button').hide();
                }
            }

            $("#show-more-departure-button").on('click', function(event) {
                if (groupDepartureStatus) {
                    displayMoreGroupDepartureItems(groupDepartureList, 10); // Display the next set of items
                } else {
                    displayMorePrivateDepartureItems(privateDepartureList, 10); // Display the next set of items
                }
            });

            $("#private-departure").click();

            function isTimestampInMonth(timestamp, targetMonth) {
                const date = new Date(timestamp * 1000);
                const month = date.getMonth() + 1; // Adding 1 to match the input targetMonth (1-based)

                return month === targetMonth;
            }

            function getNextDayTimestamp(timestamp) {
                const currentDate = new Date(timestamp * 1000);
                const nextDate = new Date(currentDate);
                nextDate.setDate(currentDate.getDate() + 1);

                const nextDayTimestamp = Math.floor(nextDate.getTime() / 1000);
                return nextDayTimestamp;
            }

            function convertToTimestamp(dateString) {
                    const timestamp = Math.floor(Date.parse(dateString) / 1000);
                    return timestamp;
                }

            function convertToFormattedDate(timestamp) {
                const date = new Date(timestamp * 1000); // Convert timestamp to milliseconds
                const options = { day: 'numeric', month: 'short', year: 'numeric' };
                return date.toLocaleDateString('en-US', options);
            }

            function getDateRangeForGap(startTimestamp, gap) {
                const startDateObj = new Date(startTimestamp * 1000);
                const endDateObj = new Date(startDateObj.getFullYear(), startDateObj.getMonth(), startDateObj.getDate() + gap - 1);

                const startTimestampResult = Math.floor(startDateObj.getTime() / 1000);
                const endTimestampResult = Math.floor(endDateObj.getTime() / 1000);

                return { start: startTimestampResult, end: endTimestampResult };
            }

            $("#all-departure-filter").on('click', function(event) {
                filterDepartureByMonth("all");
            });

            function filterDepartureByMonth(dateStr) {
                let html = "";

                let filteredDepartures = trip_departures;
                // Get the month from the startTimestamp
                if (groupDepartureStatus) {
                    if (dateStr !== "all") {
                        const startMonth = new Date(dateStr * 1000).getMonth() + 1; // Adding 1 because months are zero-based
                        // Filter the array based on the start date in PHP strtotime format
                        filteredDepartures = trip_departures.filter(departure => {
                            const departureMonth = new Date(departure.from_date.replace(/-/g, '/')).getMonth() + 1; // Adding 1 because months are zero-based
                            return departureMonth === startMonth
                        });
                    }
                    if (filteredDepartures.length > 0) {
                        $.each(filteredDepartures, (i, departure) => {
                            let urlroute = "{{ route('front.trips.departure-booking', ['slug' => 'TRIP_SLUG', 'id' => 'DEPARTURE_ID']) }}";
                            urlroute = urlroute.replace('TRIP_SLUG', trip.slug);
                            urlroute = urlroute.replace('DEPARTURE_ID', departure.id);
                            html += `<div class="grid grid-cols-2 lg:grid-cols-5 lg:place-items-center gap-4 relative p-4 border border-gray-100 rounded hover:border-primary">
                                <div class="absolute top-0 left-4 border border-gray-100 bg-white px-1 rounded-full text-xs text-gray-400" style="translate: 0 -50%;">Group</div>
                                <div class="absolute top-0 right-0 w-10 h-10 rounded overflow-hidden">
                                    <div class="bg-red-600 w-16 text-white text-xs px-1 pt-4 text-center" style="rotate: 45deg; margin-top: -8px">-10%</div>
                                </div>
                                <div>
                                    <div class="font-bold">${formatDate(departure.from_date)}</div>
                                    <div class="text-sm text-gray-400">From ${trip.starting_point}</div>
                                </div>
                                <div>
                                    <div class="font-bold">${formatDate(departure.to_date)}</div>
                                    <div class="text-sm text-gray-400">To ${trip.ending_point}</div>
                                </div>
                                <div>
                                    <div class="font-bold">${departure.seats}</div>
                                    <div class="text-sm text-gray-400">people booked</div>
                                </div>
                                <div>
                                    <div class="font-bold">From <span class="text-red"><s>US $ ${numberFormatFromString(trip.cost)}</s></span></div>
                                    <div class="font-bold text-lg">US$ ${numberFormatFromString(departure.price)}</div>
                                    <div class="text-sm"><span class="text-gray-400">Saving </span>US$ ${numberFormatFromString(trip.cost - departure.price)}</div>
                                </div>
                                <div class="flex items-center">
                                    <a href="${urlroute}" class="border border-primary py-2 px-3 text-sm text-primary rounded hover:bg-primary hover:text-white">Book Now</a>
                                </div>
                            </div>`;
                        })
                    } else {
                        html = "No departures found.";
                    }
                    console.log(filteredDepartures);
                    $("#departure-filter-block").html(html);
                } else {
                    // private
                    let startMonth = 1;
                    if (dateStr !== "all") {
                        startMonth = new Date(dateStr * 1000).getMonth() + 1;
                    }
                    showPrivateDeparture(startMonth);
                }
            }

            function formatDate(date) {
                return new Date(date.replace(/-/g, '/')).toLocaleDateString('en-GB', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric'
                    });
            }

            function numberFormatFromString(price) {
                return parseInt(price, 10).toLocaleString();
            }
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
