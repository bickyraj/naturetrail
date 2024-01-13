<?php
  if (session()->has('success_message')) {
    $success_message = session('success_message');
    session()->forget('success_message');
  }
?>
@extends('layouts.admin')
@push('styles')
<link href="./assets/vendors/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/cropperjs/dist/cropper.min.css" rel="stylesheet">
<link href="./assets/vendors/bootstrap-rating-master/bootstrap-rating.css" rel="stylesheet">
@endpush
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                  <div class="kt-portlet__head">
                      <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-settings"></i>
                        </span>
                          <h3 class="kt-portlet__head-title">
                              Tour Policy
                          </h3>
                      </div>
                  </div>
                  <!--begin::Form-->
                  <div class="kt-portlet__body">
                    {{-- home page block --}}
                      <div class="tab-pane" data-index="2" id="kt_tabs_1_2" role="tabpanel">
                        <form class="kt-form" method="POST" action="{{ route('admin.tour-policy.store') }}" id="setting-home-form" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Content</label>
                            <div class="col-lg-7">
                              <input type="hidden" name="tourPolicy">
                              <div id="summernote-home-content" class="summernote"><?= Setting::get('tourPolicy')??'' ?></div>
                            </div>
                          </div>
                          <hr>
                          <div class="kt-form__actions">
                            <button type="submit" id="home-page-save-btn" class="btn btn-sm btn-primary">
                                  <i class="flaticon2-arrow-up"></i>
                                Save</button>
                          </div>
                        </form>
                      </div>
                      {{-- end of home page block --}}
                  </div>
                <!--end::Form-->
            </div>
            <!--end::Portlet-->
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="./assets/vendors/general/summernote/dist/summernote.js" type="text/javascript"></script>
<script src="./assets/js/demo1/pages/crud/forms/widgets/summernote.js" type="text/javascript"></script>
<script src="./assets/vendors/cropperjs/dist/cropper.min.js"></script>
<script src="./assets/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="./assets/vendors/jquery-validation/dist/additional-methods.min.js"></script>
<script src="./assets/vendors/bootstrap-rating-master/bootstrap-rating.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {
  var success_message = '{{ $success_message ?? '' }}';
  if (success_message) {
    Toast.fire({
      type: 'success',
      title: success_message
    })
  }

    var validation_rules = {
        pdf_file_name: {
          extension: "pdf"
        },
        map_file_name: {
          extension: "jpeg|jpg|png|gif"
        },
        "trip_seo[og_image]": {
          extension: "jpeg|jpg|png|gif"
        },
        cost: {
          number: true
        },
        max_altitude: {
          number: true
        },
        offer_price: {
          number: true
        }
    };
    var validation_messages = {
      pdf_file_name: {
          extension: "Only pdf is allowed."
      },
      map_file_name: {
          extension: "Only image files is allowed."
      }
    };

    $('#setting-home-form button[type="submit"]').on('click', function(event) {
      event.preventDefault();
      $('input[name="tourPolicy"]').val($('#summernote-home-content').summernote('code'));
      $("#setting-home-form").submit();
    });

    function handleTripAddForm(form, cont = false) {

      var form = $(form);
      var formData = new FormData(form[0]);

      if (!$('#tripTab li:nth-child(2) a').hasClass("disabled")) {
        var trip_info = "";

        trip_info = {
          'accomodation' : $('#summernote-accomodation').summernote('code'),
          'meals' : $('#summernote-meals').summernote('code'),
          'transportation' : $('#summernote-transportation').summernote('code'),
          'overview' : $('#summernote-overview').summernote('code'),
          'highlights' : $('#summernote-highlights').summernote('code')
        };

        formData.append('trip_info', JSON.stringify(trip_info));
      }

      if (!$('#tripTab li:nth-child(3) a').hasClass("disabled")) {
        var trip_include = "";

        trip_include = {
          'include' : $('#summernote-include').summernote('code'),
          'exclude' : $('#summernote-exclude').summernote('code'),
        };

        formData.append('trip_include_exclude', JSON.stringify(trip_include));
      }

      if (!$('#tripTab li:nth-child(4) a').hasClass("disabled")) {
        var trip_leader = $('#summernote-leader').summernote('code');
        formData.append('trip_seo[about_leader]', trip_leader);
      }

      if (!$('#tripTab li:nth-child(5) a').hasClass("disabled")) {

        $.each($("#itinerary-block>.itinerary-group").find('.summernote'), function(i, v) {
          var desc = $(v).summernote('code');
          formData.append('trip_itineraries['+i+'][day]', i + 1);
          formData.append('trip_itineraries['+i+'][display_order]', i + 1);
          formData.append('trip_itineraries['+i+'][description]', desc);
        });
      }

      $.ajax({
          url: "{{ route('admin.trips.store') }}",
          type: 'POST',
          data: formData,
          dataType: 'json',
          processData: false,
          contentType: false,
          async: false,
          success: function(res) {
              if (res.status === 1) {
                if (cont) {
                  if (typeof(Storage) !== "undefined") {
                    // Store
                    sessionStorage.setItem("save-and-continue", true);
                  }

                  location.href = '{{ url('/admin/trips/edit') }}' + '/' + res.trip.id ;
                } else {
                  location.href = '{{ route('admin.trips.index') }}';
                }
              }
          }
      });
    }

    function initSummerNote() {
      $('#summernote-home-content').summernote();
    }

    var cropped = false;
    const image = document.getElementById('cropper-image');
    var cropper = "";

    function handleBannerAddForm(form) {
      var form = $(form);
      var formData = new FormData(form[0]);
      if (cropper) {
        formData.append('cropped_data', JSON.stringify(cropper.getData()));
      }
    }

    $("#home-page-save-btn").on('click', function(event) {
      event.preventDefault();
      if (cropper) {
        $("#cropped-data-input").val(JSON.stringify(cropper.getData()));
      }
      $(this).closest('form').submit();
    });

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#cropper-image').attr('src', e.target.result);
          initCropperjs();
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#cropper-upload").change(function() {
      readURL(this);
    });

    function initCropperjs() {
      if (cropped) {
        cropper.destroy();
        cropped = false;
      }

      cropper = new Cropper(image, {
          aspectRatio: 2 / 1,
          zoomable: false,
          viewMode: 2,
          ready: function (data) {
            var contData = cropper.getImageData(); //Get container data
            cropper.setCropBoxData({"left":0,"top":0,"width":contData.width,"height":contData.height});
          },
          crop(event) {
              // console.log(event.detail.x);
              // console.log(event.detail.y);
              // console.log(event.detail.width);
              // console.log(event.detail.height);
              // console.log(event.detail.rotate);
              // console.log(event.detail.scaleX);
              // console.log(event.detail.scaleY);
          },
      });

      cropped = true;
    }

    initCropperjs();
    initSummerNote();
});

</script>
@endpush
