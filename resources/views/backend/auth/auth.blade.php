<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>{{Config::config()->appname}}</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ Config::fetchImage('icon', Config::config()->favicon, true) }}">

    
    @if (Config::config()->alert === 'izi')
        <link rel="stylesheet" href="{{ Config::cssLib('backend', 'izitoast.min.css') }}">
    @elseif(Config::config()->alert === 'toast')
        <link href="{{ Config::cssLib('backend', 'toastr.min.css') }}" rel="stylesheet">
    @else
        <link href="{{ Config::cssLib('backend', 'sweetalert.min.css') }}" rel="stylesheet">
    @endif

    <link href="{{ Config::cssLib('backend', 'main.css') }}" rel="stylesheet">

</head>

<body class="h-100">

    <div class="authincation">
        <div class="authincation-content rounded-xl">
            <div class="auth-form rounded-xl">
                <h3 class="text-center mb-4">{{ $title }}</h3>
                @yield('element')
            </div>
        </div>
    </div>

    <script src="{{ Config::jsLib('backend', 'global.min.js') }}"></script>

    @if (Config::config()->alert === 'izi')
        <script src="{{ Config::jsLib('backend', 'izitoast.min.js') }}"></script>
    @elseif(Config::config()->alert === 'toast')
        <script src="{{ Config::jsLib('backend', 'toastr.min.js') }}"></script>
    @else
        <script src="{{ Config::jsLib('backend', 'sweetalert.min.js') }}"></script>
    @endif

    @include('alert')


    @stack('script')

</body>

</html>
