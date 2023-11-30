@extends('backend.auth.auth')

@section('element')
    <form action="{{ route('admin.password.verify.code') }}" method="POST" class="cmn-form mt-30">
        @csrf
        <div class="form-group">
            <label class="text-dark">{{ __('Verification Code') }}</label>
            <input type="text" name="code" id="code" class="form-control" placeholder="Place your Code">
        </div>

        @if (Config::config()->allow_recaptcha == 1)
            <div class="form-group">
                <script src="https://www.google.com/recaptcha/api.js"></script>
                <div class="g-recaptcha" data-sitekey="{{ Config::config()->recaptcha_key }}" data-callback="verifyCaptcha">
                </div>
                <div id="g-recaptcha-error"></div>
            </div>
        @endif
        
        <div class="form-group d-flex justify-content-end align-items-center">
           

            <a href="{{ route('admin.send.again') }}" class="text-primary text--small"
                id="try">{{ __('Try to send again') }}</a>

        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" tabindex="4">
                {{ __('Verify Code') }}
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
                    "<span class='text-danger'>{{__('Captcha field is required.')}}</span>";
                return false;
            }
            return true;
        }

        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }
    </script>
@endpush
