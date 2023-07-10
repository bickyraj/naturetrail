@extends('layouts.front')
@section('content')
<!-- Hero -->
<section class="hero hero-alt relative">
    <img src="{{ $blog->imageUrl }}" alt="" style="border-radius: 0px;height: 80vh;">
    <div class="overlay absolute">
        <div class="container ">
            <h1 style="font-size: calc(2vw + 1rem);">{{ $blog->name }}</h1>
            <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb fs-sm wrap">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('front.blogs.index') }}">Blog</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $blog->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
</section>

<section class="tour-details mb-4">
    <div class="container mt-2">
        <div class="tour-details-section lim">
            {!! $blog->description !!}
        </div>
    </div>

</section>
@if ($contents)
<section class="news">
    <div class="container">
        <h2>Table of Content</h2>
        <div class="row">
            @if(!empty($contents))
                @include('bickyraj.toc.table', $contents)
            @endif
        </div>
    </div>
    <div class="container">
        {!! $body !!}
    </div>
</section>
@endif

<!-- similar blogs -->
@if (isset($blog->similar_blogs) && !empty($similar_blogs)))
<section class="news mb-5 mt-20 bg-gray">
    <div class="container">
        <h2 class="relative pr-10 text-3xl font-bold uppercase lg:text-5xl text-gray-600 font-display pb-10 pt-10">Similar Blogs</h2>
        <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
        <div class="grid lg:grid-cols-3 gap-2 xl:gap-3">
            @forelse ($blog->similar_blogs as $s_blog)
                <a href="{{ route('front.blogs.show', ['slug' => $s_blog->slug]) }}">
                    <div class="article">
                        <div class="image">
                            <img src="{{ $s_blog->imageUrl }}" alt="">
                        </div>
                        <div class="content">
                            <h2>{{ $s_blog->name }}</h2>
                            <p class="fs-sm">{{ truncate(strip_tags($s_blog->description)) }}</p>
                        </div>
                    </div>
                </a>
            @empty
            @endforelse
        </div>
    </div>
</section>
@endif

<!-- Latest News -->
<section class="news mb-5 mt-20 bg-gray">
    <div class="container">
        <h2 class="relative pr-10 text-3xl font-bold uppercase lg:text-5xl text-gray-600 font-display pb-10 pt-10">Latest Travel Blogs</h2>
        <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
        <div class="grid lg:grid-cols-3 gap-2 xl:gap-3">
            @forelse ($blogs as $blog)
                <a href="{{ route('front.blogs.show', ['slug' => $blog->slug]) }}">
                    <div class="article">
                        <div class="image">
                            <img src="{{ $blog->imageUrl }}" alt="">
                        </div>
                        <div class="content">
                            <h2>{{ $blog->name }}</h2>
                            <p class="fs-sm">{{ truncate(strip_tags($blog->description)) }}</p>
                        </div>
                    </div>
                </a>
            @empty
            @endforelse
        </div>
    </div>
</section>
@endsection
