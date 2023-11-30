<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>{{ Config::config()->appname }}</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ Config::fetchImage('icon', Config::config()->favicon, true) }}">

    <link href="{{ Config::cssLib('backend', 'all.min.css') }}" rel="stylesheet">


    <link href="{{ Config::cssLib('backend', 'line-awesome.min.css') }}" rel="stylesheet">

    <link href="{{ Config::cssLib('backend', 'perfect-scrollbar.css') }}" rel="stylesheet">

    <link href="{{ Config::cssLib('backend', 'metisMenu.min.css') }}" rel="stylesheet">

    <link href="{{ Config::cssLib('backend', 'uploader.css') }}" rel="stylesheet">

    <link href="{{ Config::cssLib('backend', 'iconpicker.css') }}" rel="stylesheet">

    <link href="{{ Config::cssLib('backend', 'jquery.dataTables.min.css') }}" rel="stylesheet">

    <link href="{{ Config::cssLib('backend', 'summernote-bs4.min.css') }}" rel="stylesheet">

    <link href="{{ Config::cssLib('backend', 'ui.css') }}" rel="stylesheet">

    @if (Config::config()->alert === 'izi')
        <link href="{{ Config::cssLib('backend', 'izitoast.min.css') }}" rel="stylesheet">
    @elseif(Config::config()->alert === 'toast')
        <link href="{{ Config::cssLib('backend', 'toastr.min.css') }}" rel="stylesheet">
    @else
        <link href="{{ Config::cssLib('backend', 'sweetalert.min.css') }}" rel="stylesheet">
    @endif

    @stack('external-style')

    <link href="{{ Config::cssLib('backend', 'main.css') }}" rel="stylesheet">

    @stack('style')

</head>
<body>

    <div id="main-wrapper">

        @include('backend.layout.header')

        @include('backend.layout.sidebar')

        <div class="content-body">
            <div id="overlay">
                <div class="cv-spinner">
                    <span class="spinner"></span>
                </div>
            </div>
            <div class="container-fluid">
                @include('backend.layout.breadcrumb')

                @yield('element')

            </div>
        </div>

        @include('backend.layout.footer')

    </div>

    <script src="{{ Config::jsLib('backend', 'global.min.js') }}"></script>

    <script src="{{ Config::jsLib('backend', 'feather.min.js') }}"></script>

    <script src="{{ Config::jsLib('backend', 'quixnav-init.js') }}"></script>

    <script src="{{ Config::jsLib('backend', 'metismenu.min.js') }}"></script>

    <script src="{{ Config::jsLib('backend', 'perfectscroll.min.js') }}"></script>

    <script src="{{ Config::jsLib('backend', 'jquery.dataTables.min.js') }}"></script>

    <script src="{{ Config::jsLib('backend', 'jquery.uploadPreview.min.js') }}"></script>

    <script src="{{ Config::jsLib('backend', 'summernote-bs4.min.js') }}"></script>

    <script src="{{ Config::jsLib('backend', 'ui.js') }}"></script>

    <script src="{{ Config::jsLib('backend', 'apex-chart.min.js') }}"></script>

    <script src="{{ Config::jsLib('backend', 'iconpicker.js') }}"></script>

    @if (Config::config()->alert === 'izi')
        <script src="{{ Config::jsLib('backend', 'izitoast.min.js') }}"></script>
    @elseif(Config::config()->alert === 'toast')
        <script src="{{ Config::jsLib('backend', 'toastr.min.js') }}"></script>
    @else
        <script src="{{ Config::jsLib('backend', 'sweetalert.min.js') }}"></script>
    @endif

    @stack('external-script')

    <script src="{{ Config::jsLib('backend', 'custom.js') }}"></script>

    @stack('script')
    @include('backend.layout.alert')

    <script>
        $(function() {
            'use strict'
            
            $('.summernote').summernote({
                height: 250,
            });

            var url = "{{ route('admin.changeLang') }}";

            $(".changeLang").change(function() {
                if ($(this).val() == '') {
                    return false;
                }
                window.location.href = url + "?lang=" + $(this).val();
            });
        })
    </script>

</body>

</html>
