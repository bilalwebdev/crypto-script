@extends(Config::theme() . 'auth.master')

@section('content')
    <form class="account-form mt-4" action="{{ route('user.auth.verify') }}" method="POST">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">

        <label>{{ __('Verification Code') }}</label>
        <div class="sp_input_icon_field mb-3">
            <input type="text" name="code" class="form-control" placeholder="{{ __('Enter Code Here') }}">
            <i class="las la-envelope"></i>
        </div>


        @if (Config::config()->allow_recaptcha == 1)
            <div class="col-md-12 my-3">
                <script src="https://www.google.com/recaptcha/api.js"></script>
                <div class="g-recaptcha" data-sitekey="{{ Config::config()->recaptcha_key }}" data-callback="verifyCaptcha">
                </div>
                <div id="g-recaptcha-error"></div>
            </div>
        @endif


        <div class="d-flex flex-wrap align-items-center mt-4">
            <button type="submit" class="btn sp_theme_btn">{{ __('Verify Now') }}</button>
            <span class="px-3">{{__('or')}}</span>
            <a href="{{ route('user.login') }}" class="sp_site_color">{{ __('Login Again') }}</a>
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
