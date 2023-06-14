@extends('layouts.front_inner')
@section('content')
<!-- Hero -->
<section class="hero hero-alt relative">
    <img src="{{ asset('assets/front/img/hero.jpg') }}" alt="">
    <div class="overlay absolute">
        <div class="container ">
            <h1>Activities</h1>
            <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb fs-sm wrap">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Activities</li>
                    </ol>
                </nav>
            </div>
        </div>
</section>

<section class="pt-5">
    <div class="container">
        <div class="mb-4" id="searchDiv">
            <div class="grid lg:grid-cols-3 gap-2">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="">Keywords</label>
                        <input id="search-keyword" type="text" placeholder="search by country" name="keywords">
                    </div>
                </div>
                {{-- <div class="col-lg-4">
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
                {{-- <div class="col-lg-4">
                    <div class="form-group">
                        <label for="">Sort by</label>
                        <select name="price" id="select-sort" class="custom-select">
                            <option value="asc">Price (low to high)</option>
                            <option value="desc" selected>Price (high to low)</option>
                        </select>
                    </div>
                </div> --}}
            </div>
        </div>

        <!-- Search Results -->
    </div>
    <div class="bg-light">
        <div class="container py-4">
            @if(isset($keyword) && !empty($keyword))
            <p id="search-p" class="fs-sm">Search results for "<strong>{{ strtoupper($keyword) }}</strong>"</p>
            @endif


            <div id="activity-card-block" class="grid md:grid-cols-2 lg:grid-cols-3 gap-2 xl:gap-3 mb-5">
                @forelse ($activities as $activity)
                    @include('front.elements.activity-card', ['activity' => $activity])
                @empty
                @endforelse
            </div>
            <div class="flex items-center" style="justify-content: center; margin-top: 50px;">
                <div id="spinner-block"></div>
                <button id="show-more" class="btn btn-accent" style="display: block;">show more</button>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript">
    let xhr;
    let typingTimer;
    const debounceTime = 500;
    let totalPage = "{{ $activities->total() }}";
    let nextPage = "{{ $activities->nextPageUrl() }}"
    let currentPage = "{{ $activities->currentPage() }}";
    $('html, body').animate({
        scrollTop: $("#searchDiv").offset().top
    }, "fast");

  $(".custom-select").on('change', function(event) {
    filter();
  });

  $("#search-keyword").on('keyup', function(event) {
    handleKeyDown();
  });

  function handleKeyDown() {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(performSearch, debounceTime);
}

function performSearch() {
    if (xhr && xhr.readyState !== 4) {
        // If there is an ongoing AJAX request, abort it
        xhr.abort();
    }

    filter();
}

  $("#show-more").on('click', async function(event) {
        event.preventDefault();
        currentPage++;
        if (nextPage) {
            await paginate(currentPage);
            if (currentPage == totalPage) {
                $("#show-more").hide();
            }
        }
    });

    async function paginate(page) {
        return new Promise((resolve, reject) => {
            var keyword = $("#search-keyword").val();
            const url = "{!! route('front.activities.index') !!}" + "?page=" + page + "&keyword=" + keyword;
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                async: "false",
                beforeSend: function(xhr) {
                    var spinner = '<button style="margin:0 auto;" class="btn btn-sm btn-primary text-white" type="button" disabled>\
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\
                                Loading Activities...\
                                </button>';
                    $("#spinner-block").html(spinner);
                    $("#show-more").hide();
                },
                success: function(res) {
                    if (res.success) {
                        $("#activity-card-block").append(res.data);
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
    var keyword = $("#search-keyword").val();
    // var activity_id = $("#select-activity").val();
    // var sortBy = $("#select-sort").val();
    // var url_query = "keyword=" + activity_id + "&act=" + activity_id + "&price=" + sortBy;
    var url_query = "keyword=" + keyword;

    var filter_url = '{{ route("front.activities.search") }}' + '?' + url_query;
    // window.location.href = filter_url;
    const url = "{!! route('front.activities.search') !!}" + "?" + url_query;
        xhr = $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            async: "false",
            beforeSend: function(xhr) {
                var spinner = '<button style="margin:0 auto;" class="btn btn-sm btn-primary text-white" type="button" disabled>\
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\
                            Loading Activities...\
                            </button>';
                $("#spinner-block").html(spinner);
                $("#show-more").hide();
            },
            success: function(res) {
                if (res.success) {
                    $("#activity-card-block").html(res.data);
                    totalPage = res.pagination.total;
                    currentPage = res.pagination.current_page;
                    nextPage = res.pagination.next_page;
                }

            }
        }).done(function( data ) {
            $("#spinner-block").html('');
            if (currentPage == totalPage) {
                $("#show-more").hide();
            } else {

                $("#show-more").show();
            }
        });
  }
</script>
@endpush
