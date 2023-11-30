@extends(Config::theme() . 'auth.master')


@section('content')
    <form action="{{ route('user.reset.password') }}" method="POST" class="reg-form">

        @csrf

        <input type="hidden" name="email" value="{{ $session['email'] }}">

        <div class="mb-3">
            <label for="">{{ __('New Password') }}</label>
            <input type="password" name="password" class="form-control" placeholder="Enter new password">
        </div>

        <div class="mb-3">
            <label for="">{{ __('Confirm Password') }}</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
        </div>

        @if (Config::config()->allow_recaptcha == 1)
            <div class="mb-3">
                <script src="https://www.google.com/recaptcha/api.js"></script>
                <div class="g-recaptcha" data-sitekey="{{ Config::config()->recaptcha_key }}" data-callback="verifyCaptcha"></div>
                <div id="g-recaptcha-error"></div>
            </div>
        @endif


        <div class="mb-3">

            <button type="submit" id="recaptcha" class="btn sp_theme_btn">{{ __('Reset Password') }}</button>
        </div>

        <div class="mb-3">

            <p>{{ __('Login Again') }}? <a href="{{ route('user.login') }}" class="sp_site_color">{{ __('Login') }}</a></p>

        </div>
    </form>
@endsection


@push('script')
    <script>
        "use strict";

        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML =
                    "<span class='sp_text_danger'>{{ __('Captcha field is required.') }}</span>";
                return false;
            }
            return true;
        }

        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }
    </script>
@endpush
