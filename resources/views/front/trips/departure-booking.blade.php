<?php
if (session()->has('success_message')) {
    $session_success_message = session('success_message');
    session()->forget('success_message');
}

if (session()->has('error_message')) {
    $session_error_message = session('error_message');
    session()->forget('error_message');
}
?>
@extends('layouts.front_inner')
@push('styles')
    <style>
        .payment-radio-block {
            display: flex;
        }

        .nature-from-radio-button {
            cursor: pointer;
            margin-right: 6px;
            width: 16px !important;
            padding: 0px !important;
        }

        .nature-form-check label {
            cursor: pointer !important;
        }

        .nature-form-check {
            margin-right: 40px;
            margin-bottom: 12px;
            display: flex;
            align-content: flex-start;
            justify-content: flex-start;
            align-items: center;

        }
    </style>
@endpush

@section('content')
    <!-- Hero -->
    <section class="relative hero-alt">
        <img src="{{ $trip->imageUrl }}" alt="">
        <div class="absolute py-10 overlay">
            <div class="container ">
                <h1 class="mb-2">Book {{ $trip->name }}</h1>
                <div class="breadcrumb-wrapper text-white">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb fs-sm wrap">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('front.trips.show', ['slug' => $trip->slug]) }}">{{ $trip->name }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Booking Form</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="container">
            <div class="grid lg:grid-cols-3 gap-10 lg:gap-20">
                <div class="lg:col-span-2">
                    <div class="mb-10 flex">
                        <div class="bg-gray p-6 rounded-xl">
                            <h3 class="mb-2">Departure</h3>
                            <div>
                                <span class="text-2xl font-bold text-gray-600">{{ formatDate($trip_departure->from_date) }}</span><br>to
                                <span class="text-gray-600">{{ formatDate($trip_departure->to_date) }}</span>
                            </div>
                        </div>
                    </div>

                    <form id="captcha-form" action="{{ route('front.trips.departure-booking.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="departure_id" value="{{ $trip_departure->id }}">
                        <input type="hidden" name="id" value="{{ $trip->id }}">
                        <input type="hidden" name="id" value="{{ $trip->id }}">
                        <h2 class="mb-2 text-2xl font-bold text-gray-600 font-display">Personal details</h2>
                        <div class="grid gap-4 mb-2 lg:grid-cols-3">
                            <div class="form-group">
                                <label for="">First name *</label>
                                <input type="text" class="form-control" name="first_name" placeholder="First name" required>
                            </div>
                            <div class="form-group">
                                <label for="">Middle name</label>
                                <input type="text" class="form-control" name="middle_name" placeholder="Middle name">
                            </div>
                            <div class="form-group">
                                <label for="">Last name *</label>
                                <input type="text" class="form-control" name="last_name" placeholder="Last name" required>
                            </div>
                        </div>
                        <div class="grid gap-4 mb-2 lg:grid-cols-2">
                            <div class="form-group">
                                <label for="">Country *</label>
                                @include('front.elements.country')
                            </div>
                            <div class="form-group">
                                {{-- <label for="">Mailing address *</label>
                                <textarea name="mailing_address" id="" cols="30" rows="3" class="form-control"></textarea> --}}
                            </div>
                            <div class="form-group">
                                <label for="">Email *</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="">Contact no. *</label>
                                <input type="tel" name="contact_no" class="form-control" placeholder="Contact no." required>
                            </div>
                            <div class="form-group">
                                <label for="">Gender </label>
                                <select name="gender" id="" class="form-control">
                                    <option value="" selected disabled>Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Date of Birth </label>
                                <input type="date" name="dob" id="" class="form-control" max="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>

                        <h2 class="mt-10 mb-2 text-2xl font-bold text-gray-600 font-display">Trip details</h2>
                        <div class="mb-10 grid gap-4 mb-2 lg:grid-cols-2">
                            <div class="form-group">
                                <label for="">Passport no.</label>
                                <input type="text" name="passport_no" class="form-control" placeholder="Passport No.">
                            </div>
                            {{-- <div class="form-group">
                                <label for="">Place of issue</label>
                                <input type="text" name="place_of_issue" class="form-control" placeholder="Place of issue">
                            </div>
                            <div class="form-group">
                                <label for="">Issue date</label>
                                <input type="date" name="issue_date" class="form-control" max="{{ date('Y-m-d') }}" placeholder="Issue date">
                            </div>
                            <div class="form-group">
                                <label for="">Expiry date </label>
                                <input type="date" name="expiry_date" class="form-control" min="{{ date('Y-m-d') }}" placeholder="Expiry date">
                            </div> --}}
                            <div class="form-group">
                                <label for="">No. of travellers </label>
                                <input type="number" name="no_of_travellers" class="form-control" min="1" x-model="noOfTravellers" placeholder="No. of travellers">
                            </div>
                            {{-- <div class="form-group">
                                <label for="">Preferred departure date</label>
                                <input type="date" name="preferred_departure_date" name="" id="" class="form-control" min="{{ date('Y-m-d') }}">
                            </div> --}}
                            <div class="form-group">
                                <label for="">Message </label>
                                <textarea name="message" id="" cols="60" rows="3" class="form-control" placeholder="Message"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Emergency Contact </label>
                                <textarea name="emergency_contact" id="" cols="60" rows="3" class="form-control" placeholder="Emergency Contact"></textarea>
                            </div>
                            <input type="hidden" id="recaptcha" name="google_recaptcha">
                        </div>

                        <button id="make_a_payment_btn" class="btn btn-primary">Submit</button>
                        @include('front.elements.recaptcha')
                    </form>
                </div>

                <aside>
                    <div class="p-10 rounded bg-gray">
                        <h2 class="text-2xl font-bold text-primary">Book {{ $trip->name }}</h2>
                        <div class="card-body">
                            <p class="flex justify-between"><span>Duration:</span>{{ $trip->duration }} days</p>
                            <!-- <b>Earliest Fixed Depature Date</b>
                                                                                                                                                                    <p>1 Jan 2020</p> -->
                            @if ($trip_departure->price)
                                <b>USD {{ $trip_departure->price }}</b> per person
                            @endif
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function() {
            var session_success_message = '{{ $session_success_message ?? '' }}';
            var session_error_message = '{{ $session_error_message ?? '' }}';
            if (session_success_message) {
                toastr.success(session_success_message);
            }

            if (session_error_message) {
                toastr.error(session_error_message);
            }
        });
    </script>
@endpush
