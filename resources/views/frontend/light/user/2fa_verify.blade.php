@extends(Config::theme() . 'layout.auth')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="sp_site_card">
                <div class="card-header">
                    <h5>{{ __('Two Factor Authentication') }}</h5>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <p>{{ __('Two factor authentication (2FA) strengthens access security by requiring two methods (also referred to as factors) to verify your identity. Two factor authentication protects against phishing, social engineering and password brute force attacks and secures your logins from attackers exploiting weak or stolen credentials.') }}
                        </p>

                        {{ __(' Enter the pin from Google Authenticator app') }}:<br /><br />
                        <form class="form-horizontal" action="{{ route('user.2faVerify') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('one_time_password-code') ? ' has-error' : '' }}">
                                <label for="one_time_password" class="control-label">{{ __('One Time Password') }}</label>
                                <input id="one_time_password" name="one_time_password" class="form-control col-md-12 mb-3"
                                    type="text" required />
                            </div>
                            <button class="btn sp_theme_btn w-100" type="submit">{{ __('Authenticate') }}</button>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

@endsection
