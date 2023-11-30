@extends(Config::theme() . 'layout.auth')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="sp_site_card">
                <div class="card-header d-flex flex-wrap justify-content-between">
                    <div class="radio_button_list">
                        <div class="sp_site_radio">
                            <input type="radio" class="form-check-input currency" id="trad-1" name="currency"
                                value="BTC" checked>
                            <label class="form-check-label" for="trad-1">
                                {{ __('BTC') }}
                            </label>
                        </div>

                        <div class="sp_site_radio">
                            <input type="radio" class="form-check-input currency" id="trad-2" name="currency"
                                value="ETH">
                            <label class="form-check-label" for="trad-2">
                                {{ __('ETH') }}
                            </label>
                        </div>

                        <div class="sp_site_radio">
                            <input type="radio" class="form-check-input currency" id="trad-3" name="currency"
                                value="USDT">
                            <label class="form-check-label" for="trad-3">
                                {{ __('USDT') }}
                            </label>
                        </div>

                        <div class="sp_site_radio">
                            <input type="radio" class="form-check-input currency" id="trad-4" name="currency"
                                value="BNB">
                            <label class="form-check-label" for="trad-4">
                                {{ __('BNB') }}
                            </label>
                        </div>

                        <div class="sp_site_radio">
                            <input type="radio" class="form-check-input currency" id="trad-5" name="currency"
                                value="DOGE">
                            <label class="form-check-label" for="trad-5">
                                {{ __('DOGE') }}
                            </label>
                        </div>

                        <div class="sp_site_radio">
                            <input type="radio" class="form-check-input currency" id="trad-6" name="currency"
                                value="LTC">
                            <label class="form-check-label" for="trad-6">
                                {{ __('LTC') }}
                            </label>
                        </div>

                        <div class="sp_site_radio">
                            <input type="radio" class="form-check-input currency" id="trad-7" name="currency"
                                value="DASH">
                            <label class="form-check-label" for="trad-7">
                                {{ __('DASH') }}
                            </label>
                        </div>

                        <div class="sp_site_radio">
                            <input type="radio" class="form-check-input currency" id="trad-8" name="currency"
                                value="ETC">
                            <label class="form-check-label" for="trad-8">
                                {{ __('ETC') }}
                            </label>
                        </div>

                        <div class="sp_site_radio">
                            <input type="radio" class="form-check-input currency" id="trad-9" name="currency"
                                value="BCH">
                            <label class="form-check-label" for="trad-9">
                                {{ __('BCH') }}
                            </label>
                        </div>
                    </div>

                    <div>
                        <button class="btn sp_theme_btn order">{{ __('Place Order') }}</button>
                    </div>
                </div>
                <div class="sp_card_body">
                    <div id="linechart"></div>
                </div>

            </div>
        </div>
    </div>


    <div class="row">

        <script>
            'use strict'


            function firePayment(elementId) {
                $.ajax({
                    url: "{{ route('user.tradeClose') }}",
                    method: "GET",
                    success: function(response) {
                        if (response) {
                            document.getElementById(elementId).innerHTML = "COMPLETE";
                            return
                        }

                        window.location.href = "{{ url()->current() }}"
                    }
                })
            }

            function getCountDown(elementId, seconds) {
                var times = seconds;

                var x = setInterval(function() {
                    var distance = times * 1000;

                    if (distance < 0) {
                        clearInterval(x);
                        firePayment(elementId);
                        return
                    }
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    document.getElementById(elementId).innerHTML = days + "d " + hours + "h " + minutes + "m " +
                        seconds + "s ";
                    times--;
                }, 1000);
            }
        </script>
        <div class="col-md-12 mt-4">
            <div class="sp_site_card">
                <div class="card-header">
                    <div class="card-header-items">
                        <h5 class="card-header-item">{{ __('Current Balance') }} :
                            {{ Config::formatter(auth()->user()->balance) }}</h5>
                        <form action="" method="get" class="row justify-content-md-end g-3 card-header-item">
                            <div class="col-auto">
                                <input type="text" name="trx" class="form-control me-2"
                                    placeholder="transaction id">
                            </div>
                            <div class="col-auto">
                                <input type="date" class="form-control me-3" 
                                    name="date">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn sp_theme_btn">{{ __('Search') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table sp_site_table">
                            <thead>
                                <tr>
                                    <th>{{ __('Ref') }}</th>
                                    <th>{{ __('Currency Sym') }}</th>
                                    <th>{{ __('Trade Price At') }}</th>
                                    <th>{{ __('Trade Type') }}</th>
                                    <th>{{ __('Trade Close At') }}</th>
                                    <th>{{ __('Profit/Loss') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($trades as $key => $trade)
                                    <tr>
                                        <td>{{ strtoupper($trade->ref) }}</td>
                                        <td>{{ $trade->currency }}</td>
                                        <td>{{ Config::formatter($trade->current_price) }}</td>

                                        <td>
                                            @if ($trade->trade_type == 'buy')
                                                <i class="fas fa-arrow-alt-circle-up text-success"></i>
                                                {{ $trade->trade_type }}
                                            @else
                                                <i class="fas fa-arrow-alt-circle-down text-danger"></i>
                                                {{ $trade->trade_type }}
                                            @endif
                                        </td>

                                        <td>
                                            <p id="count_{{ $loop->iteration }}" class="mb-2">
                                                @if ($trade->profit_type != null)
                                                    <span class="sp_badge sp_badge_success">
                                                        {{ $trade->trade_stop_at }}
                                                    </span>
                                                @endif
                                            </p>
                                            <script>
                                                @if ($trade->profit_type == null)
                                                    getCountDown("count_{{ $loop->iteration }}",
                                                        "{{ now()->gt($trade->trade_stop_at) ? 0 : now()->diffInSeconds($trade->trade_stop_at) }}"
                                                    )
                                                @endif
                                            </script>
                                        </td>

                                        <td>
                                            @if ($trade->profit_type == '+')
                                                <span class="text-success">{{ __('+' . $trade->profit_amount) }}</span>
                                            @elseif($trade->profit_type == '-')
                                                <span class="text-danger">{{ __('-' . $trade->loss_amount) }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($trade->status)
                                                <span class="text-success"><i class="far fa-check-circle"></i></span>
                                            @else
                                                <span class="text-danger"><i class="fas fa-spinner fa-spin"></i></span>
                                            @endif
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">
                                            {{ __('No Trades Found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
                @if ($trades->hasPages())
                    <div class="sp_card_footer">
                        {{ $trades->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="order" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Place Order') }}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-between">
                            <h5 id="currentPrice" class="mb-4">{{ __('Current Price') }} : </h5>
                        </div>
                        <input type="hidden" name="trade_cur">
                        <input type="hidden" name="trade_price">
                        <div class="form-group mb-3">
                            <label for="">{{ __('Trade Duration') }} <span class="sp_theme_color">(
                                    {{ __('in Minutes') }} )</span> </label>
                            <input type="text" name="duration" class="form-control" placeholder="ex. 1">
                        </div>

                        <div class="row">
                            <div class="col-auto">
                                <div class="sp_form_check">
                                    <input class="form-check-input" id="trading-buy" type="radio" name="type"
                                        value="buy" checked>
                                    <label class="form-check-label" for="trading-buy">
                                        {{ __('BUY') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="sp_form_check">
                                    <input class="form-check-input" id="trading-sell" type="radio" name="type"
                                        value="sell">
                                    <label class="form-check-label" for="trading-sell">
                                        {{ __('SELL') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex">
                        <button type="submit" class="btn sp_theme_btn">{{ __('Confirm') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="spinner"></div>
@endsection

@push('style')
    <style>
        #linechart .apexcharts-tooltip {
            background-color: #220700 !important;
            border: 1px solid rgba(255, 255, 255, 0.15)
        }

        .sp_trading_section {
            padding: 120px 0;
        }

        .radio_button_list {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            margin: -3px -15px;
        }

        .radio_button_list .sp_site_radio {
            padding: 3px 15px;
        }
    </style>
@endpush


@push('external-script')
    <script src="{{ Config::jsLib('frontend', 'lib/apex.min.js') }}"></script>
@endpush

@push('script')
    <script>
        'use strict'


        let cryptoPrice;

        let currency = $("input[name='currency']:checked").val();

        $('.currency').each(function(index) {
            $('.currency').eq(index).on('click', function() {
                currency = $(this).val();
                fetchCryptocurrencyPrices(currency);
                currentPrice(currency)
            })
        })

        function currentPrice(currency) {

            $.ajax({
                url: "{{ route('user.current-price') }}",
                method: "GET",
                data: {
                    currency: currency
                },
                success: function(response) {
                    $('#currentPrice').text('Current Price ' + response + '(' + currency + ')')
                    $('input[name=trade_cur]').val(currency)
                    $('input[name=trade_price]').val(response)
                }
            });

        }

        function updateChart(data) {
            chart.updateSeries([{
                data: data
            }]);
        }

        setInterval(() => {
            fetchCryptocurrencyPrices(currency);
            currentPrice(currency);
        }, 5000);


        $(window).on("load", function() {
            fetchCryptocurrencyPrices(currency);
            currentPrice(currency);
        });


        function fetchCryptocurrencyPrices(currency) {
            $.ajax({
                url: "{{ route('ticker') }}",
                method: "GET",
                data: {
                    currency: currency
                },
                success: function(response) {
                    chart.updateSeries([{
                        data: response
                    }]);

                }
            });
        }

        var options = {
            series: [{
                data: cryptoPrice
            }],
            chart: {
                type: 'candlestick',
                height: 400
            },
            title: {
                text: 'CandleStick Chart',
                align: 'left',
                style: {
                    color: '#ffffff'
                }
            },
            xaxis: {
                type: 'datetime',
                labels: {
                    style: {
                        colors: ['#ffffff', '#ffffff', '#ffffff', '#ffffff', '#ffffff']
                    }
                }
            },
            yaxis: {
                tooltip: {
                    enabled: true
                },
                labels: {
                    style: {
                        colors: ['#ffffff', '#ffffff', '#ffffff', '#ffffff', '#ffffff']
                    }
                }
            },
            grid: {
                show: true,
                borderColor: '#ffffff26',
                strokeDashArray: 0,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#linechart"), options);
        chart.render();


        $('.order').on('click', function() {

            const modal = $('#order');

            modal.modal('show')
        })
    </script>
@endpush
