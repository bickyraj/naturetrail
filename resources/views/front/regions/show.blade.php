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
    <img src="{{ $region->imageUrl }}" alt="">
    <div class="absolute top-1/2 w-full">
        <div class="container text-center">
            <div class="text-2xl text-white text-center">Regions</div>
            <h1 style="max-width: unset;">{{ $region->name }}</h1>
        </div>
    </div>
</section>

<section class="pt-5">
    <div class="container" style="padding-top: 70px;">
        <div class="mb-10">
            @if((strip_tags($region->description) != ""))
            <div class="prose mx-auto text-center">
              <?= $region->description; ?>
            </div>
            @endif
        </div>
        <div class="mb-4" id="searchDiv">
            <div class="max-w-5xl mx-auto grid lg:grid-cols-3 gap-4">
                {{-- <div class="col-lg-4">
                    <div class="form-group">
                        <label for="">Destinations</label>
                        <select name="" id="select-destination" class="custom-select">
                          <option value="" selected>All Destinations</option>
                          @if($destinations)
                            @foreach($destinations as $dest)
                            <option value="{{ $dest->id }}">{{ $dest->name }}</option>
                            @endforeach
                          @endif
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="">Activities</label>
                        <select name="" id="select-activity" class="custom-select">
                          <option value="" selected>All activities</option>
                          @if($activities)
                            @foreach($activities as $activity)
                            <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                            @endforeach
                          @endif
                        </select>
                    </div>
                </div> --}}
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="">Sort by</label>
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
    <div class="bg-light">
        <div class="container py-20">
            <div id="tirps-block" class="grid md:grid-cols-2 lg:grid-cols-3 gap-2 xl:gap-8">
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
    let region_id = "{!! $region->id ?? ''  !!}";
    let xhr;
    let typingTimer;
    const debounceTime = 500;
    let totalPage;
    let nextPage;
    let currentPage = 1;

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
            const url = "{{ route('front.trips.filter') }}" + "?page=" + currentPage + "&region_id=" + region_id + "&sortBy=" + sortBy;
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
    var url = "{{ url('trips/filter') }}" + "?page=" + currentPage + "&region_id=" + region_id + "&sortBy=" + sortBy;
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
