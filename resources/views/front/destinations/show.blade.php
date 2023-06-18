@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.css">
@endpush
@extends('layouts.front_inner')
@section('meta_og_title'){!! $seo->meta_title??'' !!}@stop
@section('meta_description'){!! $seo->meta_description??'' !!}@stop
@section('meta_keywords'){!! $seo->meta_keywords??'' !!}@stop
@section('meta_og_url'){!! $seo->canonical_url??'' !!}@stop
@section('meta_og_description'){!! $seo->meta_description??'' !!}@stop
@section('meta_og_image'){!! $seo->socialImageUrl??'' !!}@stop
@section('content')
<!-- Hero -->
<section class="hero hero-alt relative">
    <img src="{{ $destination->imageUrl }}" alt="">
    <div class="overlay absolute">
        <div class="container ">
            <h1 style="text-align: center;">{{ $destination->name }}</h1>
            <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb fs-sm wrap">
                       {{-- <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $destination->name }}</li>
                        --}}
                    </ol>
                </nav>
            </div>

        </div>
</section>

<section class="pt-5">
    <div class="container" style="padding-top: 20px;max-width: 1100px;">
        <div class="mb-4">
            @if((strip_tags($destination->description) != ""))
            <div class="tour-details-section mb-4 relative" x-data="{ expanded: false }">
                <div x-show="expanded" class="prose mx-auto pb-20" x-collapse.min.427px><?= $destination->description; ?></div>
                <div class="flex justify-center absolute bottom-0 w-full py-4" style="background: linear-gradient(to top, rgba(255,255,255,1), rgba(255,255,255,0));"><button class="text-xs bg-light rounded-full px-4 py-2" x-on:click="expanded=!expanded" x-text="expanded?'Show less':'Show more'">Show more</button></div>
            </div>
            @endif
        </div>
    </div>

        {{-- Activities --}}
    <div class="py-10 activities bg-gray">
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


    {{-- Travel Guide --}}
    <div class="relative py-10">
        <div class="container">
            <div class="grid gap-4 lg:grid-cols-2">
                <div class="lg:pr-10 prose">
                    <h2>
                        <div class="mb-2 text-2xl font-handwriting text-primary">The Definitive</div>
                        <div class="text-gray-600 text-3xl font-display font-bold uppercase lg:text-5xl">{{ $destination->name }} Travel Guide</div>
                    </h2>
                   {{-- <p>{!! $destination->tour_guide_description !!}</p> --}}
                     <p>Nepal, a land of rugged mountains, vibrant culture, and spiritual enlightenment, offers a mesmerizing experience for travelers seeking adventure, serenity, and cultural immersion. This definitive travel guide aims to provide you with essential information and insights to make your journey to Nepal an unforgettable one. From the majestic Himalayas to the ancient temples and bustling markets, Nepal promises a diverse range of experiences for every traveler.</p>

                    <p>To begin your exploration, the Himalayas stand as Nepal's crown jewel, offering breathtaking vistas and thrilling treks. Mount Everest, the world's highest peak, beckons adventure enthusiasts to conquer its summit, while the Annapurna Circuit invites trekkers to experience the mesmerizing beauty of the Annapurna mountain range. Whether you're an experienced mountaineer or a beginner hiker, Nepal offers a range of trekking options suited to various skill levels. </p>

                    <a href="https://naturetrail.manojpanta.com.np/nepal-travel-info" class="btn btn-accent" style="text-decoration:none;">View Full Guide</a>
                </div>
                @if (!empty($destination->tour_guide_image_name))
                    <div class="lg:absolute w-full lg:w-1/2 right-0"><img src="{{ $destination->tour_guide_image_url }}" style="padding-top: 44px;"></div>
                @else
                    <div class="lg:absolute w-full lg:w-1/2 right-0"><img src="{{ asset('assets/front/img/nepal.webp') }}" style="padding-top: 44px;"></div>
                @endif
            </div>
        </div>
    </div>{{-- Travel Guide --}}


        <div class="bg-gray">
    <div class="container" style="padding-top: 20px;padding-bottom: 20px;">
        <div class="mb-4" id="searchDiv">
            <div class="grid lg:grid-cols-3 gap-2">
                {{-- <div class="col-lg-4 pb-8">
                    <div class="form-group">
                        <label for="" style="color: #000;">Destinations</label>
                        <select name="" id="select-destination" class="custom-select">
                          <option value="" selected>All Destinations</option>
                          @if($destinations)
                            @foreach($destinations as $dest)
                            <option value="{{ $dest->id }}">{{ $dest->name }}</option>
                            @endforeach
                          @endif
                        </select>
                    </div>
                </div> --}}
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" style="color: #000;">Activities</label>
                        <select name="" id="select-activity" class="custom-select">
                          <option value="" selected>All activities</option>
                          @if($activities)
                            @foreach($activities as $act)
                            <option value="{{ $act->id }}">{{ $act->name }}</option>
                            @endforeach
                          @endif
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" style="color: #000;">Sort by</label>
                        <select name="" id="select-sort" class="custom-select">
                            <option value="asc">Price (low to high)</option>
                            <option value="desc" selected>Price (high to low)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Results -->
    </div>
    </div>
    <div class="bg-light">
        <div class="container py-4">
            <div id="tirps-block" class="grid md:grid-cols-2 lg:grid-cols-3 gap-2 xl:gap-3">
            </div>
        </div>
        <div class="flex items-center" style="justify-content: center; margin-top: 50px;">
            <div id="spinner-block"></div>
            <button id="show-more" class="btn btn-accent" style="display: block; margin-bottom: 50px;">show more</button>
        </div>
    </div>
