<form action="{{ route('admin.general.basic') }}" method="post">
    @csrf
    <input type="hidden" name="type" value="api">

    
    <div class="card">
        <div class="card-header">
            <h4 class="m-0">{{ __('Cryptocompare Api') }}</h4>
        </div>
        <div class="card-body">

            <div class="row">

                <div class="mb-4 col-md-12">
                    <label for="">{{ __('Api Key') }}</label>
                    <input type="text" name="api_key" class="form-control"
                        value="{{ env('DEMO') ? '------' : Config::config()->crypto_api }}">
                </div>
            </div>
        </div>
    </div>

    

    <div class="card">
        <div class="card-header">

            <h4 class="m-0">{{ __('Facebook Auth') }}</h4>
        </div>
        <div class="card-body">

            <div class="row">

                <div class="mb-4 col-md-5">
                    <label for="">{{ __('App ID') }}</label>
                    <input type="text" name="app_id" class="form-control"
                        value="{{ env('DEMO') ? '------' : env('FACEBOOK_APP_ID') }}">
                </div>

                <div class="mb-4 col-md-5">
                    <label for="">{{ __('App Secret') }}</label>
                    <input type="text" name="app_secret" class="form-control"
                        value="{{ env('DEMO') ? '------' : env('FACEBOOK_SECRET') }}">
                </div>

                <div class="mb-4 col-md-2">
                    <label for="">{{ __('Allow Facebook Login') }}</label>
                    <input type="checkbox" name="allow_facebook" {{ Config::config()->allow_facebook ? 'checked' : '' }}
                        data-toggle="toggle" data-on="Active" data-off="Disabled" data-onstyle="success"
                        data-offstyle="danger" data-width="100%" data-height="43px">
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header">

            <h4 class="m-0">{{ __('Google Auth') }}</h4>
        </div>
        <div class="card-body">

            <div class="row">

                <div class="mb-4 col-md-5">
                    <label for="">{{ __('App ID') }}</label>
                    <input type="text" name="google_app_id" class="form-control"
                        value="{{ env('DEMO') ? '------' : env('GOOGLE_APP_ID') }}">
                </div>

                <div class="mb-4 col-md-5">
                    <label for="">{{ __('App Secret') }}</label>
                    <input type="text" name="google_app_secret" class="form-control"
                        value="{{ env('DEMO') ? '------' : env('GOOGLE_SECRET') }}">
                </div>

                <div class="mb-4 col-md-2">
                    <label for="">{{ __('Allow google Login') }}</label>
                    <input type="checkbox" name="allow_google" {{ Config::config()->allow_google ? 'checked' : '' }}
                        data-toggle="toggle" data-on="Active" data-off="Disabled" data-onstyle="success"
                        data-offstyle="danger" data-width="100%" data-height="43px">
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="m-0">{{ __('Telegram Bot') }}</h4>
            <p class="m-0">
                <button class="btn btn-primary btn-sm ins"> <i class="fa fa-eye"></i> {{ __('Instruction') }}</button>
            </p>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="mb-4 col-md-5">
                    <label for="">{{ __('Telegram Bot Url') }}</label>
                    <input type="text" name="bot_url" class="form-control"
                        value="{{ env('DEMO') ? '------' : Config::config()->bot_url }}">
                </div>

                <div class="mb-4 col-md-5">
                    <label for="">{{ __('Telegram Bot Token') }}</label>
                    <input type="text" name="telegram_token" class="form-control"
                        value="{{ env('DEMO') ? '------' : Config::config()->telegram_token }}">
                </div>

                <div class="mb-4 col-md-2">
                    <label for="">{{ __('Allow Telegram') }}</label>
                    <input type="checkbox" name="allow_telegram"
                        {{ Config::config()->allow_telegram ? 'checked' : '' }} data-toggle="toggle" data-on="Active"
                        data-off="Disabled" data-onstyle="success" data-offstyle="danger" data-width="100%"
                        data-height="43px">
                </div>
            </div>
        </div>
    </div>




    <div class="card">
        <div class="card-header">

            <h4 class="m-0">{{ __('Ultramsg Settings') }} <a href="https://ultramsg.com/"
                    style="text-decoration: underline">(Whatsapp api)</a></h4>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="mb-4 col-md-5">
                    <label for="">{{ __('Ultramsg ID') }}</label>
                    <input type="text" name="ultra_id" class="form-control"
                        value="{{ env('DEMO') ? '------' : env('ULTRA_ID') }}">
                </div>

                <div class="mb-4 col-md-5">
                    <label for="">{{ __('Ultramsg TOKEN') }}</label>
                    <input type="text" name="ultra_token" class="form-control"
                        value="{{ env('DEMO') ? '------' : env('ULTRA_TOKEN') }}">
                </div>

                <div class="mb-4 col-md-2">
                    <label for="">{{ __('Allow Ultramsg') }}</label>
                    <input type="checkbox" name="allow_ultra" {{ env('ALLOW_ULTRA') == 'on' ? 'checked' : '' }}
                        data-toggle="toggle" data-on="Active" data-off="Disabled" data-onstyle="success"
                        data-offstyle="danger" data-width="100%" data-height="43px">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>{{ __('Google reCaptcha v3') }}</h4>
        </div>
        <div class="card-body">

            <div class="row">

                <div class="mb-4 col-md-5">
                    <label for="">{{ __('Recaptcha Key') }}</label>
                    <input type="text" name="recaptcha_key" class="form-control"
                        value="{{ env('DEMO') ? '------' : Config::config()->recaptcha_key }}">
                </div>

                <div class="mb-4 col-md-5">
                    <label for="">{{ __('Recaptcha Secret') }}</label>
                    <input type="text" name="recaptcha_secret" class="form-control"
                        value="{{ env('DEMO') ? '------' : Config::config()->recaptcha_secret }}">
                </div>

                <div class="mb-4 col-md-2">
                    <label for="">{{ __('Allow Recaptcha') }}</label>
                    <input type="checkbox" name="allow_recaptcha"
                        {{ Config::config()->allow_recaptcha ? 'checked' : '' }} data-toggle="toggle"
                        data-on="Active" data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                        data-width="100%" data-height="43px">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>{{ __('Tidio Settings') }}</h4>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="mb-4 col-md-10">
                    <label for="">{{ __('Tidio url') }}</label>
                    <input type="text" name="tidio_url" class="form-control" placeholder="Tidio url"
                        value="{{ env('DEMO') ? '------' : Config::config()->tdio_url }}">
                </div>

                <div class="mb-4 col-md-2">
                    <label for="">{{ __('Allow tidio') }}</label>
                    <input type="checkbox" name="tdio_allow" {{ Config::config()->tdio_allow ? 'checked' : '' }}
                        data-toggle="toggle" data-on="Active" data-off="Disabled" data-onstyle="success"
                        data-offstyle="danger" data-width="100%" data-height="43px">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>{{ __('Google Analytics Settings') }}</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="mb-4 col-md-10 mb-3">
                    <label>{{ __('Analytics Id') }}</label>
                    <input type="text" name="analytics_key" class="form-control form_control"
                        placeholder="Analytics Id"
                        value="{{ env('DEMO') ? '------' : Config::config()->analytics_key }}">
                </div>

                <div class="mb-4 col-md-2">
                    <label for="">{{ __('Allow Analytics') }}</label>
                    <input type="checkbox" name="analytics_status"
                        {{ Config::config()->analytics_status ? 'checked' : '' }} data-toggle="toggle"
                        data-on="Active" data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                        data-width="100%" data-height="43px">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>{{ __('Nexmo Settings') }}</h4>
        </div>
        <div class="card-body">

            <div class="row">

                <div class="mb-4 col-md-8">
                    <label for="">{{ __('Nexmo Key') }}</label>
                    <input type="text" name="sms_username" class="form-control" placeholder="Sms API KEY"
                        value="{{ env('DEMO') ? '------' : env('NEXMO_KEY') }}">
                </div>

                <div class="mb-4 col-md-4">
                    <label for="">{{ __('Nexmo Secret') }}</label>
                    <input type="text" name="sms_password" class="form-control" placeholder="Sms API Secret"
                        value="{{ env('DEMO') ? '------' : env('NEXMO_SECRET') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt mr-2"></i>
                {{ __('Update API Settings') }}</button>
        </div>
    </div>
</form>



