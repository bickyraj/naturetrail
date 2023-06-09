@extends('layouts.front')
@section('content')
<!-- Hero -->
<section class="hero hero-alt relative">
    <img src="{{ $blog->imageUrl }}" alt="" style="border-radius: 0px;height: 80vh;">
    <div class="overlay absolute">
        <div class="container ">
            <h1>{{ $blog->name }}</h1>
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

<!-- Latest News -->
<section class="news mb-5">
    <div class="container">

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
