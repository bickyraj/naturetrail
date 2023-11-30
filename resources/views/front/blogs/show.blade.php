@section('title', $blog->name)
@extends('layouts.front')
@section('content')
<!-- Hero -->
<section class="hero hero-alt relative">
    <img src="{{ $blog->imageUrl }}" alt="">
    <div class="overlay absolute py-10">
        <div class="container text-white">
            <h1 class="mb-4">{{ $blog->name }}</h1>
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
    </div>
</section>

<section class="container py-20 grid lg:grid-cols-3 gap-10 xl:gap-20">
    <div class="lg:col-span-2">

        @if($contents)
            <div class="prose">{!! $blog->description !!}</div>
            <div class="p-4 bg-gray">
                <h2>Table of Content</h2>
                <div class="row">
                    @if(!empty($contents))
                        @include('bickyraj.toc.table', $contents)
                    @endif
                </div>
            </div>

            <div class="prose">
                {!! $body !!}
            </div>
        @else
            <div class="prose">{!! $blog->description !!}</div>
            @endif
        <div class="prose mb-10">{!! $blog->description !!}</div>
        <div class="flex items-center gap-6 mb-10">
            <img src="{{ asset('assets/front/img/hero.jpg') }}" alt="" class="flex-shrink-0 w-20 h-20 bg-gray object-cover rounded-full">
            <div>
                <div class="font-bold text-lg text-light-gray">Author</div>
                <div class="text-gray">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, voluptates?
                </div>
            </div>
        </div>
        <div class="mb-10">
            <div class="font-bold text-lg mb-4 text-light-gray">Share this article</div>
            <ul class="flex gap-4">
                <li>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="text-light-gray hover:text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->name) }}&amp;url={{ url()->current() }}" class="text-light-gray hover:text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 16 16">
                            <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ url()->current() }}&amp;{{ urlencode($blog->name) }}" class="text-light-gray hover:text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 16 16">
                            <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="https://wa.me/?text={{ url()->current() }}" class="text-light-gray hover:text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                        </svg>
                    </a>
                </li>    
            </ul>
        </div>
    </div>

    <aside>
        <div class="mb-10">
            <h2 class="mb-6 text-2xl uppercase font-display text-gray-600">Latest articles</h2>
            <div class="grid gap-4">
                @foreach ($blogs as $blog)
                    <a href="{{ route('front.blogs.show', $blog) }}" class="hover:text-primary">
                        <h3>{{ $blog->name }}</h3>
                        <div class="text-light-gray text-sm">{{ ($blog->formatted_date) }}</div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="mb-10">
            {{-- <h2 class="mb-6 text-2xl uppercase font-display text-gray-600">Latest articles</h2> --}}
            <ul class="flex flex-wrap gap-6">
                <li><a href="#" class="p-2 bg-gray rounded-lg hover-text-primary">Adventure stories</a></li>
                <li><a href="#" class="p-2 bg-gray rounded-lg hover-text-primary">Trekking tips</a></li>
                <li><a href="#" class="p-2 bg-gray rounded-lg hover-text-primary">Promotions and discounts</a></li>
                <li><a href="#" class="p-2 bg-gray rounded-lg hover-text-primary">Tour reviews</a></li>
                <li><a href="#" class="p-2 bg-gray rounded-lg hover-text-primary">Culture</a></li>
                <li><a href="#" class="p-2 bg-gray rounded-lg hover-text-primary">Wildlife and nature</a></li>
            </ul>
        </div>
        @include('front.elements.enquiry-form')
    </aside>
</section>
<!-- similar blogs -->

@if (isset($blog->similar_blogs) && !empty($blog->similar_blogs))
<section class="news mb-5 bg-gray py-10">
    <div class="container">
        <h2 class="relative pr-10 text-3xl font-bold uppercase text-gray-600 font-display pb-10 pt-10">Latest Travel Blogs</h2>
        <div class="grid lg:grid-cols-3 gap-6">
            @forelse ($blog->similar_blogs as $s_blog)
                @include('front.elements.blog-card', ['blog' => $s_blog])
            @empty
            @endforelse
        </div>
    </div>
</section>
@endif
@endsection
