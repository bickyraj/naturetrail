<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ Setting::get('homePageSeo')['meta_title'] ?? '' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- meta tags --}}
   <meta name="description" content="{{ Setting::get('homePageSeo')['og_description'] ?? '' }}" />
    <meta name="keywords" content="{{ Setting::get('homePageSeo')['meta_keywords'] ?? '' }}" />
    <link rel="canonical"  href=""  />
    <meta property="og:title" content="{{ Setting::get('homePageSeo')['og_title'] ?? '' }}" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="@yield('meta_og_site_name', Setting::get('site_name')??'')" />
    <meta property="og:image" content="{{ Setting::getSiteSettingImage(Setting::get('homePageSeo')['og_image']??null) }}" />
    <meta property="og:description" content="{{ Setting::get('homePageSeo')['og_description'] ?? '' }}" />
    <meta property="fb:app_id" content="Nature Trail" />
    <meta property="og:image" content="@yield('meta_og_image')" />
    <meta property="og:description" content="@yield('meta_og_description')" />
    <meta name="IndexType" content="trekking in Nepal" />
    <meta name="language" content="EN-US" />
    <meta name="type" content="Trekking" />
    <meta name="classification" content="Nature Trail" />
    <meta name="company" content="Nature Trail" />
    <meta name="author" content="Nature Trail" />
    <meta name="contact person" content="Nature Trail" />
    <meta name="copyright" content="Nature Trail" />
    <meta name="security" content="public" />
    <meta content="all" name="robots" />
    <meta name="document-type" content="Public" />
    <meta name="category" content="Trekking in Nepal" />
    <meta name="robots" content="all,index" />
    <meta name="googlebot" content="INDEX, FOLLOW" />
    <meta name="YahooSeeker" content="INDEX, FOLLOW" />
    <meta name="msnbot" content="INDEX, FOLLOW" />
    <meta name="allow-search" content="Yes" />
    <meta name="doc-rights" content="Nature Trail" />
    <meta name="doc-publisher" content="Nature Trail" />
    <meta name="p:domain_verify" content="" />
    {{-- end of meta tags --}}

   {{-- fonts --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Solitreo&family=Source+Sans+Pro:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">

    {{-- Smartmenus --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/smartmenus@1.1.1/dist/css/sm-core-css.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/perfect-scrollbar@1.5.0/css/perfect-scrollbar.css">

    <link rel="stylesheet" href="{{ asset('assets/front/css/tw.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/app.css') }}">
    <link href="{{ asset('assets/vendors/general/toastr/build/toastr.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/front/css/front-style.css') }}">

    @stack('styles')

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "url": "https://www.naturetrail.com/",
      "potentialAction": {
        "@type": "SearchAction",
        "target": {
          "@type": "EntryPoint",
          "urlTemplate": "https://query.naturetrail.com/search?q={search_term_string}"
        },
        "query-input": "required name=search_term_string"
      }
    }
    </script>

    <style>
        [x-cloak] {
            display: none;
        }
    </style>
</head>

<body>
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
    <script src="https://cdn.jsdelivr.net/npm/smartmenus@1.1.1/dist/jquery.smartmenus.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.12.2/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.2/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/perfect-scrollbar@1.5.0/dist/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('assets/vendors/general/toastr/build/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/toastr-option.js') }}" type="text/javascript"></script>
     <script src="{{ asset('assets/front/js/lazysizes.min.js') }}" type="text/javascript"></script>
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
        {{-- Change header on scroll--}}
        const headerScrollObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if(entry.isIntersecting){
                    header.classList.remove('scrolled')
                }else {
                    header.classList.add('scrolled')
                }
            })
        }, {
            rootMargin: "40px 0px 0px 0px"
        })
        headerScrollObserver.observe(document.querySelector('#topIO'))
    </script>
</body>
</html>
