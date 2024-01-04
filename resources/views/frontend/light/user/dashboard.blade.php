@extends(Config::theme() . 'layout.auth')

@section('content')


    <div class="row g-sm-4 g-3">
        <div class="col-xxl-12 col-xl-12">
            <div class="d-left-wrapper">
                <div class="d-left-countdown">
                    <div id="countdownTwo"></div>
                </div>
                <div class="row g-sm-4 g-3">
                    <div class="col-xl-6 col-12">
                        <div class="d-card">
                            <div>
                                <h5>{{ __('Start trading with ---') }}</h5>
                                <div class="text-center">
                                    <a class="btn sp_theme_btn btn-sm text-uppercase mt-4 w-100"
                                        href="{{ route('user.open-account') }}">{{ __('Open Live Account!') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-12">
                        <div class="d-card">
                            <div>
                                <h5>{{ __('Top up your trading accounts now') }}</h5>
                                <div class="text-center">
                                    <a class="btn sp_theme_btn btn-sm text-uppercase mt-4 w-100"
                                        href="{{ route('user.deposit') }}">{{ __('Fund Your Account!') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xl-4 col-12">
                        <div class="d-card">
                            <div>
                                <h5>{{ __('Try us with our Demo Account!') }}</h5>

                                <div class="text-center">
                                    <a class="btn sp_theme_btn btn-sm text-uppercase mt-4 btn-block w-100" href="{{ route('user.open-account') }}?acc=demoacc">{{ __('Open Demo Account!') }}</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>



        @if ($liveAccounts)
            <div class="col-xxl-12 col-xl-12">
                <div class="col-md-12 mt-2">
                    <div class="sp_site_card">
                        <div class="card-header">
                            <div class="card-header-items">
                                <h6 class="card-header-item text-capitalize">{{ __('Live Accounts') }}</h6>

                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table sp_site_table">
                                    <thead>
                                        <tr>
                                            <th>LOGIN</th>
                                            <th>ACCOUNT TYPE</th>
                                            <th>BASE CURRENCY</th>
                                            <th>BALANCE</th>
                                            <th></th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($liveAccounts as $item)
                                            <tr>
                                                <td>
                                                    <span class="tdStyle"><b>{{ $item['login'] }}</b></span>
                                                </td>
                                                <td>
                                                    <span class="tdStyle">
                                                        @if ($item['account_type'] == 1)
                                                            Standard
                                                        @elseif($item['account_type'] == 2)
                                                            Premium
                                                        @elseif($item['account_type'] == 3)
                                                            VIP
                                                        @else
                                                            Demo
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="tdStyle text-uppercase">{{ $item['currency'] }}</span>
                                                </td>
                                                <td>
                                                    <span class="tdStyle border-0"><b>{{ $item['balance'] }} <span
                                                                class="text-uppercase">{{ $item['currency'] }}</span></b></span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('user.deposit') }}"
                                                        class="btn sp_theme_btn btn-sm text-uppercase">Fund Now</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- @if ($demoAccounts)
            <div class="col-xxl-12 col-xl-12">
                <div class="col-md-12 mt-2">
                    <div class="sp_site_card">
                        <div class="card-header">
                            <div class="card-header-items">
                                <h6 class="card-header-item text-capitalize">{{ __('Demo Accounts') }}</h6>

                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table sp_site_table">
                                    <thead>
                                        <tr>
                                            <th>LOGIN</th>
                                            <th>ACCOUNT TYPE</th>
                                            <th>BASE CURRENCY</th>
                                            <th class="text-lg-start">BALANCE</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($demoAccounts as $item)
                                            <tr>
                                                <td>
                                                    <span class="tdStyle"><b>{{ $item->login }}</b></span>
                                                </td>
                                                <td>
                                                    <span class="tdStyle">
                                                        DEMO
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="tdStyle text-uppercase">{{ $item->currency }}</span>
                                                </td>
                                                <td class="text-lg-start">
                                                    <span class="tdStyle border-0"><b>{{ $item->balance }} <span
                                                                class="text-uppercase">{{ $item->currency }}</span></b></span>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif --}}




    </div>
    </div>
@endsection

@push('external-css')
    <link rel="stylesheet" href="{{ Config::cssLib('frontend', 'lib/apex.min.css') }}">
@endpush
