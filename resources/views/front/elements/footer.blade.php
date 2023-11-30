<!-- Newsletter -->
<div class="bg-gray py-8">
    <div class="container">
        <div class="grid lg:grid-cols-2 gap-8 lg:gap-20">
            <div class="flex flex-col justify-center">
                <h2 class="mb-2 font-display uppercase text-3xl text-primary">Searching for exclusive travel deals?</h2>
                <div class="prose">
                    <p>Discover incredible offers for your upcoming adventure by subscribing to our newsletter with the latest travel tips and updates.</p>
                </div>
            </div>
            <div>
                {{-- <form class="flex flex-wrap gap-2" id="email-subscribe-form">
                    <label for="emailsub" class="sr-only">Email</label>
                    <input type="email" id="emailsub" class="lg:text-xl p-4 mb-1 lg:mb-0 lg:mr-2 border-accent rounded-lg" placeholder="Enter your email" required="">
                    <button type="submit" class="btn btn-accent">Subscribe</button>
                </form> --}}
                <form action="https://naturetrail.us21.list-manage.com/subscribe/post?u=f93f44454b12058dbad8758a3&id=72de291768&f_id=0001e2e6f0" method="post" id="mc-embedded-subscribe-form"
                    name="mc-embedded-subscribe-form" class="validate" target="_self" novalidate="">
                    <div id="mc_embed_signup_scroll">
                        <div class="flex flex-wrap lg:flex-nowrap items-end gap-4">
                            <div>
                                <label for="mce-FNAME" class="text-sm">First Name </label>
                                <input type="text" name="FNAME" class="lg:text-lg px-3 py-2 lg:mb-0 lg:mr-2 border-gray-400 rounded-lg w-full" id="mce-FNAME" value="">
                            </div>
                            <div>
                                <label for="mce-EMAIL" class="text-sm">Email Address <span class="text-gray">*</span></label>
                                <input type="email" name="EMAIL" class="lg:text-lg px-3 py-2 lg:mb-0 lg:mr-2 border-gray-400 rounded-lg w-full" id="mce-EMAIL" required="" value="">
                            </div>
                            <div aria-hidden="true" style="position: absolute; left: -5000px;">
                                /\ *real people should not fill this in and expect good things - do not remove this or risk form bot signups */
                                <input type="text" name="b_f93f44454b12058dbad8758a3_72de291768" tabindex="-1" value="">
                            </div>
                            <input type="submit" name="subscribe" id="mc-embedded-subscribe" class="btn btn-accent" value="Subscribe">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="bg-white">
    <div class="container py-10">
        <div class="mb-4 text-xl text-center">We are associated with</div>
        <ul class="flex gap-10 flex-wrap justify-center items-center">
            {{-- <li><a href="#"><img src="{{ asset('assets/front/img/ng.svg') }}" class="h-24" alt="Nepal Government Ministry of Culture, Tourism & Civil Aviation" loading="lazy"></a></li> --}}
            <div class="flex gap-10">
                <li><a href="#"><img src="{{ asset('assets/front/img/ntb.svg') }}" class="h-24" alt="Nepal Tourism Board" loading="lazy"></a></li>
                <li><a href="https://www.taan.org.np/"><img src="{{ asset('assets/front/img/taan.svg') }}" class="h-24" alt="Trekking Agencies' Association of Nepal" loading="lazy"></a></li>
                <li><a href="#"><img src="{{ asset('assets/front/img/nma.svg') }}" class="h-24" alt="Nepal Mountaineering Association" loading="lazy"></a></li>
            </div>
            <div class="flex gap-10">
                <li><a href="#"><img src="{{ asset('assets/front/img/tripadvisor.svg') }}" class="h-24" alt="Tripadvisor" loading="lazy"></a></li>
                <li><a href="#"><img src="{{ asset('assets/front/img/tourradar.svg') }}" class="h-20" alt="TourRadar" loading="lazy"></a></li>
            </div>
        </ul>
    </div>
    <img src="{{ asset('assets/front/img/webpage_art.webp') }}" alt="" class="w-full object-cover" style="min-height: 6rem;">
</div><!-- Newsletter -->

