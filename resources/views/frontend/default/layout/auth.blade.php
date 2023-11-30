<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="description" content="{{ $page->seo_description ?? Config::config()->seo_description }}" />
    <meta name="keywords" content="{{ implode(',', $page->seo_keywords ?? Config::config()->seo_tags) }} ">

    <title>{{ Config::config()->appname }}</title>

    <link rel="shortcut icon" type="image/png" href="{{ Config::getFile('icon', Config::config()->favicon, true) }}">

    <link rel="stylesheet" href="{{ Config::cssLib('frontend', 'lib/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ Config::cssLib('frontend', 'all.min.css') }}">
    <link rel="stylesheet" href="{{ Config::cssLib('frontend', 'line-awesome.min.css') }}">

    @if (Config::config()->alert === 'izi')
        <link rel="stylesheet" href="{{ Config::cssLib('frontend', 'izitoast.min.css') }}">
    @elseif(Config::config()->alert === 'toast')
        <link href="{{ Config::cssLib('frontend', 'toastr.min.css') }}" rel="stylesheet">
    @else
        <link href="{{ Config::cssLib('frontend', 'sweetalert.min.css') }}" rel="stylesheet">
    @endif

    @stack('external-css')

    <link rel="stylesheet" href="{{ Config::cssLib('frontend', 'main.css') }}">

    @stack('style')


    @php
        $heading = optional(Config::config()->fonts)->heading_font_family;
        $paragraph = optional(Config::config()->fonts)->paragraph_font_family;
    @endphp

    <style>
        :root {
            --clr-main: <?=Config::config()->color[Config::config()->theme] ?? '#9c0ac1'?>;
            --h-font: <?=$heading ?>;
            --p-font: <?=$paragraph ?>;
        }
    </style>

</head>

<body class="user-pages-body">

    @include(Config::theme() . 'layout.user_sidebar')

    <header class="user-header">
        <a href="{{ route('user.dashboard') }}" class="site-logo">
            <img src="{{ Config::getFile('logo', Config::config()->logo, true) }}" alt="image">
        </a>

        <button type="button" class="sidebar-toggeler"><i class="las la-bars"></i></button>



        <div class="dropdown user-dropdown">
            <a type="button" target="_blank" href="{{ route('home') }}"
                class="btn sp_theme_btn btn-sm">{{ __('Visit Home') }}</a>
            <button class="user-btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                aria-expanded="false">
                <img src="{{ Config::getFile('user', auth()->user()->image, true) }}" alt="image">
                <span>{{ auth()->user()->username }}</span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="far fa-user-circle me-2"></i>
                        {{ __('Profile') }}</a></li>
                <li><a class="dropdown-item" href="{{ route('user.2fa') }}"><i class="fas fa-cog me-2"></i>
                        {{ __('2FA') }}</a></li>
                <li><a class="dropdown-item" href="{{ route('user.logout') }}"><i class="fas fa-sign-out-alt me-2"></i>
                        {{ __('Logout') }}</a></li>
            </ul>
        </div>
    </header>

    <main class="dashbaord-main">
        @yield('content')
    </main>

    <script src="{{ Config::jsLib('frontend', 'lib/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ Config::jsLib('frontend', 'lib/jquery.min.js') }}"></script>
    <script src="{{ Config::jsLib('frontend', 'lib/wow.min.js') }}"></script>
    <script src="{{ Config::jsLib('frontend', 'lib/jquery.paroller.min.js') }}"></script>
    <script src="{{ Config::jsLib('frontend', 'lib/slick.min.js') }}"></script>

    @stack('external-script')


    @if (Config::config()->alert === 'izi')
        <script src="{{ Config::jsLib('frontend', 'izitoast.min.js') }}"></script>
    @elseif(Config::config()->alert === 'toast')
        <script src="{{ Config::jsLib('frontend', 'toastr.min.js') }}"></script>
    @else
        <script src="{{ Config::jsLib('frontend', 'sweetalert.min.js') }}"></script>
    @endif

    <script src="{{ Config::jsLib('frontend', 'main.js') }}"></script>

    @include('alert')

    @stack('script')

    <script>
        'use strict'


        $(".sidebar-menu>li>a").each(function() {
            let submenuParent = $(this).parent('li');

            $(this).on('click', function() {
                submenuParent.toggleClass('open')
            })
        });

        $('.sidebar-open-btn').on('click', function() {
            $(this).toggleClass('active');
            $('.user-sidebar').toggleClass('active');
            $('.dashbaord-main').toggleClass('active');
        });
    </script>

</body>

</html>
