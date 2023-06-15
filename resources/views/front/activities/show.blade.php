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
    <div class="overlay absolute">
        <div class="container ">
            <h1>{{ $activity->name }}</h1>
            <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb fs-sm wrap">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $activity->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
</section>

<section class="pt-5">
    <div class="container" style="padding-top: 70px;">
        <div class="lim mb-4">
            @if((strip_tags($activity->description) != ""))
            <div class="tour-details-section mb-4 relative" x-data="{ expanded: false }">
                <div x-show="expanded" class="pb-20" x-collapse.min.200px><?= $activity->description; ?></div>
                <div class="flex justify-center absolute bottom-0 w-full py-4" style="background: linear-gradient(to top, rgba(255,255,255,1), rgba(255,255,255,0));"><button class="text-xs bg-light rounded-full px-4 py-2" x-on:click="expanded=!expanded" x-text="expanded?'Show less':'Show more'">Show more</button></div>
            </div>
            @endif
        </div>
    </div>
    <div class="gray" style="background: var(--primary);">
    <div class="container" style="padding-top: 20px;">
        <div class="mb-4" id="searchDiv">
            <div class="grid lg:grid-cols-3 gap-2">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" style="color: #fff;">Sort by</label>
                        <select name="" id="select-sort" class="custom-select">
                            <option value="asc">Price (low to high)</option>
                            <option value="desc">Price (high to low)</option>
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
@endsection
@push('scripts')
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
</script>
@endpush