<!-- Footer -->
<footer class="bg-primary-footer text-white">
    <div class="container">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10">
            <div class="mb-4 md:col-span-2 lg:col-span-1">
                {{-- <div id="TA_excellent377" class="TA_excellent"><ul id="B53fPW4H" class="TA_links VQZgkV"><li id="7ovBpuTFQ8" class="2srDuwCwKx1"><a target="_blank" href="https://www.tripadvisor.com/Attraction_Review-g293890-d2651131-Reviews-Nature_Trail_Travels_Tours_Trekking_Expeditions_Day_Tours-Kathmandu_Kathmandu_Val.html"><img src="https://static.tacdn.com/img2/brand_refresh/Tripadvisor_lockup_horizontal_secondary_registered.svg" alt="TripAdvisor" class="widEXCIMG" id="CDSWIDEXCLOGO"/></a></li></ul></div><script async src="https://www.jscache.com/wejs?wtype=excellent&amp;uniq=377&amp;locationId=2651131&amp;lang=en_US&amp;display_version=2" data-loadtrk onload="this.loadtrk=true"></script> --}}

                <div class="flex gap-4 items-center lg:flex-col">
                    <a href="#"><img src="{{ asset('assets/front/img/certified1.png') }}" class="w-64 block" alt="Travel Life" loading="lazy"></a>
                    <a href="#"><img src="{{ asset('assets/front/img/ta-certificate.webp') }}" class="block w-64 rounded-lg" alt="Tripadvisor Certificate of Excellence" loading="lazy"></a>
                </div>
            </div>
            <div class="mb-4">
                <h2 class="font-display text-2xl text-white mb-2">Things to do in Nepal</h2>
                <ul>
                    @if ($footer2)
                        @foreach ($footer2 as $menu)
                            <li>
                                <a href="{!! $menu->link ? $menu->link : 'javascript:;' !!}">{{ $menu->name }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="mb-4">
                <h2 class="font-display text-2xl text-white mb-2">Quick Links</h2>
                <ul>
                    @if ($footer3)
                        @foreach ($footer3 as $menu)
                            <li>
                                <a href="{!! $menu->link ? $menu->link : 'javascript:;' !!}">{{ $menu->name }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>

            <div class="md:col-span-2 lg:col-span-1">
                <h2 class="font-display text-2xl text-white mb-2">Head Office, Nepal</h2>
                <ul class="mb-4 icon-list">
                    <li class="flex">
                        <svg class="flex-shrink-0 mr-1">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#locationmarker" />
                        </svg>
                        <span>{{ Setting::get('address') }}</span>
                    </li>
                    <li class="flex">
                        <svg class="flex-shrink-0 mr-1">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#phone" />
                        </svg>
                        <a href="tel:{{ Setting::get('mobile1') }}">{{ Setting::get('mobile1') }}</a>
                    </li>
                    <li class="flex">
                        <svg class="flex-shrink-0 mr-1">
                            <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#mail" />
                        </svg>
                        <a href="mailto:{{ Setting::get('email') }}">{{ Setting::get('email') }}</a>
                    </li>
                </ul>
                <ul class="social-links gap-2 flex-wrap">
                    <li>
                        <a href="{{ Setting::get('facebook') }}" class="p-4 bg-primary-dark hover:bg-accent rounded-lg">
                            <svg>
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#facebook" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ Setting::get('twitter') }}" class="p-4 bg-primary-dark hover:bg-accent rounded-lg">
                            <svg>
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#twitter" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ Setting::get('instagram') }}" class="p-4 bg-primary-dark hover:bg-accent rounded-lg">
                            <svg>
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#instagram" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ Setting::get('whatsapp') }}" class="p-4 bg-primary-dark hover:bg-accent rounded-lg">
                            <svg>
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#whatsapp" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ Setting::get('viber') }}" class="p-4 bg-primary-dark hover:bg-accent rounded-lg">
                            <svg>
                                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#viber" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="bottom">
        <div class="container text-center gap-10">

            <div class="payments mb-4">
                We accept
                <img src="{{ asset('assets/front/img/payment.svg') }}" alt="">
            </div>

            <a href="{{ route('front.makeapayment') }}" class="flex justify-center items-center gap-4">
                Make a Payment
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </a>
        </div>
    </div>
    <div class="text-sm text-center pb-10">
        <div class="container text-center">
            &copy; 2009 - {{ date('Y') }}. Nature Trail Pvt. Ltd. All right Reserved.<br>
            All content and photography on our website are copyrighted and may not be reproduced without our permission.
        </div>
    </div>
</footer><!-- Footer -->

@push('scripts')
    <script type="text/javascript">
        $(function() {

            $('#email-subscribe-form').on('submit', function(event) {
                event.preventDefault();
                var form = $(this);
                var formData = form.serialize();

                $.ajax({
                    url: "{{ route('front.email-subscribers.store') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    async: "false",
                    success: function(res) {
                        if (res.status == 1) {
                            toastr.success(res.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var status = jqXHR.status;
                        if (status == 404) {
                            toastr.warning("Element not found.");
                        } else if (status == 422) {
                            toastr.info(jqXHR.responseJSON.errors.email[0]);
                        }
                    }
                });

            });
        });
    </script>
@endpush