</section>


    @include('front.elements.plan_trip')

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.js"></script>
<script type="text/javascript">
    let destination_id = "{!! $destination->id ?? ''  !!}";
    let xhr;
    let typingTimer;
    const debounceTime = 500;
    let totalPage;
    let nextPage;
    let currentPage = 1;
    $(document).ajaxStart(function(){
    });

  /* Gets called when request is sent */
  $(document).ajaxSend(function(evt, req, set){
  });

  /* Gets called when request complete */
  $(document).ajaxComplete(function(event,request,settings){
  });

  filter();
  $(".custom-select").on('change', function(event) {
    filter();
  });

  $("#show-more").on('click', async function(event) {
        event.preventDefault();
        if (nextPage) {
            currentPage++;
            await paginate(currentPage);
            if (!nextPage) {
                $("#show-more").hide();
            }
        }
    });


  async function paginate(page) {
        return new Promise((resolve, reject) => {
            var keyword = $("#search-keyword").val();
            var activity_id = $("#select-activity").val();
            var sortBy = $("#select-sort").val();
            // const url = "{!! route('front.destinations.index') !!}" + "?page=" + page + "&keyword=" + keyword;
            const url = "{{ route('front.trips.filter') }}" + "?page=" + currentPage + "&destination_id=" + destination_id + "&activity_id=" + activity_id + "&sortBy=" + sortBy;
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                async: "false",
                beforeSend: function(xhr) {
                    var spinner = '<button style="margin:0 auto;" class="btn btn-sm btn-primary text-white" type="button" disabled>\
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\
                                Loading Destinations...\
                                </button>';
                    $("#spinner-block").html(spinner);
                    $("#show-more").hide();
                },
                success: function(res) {
                    if (res.success) {
                        $("#tirps-block").append(res.data);
                        nextPage = res.pagination.next_page;
                    }
                }
            }).done(function( data ) {
                $("#spinner-block").html('');
                $("#show-more").show();
                resolve(true);
            });
        });
    }

  function filter() {
    currentPage = 1;
    var activity_id = $("#select-activity").val();
    var sortBy = $("#select-sort").val();
    var url = "{{ url('trips/filter') }}" + "?page=" + currentPage + "&destination_id=" + destination_id + "&activity_id=" + activity_id + "&sortBy=" + sortBy;
    $.ajax({
      url: url,
      type: "GET",
      dataType: "json",
      //data: data,
      async: "false",
      beforeSend: function(xhr) {
        var spinner = '<button style="margin:0 auto;" class="btn btn-sm btn-primary text-white" type="button" disabled>\
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\
                      Loading Trips...\
                    </button>';
                    $("#spinner-block").html(spinner);
                    $("#show-more").hide();
      },
      success: function(res) {
        if (res.success) {
          $("#tirps-block").html(res.data);
          totalPage = res.pagination.total;
            currentPage = res.pagination.current_page;
            nextPage = res.pagination.next_page;
        }
      }
    }).done(function( data ) {
        $("#spinner-block").html('');
        if (!nextPage) {
            $("#show-more").hide();
        } else {

            $("#show-more").show();
        }
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
  }
</script>
@endpush
