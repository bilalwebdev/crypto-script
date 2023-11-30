@extends('backend.auth.auth')


@section('element')
    <form action="{{ route('admin.password.change') }}" method="POST" class="cmn-form mt-30">
        @csrf

        <input type="hidden" name="email" value="{{ isset($email) ? $email : '' }}">
        <input type="hidden" name="token" value="{{ isset($token) ? $token : '' }}">

        <div class="form-group">
            <label for="pass" class="text-white">{{ __('New Password') }}</label>
            <input type="password" name="password" class="form-control b-radius--capsule" id="password"
                placeholder="New password">
            <i class="las la-lock input-icon"></i>
        </div>
        <div class="form-group">
            <label for="pass" class="text-white">{{ __('Retype New Password') }}</label>
            <input type="password" name="password_confirmation" class="form-control b-radius--capsule"
                id="password_confirmation" placeholder="Retype New password">
            <i class="las la-lock input-icon"></i>
        </div>

        @if (Config::config()->allow_recaptcha == 1)
            <div class="form-group">
                <script src="https://www.google.com/recaptcha/api.js"></script>
                <div class="g-recaptcha" data-sitekey="{{ Config::config()->recaptcha_key }}" data-callback="verifyCaptcha">
                </div>
                <div id="g-recaptcha-error"></div>
            </div>
        @endif

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" tabindex="4">
                {{ __('Reset Password') }}
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
