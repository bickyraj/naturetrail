<?php
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
@push('styles')
<script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer></script>
@endpush
@section('content')
<!-- Hero -->
<section class="hero hero-alt relative">
    <img src="{{ asset('assets/front/img/hero.jpg') }}">
    <div class="overlay absolute">
        <div class="container py-10">
            <h1 class="mb-4">Reviews</h1>
            <div class="breadcrumb-wrapper text-white">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb fs-sm wrap">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Reviews</li>
                    </ol>
                </nav>
            </div>
        </div>
</section>

<section class="py-20">
    <div class="container">

        <div class="grid lg:grid-cols-3 gap-10 xl:gap-20">
            <div class="lg:col-span-2">
                <div class="text-xl text-center mb-10">
                    <div class="mb-2">
                        <svg class="h-6 text-accent" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" viewBox="0 0 80 16" fill="none">
                          <clipPath id="stars">
                            <path d="m2.864 14.354.001-.002.83-4.728L.172 6.268c-.329-.314-.158-.888.283-.95l4.898-.696L7.537.294a.512.512 0 0 1 .927 0l2.184 4.327 4.898.696c.442.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592l-4.389-2.256-4.39 2.256c-.386.197-.823-.148-.747-.591Zm16.001 0v-.002l.83-4.728-3.523-3.356c-.329-.314-.158-.888.283-.95l4.898-.696L23.537.294a.514.514 0 0 1 .927 0l2.184 4.327 4.898.696c.442.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592l-4.389-2.256-4.39 2.256c-.385.197-.823-.148-.746-.591Zm16 0v-.002l.83-4.728-3.523-3.356c-.329-.314-.158-.888.283-.95l4.898-.696L39.537.294a.513.513 0 0 1 .927 0l2.184 4.327 4.898.696c.442.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592l-4.389-2.256-4.39 2.256c-.385.197-.822-.148-.746-.591Zm16 0 .001-.002.83-4.728-3.523-3.356c-.329-.314-.158-.888.283-.95l4.898-.696L55.538.294a.512.512 0 0 1 .927 0l2.184 4.327 4.898.696c.442.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592l-4.389-2.256-4.39 2.256c-.386.197-.823-.148-.747-.591Zm16.001 0v-.002l.83-4.728-3.523-3.356c-.329-.314-.158-.888.283-.95l4.898-.696L71.538.294a.514.514 0 0 1 .927 0l2.184 4.327 4.898.696c.442.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592l-4.389-2.256-4.39 2.256c-.386.197-.823-.148-.746-.591Z"/>
                          </clipPath>
                          <rect id="fill" x="0" y="0" width="{{ $avg_rating / 5 * 80 }}" height="16" />
                          <path d="m2.864 14.354.001-.002.83-4.728L.172 6.268c-.329-.314-.158-.888.283-.95l4.898-.696L7.537.294a.512.512 0 0 1 .927 0l2.184 4.327 4.898.696c.442.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592l-4.389-2.256-4.39 2.256c-.386.197-.823-.148-.747-.591Zm16.001 0v-.002l.83-4.728-3.523-3.356c-.329-.314-.158-.888.283-.95l4.898-.696L23.537.294a.514.514 0 0 1 .927 0l2.184 4.327 4.898.696c.442.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592l-4.389-2.256-4.39 2.256c-.385.197-.823-.148-.746-.591Zm16 0v-.002l.83-4.728-3.523-3.356c-.329-.314-.158-.888.283-.95l4.898-.696L39.537.294a.513.513 0 0 1 .927 0l2.184 4.327 4.898.696c.442.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592l-4.389-2.256-4.39 2.256c-.385.197-.822-.148-.746-.591Zm16 0 .001-.002.83-4.728-3.523-3.356c-.329-.314-.158-.888.283-.95l4.898-.696L55.538.294a.512.512 0 0 1 .927 0l2.184 4.327 4.898.696c.442.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592l-4.389-2.256-4.39 2.256c-.386.197-.823-.148-.747-.591Zm16.001 0v-.002l.83-4.728-3.523-3.356c-.329-.314-.158-.888.283-.95l4.898-.696L71.538.294a.514.514 0 0 1 .927 0l2.184 4.327 4.898.696c.442.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592l-4.389-2.256-4.39 2.256c-.386.197-.823-.148-.746-.591Z" stroke="currentColor" stroke-width="1"/>
                          <use clip-path="url(#stars)" href="#fill" fill="currentColor">
                        </svg>
                    </div>
                    
                    {{ $avg_rating }} out of 5 ({{ $review_count }} reviews)
        
                    <div class="text-center mt-10"><a href="{{ route('front.reviews.create') }}" class="mb-4 btn btn-accent">Write a review</a></div>
                </div>

                <div class="grid gap-6">
                    @forelse ($reviews as $review)
                        <div class="p-4" x-data="{fullText: `{{ $review->review }}`}">
                            <div class="review__content">
                                <h2 class="mb-2 font-display text-2xl text-light-gray">{{ $review->title }}</h2>
                                <p class="italic" x-ref="review">
                                    {{ truncate($review->review, 400) }}
                                    @if (Str::length( $review->review) > 400)
                                        <button x-on:click="$refs.review.innerText=fullText"><span style="text-decoration: underline">more</span></button>
                                    @endif
                                </p>
                            </div>
                            <div class="flex items-center gap-6">
                                <div>
                                    <img src="{{ $review->thumbImageUrl }}" alt="">
                                </div>
                                <div>
                                    <div class="font-bold">{{ ucfirst($review->review_name) }}</div>
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
                    @empty
                    @endforelse
                </div>

                {{ $reviews->links('pagination.default') }}
            </div>
            <aside>
                <div class="mb-10">
                    <h2 class="mb-6 text-2xl uppercase font-display text-gray-600">Why Nature Trail?</h2>
                    <ul class="grid gap-4">
                        @php
                            $whys = ['28+ Years of Expertise', 'Best Price Guarantee', 'Tailor-made Trips', 'Safety assured'];
                        @endphp
                        @foreach ($whys as $why)
                            <li class="flex gap-4">
                                <svg class="flex-shrink-0 w-6 h-6 text-light-gray" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
                                </svg>
                                {{ $why }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                @include('front.elements.enquiry-form')
            </aside>
        </div>
    </div>

</section>
@endsection
@push('scripts')
<script>
    $(function() {
        var session_success_message = '{{ $session_success_message ?? '' }}';
        var session_error_message = '{{ $session_error_message ?? '' }}';
        if (session_success_message) {
          toastr.success(session_success_message);
        }

        if (session_error_message) {
          toastr.danger(session_error_message);
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
                if (grecaptcha.getResponse(0)) {
                    var btn = $(form).find('button[type=submit]').attr('disabled', true).html('Sending...');
                    setTimeout(() => {
                        form.submit();
                    }, 500);
                }else{
                    grecaptcha.reset(enquiry_captcha);
                    grecaptcha.execute(enquiry_captcha);
                }
            },
        });
    });

    function onSubmitEnquiry(token) {
        $("#enquiry-form").submit();
        return true;
    }

    let enquiry_captcha;
    var CaptchaCallback = function() {
        enquiry_captcha = grecaptcha.render('inquiry-g-recaptcha', {'sitekey' : '{!! config("constants.recaptcha.sitekey") !!}'});
        // review_captcha = grecaptcha.render('review-g-recaptcha', {'sitekey' : '{!! config("constants.recaptcha.sitekey") !!}'});
    };
</script>
@endpush
