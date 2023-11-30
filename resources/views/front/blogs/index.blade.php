@extends('layouts.front')
@section('content')
<!-- Hero -->
<section class="hero hero-alt relative">
    <img src="{{ asset('assets/front/img/hero.jpg') }}" alt="" >
    <div class="overlay absolute py-10">
        <div class="container ">
            <h1 class="mb-4">Blog</h1>
            <div class="breadcrumb-wrapper text-white">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb fs-sm wrap">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="https://www.naturetrail.com/blogs">Blog </a> | <a href="https://www.naturetrail.com"> News </a></li>
                    </ol>
                </nav>
            </div>
        </div>
</section>

<section class="news py-20">
    <div class="container">

        <div class="mb-10 grid lg:grid-cols-3 gap-2 lg:gap-6">
            @forelse ($blogs as $blog)
                @include('front.elements.blog-card')
            @empty
            @endforelse
        </div>

        {{ $blogs->links('pagination.default') }}
    </div>
</section>
@endsection
