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
    <img src="{{ $activity->imageUrl }}" alt="">
    <div class="absolute top-1/2 w-full">
        <div class="container ">

           {{-- <div class="text-2xl text-white text-center">Activities</div> --}}
            <h1 style="text-align: center;">{{ $activity->name }}</h1>
            {{-- <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb fs-sm wrap">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $activity->name }}</li>
                    </ol>
                </nav>
            </div> --}}
        </div>
</section>

<section class="pt-5">
    <div class="container" style="padding-top: 40px; max-width:1100px;">
        <div class="mb-4">
            @if((strip_tags($activity->description) != ""))
            <div class="mb-4 relative" x-data="{ expanded: false }">
                <div x-show="expanded" class="pb-20" x-collapse.min.200px><?= $activity->description; ?></div>
                <div class="flex justify-center absolute bottom-0 w-full py-4" style="background: linear-gradient(to top, rgba(255,255,255,1), rgba(255,255,255,0));"><button class="text-xs bg-light rounded-full px-4 py-2" x-on:click="expanded=!expanded" x-text="expanded?'Show less':'Show more'">Show more</button></div>
            </div>
            @endif
        </div>
    </div>

    {{-- Things to do --}}
    @if ($activity->id == 9)
        @if(isset($sub_activities) && !empty($sub_activities))
        <div class="py-10 activities bg-gray">
            <div class="container">
                <div class="items-center justify-between gap-20 mb-4 lg:flex">
                    <div>
                        {{-- <p class="mb-2 text-2xl font-handwriting text-primary">Choose your region</p> --}}
                        <div class="flex">
                            <h2 class="relative pr-10 mb-8 text-3xl font-bold text-gray-600 uppercase lg:text-5xl font-display">
                                Things To Do
                                <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                            </h2>
                        </div>
                    </div>
                    <div class="flex gap-10 things-to-do-slider-controls">
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
                <div class="things-to-do-slider">
                    @forelse ($sub_activities as $sub_activity)
                        <div>
                            <a href="{{ $sub_activity->link }}" class="activity">
                                <div class="relative">
                                    <img src="{{ $sub_activity->imageUrl }}" alt="{{ $sub_activity->name }}" class="block w-full">
                                    <div class="text absolute text-white px-2 py-4">
                                        <h2 class="font-display uppercase">{{ $sub_activity->name }}</h2>
                                        <div class="tours">
                                            <span class="fs-xl bold">{{ $sub_activity->trips->count() }}</span>
                                            <span class="fs-sm">tours</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
        @endif
    @endif
    {{-- end of things to do --}}

    {{-- Find Climbing & Expeditions By  Level --}}
    @if ($activity->id == 3)
        @if(isset($sub_activities) && !empty($sub_activities))
        <div class="py-10 activities bg-gray">
            <div class="container">
                <div class="items-center justify-between gap-20 mb-4 lg:flex">
                    <div>
                        {{-- <p class="mb-2 text-2xl font-handwriting text-primary">Choose your region</p> --}}
                        <div class="flex">
                            <h2 class="relative pr-10 mb-8 text-3xl font-bold text-gray-600 uppercase lg:text-5xl font-display">
                                Find Climbing & Expeditions By  Level
                                <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                            </h2>
                        </div>
                    </div>
                    <div class="flex gap-10 sub-activities-slider-controls">
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
                <div class="sub-activities-slider">
                    @forelse ($sub_activities as $sub_activity)
                        <div>
                            <a href="{{ $sub_activity->link }}" class="activity">
                                <div class="relative">
                                    <img src="{{ $sub_activity->imageUrl }}" alt="{{ $sub_activity->name }}" class="block w-full">
                                    <div class="text absolute text-white px-2 py-4">
                                        <h2 class="font-display uppercase">{{ $sub_activity->name }}</h2>
                                        <div class="tours">
                                            <span class="fs-xl bold">{{ $sub_activity->trips->count() }}</span>
                                            <span class="fs-sm">tours</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
        @endif
    @endif
    {{-- end of Find Climbing & Expeditions By  Level --}}
    
    {{-- Climbing & Expeditions only --}}
    @if ($activity->id == 3)
    <div class="py-20 bg-gradient">
        <div class="container">
            <div class="grid lg:grid-cols-2 gap-10">
                <div class="flex flex-col justify-center w-full h-full">
                    <p class="mb-2 text-xl font-handwriting text-gray-600 uppercase">Available for rental</p>
                    <h2 class="mb-10 text-3xl lg:text-4xl text-primary">Climbing and Expedition Gears</h2>
                    <div class="tour-details">
                        <ul class="columns includes">
                            <li>Mountaineering Boots</li>
                            <li>Crampons</li>
                            <li>Ice Axe</li>
                            <li>Climbing Harness</li>
                            <li>Ropes</li>
                            <li>Carabiners</li>
                            <li>Helmet</li>
                            <li>Mountaineering Clothing</li>
                            <li>Down Jacket</li>
                            <li>Gloves</li>
                            <li>Goggles</li>
                            <li>High-Altitude Tent</li>
                            <li>Sleeping Bag</li>
                            <li>Oxygen System</li>
                            <li>Climbing Backpack</li>
                            <li>Headlamp</li>
                            <li>Cooking Equipment</li>
                            <li>Personal Protective Equipment (PPE)</li>
                        </ul>
                    </div>
                </div>
                <div class="flex flex-col justify-center w-full h-full">
                    <img src="{{ asset('assets/front/img/mountaineering-gear.png') }}" >
                </div>
            </div>
        </div>
    </div>
    @endif
    {{-- Climbing & Expeditions only --}}

    {{-- Find Climbing & Expeditions By Regions --}}
    @if ($activity->id == 3)
        @if(isset($find_climbing_expedition_regions) && !empty($find_climbing_expedition_regions))
        <div class="py-10 activities bg-white">
            <div class="container">
                <div class="items-center justify-between gap-20 mb-4 lg:flex">
                    <div>
                        {{-- <p class="mb-2 text-2xl font-handwriting text-primary">Choose your region</p> --}}
                        <div class="flex">
                            <h2 class="relative pr-10 mb-8 text-3xl font-bold text-gray-600 uppercase lg:text-5xl font-display">
                                Find Climbing & Expeditions By Regions
                                <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                            </h2>
                        </div>
                    </div>
                    <div class="flex gap-10 expedition-slider-controls">
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
                <div class="expedition-slider">
                    @forelse ($find_climbing_expedition_regions as $expedition_region)
                        <div>
                            <a href="{{ $expedition_region->link }}" class="activity">
                                <div class="relative">
                                    <img src="{{ $expedition_region->imageUrl }}" alt="{{ $expedition_region->name }}" class="block w-full">
                                    <div class="text absolute text-white px-2 py-4">
                                        <h2 class="font-display uppercase">{{ $expedition_region->name }}</h2>
                                        <div class="tours">
                                            <span class="fs-xl bold">{{ $expedition_region->trips->count() }}</span>
                                            <span class="fs-sm">tours</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
        @endif
    @endif
    {{-- end of Find Climbing & Expeditions By Regions --}}

    {{-- Activities --}}
    @if($activity->id == 1)
    <div class="py-10 activities bg-gray">
        <div class="container">
             <div class="items-center justify-between gap-20 mb-4 lg:flex">
                <div>
                    {{-- <p class="mb-2 text-2xl font-handwriting text-primary">Choose your region</p> --}}
                    <div class="flex">
                        <h2 class="relative pr-10 mb-8 text-3xl font-bold text-gray-600 uppercase lg:text-5xl font-display">
                            Regions
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
                @forelse ($regions as $region)
                    <div>
                        <a href="{{ $region->link }}" class="activity">
                            <div class="relative">
                                <img src="{{ $region->imageUrl }}" alt="{{ $region->name }}" class="block w-full">
                                <div class="text absolute text-white px-2 py-4">
                                    <h2 class="font-display uppercase">{{ $region->name }}</h2>
                                    <div class="tours">
                                        <span class="fs-xl bold">{{ $region->trips->count() }}</span>
                                        <span class="fs-sm">tours</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>{{-- Activities --}}
    @endif

    <div class="gray" style="background: var(--primary);">
        <div class="container" style="padding-top: 20px;">
            <div class="mb-4 flex justify-end" id="searchDiv">
                <div class="form-group items-center flex gap-2">
                    <label for="sort" class="whitespace-nowrap">Sort by</label>
                    <select name="sort" id="select-sort" class="p-2 text-sm">
                        <option value="asc">Price (low to high)</option>
                        <option value="desc">Price (high to low)</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-light">
        <div class="container py-4">
            <div id="tirps-block" class="grid md:grid-cols-2 lg:grid-cols-3 gap-2 xl:gap-8">
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
    let activity_id = "{!! $activity->id ?? ''  !!}";
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
            var sortBy = $("#select-sort").val();
            const url = "{{ route('front.trips.filter') }}" + "?page=" + currentPage + "&activity_id=" + activity_id + "&sortBy=" + sortBy;
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
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
    var sortBy = $("#select-sort").val();
    var url = "{{ url('trips/filter') }}" + "?page=" + currentPage + "&activity_id=" + activity_id + "&sortBy=" + sortBy;
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
  }

  if (document.getElementsByClassName('activities-slider').length > 0) {
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
      });
  }

  if (document.getElementsByClassName('sub-activities-slider').length > 0) {
      const subactivitiesSlider = tns({
          container: '.sub-activities-slider',
          nav: false,
          controlsContainer: '.sub-activities-slider-controls',
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
      });
  }

  if (document.getElementsByClassName('expedition-slider').length > 0) {
      const subactivitiesSlider = tns({
          container: '.expedition-slider',
          nav: false,
          controlsContainer: '.expedition-slider-controls',
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
      });
  }
  if (document.getElementsByClassName('things-to-do-slider').length > 0) {
      const thingsToDoSlider = tns({
          container: '.things-to-do-slider',
          nav: false,
          controlsContainer: '.things-to-do-slider-controls',
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
      });
  }
</script>
@endpush
