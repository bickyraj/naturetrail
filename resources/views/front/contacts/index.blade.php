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
@extends('layouts.front')
@section('content')
    <!-- Hero -->
    <section class="hero hero-alt relative">
        <img src="{{ asset('assets/front/img/hero.jpg') }}" alt="Nature Trails">
        <div class="overlay absolute">
            <div class="container ">
                <h1 class="font-display upper">Contact Us</h1>
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb fs-sm wrap">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
    </section>

    <section class="py-20">
        <div class="container">
            <div class="grid lg:grid-cols-2 gap-10 lg:gap-20">
                {{-- Left --}}
                <div>
                    <h2 class="text-2xl mb-8">Where are we?</h2>
                    <div class="mb-10 flex flex-col gap-4">
                        <div class="flex gap-4">
                            <div class="flex justify-center items-center flex-shrink-0 w-12 h-12 bg-gray rounded-lg">
                                <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3>Location</h3>
                                <p>Nature Trail is conveniently located in Kathmandu, the capital city of Nepal.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex justify-center items-center flex-shrink-0 w-12 h-12 bg-gray rounded-lg">
                                <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M8.161 2.58a1.875 1.875 0 011.678 0l4.993 2.498c.106.052.23.052.336 0l3.869-1.935A1.875 1.875 0 0121.75 4.82v12.485c0 .71-.401 1.36-1.037 1.677l-4.875 2.437a1.875 1.875 0 01-1.676 0l-4.994-2.497a.375.375 0 00-.336 0l-3.868 1.935A1.875 1.875 0 012.25 19.18V6.695c0-.71.401-1.36 1.036-1.677l4.875-2.437zM9 6a.75.75 0 01.75.75V15a.75.75 0 01-1.5 0V6.75A.75.75 0 019 6zm6.75 3a.75.75 0 00-1.5 0v8.25a.75.75 0 001.5 0V9z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3>Accessibility</h3>
                                <p>Open 24/7 and just a 25-minute drive from Kathmandu International Airport to Jhamsikhel, Sanepa (Lalitpur), the new tourist hub of Nepal.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex justify-center items-center flex-shrink-0 w-12 h-12 bg-gray rounded-lg">
                                <svg class="w-6 h-6 text-primary" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path
                                        d="M135.2 117.4L109.1 192H402.9l-26.1-74.6C372.3 104.6 360.2 96 346.6 96H165.4c-13.6 0-25.7 8.6-30.2 21.4zM39.6 196.8L74.8 96.3C88.3 57.8 124.6 32 165.4 32H346.6c40.8 0 77.1 25.8 90.6 64.3l35.2 100.5c23.2 9.6 39.6 32.5 39.6 59.2V400v48c0 17.7-14.3 32-32 32H448c-17.7 0-32-14.3-32-32V400H96v48c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V400 256c0-26.7 16.4-49.6 39.6-59.2zM128 288a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3>Driving directions</h3>
                                <p>If you are driving from the airport via Baneswor road, follow Maitighar Mandala and continue on to Thapathali until you reach the Bagmati Bridge. Cross the bridge and
                                    follow
                                    the road, then turn right at Kandevata. Continue driving southwest for another 3 minutes until you reach Sanepa Chok. Follow Tika Marg, where you will find the Nature
                                    Trail
                                    Office Board after a 2-minute drive. It is located just before Jump KTM on the right side (3rd floor), between Jump KTM and Tika School.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex justify-center items-center flex-shrink-0 w-12 h-12 bg-gray rounded-lg">
                                <svg class="w-6 h-6 text-primary" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" aria-hidden="true">
                                    <path
                                        d="M208 96c26.5 0 48-21.5 48-48S234.5 0 208 0s-48 21.5-48 48 21.5 48 48 48zm94.5 149.1l-23.3-11.8-9.7-29.4c-14.7-44.6-55.7-75.8-102.2-75.9-36-.1-55.9 10.1-93.3 25.2-21.6 8.7-39.3 25.2-49.7 46.2L17.6 213c-7.8 15.8-1.5 35 14.2 42.9 15.6 7.9 34.6 1.5 42.5-14.3L81 228c3.5-7 9.3-12.5 16.5-15.4l26.8-10.8-15.2 60.7c-5.2 20.8.4 42.9 14.9 58.8l59.9 65.4c7.2 7.9 12.3 17.4 14.9 27.7l18.3 73.3c4.3 17.1 21.7 27.6 38.8 23.3 17.1-4.3 27.6-21.7 23.3-38.8l-22.2-89c-2.6-10.3-7.7-19.9-14.9-27.7l-45.5-49.7 17.2-68.7 5.5 16.5c5.3 16.1 16.7 29.4 31.7 37l23.3 11.8c15.6 7.9 34.6 1.5 42.5-14.3 7.7-15.7 1.4-35.1-14.3-43zM73.6 385.8c-3.2 8.1-8 15.4-14.2 21.5l-50 50.1c-12.5 12.5-12.5 32.8 0 45.3s32.7 12.5 45.2 0l59.4-59.4c6.1-6.1 10.9-13.4 14.2-21.5l13.5-33.8c-55.3-60.3-38.7-41.8-47.4-53.7l-20.7 51.5z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3>Walking directions</h3>
                                <p>If you're walking from Kathmandu or any hotel, please follow google map given in our website.</p>
                            </div>
                        </div>
                    </div>

                    <h3 class="mb-4"><span class="text-3xl">Nature Trail</span><br>Travels & Tours, Trekking & Expeditions</h3>
                    <p>
                        Tika Marg -367/35,<br>
                        Jhamsikhel, Lalitpur<br>
                        Call/Whatsapp: +9779851022394<br>
                        Email us: info@naturetrail.com
                    </p>
                    <ul class="flex gap-4">
                        <li>
                            <a href="{{ Setting::get('facebook') }}">
                                <svg class="w-6 h-6">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#facebook" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="{{ Setting::get('twitter') }}">
                                <svg class="w-6 h-6">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#twitter" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="{{ Setting::get('instagram') }}">
                                <svg class="w-6 h-6">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#instagram" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="{{ Setting::get('whatsapp') }}">
                                <svg class="w-6 h-6">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#whatsapp" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="{{ Setting::get('viber') }}">
                                <svg class="w-6 h-6">
                                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#viber" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
                {{-- Right --}}
                <div>
                    <h2 class="text-2xl mb-8">Get connected with us!</h2>
                    <p>Tell us more about your interests, and we will respond to your query within 12 hours!</p>

                    <form id="captcha-form" action="{{ route('front.contact.store') }}" method="POST" x-data="{ method: 'email', timezone: '' }" x-init="$watch('method', value => {
                        if (value === 'whatsapp' || value === 'phone') {
                            flatpickr($refs.date, {
                                enableTime: true,
                                minDate: 'today'
                            });
                            $refs.timezoneSelect.value = timezone
                        };
                        timezone = Intl.DateTimeFormat().resolvedOptions().timeZone === 'Asia/Katmandu' ? 'Asia/Kathmandu' : Intl.DateTimeFormat().resolvedOptions().timeZone;
                    })">
                        @csrf
                        <div class="grid grid-cols-2 gap-4 mb-10">
                            <div class="form-group">
                                <label for="first-name" class="text-sm">First Name</label>
                                <input type="text" name="first_name" required class="form-control" id="first-name" placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <label for="last-name" class="text-sm">Last Name</label>
                                <input type="text" name="last_name" required class="form-control" id="last-name" placeholder="Last Name">
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-sm">E-mail</label>
                                <input type="email" name="email" required class="form-control" id="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="text-sm">Contact Number</label>
                                <input type="tel" name="phone" required class="form-control block" id="phone" placeholder="Phone No.">
                            </div>
                            <div class="form-group">
                                <label for="contact-method" class="text-sm">Preferred contact method</label>
                                <select name="contact-method" required class="form-control block" id="contact-method" x-model="method">
                                    <option value="email">Email</option>
                                    <option value="whatsapp">WhatsApp</option>
                                    <option value="phone">Phone</option>
                                    <option value="any">Any</option>
                                </select>
                            </div>

                            @push('styles')
                                <link href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css" rel="stylesheet">
                            @endpush
                            @push('scripts')
                                <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
                            @endpush

                            <template x-if="method === 'whatsapp' || method === 'phone'">
                                <div class="form-group">
                                    <label for="date" class="text-sm">Preferred time to call</label>
                                    <input type="text" id="date" x-ref="date" class="form-control block" required>
                                </div>
                            </template>
                            <template x-if="method === 'whatsapp' || method === 'phone'">
                                <div class="form-group">
                                    <label for="timezone" class="text-sm">Your timezone</label>
                                    <select name="timezone" required class="form-control block" id="timezone" x-model="timezone" x-ref="timezoneSelect">
                                        @php
                                            $timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
                                            
                                            // Create an array to store timezone data (offset and formatted name)
                                            $timezoneData = [];
                                            
                                            foreach ($timezones as $timezoneName) {
                                                $timezone = new DateTimeZone($timezoneName);
                                                $offset = $timezone->getOffset(new DateTime());
                                            
                                                // Calculate hours and minutes from the offset in seconds
                                                $hours = floor(abs($offset) / 3600);
                                                $minutes = floor((abs($offset) % 3600) / 60);
                                            
                                                // Determine the sign of the offset
                                                $sign = $offset < 0 ? '-' : '+';
                                            
                                                // Format the offset as a string (e.g., "+02:00" or "-05:30")
                                                $offsetString = sprintf('%s%02d:%02d', $sign, $hours, $minutes);
                                            
                                                // Store the offset and formatted name in the array
                                                $timezoneData[$timezoneName] = [
                                                    'offset' => $offsetString,
                                                    'name' => $timezoneName,
                                                ];
                                            }
                                        @endphp
                                        @foreach ($timezoneData as $tz)
                                            <option value="{{ $tz['name'] }}">{{ $tz['name'] }} (UTC {{ $tz['offset'] }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </template>
                            <div class="form-group col-span-2">
                                <label for="" class="text-sm">Message</label>
                                <textarea class="form-control block" required name="message" id="message" rows="5" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="recaptcha" name="g-recaptcha-response">
                            @include('front.elements.recaptcha')
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d28275.51054552614!2d85.322707!3d27.641892!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb18e330f2565d%3A0x21fd1082f7db1e89!2sNature%20Trail!5e0!3m2!1sen!2sus!4v1686463950166!5m2!1sen!2sus"
        width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
