<?php
$success_message = "";
$error_message = "";
if (session()->has('success_message')) {
    $success_message = session()->get('success_message');
}

if (session()->has('error_message')) {
    $error_message = session()->get('error_message');
}
?>
@push('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush

{{-- Top header --}}
<div class="text-white bg-primary">
    <div class="container flex items-center justify-between gap-4 py-1 text-white">
        <a href="mailto:{{ Setting::get('email') ?? '' }}" class="flex items-center gap-1 text-sm text-light hover:text-white">
            <svg class="w-4 h-4">
                <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#mail" />
            </svg>
            <span class="none lg:inline">{{ Setting::get('email') ?? '' }}</span>
        </a>
        {{-- Header Search --}}
        <form id="search-form" action="{{ route('front.trips.search') }}" method="GET" class="flex header__searchform">
            <input type="search" name="keyword" id="header-search" value="{{ request()->get('keyword') }}" placeholder="Where do you want to go?" class="px-2 text-sm border-none flex-grow-1 bg-gray">
            <button class="flex items-center justify-center w-8 h-8 p-1 btn-accent">
                <svg class="w-4 h-4">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#search" />
                </svg>
            </button>
        </form>{{-- Header Search --}}
        <div class="flex gap-2">
            <a href="tel:{{ Setting::get('mobile1') ?? '' }}" class="flex items-center gap-1 text-sm text-light hover:text-white">
                <svg class="w-4 h-4">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#phone" />
                </svg>
                <span class="none lg:inline">{{ Setting::get('mobile1') ?? '' }}</span>
            </a>
            <a href="{{ Setting::get('viber') ?? '' }}" style="color:#d6b8e0">
                <svg class="w-4 h-4">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#viber" />
                </svg>
            </a>
            <a href="{{ Setting::get('whatsapp') ?? '' }}" style="color:#25d366">
                <svg class="w-4 h-4">
                    <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#whatsapp" />
                </svg>
            </a>
        </div>
    </div>
</div>{{-- Top row --}}

{{-- Header --}}
<div class="flex items-center w-full shadow-md header sticky-top" x-data="{ mobilenavOpen: false }">
    <div class="container relative flex items-end justify-between w-full">
        <!-- Logo -->
        <a class="flex-shrink-0" href="https://naturetrail.manojpanta.com.np/">
            <img src="{{ asset('assets/front/img/logo.png') }}" class="block h-16 brand" alt="{{ config('app.name') }}" width="318" height="197">
        </a><!-- Logo -->
        <div class="flex items-end">
            <!-- Nav -->
            @include('front.elements.navbar')

            {{-- Mobile Nav Button --}}
            <div class="lg:none">
                <button class="p-2" @click="mobilenavOpen=!mobilenavOpen">
                    <svg class="w-6 h-6" x-show="!mobilenavOpen">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#menu" />
                    </svg>
                    <svg class="w-6 h-6" x-cloak x-show="mobilenavOpen">
                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#x" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>{{-- Header --}}
@push('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('assets/js/search-trips.js') }}"></script>
    <script>
        (function() {
            let success_message = "<?php echo $success_message;?>";
            let error_message = "<?php echo $error_message;?>";
            if (success_message != "") {
                toastr.success(success_message);
            }
            if (error_message != "") {
                toastr.warning(error_message);
            }
        })();
    </script>
@endpush
