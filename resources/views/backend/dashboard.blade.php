@extends('backend.layout.master')

@section('element')
    <div class="row">
        <div class="col-xxl-9">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="card mb-4 gr-white rounded-xl link-item widget-hr-effect">
                        <a href="{{ route('admin.payments.index', 'offline') }}" class="link"></a>
                        <div class="sp-widget-2 card-body">
                            <a href="{{ route('admin.payments.index', 'offline') }}" class="widget-link-arrow"><i
                                    class="las la-arrow-right"></i></a>
                            <div class="top">
                                <div class="widget-icon">
                                    <i class="las la-dollar-sign"></i>
                                </div>
                                <div class="widget-content">
                                    <h5 class="mb-0">{{ __('Total Payments') }}</h5>
                                </div>
                            </div>
                            <div class="bottom mt-3">
                                <div class="widget-content">
                                    <h2 class="mb-0">{{ Config::formatter($subscriptionAmount) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card mb-4 gr-white gr-white2 rounded-xl link-item widget-hr-effect">
                        <a href="{{ route('admin.deposit', 'offline') }}" class="link"></a>
                        <div class="sp-widget-2 card-body">
                            <a href="{{ route('admin.deposit', 'offline') }}" class="widget-link-arrow"><i
                                    class="las la-arrow-right"></i></a>
                            <div class="top">
                                <div class="widget-icon">
                                    <i class="las la-hourglass-half"></i>
                                </div>
                                <div class="widget-content">
                                    <h5 class="mb-0">{{ __('Total Deposit') }}</h5>
                                </div>
                            </div>
                            <div class="bottom mt-3">
                                <div class="widget-content">
                                    <h2 class="mb-0">{{ Config::formatter($totalDeposit) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card mb-4 gr-white gr-white3 rounded-xl link-item widget-hr-effect">
                        <a href="{{ route('admin.withdraw.filter', 'pending') }}" class="link"></a>
                        <div class="sp-widget-2 card-body">
                            <a href="{{ route('admin.withdraw.filter', 'pending') }}" class="widget-link-arrow"><i
                                    class="las la-arrow-right"></i></a>
                            <div class="top">
                                <div class="widget-icon">
                                    <i class="las la-hourglass-start"></i>
                                </div>
                                <div class="widget-content">
                                    <h5 class="mb-0">{{ __('Total Withdraw') }}</h5>
                                </div>
                            </div>
                            <div class="bottom mt-3">
                                <div class="widget-content">
                                    <h2 class="mb-0">{{ Config::formatter($totalWithdraw) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6 col-4 mb-4">
                    <div class="sp-widget-1 bg-white rounded-xl link-item widget-hr-effect">
                        <a href="{{ route('admin.user.index') }}" class="link"></a>
                        <div class="widget-icon light-icon-1">
                            <i class="las la-dollar-sign"></i>
                        </div>
                        <div class="widget-content">
                            <div class="widget-caption text-dark">{{ __('Total user') }}</div>
                            <h3 class="mb-0 mt-1 widget-title text-dark">{{ $totalUser }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-4 mb-4">
                    <div class="sp-widget-1 bg-white rounded-xl link-item widget-hr-effect">
                        <a href="{{ route('admin.user.filter', 'deactive') }}" class="link"></a>
                        <div class="widget-icon light-icon-2">
                            <i class="las la-user-friends"></i>
                        </div>
                        <div class="widget-content">
                            <div class="widget-caption text-dark">{{ __('Deactive user') }}</div>
                            <h3 class="mb-0 mt-1 widget-title text-dark">{{ $pendingUser }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-4 mb-4">
                    <div class="sp-widget-1 bg-white rounded-xl link-item widget-hr-effect">
                        <a href="{{ route('admin.ticket.index') }}" class="link"></a>
                        <div class="widget-icon light-icon-3">
                            <i class="las la-folder"></i>
                        </div>
                        <div class="widget-content">
                            <div class="widget-caption text-dark">{{ __('Total Ticket') }}</div>
                            <h3 class="mb-0 mt-1 widget-title text-dark">{{ $totalTicket }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-4 mb-4">
                    <div class="sp-widget-1 bg-white rounded-xl link-item widget-hr-effect">
                        <a href="{{ route('admin.ticket.status', 'pending') }}" class="link"></a>
                        <div class="widget-icon  light-icon-4">
                            <i class="las la-link"></i>
                        </div>
                        <div class="widget-content">
                            <div class="widget-caption text-dark">{{ __('Pending Ticket') }}</div>
                            <h3 class="mb-0 mt-1 widget-title text-dark">{{ $pendingTicket }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-4 mb-4">
                    <div class="sp-widget-1 bg-white rounded-xl link-item widget-hr-effect">
                        <a href="{{ route('admin.payment.index') }}" class="link"></a>
                        <div class="widget-icon light-icon-5">
                            <i class="las la-dollar-sign"></i>
                        </div>
                        <div class="widget-content">
                            <div class="widget-caption text-dark">{{ __('Online Gateway') }}</div>
                            <h3 class="mb-0 mt-1 widget-title text-dark">{{ $totalOnlineGateway }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-4 mb-4">
                    <div class="sp-widget-1 bg-white rounded-xl link-item widget-hr-effect">
                        <a href="{{ route('admin.payment.offline') }}" class="link"></a>
                        <div class="widget-icon light-icon-6">
                            <i class="las la-user-friends"></i>
                        </div>
                        <div class="widget-content">
                            <div class="widget-caption text-dark">{{ __('Offline Gateway') }}</div>
                            <h3 class="mb-0 mt-1 widget-title text-dark">{{ $totalOfflineGateway }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-md-6">
            <div class="card">
                <div class="card-body pb-1">
                    <h4 class="mb-3">{{ __('Quick Links') }}</h4>
                    <div class="row quick-links-wrapper">
                        <div class="col-4 mb-3">
                            <div class="short-card link-item">
                                <a href="{{ route('admin.user.index') }}" class="link"></a>
                                <div class="short-card-icon light-icon-1">
                                    <i class="fas fa-exchange-alt"></i>
                                </div>
                                <p class="short-card-title">{{ __('Users') }}</p>
                            </div>
                        </div>
                        <div class="col-4 mb-3">
                            <div class="short-card link-item">
                                <a href="{{ route('admin.plan.index') }}" class="link"></a>
                                <div class="short-card-icon light-icon-2">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <p class="short-card-title">{{ __('Plans') }}</p>
                            </div>
                        </div>
                        <div class="col-4 mb-3">
                            <div class="short-card link-item">
                                <a href="{{ route('admin.signals.index') }}" class="link"></a>
                                <div class="short-card-icon light-icon-3">
                                    <i class="fas fa-link"></i>
                                </div>
                                <p class="short-card-title">{{ __('Signals') }}</p>
                            </div>
                        </div>
                        <div class="col-4 mb-3">
                            <div class="short-card link-item">
                                <a href="{{ route('admin.deposit', 'offline') }}" class="link"></a>
                                <div class="short-card-icon light-icon-4">
                                    <i class="fas fa-wallet"></i>
                                </div>
                                <p class="short-card-title">{{ __('Deposit') }}</p>
                            </div>
                        </div>
                        <div class="col-4 mb-3">
                            <div class="short-card link-item">
                                <a href="{{ route('admin.withdraw.filter', 'pending') }}" class="link"></a>
                                <div class="short-card-icon light-icon-5">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </div>
                                <p class="short-card-title">{{ __('Withdraw') }}</p>
                            </div>
                        </div>
                        <div class="col-4 mb-3">
                            <div class="short-card link-item">
                                <a href="{{ route('admin.payments.index', 'offline') }}" class="link"></a>
                                <div class="short-card-icon light-icon-6">
                                    <i class="fas fa-ticket-alt"></i>
                                </div>
                                <p class="short-card-title">{{ __('Payments') }}</p>
                            </div>
                        </div>
                        <div class="col-4 mb-3">
                            <div class="short-card link-item">
                                <a href="{{ route('admin.transaction') }}" class="link"></a>
                                <div class="short-card-icon light-icon-7">
                                    <i class="fas fa-exchange-alt"></i>
                                </div>
                                <p class="short-card-title">{{ __('Reports') }}</p>
                            </div>
                        </div>
                        <div class="col-4 mb-3">
                            <div class="short-card link-item">
                                <a href="{{ route('admin.ticket.index') }}" class="link"></a>
                                <div class="short-card-icon light-icon-8">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <p class="short-card-title">{{ __('Tickets') }}</p>
                            </div>
                        </div>
                        <div class="col-4 mb-3">
                            <div class="short-card link-item">
                                <a href="{{ route('admin.general.index') }}" class="link"></a>
                                <div class="short-card-icon light-icon-9">
                                    <i class="fas fa-link"></i>
                                </div>
                                <p class="short-card-title">{{ __('Settings') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 d-xxl-none d-block">
            <div class="card">
                <div class="card-body">
                    <h4>{{ __('Users Status') }}</h4>
                    <div id="chart5" class="d-flex justify-content-center"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('Payment Chart') }}</h4>
                </div>
                <div class="card-body">
                    <div id="profit-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 d-xxl-block d-none">
            <div class="card">
                <div class="card-body">
                    <h4>{{ __('Users Status') }}</h4>
                    <div id="chart2" class="d-flex justify-content-center"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-9 col-lg-8">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h4 class="card-title">{{ __('Latest Subscription List') }}</h4>
                    <a href="{{ route('admin.payments.index', 'offline') }}"
                        class="site-color fw-500">{{ __('View All') }}</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('User') }}</th>
                                    <th>{{ __('Plan') }}</th>
                                    <th>{{ __('TRX') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @forelse($investments as $key => $invest)
                                
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.user.details', optional($invest->user)->id) }}">
                                                <img src="{{ Config::getFile('user', optional($invest->user)->image, true) }}"
                                                    alt="" class="image-table">
                                                <span>
                                                    {{ optional($invest->user)->username }}
                                                </span>
                                            </a>
                                        </td>
                                        <td>{{ optional($invest->plan)->name }}</td>
                                        <td>{{ $invest->trx }}</td>
                                        <td>{{ Config::formatter($invest->amount) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center">{{ __('No user Found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-lg-4">
            <div class="card">
                <div class="card-body user-status-card">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <h4>{{ __('Browser Statistics') }}</h4>
                    </div>

                    <ul class="browser-status-list mt-4">
                        <li>
                            <span class="caption"><img src="{{ Config::getFile('browsers','chrome.svg', true) }}"
                                    alt="image"> {{ __('Chrome') }}</span>
                            <span
                                class="user-amount">{{ optional($browser->where('browser', 'Chrome')->first())->total ?? 0 }}</span>
                            <div class="user-progressbar">
                                @php
                                    $count = (100 * (optional($browser->where('browser', 'Chrome')->first())->total ?? 0)) / ($logTotal == 0 ? 1 : $logTotal);
                                @endphp
                                <div class="user-progressbar-inner bg-success" style="width: {{ $count }}%;">
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="caption"><img src="{{ Config::getFile('browsers','firefox.svg', true) }}"
                                    alt="image"> {{ __('Friefox') }}</span>
                            <span
                                class="user-amount">{{ optional($browser->where('browser', 'Mozilla')->first())->total ?? 0 }}</span>
                            <div class="user-progressbar">
                                @php
                                    $count = (100 * (optional($browser->where('browser', 'Mozilla')->first())->total ?? 0)) / ($logTotal == 0 ? 1 : $logTotal);
                                @endphp
                                <div class="user-progressbar-inner bg-danger" style="width: {{ $count }}%;"></div>
                            </div>
                        </li>
                        <li>
                            <span class="caption"><img src="{{ Config::getFile('browsers','safari.svg', true) }}"
                                    alt="image"> {{ __('Safari') }}</span>
                            <span
                                class="user-amount">{{ optional($browser->where('browser', 'Safari')->first())->total ?? 0 }}</span>
                            <div class="user-progressbar">
                                @php
                                    $count = (100 * (optional($browser->where('browser', 'Safari')->first())->total ?? 0)) / ($logTotal == 0 ? 1 : $logTotal);
                                @endphp
                                <div class="user-progressbar-inner bg-info" style="width: {{ $count }}%;"></div>
                            </div>
                        </li>
                        <li>
                            <span class="caption"><img src="{{ Config::getFile('browsers','edge.svg', true) }}"
                                    alt="image"> {{ __('Edge') }}</span>
                            <span
                                class="user-amount">{{ optional($browser->where('browser', 'Edge')->first())->total ?? 0 }}</span>
                            <div class="user-progressbar">
                                @php
                                    $count = (100 * (optional($browser->where('browser', 'Edge')->first())->total ?? 0)) / ($logTotal == 0 ? 1 : $logTotal);
                                @endphp

                                <div class="user-progressbar-inner bg-info" style="width: {{ $count }}%;"></div>
                            </div>
                        </li>
                        <li>
                            <span class="caption"><img src="{{ Config::getFile('browsers','opera.svg', true) }}"
                                    alt="image"> {{ __('Opera') }}</span>
                            <span
                                class="user-amount">{{ optional($browser->where('browser', 'Opera')->first())->total ?? 0 }}</span>
                            <div class="user-progressbar">
                                @php
                                    $count = (100 * (optional($browser->where('browser', 'Opera')->first())->total ?? 0)) / ($logTotal == 0 ? 1 : $logTotal);
                                @endphp
                                <div class="user-progressbar-inner bg-danger" style="width: {{ $count }}%;"></div>
                            </div>
                        </li>
                        <li>
                            <span class="caption"><img src="{{ Config::getFile('browsers','uc.svg', true) }}"
                                    alt="image"> {{ __('UC') }}</span>
                            <span
                                class="user-amount">{{ optional($browser->where('browser', 'Uc')->first())->total ?? 0 }}</span>
                            <div class="user-progressbar">
                                @php
                                    $count = (100 * (optional($browser->where('browser', 'Uc')->first())->total ?? 0)) / ($logTotal == 0 ? 1 : $logTotal);
                                @endphp
                                <div class="user-progressbar-inner bg-warning" style="width: {{ $count }}%;">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h4 class="card-title">{{ __('Latest Deposit') }}</h4>
                    <a href="{{ route('admin.deposit', 'offline') }}" class="site-color fw-500">{{ __('View All') }}</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('User') }}</th>

                                    <th>{{ __('TRX') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($deposits as $key => $deposit)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.user.details', $deposit->user->id) }}">
                                                <img src="{{ Config::getFile('user', $deposit->user->image, true) }}"
                                                    alt="" class="image-table">
                                                <span>
                                                    {{ $deposit->user->username }}
                                                </span>
                                            </a>
                                        </td>

                                        <td>{{ $deposit->trx }}</td>
                                        <td>{{ Config::formatter($deposit->amount) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center">{{ __('No user Found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h4 class="card-title">{{ __('Latest Withdraw') }}</h4>
                    <a href="{{ route('admin.withdraw.filter') }}" class="site-color fw-500">{{ __('View All') }}</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('User') }}</th>
                                    <th>{{ __('Method') }}</th>
                                    <th>{{ __('TRX') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($withdraws as $key => $withdraw)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.user.details', $withdraw->user->id) }}">
                                                <img src="{{ Config::getFile('user', $withdraw->user->image, true) }}"
                                                    alt="" class="image-table">
                                                <span>
                                                    {{ $withdraw->user->username }}
                                                </span>
                                            </a>
                                        </td>
                                        <td>{{ $withdraw->withdrawMethod->name }}</td>
                                        <td>{{ $withdraw->trx }}</td>
                                        <td>{{ Config::formatter($withdraw->total) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center">{{ __('No user Found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cron" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Cron Settings Instruction') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        {{ __('Please set cron job to your server otherwise user can not get Bulk Mail') }}
                    </p>
                    <div class="input-group">
                        <input type="text" name="" class="form-control copy-text"
                            value="curl -s {{ route('fire') }}">
                        <div class="input-group-append">
                            <button class="input-group-text gr-bg-1 text-white copy" type="button"
                                id="button-addon2">{{ __('Copy') }}</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        'use strict'


        @if (now()->diffInMinutes(\Carbon\Carbon::parse(Config::config()->cron_run_time)) > 25)

            $(function() {
                const modal = $('#cron')

                modal.modal('show')
            })


            var copyButton = document.querySelector('.copy');
            var copyInput = document.querySelector('.copy-text');
            copyButton.addEventListener('click', function(e) {
                e.preventDefault();
                var text = copyInput.select();
                document.execCommand('copy');
            });
            copyInput.addEventListener('click', function() {
                this.select();
            });
        @endif

        // User Statistics

        var user = {

            series: [{{ $activeUser }}, {{ $pendingUser }}, {{ $emailUser }}],
            labels: ['Active', 'Deactive', 'Email Verified'],
            chart: {
                type: 'donut',
                width: 345,
                height: 393
            },
            colors: ['#622bd7', '#e2a03f', '#e7515a', '#e2a03f'],
            dataLabels: {
                enabled: false
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                fontSize: '14px',
                labels: {
                    colors: '#777'
                },
                markers: {
                    width: 10,
                    height: 10,
                    offsetX: -5,
                    offsetY: 0
                },
                itemMargin: {
                    horizontal: 10,
                    vertical: 30
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '75%',
                        background: 'transparent',
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontSize: '29px',
                                fontFamily: 'Nunito, sans-serif',
                                color: '#ffffff',
                                offsetY: -10
                            },
                            value: {
                                show: true,
                                fontSize: '26px',
                                fontFamily: 'Nunito, sans-serif',
                                color: '#bfc9d4',
                                offsetY: 16,
                                formatter: function(val) {
                                    return val
                                }
                            },
                            total: {
                                show: true,
                                showAlways: true,
                                label: 'Total',
                                color: '#777777',
                                fontSize: '30px',
                                formatter: function(w) {
                                    return "{{ $totalUser }}"
                                }
                            }
                        }
                    }
                }
            },
            stroke: {
                show: true,
                width: 15,
                colors: '#ffffff'
            },
            responsive: [{
                breakpoint: 1400,
                options: {
                    chart: {
                        width: 300,
                        height: 315
                    }
                }
            }]
        };

        var chart2 = new ApexCharts(document.querySelector("#chart2"), user);
        chart2.render();
        
        var chart5 = new ApexCharts(document.querySelector("#chart5"), user);
        chart5.render();



        var payment = {
            series: [{
                    name: 'Payments',
                    data: @json($totalAmount)
                },
                {
                    name: 'Deposits',
                    data: @json($depositsTotalAmount)
                },
                {
                    name: 'Withdraw',
                    data: @json($withdrawTotalAmount)
                }
            ],
            labels: ['Payments', 'Deposits', 'Withdraw'],
            chart: {
                height: 300,
                type: 'area',
                dropShadow: {
                    enabled: true,
                    opacity: 0.2,
                    blur: 10,
                    left: -7,
                    top: 22
                },
                toolbar: {
                    show: false
                },
            },

            plotpayment: {
                bar: {
                    horizontal: false,
                    columnWidth: '40%',
                    endingShape: 'rounded'
                },
            },

            markers: {
                colors: ['#449ae7', '#449ae7', '#449ae7']
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                curve: 'smooth',
                width: 2,
                lineCap: 'square'
            },
            xaxis: {
                categories: @json($months),
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    show: true
                },
                labels: {
                    offsetX: 0,
                    offsetY: 5,
                    style: {
                        fontSize: '12px',
                        cssClass: 'apexcharts-xaxis-title',
                    },
                }
            },
            yaxis: {
                labels: {
                    formatter: function(value, index) {
                        return (value / 1000) + 'K'
                    },
                    offsetX: -15,
                    offsetY: 0,
                    style: {
                        fontSize: '12px',
                        cssClass: 'apexcharts-yaxis-title',
                    },
                }
            },
            grid: {
                borderColor: '#d1d1d1',
                strokeDashArray: 5,
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                yaxis: {
                    lines: {
                        show: false,
                    }
                },
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 5
                },
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                fontSize: '14px',
                labels: {
                    colors: '#777'
                },
                markers: {
                    width: 10,
                    height: 10,
                    offsetX: -5,
                    offsetY: 0
                },
                itemMargin: {
                    horizontal: 10,
                    vertical: 30
                }
            },

            fill: {
                type: "gradient",
                gradient: {
                    type: "vertical",
                    shadeIntensity: 1,
                    inverseColors: !1,
                    opacityFrom: .19,
                    opacityTo: .05,
                    stops: [100, 100]
                }
            },
            responsive: [{
                breakpoint: 575,
                options: {
                    legend: {
                        offsetY: -50,
                    },
                },
            }],

            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            },
        };


        var chart = new ApexCharts(document.querySelector("#profit-chart"), payment);
        chart.render();
    </script>
@endpush
