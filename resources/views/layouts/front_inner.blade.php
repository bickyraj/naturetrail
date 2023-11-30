<!DOCTYPE html>
<html lang="en" style="scroll-padding-top: 10rem;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('meta_og_title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- meta tags --}}
    <meta name="description" content="@yield('meta_description')" />
    <meta name="keywords" content="@yield('meta_keywords')" />
    <meta property="og:title" content="@yield('meta_og_title')" />
    <meta property="og:url" content="@yield('meta_og_url')" />
    <meta property="og:site_name" content="@yield('meta_og_site_name', Setting::get('site_name') ?? '')" />
    <meta property="og:image" content="@yield('meta_og_image')" />
    <meta property="og:description" content="@yield('meta_og_description')" />
    {{-- end of meta tags --}}

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon-32x32') }}.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon-16x16') }}.png">
    <link rel="manifest" href="{{ asset('/site.webmanifest') }}">

    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://code.jquery.com">
    <link rel="preconnect" href="https://www.google.com">
    <link rel="preconnect" href="https://www.googletagmanager.com">
    <link rel="preconnect" href="https://www.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Preload --}}
    {{-- Preload css and js assets except those not needed immediately --}}
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/smartmenus@1.1.1/dist/css/sm-core-css.css" as="style">
    <link rel="preload" href="{{ asset('assets/front/css/tw.css') }}" type="text/css" as="style">
    <link rel="preload" href="{{ asset('assets/front/css/app.css') }}" type="text/css" as="style">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" type="text/javascript" as="script">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/smartmenus@1.1.1/dist/jquery.smartmenus.min.js" type="text/javascript" as="script">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.12.2/dist/cdn.min.js" type="text/javascript" as="script">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/alpinejs@3.12.2/dist/cdn.min.js" type="text/javascript" as="script">
    <link rel="preload" href="{{ asset('assets/vendors/general/toastr/build/toastr.min.js') }}" type="text/javascript" as="script">
    <link rel="preload" href="{{ asset('assets/js/toastr-option.js') }}" type="text/javascript" as="script">

    {{-- fonts --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;1,400&family=Roboto+Condensed:ital,wght@0,500;0,700&family=Solitreo&display=swap" rel="stylesheet">

    {{-- Smartmenus --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/smartmenus@1.1.1/dist/css/sm-core-css.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/perfect-scrollbar@1.5.0/css/perfect-scrollbar.css">

    <link rel="stylesheet" href="{{ asset('assets/front/css/tw.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/app.css') }}">
    <link href="{{ asset('assets/vendors/general/toastr/build/toastr.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/front/css/front-style.css') }}">

    @stack('styles')
    <style>
        [x-cloak] {
            display: none;
        }
    </style>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-PPD9HP85');
    </script>
    <!-- End Google Tag Manager -->

</head>

<body x-data="{showModal: false}" @keydown.esc="showModal = false" x-cloak>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PPD9HP85" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- scrollspy for tour-details page -->

    <!-- Header -- Topbar & Navbar-->
    @include('front.elements.header')
    {{-- end of header --}}

    <div id="topIO"></div>

    @yield('content')

    <!-- Footer -->
    @include('front.elements.footer')
    {{-- end of footer --}}

    <!-- Scripts -->
    <!-- jQuery-->
    {{-- <script src="{{ asset('assets/front/js/jQuery-3.3.1.min.js') }}"></script> --}}
    <!-- Popper -->
    <!-- Bootstrap -->
    {{-- <script src="{{ asset('assets/front/js/bootstrap.bundle.min.js') }}"></script> --}}
    <!-- App.js -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="{{ asset('assets/vendors/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/smartmenus@1.1.1/dist/jquery.smartmenus.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.12.2/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.12.2/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.2/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/perfect-scrollbar@1.5.0/dist/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('assets/vendors/general/toastr/build/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/front/js/lazysizes.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/toastr-option.js') }}" type="text/javascript"></script>
    <script>
        // Initialize jQuery Smartmenus
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var status = jqXHR.status;
                    if (status == 404) {
                        toastr.warning("Element not found.");
                    } else if (status == 422) {
                        toastr.info(jqXHR.responseJSON.message);
                    }
                }
            });
        });
    </script>
    @stack('scripts')

    <script>
        const header = document.querySelector('header')
        {{-- Change header on scroll --}}
        const headerScrollObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (header && header.classList) {
                    if (entry.isIntersecting) {
                        header.classList.remove('scrolled')
                    } else {
                        header.classList.add('scrolled')
                    }
                }
            })
        }, {
            rootMargin: "40px 0px 0px 0px"
        })
        headerScrollObserver.observe(document.querySelector('#topIO'))
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-62863YPN01"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-62863YPN01');
    </script>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-T4NJBC4C');
    </script>
    <!-- End Google Tag Manager -->

</body>

</html>
