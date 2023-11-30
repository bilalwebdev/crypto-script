<form action="{{ route('admin.general.basic') }}" method="post" enctype="multipart/form-data">

    @csrf

    <input type="hidden" name="type" value="general">

    <div class="row">

        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for="sitename">{{ __('Site Name') }}</label>
            <input type="text" name="sitename" class="form-control form_control" value="{{ Config::config()->appname }}">
        </div>

        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for="site_currency">{{ __('Site Currency') }}</label>
            <input type="text" name="site_currency" class="form-control" value="{{ Config::config()->currency ?? '' }}">
        </div>


        <div class="col-xxl-3 col-lg-4 col-sm-6">
            <label>{{ __('Decimal precision') }}</label>
            <div class="input-group">
                <input type="number" name="decimal_precision" class="form-control form_control"
                    value="{{ Config::config()->decimal_precision }}">
                <div class="input-group-append">
                    <span class="input-group-text bg-primary text-white" id="basic-addon2">{{ __('decimal precision') }}</span>
                </div>
            </div>
        </div>

        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for="signup_bonus">{{ __('Sign Up Bonus') }}</label>
            <input type="text" name="signup_bonus" class="form-control form_control"
                value="{{ Config::formatOnlyNumber(Config::config()->signup_bonus) }}">
        </div>

        <div class="col-xxl-3 col-lg-4 col-sm-6">
            <label>{{ __('Withdraw Limit') }}</label>
            <div class="input-group">
                <input type="number" name="withdraw_limit" class="form-control form_control"
                    value="{{ Config::config()->withdraw_limit }}">
                <div class="input-group-append">
                    <span class="input-group-text bg-primary text-white" id="basic-addon2">{{ __('Times per day') }}</span>
                </div>
            </div>
        </div>

        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for="pagination_limit">{{ __('Pagination Limit') }}</label>
            <input type="number" name="pagination_limit" class="form-control form_control"
                value="{{ Config::config()->pagination }}">
        </div>

        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for="timezone">{{ __('Timezone') }}</label>
            <select name="timezone" id="" class="form-control">
                @foreach ($timezone as $zone)
                    <option value="{{$zone}}" {{env('APP_TIMEZONE') == $zone ? 'selected' : ''}}>{{$zone}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for="alert">{{ __('Alert Type') }}</label>
            <select name="alert" id="" class="form-control">
                <option value="izi" {{Config::config()->alert === 'izi' ? 'selected' : ''}}>{{__('IziToast')}}</option>
                <option value="toast" {{Config::config()->alert === 'toast' ? 'selected' : ''}}>{{__('Toaster')}}</option>
                <option value="sweet" {{Config::config()->alert === 'sweet' ? 'selected' : ''}}>{{__('Sweetalert')}}</option>
            </select>
        </div>


        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for="">{{ __('Transfer Limit Per Day') }}</label>
            <input type="number" name="trans_limit" class="form-control"
                value="{{ Config::config()->transfer_limit }}">
        </div>

        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for="">{{ __('Transfer Charge') }}</label>

            <div class="input-group">
                <div class="input-group-prepend">
                    <input type="number" name="trans_charge" class="form-control"
                        value="{{ Config::formatOnlyNumber(Config::config()->transfer_charge) }}">
                </div>
                <select class="form-control" id="inputGroupSelect01" name="trans_type">
                    <option value="fixed"
                        {{ Config::config()->transfer_type === 'fixed' ? 'selected' : '' }}>
                        {{ __('Fixed') }}</option>
                    <option value="percent"
                        {{ Config::config()->transfer_type === 'fixed' ? '' : 'selected' }}>
                        {{ __('Percent') }}</option>
                </select>
            </div>
        </div>


        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for="">{{ __('Transfer Min Amount') }}</label>
            <input type="number" name="min_amount" class="form-control"
                value="{{ Config::formatOnlyNumber(Config::config()->transfer_min_amount) }}">
        </div>

        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for="">{{ __('Transfer Max Amount') }}</label>
            <input type="number" name="max_amount" class="form-control"
                value="{{ Config::formatOnlyNumber(Config::config()->transfer_max_amount) }}">
        </div>


        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for="">{{ __('Trading Charge') }}</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="trade_charge"
                    value="{{ Config::formatOnlyNumber(Config::config()->trade_charge) }}">
                <span class="input-group-text" id="basic-addon2">{{ __('Percent') }}</span>
            </div>
        </div>


        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for="">{{ __('Min Trade Balance') }}</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="min_trade_balance"
                    value="{{ Config::formatOnlyNumber(Config::config()->min_trade_balance) }}">
                <span class="input-group-text" id="basic-addon2">{{ Config::config()->currency }}</span>
            </div>
        </div>

        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for="">{{ __('Per day limit') }}</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="trade_limit"
                    value="{{ Config::config()->trade_limit }}">
                <span class="input-group-text" id="basic-addon2">{{ Config::config()->currency }}</span>
            </div>
        </div>

    </div>

    

    <div class="row">
        <div class="mb-4 col-md-3 mb-3">
            <label class="col-form-label">{{ __('White logo') }}</label>
            <div id="image-preview" class="image-preview"
                style="background-image:url({{ Config::getFile('logo', Config::config()->logo, true) }});">
                <label for="image-upload" id="image-label">{{ __('Choose File') }}</label>
                <input type="file" name="logo" id="image-upload" />
            </div>
        </div>

        <div class="mb-4 col-md-3 mb-3">
            <label class="col-form-label">{{ __('Dark logo') }}</label>
            <div id="image-preview-dark" class="image-preview"
                style="background-image:url({{ Config::getFile('dark_logo', Config::config()->dark_logo, true) }});">
                <label for="image-upload-dark" id="image-label-dark">{{ __('Choose File') }}</label>
                <input type="file" name="dark_logo" id="image-upload-dark" />
            </div>
        </div>

        <div class="mb-4 col-md-3 mb-3">
            <label class="col-form-label">{{ __('Icon') }}</label>
            <div id="image-preview-icon" class="image-preview"
                style="background-image:url({{ Config::getFile('icon', Config::config()->favicon, true) }});">
                <label for="image-upload-icon" id="image-label-icon">{{ __('Choose File') }}</label>
                <input type="file" name="icon" id="image-upload-icon" />
            </div>
        </div>

        <div class="mb-4 col-md-12 mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-sync-alt mr-2"></i>
                {{ __('Update General Settings') }}
            </button>
        </div>
    </div>

</form>
