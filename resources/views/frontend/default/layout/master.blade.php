<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="description" content="{{ $page->seo_description ?? Config::config()->seo_description }}" />
    <meta name="keywords" content="{{ implode(',', $page->seo_keywords ?? Config::config()->seo_tags) }} ">

    <title>{{ Config::config()->appname }}</title>

    <link rel="stylesheet" href="{{ optional(Config::config()->fonts)->heading_font_url }}">
    <link rel="stylesheet" href="{{ optional(Config::config()->fonts)->paragraph_font_url }}">

    <link rel="shortcut icon" type="image/png" href="{{ Config::getFile('icon', Config::config()->favicon, true) }}">

    <link rel="stylesheet" href="{{ Config::cssLib('frontend', 'lib/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ Config::cssLib('frontend', 'all.min.css') }}">
    <link rel="stylesheet" href="{{ Config::cssLib('frontend', 'line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ Config::cssLib('frontend', 'lib/slick.css') }}">
    <link rel="stylesheet" href="{{ Config::cssLib('frontend', 'lib/odometer.css') }}">

    @if (Config::config()->alert === 'izi')
        <link rel="stylesheet" href="{{ Config::cssLib('frontend', 'izitoast.min.css') }}">
    @elseif(Config::config()->alert === 'toast')
        <link href="{{ Config::cssLib('frontend', 'toastr.min.css') }}" rel="stylesheet">
    @else
        <link href="{{ Config::cssLib('frontend', 'sweetalert.min.css') }}" rel="stylesheet">
    @endif

    <link href="{{ Config::cssLib('frontend', 'main.css') }}" rel="stylesheet">

    @php
        $heading = optional(Config::config()->fonts)->heading_font_family;
        $paragraph = optional(Config::config()->fonts)->paragraph_font_family;
    @endphp

    <style>
        :root {
            --clr-main: <?= Config::config()->color[Config::config()->theme] ?? '#9c0ac1' ?>;
            --h-font: <?=$heading ?>;
            --p-font: <?=$paragraph ?>;
        }
    </style>

    @stack('external-css')

    @stack('style')


</head>

<body>


    @if (Config::config()->preloader_status)
        <div class="preloader-holder">
            <div class="preloader">
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
            </div>
        </div>
    @endif


    @if (Config::config()->analytics_status)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ Config::config()->analytics_key }}"></script>
        <script>
            'use strict'
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag("js", new Date());
            gtag("config", "{{ Config::config()->analytics_key }}");
        </script>
    @endif

    @if (Config::config()->allow_modal)
        @include('cookieConsent::index')
    @endif

    <div class="body-content-area">
        @if (request()->routeIs('home'))
            @include(Config::theme() . 'widgets.banner')
        @endif

        @include(Config::theme() . 'layout.header')

        @if (!request()->routeIs('home'))
            @include(Config::theme() . 'widgets.breadcrumb')
        @endif

        @yield('content')
    </div>

    @include(Config::theme() . 'widgets.footer')

    <script src="{{ Config::jsLib('frontend', 'lib/jquery.min.js') }}"></script>
    <script src="{{ Config::jsLib('frontend', 'lib/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ Config::jsLib('frontend', 'lib/slick.min.js') }}"></script>
    <script src="{{ Config::jsLib('frontend', 'lib/wow.min.js') }}"></script>
    <script src="{{ Config::jsLib('frontend', 'lib/jquery.paroller.min.js') }}"></script>
    <script src="{{ Config::jsLib('frontend', 'lib/TweenMax.min.js') }}"></script>
    <script src="{{ Config::jsLib('frontend', 'lib/odometer.min.js') }}"></script>
    <script src="{{ Config::jsLib('frontend', 'lib/viewport.jquery.js') }}"></script>



    @if (Config::config()->alert === 'izi')
        <script src="{{ Config::jsLib('frontend', 'izitoast.min.js') }}"></script>
    @elseif(Config::config()->alert === 'toast')
        <script src="{{ Config::jsLib('frontend', 'toastr.min.js') }}"></script>
    @else
        <script src="{{ Config::jsLib('frontend', 'sweetalert.min.js') }}"></script>
    @endif

    <script src="{{ Config::jsLib('frontend', 'main.js') }}"></script>

    @stack('script')


    @if (Config::config()->twak_allow)
        <script type="text/javascript">
            var Tawk_API = Tawk_API || {},
                Tawk_LoadStart = new Date();
            (function() {
                var s1 = document.createElement("script"),
                    s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = "{{ Config::config()->twak_key }}";
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        </script>
    @endif

    <script>
        $(function() {
            'use strict'

            $(document).on('submit', '#subscribe', function(e) {
                e.preventDefault();
                const email = $('.subscribe-email').val();
                var url = "{{ route('subscribe') }}";
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        email: email,
                        _token: "{{ csrf_token() }}"
                    },
                    success: (response) => {

                        $('.subscribe-email').val('');

                        @include(Config::theme() . 'layout.ajax_alert', [
                            'message' => 'Successfully Subscribe',
                            'message_error' => '',
                        ])

                    },
                    error: () => {

                        @if (Config::config()->alert === 'izi')
                            iziToast.error({
                                position: 'topRight',
                                message: "Email is Required",
                            });
                        @elseif (Config::config()->alert === 'toast')
                            toastr.error("Email is Required", {
                                positionClass: "toast-top-right"

                            })
                        @else
                            Swal.fire({
                                icon: 'error',
                                title: "Email is Required"
                            })
                        @endif
                    }
                })

            });

            var url = "{{ route('change-language') }}";

            $(".changeLang").on('change', function() {
               
                if ($(this).val() == '') {
                    return false;
                }
                window.location.href = url + "?lang=" + $(this).val();
            });

        })
    </script>


    @include('alert')


</body>

</html>
