@extends(Config::theme() . 'auth.master')

@section('content')
    <form action="{{ route('user.register') }}" method="POST">
        @csrf
        <div class="row">
            @if (isset(request()->reffer))
                <div class="col-md-12">
                    <label>{{ __('Reffered By') }}</label>
                    <div class="sp_input_icon_field mb-3">
                        <input type="text" class="form-control sp_bg_dark" value="{{ request()->reffer }}" name="reffered_by"
                            placeholder="{{ __('Reffered By') }}" readonly>
                        <i class="las la-envelope"></i>
                    </div>
                </div>
            @endif
            
            <div class="col-sm-6">
                <label>{{ __(' Username') }}</label>
                <div class="sp_input_icon_field mb-3">
                    <input type="text" class="form-control @error('username', 'registration')  is-invalid @enderror"
                        name="username" value="{{ old('username') }}" id="username" placeholder="{{ __('User Name') }}">
                    <i class="las la-user"></i>
                    @error('username', 'registration')
                        <div class="invalid-feedback">
                            {{ __($message) }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <label>{{ __('Whatsapp Number') }}</label>
                <div class="sp_input_icon_field mb-3">
                    <input type="tel" name="phone"
                        class="form-control @error('phone', 'registration')  is-invalid @enderror"
                        placeholder="Phone number">
                    <i class="las la-phone"></i>
                    @error('phone', 'registration')
                        <div class="invalid-feedback">
                            {{ __($message) }}
                        </div>
                    @enderror
                </div>

            </div>
            <div class="col-lg-12">
                <label>{{ __('Email') }}</label>
                <div class="sp_input_icon_field mb-3">
                    <input type="Email" class="form-control @error('email', 'registration')  is-invalid @enderror"
                        name="email" value="{{ old('email') }}" id="email" placeholder="{{ __('Email') }}">
                    <i class="las la-envelope"></i>
                    @error('email', 'registration')
                        <div class="invalid-feedback">
                            {{ __($message) }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <label>{{ __('Password') }}</label>
                <div class="sp_input_icon_field mb-3">
                    <input type="password" class="form-control @error('password', 'registration')  is-invalid @enderror"
                        name="password" id="password" placeholder="{{ __('Password') }}">
                    <i class="las la-eye" id="togglePassword"></i>
                    @error('password', 'registration')
                        <div class="invalid-feedback">
                            {{ __($message) }}
                        </div>
                    @enderror
                </div>

            </div>
            <div class="col-sm-6">
                <label>{{ __('Confirm password') }}</label>
                <div class="sp_input_icon_field mb-3">
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                        placeholder="{{ __('Confirm Password') }}">
                    <i class="las la-eye" id="confirmTogglePassword"></i>
                </div>
            </div>

            @if (Config::config()->allow_recaptcha == 1)
                <div class="col-md-12 my-3">
                    <script src="https://www.google.com/recaptcha/api.js"></script>
                    <div class="g-recaptcha" data-sitekey="{{ Config::config()->recaptcha_key }}" data-callback="verifyCaptcha">
                    </div>
                    <div id="g-recaptcha-error"></div>
                </div>
            @endif
        </div>
        <div class="mt-4">
            <button type="submit" class="btn sp_theme_btn w-100">{{ __('Sign Up') }}</button>
        </div>
        <p class="text-center mt-4">{{ __('Already have an account') }} ? <a href="{{ route('user.login') }}"
                class="sp_site_color">{{ __('Login') }}</a></p>
    @endsection

    @push('script')
        <script>
            "use strict";


            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function(e) {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.classList.toggle('la-eye-slash');
            });


            const togglePasswordConfirm = document.querySelector('#confirmTogglePassword');
            const passwordConfirm = document.querySelector('#password_confirmation');

            togglePasswordConfirm.addEventListener('click', function(e) {
                const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirm.setAttribute('type', type);
                this.classList.toggle('la-eye-slash');
            });


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
