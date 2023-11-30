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

    @php
        $content= App\Models\Content::where('name', 'auth')->where('theme', Config::config()->theme)->first();
    @endphp
    

    <div class="account-page">
        <div class="form-wrapper">
            <div class="logo text-center">
                <a href="{{ route('home') }}" class="site-logo"><img src="{{ Config::getFile('dark_logo', Config::config()->dark_logo, true) }}"
                        alt="image"></a>
            </div>
            <div class="inner-wrapper">
                <h3 class="title">{{ $content->content->title }}</h3>
                @yield('content')
            </div>
            <div class="copy-right-text">
                <p>{{__(Config::config()->copyright)}}</p>
            </div>
        </div>
        <div class="img-wrapper">
            <img src="{{ Config::getFile('auth', $content->content->image_one) }}" class="account-line-bg" alt="image">
        </div>
    </div>

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


    @include('alert')
</body>

</html>
