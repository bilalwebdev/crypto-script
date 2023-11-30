@extends('backend.auth.auth')

@section('element')
    <form action="{{ route('admin.password.reset') }}" method="POST" class="cmn-form mt-30">
        @csrf
        <div class="form-group">
            <label for="email" class="text-white">{{ __('Email') }}</label>
            <input type="email" name="email" class="form-control b-radius--capsule" id="username"
                value="{{ old('email') }}" placeholder="{{ __('Enter your email') }}">
            <i class="las la-user input-icon"></i>
        </div>

        @if (Config::config()->allow_recaptcha == 1)
            <div class="form-group">
                <script src="https://www.google.com/recaptcha/api.js"></script>
                <div class="g-recaptcha" data-sitekey="{{ Config::config()->recaptcha_key }}" data-callback="verifyCaptcha">
                </div>
                <div id="g-recaptcha-error"></div>
            </div>
        @endif


        <div class="form-group text-right">
            <a href="{{ route('admin.login') }}" class="text--small"><i
                    class="fas fa-lock mr-2"></i>{{ __('Back to Login') }}</a>
        </div>

        <div class="form-group mb-0">
            <button type="submit" class="btn btn-primary btn-block">
                {{ __('Send Reset Code') }}
            </button>
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
                    "<span class='text-danger'>{{ __('Captcha field is required.') }}</span>";
                return false;
            }
            return true;
        }

        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }
    </script>
@endpush
