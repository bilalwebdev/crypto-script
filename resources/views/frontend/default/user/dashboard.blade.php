@extends(Config::theme() . 'layout.auth')

@section('content')

@php
    $plan_expired_at = now();
@endphp

@if (auth()->user()->currentplan)
    @php
        $is_subscribe = auth()->user()->currentplan()->where('is_current', 1)->first();

        if($is_subscribe){
            $plan_expired_at =  $is_subscribe->plan_expired_at;
        }
    @endphp
@endif

    <div class="row g-sm-4 g-3">
        <div class="col-xxl-9 col-xl-8 d-custom-left">
            <div class="d-left-wrapper">
                <div class="d-left-countdown">
                    <div id="countdownTwo"></div>
                </div>
                <div class="row g-sm-4 g-3">
                    <div class="custom-xxl-6 col-xxl-3 col-xl-6 col-lg-3 col-6">
                        <div class="d-card d-icon-card">
                            <div class="d-card-icon gr-bg-1">
                                <i class="las la-credit-card"></i>
                            </div>
                            <div class="d-card-content">
                                <h4 class="d-card-amount">{{ Config::formatter($totalDeposit) }}</h4>
                                <p class="d-card-caption">{{ __('Total Deposit') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="custom-xxl-6 col-xxl-3 col-xl-6 col-lg-3 col-6">
                        <div class="d-card d-icon-card">
                            <div class="d-card-icon gr-bg-2">
                                <i class="las la-hand-holding-usd"></i>
                            </div>
                            <div class="d-card-content">
                                <h4 class="d-card-amount">{{ Config::formatter($totalWithdraw) }}</h4>
                                <p class="d-card-caption">{{ __('Total Withdraw') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="custom-xxl-6 col-xxl-3 col-xl-6 col-lg-3 col-6">
                        <div class="d-card d-icon-card">
                            <div class="d-card-icon gr-bg-3">
                                <i class="las la-chart-bar"></i>
                            </div>
                            <div class="d-card-content">
                                <h4 class="d-card-amount">{{ Config::formatter($totalPayments) }}</h4>
                                <p class="d-card-caption">{{ __('Total Payment') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="custom-xxl-6 col-xxl-3 col-xl-6 col-lg-3 col-6">
                        <div class="d-card d-icon-card">
                            <div class="d-card-icon gr-bg-4">
                                <i class="las la-ticket-alt"></i>
                            </div>
                            <div class="d-card-content">
                                <h4 class="d-card-amount">{{ $totalSupportTickets }}</h4>
                                <p class="d-card-caption">{{ __('Support Ticket') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-xl-none d-block mt-4">
                    <div class="row g-sm-4 g-3">
                        <div class="col-xl-12 col-lg-6">
                            <div class="d-card user-card not-hover"> 
                                <div class="text-center">
                                    <h5 class="user-card-title">{{ __('Total Balance') }}</h5>
                                    <h4 class="d-card-balance mt-xxl-3 mt-2">{{ Config::formatter($totalbalance) }}</h4>
                                    <div class="mt-4">
                                        <a href="{{ route('user.withdraw') }}" class="btn btn-md sp_btn_danger me-xxl-3 me-2"><i class="las la-minus-circle fs-lg"></i> {{ __('Withdraw') }}</a>
                                        <a href="{{ route('user.deposit') }}" class="btn btn-md sp_btn_success ms-xxl-3 ms-2"><i class="las la-plus-circle fs-lg"></i> {{ __('Deposit') }}</a>
                                    </div>
                                </div>

                                <hr class="my-4">



                                <ul class="recent-transaction-list mt-4">
                                    @foreach ($transactions as $trans)

                
                                        
                                    <li class="single-recent-transaction">
                                       
                                        <div class="content">
                                            <h6 class="title">{{$trans->details}}</h6>
                                            <span>{{$trans->created_at->format('d F, Y')}}</span>
                                        </div>
                                        <p class="recent-transaction-amount {{$trans->type == '+' ?  "sp_text_success" : 'sp_text_danger' }}">{{Config::formatter($trans->amount)}}</p>
                                    </li>
                                    @endforeach
                                    
                                </ul>
                                <a href="{{ route('user.transaction.log') }}" class="btn sp_theme_btn mt-4 w-100"><i class="fas fa-rocket me-2"></i> {{ __('View All Transaction') }}</a>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-6">
                            <div class="d-card not-hover">
                                <div id="chart3" class="d-flex justify-content-center"></div>
                            </div>

                            <h6 class="mb-2 mt-4">{{ __('Your Referral Link') }}</h6>
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control copy-text" placeholder="Referral link"
                                        value="{{ route('user.register', $user->username) }}" readonly>
                                        <button type="button" class="input-group-text sp_bg_base px-4 copy
                                        ">{{ __('Copy') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="d-card mt-4">
                    <h5 class="">{{ __('All Signal') }}</h5>
                    <div id="chart"></div>
                </div>

                <div class="sp_site_card mt-4">
                    <div class="card-header">
                        <h5>{{ __('Latest Signal') }}</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table sp_site_table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Signal Date') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($signals as $signal)
                                        <tr>
                                            <td data-caption="{{ __('Signal Date') }}">
                                                {{ $signal->created_at->format('dS M, Y -') }}

                                                <span class="table-date">{{ $signal->created_at->format('h:i:s A') }}</span>
                                            </td>
                                            <td data-caption="{{ __('Title') }}">{{ $signal->signal->title }}</td>
                                            <td data-caption="{{ __('Action') }}">
                                                <a href="{{ route('user.signal.details', ['id' => $signal->signal->id, 'slug' => Str::slug($signal->signal->title)]) }}"
                                                    class="view-btn"><i class="far fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="100%">{{ __('No Signals Found') }}</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if ($signals->hasPages())
                        <div class="card-footer">
                            {{ $signals->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <div class="col-xxl-3 col-xl-4 d-custom-right">
            <div class="d-right-wrapper">
                <div class="d-xl-block d-none">
                    <div class="row g-sm-4 g-3">
                        <div class="col-xl-12 col-lg-6">
                            <div class="d-card user-card not-hover"> 
                                <div class="text-center">
                                    <h5 class="user-card-title">{{ __('Total Balance') }}</h5>
                                    <h4 class="d-card-balance mt-xxl-3 mt-2">{{ Config::formatter($totalbalance) }}</h4>
                                    <div class="mt-4">
                                        <a href="{{ route('user.withdraw') }}" class="btn btn-md sp_btn_danger me-xxl-3 me-2"><i class="las la-minus-circle fs-lg"></i> {{ __('Withdraw') }}</a>
                                        <a href="{{ route('user.deposit') }}" class="btn btn-md sp_btn_success ms-xxl-3 ms-2"><i class="las la-plus-circle fs-lg"></i> {{ __('Deposit') }}</a>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <ul class="recent-transaction-list mt-4">
                                    @foreach ($transactions as $trans)
                                        
                                    <li class="single-recent-transaction">
                                      
                                        <div class="content">
                                            <h6 class="title">{{$trans->details}}</h6>
                                            <span>{{$trans->created_at->format('d F, Y')}}</span>
                                        </div>
                                        <p class="recent-transaction-amount {{$trans->type == '+' ?  "sp_text_success" : 'sp_text_danger' }}">{{number_format($trans->amount)}}</p>
                                    </li>
                                    @endforeach
                                    
                                </ul>
                                <a href="{{ route('user.transaction.log') }}" class="btn sp_theme_btn mt-4 w-100"><i class="fas fa-rocket me-2"></i> {{ __('View All Transaction') }}</a>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-6">
                            <div class="d-card not-hover">
                                <div id="chart2" class="d-flex justify-content-center"></div>
                            </div>

                            <h6 class="mb-2 mt-4">{{ __('Your Referral Link') }}</h6>
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control copy-text2" placeholder="Referral link"
                                        value="{{ route('user.register', $user->username) }}" readonly>
                                    <button type="button" class="input-group-text sp_bg_base px-4 copy2">{{ __('Copy') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('external-css')
    <link rel="stylesheet" href="{{ Config::cssLib('frontend', 'lib/apex.min.css') }}">
@endpush


@push('external-script')
    <script src="{{ Config::jsLib('frontend', 'lib/apex.min.js') }}"></script>
@endpush

@push('script')
    <script>
    $(function() {
        'use strict'

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



        var copyButton2 = document.querySelector('.copy2');
        var copyInput2 = document.querySelector('.copy-text2');
        copyButton2.addEventListener('click', function(e) {
            e.preventDefault();
            var text = copyInput2.select();
            document.execCommand('copy');
        });
        copyInput2.addEventListener('click', function() {
            this.select();
        });


        var expirationDate = new Date('{{ $plan_expired_at }}');

        function updateCountdown() {
            var now = new Date();
            var timeLeft = expirationDate - now;

            if (timeLeft < 0) {
                // The plan has expired
                $('#countdownTwo').html(`
                    <p class="upgrade-text"><i class="fas fa-rocket"></i> Please Upgrade Your Plan To Get Signals</p>
                `);
            } else {
                // The plan is still active
                var daysLeft = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                var hoursLeft = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutesLeft = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                var secondsLeft = Math.floor((timeLeft % (1000 * 60)) / 1000);

                $('#countdownTwo').html(`
                    <h5 class="d-left-countdown-title">{{ __('plan expired at :') }}</h5>
                    <div class="countdown-wrapper">
                    <p class="countdown-single">
                        ${daysLeft}
                        <span>D</span>
                    </p>
                    <p class="countdown-single">
                        ${hoursLeft}
                        <span>H</span>
                    </p>
                    <p class="countdown-single">
                        ${minutesLeft}
                        <span>M</span>
                    </p>
                    <p class="countdown-single">
                        ${secondsLeft}
                        <span>S</span>
                    </p>
                    </div>
                `);
            }
        }
        // Call updateCountdown every second
        setInterval(updateCountdown, 1000);


        var colors = ['#9C0AC1'];

        var options = {
            series: [{
                name: 'Signal',
                data: @json($signalGrapTotal)
            }],
            legend: {
                labels: {
                    colors: '#ffffff'
                }
            },
            colors: colors,
            chart: {
                height: 280,
                type: 'bar',
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '40%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent'],
                curve: 'smooth'
            },
            xaxis: {
                categories: @json($months),
                labels: {
                    style: {
                        colors: '#bebebe',
                        fontSize: '12px',
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: '#bebebe'
                    }
                }
            },
            grid: {
                xaxis: {
                    lines: {
                        show: false
                    }
                },   
                yaxis: {
                    lines: {
                        show: false
                    }
                }, 
            },
            fill: {
                opacity: 1,
                colors: colors
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        var options = {
       
        series: [{{$totalAmount->sum()}}, {{$withdrawTotalAmount->sum()}}, {{$depositTotalAmount->sum()}}],
        labels: ['Payment', 'Withdraw', 'Deposit'],
        chart: {
            type: 'donut',
            width: 370,
            height: 430
        },
        colors: ['#622bd7', '#e7515a', '#10a373', '#10a373'],
        dataLabels: {
            enabled: false
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            fontSize: '14px',
            labels: {
                colors: '#ffffff'
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
                        number_format: function (val) {
                            return val
                        }
                    },
                    total: {
                        show: true,
                        showAlways: true,
                        label: 'Total',
                        color: '#ffffff',
                        fontSize: '30px',
                        number_format: function (w) {
                            return w.globals.seriesTotals.reduce( function(a, b) {
                            return a + b
                            }, 0)
                        }
                    }
                }
                }
            }
        },
        stroke: {
            show: true,
            width: 15,
            colors: '#1E1F25'
          },
          responsive: [
            { 
              breakpoint: 1440, options: {
                chart: {
                  width: 325
                },
              }
            },
            { 
              breakpoint: 1199, options: {
                chart: {
                  width: 380
                },
              }
            },
            { 
              breakpoint: 575, options: {
                chart: {
                  width: 320
                },
              }
            },
          ],
        };

        var chart = new ApexCharts(document.querySelector("#chart2"), options);
        chart.render();

        var chart2 = new ApexCharts(document.querySelector("#chart3"), options);
        chart2.render();
    })
    </script>
@endpush
