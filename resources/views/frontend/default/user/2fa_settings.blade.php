@extends(Config::theme() . 'layout.auth')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="sp_site_card">
                <div class="card-header">
                    <h5>{{ __('Two Factor Authentication') }}</h5>
                </div>
                <div class="card-body">
                    <p>{{ __('Two factor authentication (2FA) strengthens access security by requiring two methods (also referred to as factors) to verify your identity. Two factor authentication protects against phishing, social engineering and password brute force attacks and secures your logins from attackers exploiting weak or stolen credentials.') }}
                    </p>

                    @if ($user->loginSecurity == null)
                        <form class="form-horizontal" method="POST" action="{{ route('user.generate2faSecret') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <button type="submit" class="btn sp_theme_btn">
                                    {{ __('Generate Secret Key to Enable 2FA') }}
                                </button>
                            </div>
                        </form>
                    @elseif(!$user->loginSecurity->google2fa_enable)
                        {{ __(' 1. Scan this QR code with your Google Authenticator App.') }}<br />

                        <img src="<?= $google2fa_url ?>">

                        <br /><br />
                        2. {{ __('Enter the pin from Google Authenticator app') }}:<br /><br />
                        <form class="form-horizontal" method="POST" action="{{ route('user.enable2fa') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('verify-code') ? ' has-error' : '' }}">
                                <label for="secret" class="control-label">{{ __('Authenticator Code') }}</label>
                                <input id="secret" type="password" class="form-control col-md-12 mb-3" name="secret"
                                    required>
                                @if ($errors->has('verify-code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('verify-code') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn sp_theme_btn">
                                {{ __('Enable 2FA') }}
                            </button>
                        </form>
                    @elseif($user->loginSecurity->google2fa_enable)
                        <p>{{ __('If you are looking to disable Two Factor Authentication. Please confirm your password and Click Disable 2FA Button') }}.
                        </p>
                        <form class="form-horizontal" method="POST" action="{{ route('user.disable2fa') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                <label for="change-password" class="control-label">{{ __('Current Password') }}</label>
                                <input id="current-password" type="password" class="form-control col-md-12 mb-4"
                                    name="current-password" required>
                                @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn sp_theme_btn">{{ __('Disable 2FA') }}</button>
                        </form>
                    @endif
                </div>

            </div>
        </div>
    </div>

@endsection
