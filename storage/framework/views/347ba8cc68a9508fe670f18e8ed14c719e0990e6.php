

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="sp_site_card">
                <div class="card-header d-flex flex-wrap justify-content-between">
                    <div class="radio_button_list">
                        <div class="sp_site_radio">
                            <input type="radio" class="form-check-input currency" id="trad-1" name="currency"
                                value="BTC" checked>
                            <label class="form-check-label" for="trad-1">
                                <?php echo e(__('BTC')); ?>

                            </label>
                        </div>

                        <div class="sp_site_radio">
                            <input type="radio" class="form-check-input currency" id="trad-2" name="currency"
                                value="ETH">
                            <label class="form-check-label" for="trad-2">
                                <?php echo e(__('ETH')); ?>

                            </label>
                        </div>

                        <div class="sp_site_radio">
                            <input type="radio" class="form-check-input currency" id="trad-3" name="currency"
                                value="USDT">
                            <label class="form-check-label" for="trad-3">
                                <?php echo e(__('USDT')); ?>

                            </label>
                        </div>

                        <div class="sp_site_radio">
                            <input type="radio" class="form-check-input currency" id="trad-4" name="currency"
                                value="BNB">
                            <label class="form-check-label" for="trad-4">
                                <?php echo e(__('BNB')); ?>

                            </label>
                        </div>

                        <div class="sp_site_radio">
                            <input type="radio" class="form-check-input currency" id="trad-5" name="currency"
                                value="DOGE">
                            <label class="form-check-label" for="trad-5">
                                <?php echo e(__('DOGE')); ?>

                            </label>
                        </div>

                        <div class="sp_site_radio">
                            <input type="radio" class="form-check-input currency" id="trad-6" name="currency"
                                value="LTC">
                            <label class="form-check-label" for="trad-6">
                                <?php echo e(__('LTC')); ?>

                            </label>
                        </div>

                        <div class="sp_site_radio">
                            <input type="radio" class="form-check-input currency" id="trad-7" name="currency"
                                value="DASH">
                            <label class="form-check-label" for="trad-7">
                                <?php echo e(__('DASH')); ?>

                            </label>
                        </div>

                        <div class="sp_site_radio">
                            <input type="radio" class="form-check-input currency" id="trad-8" name="currency"
                                value="ETC">
                            <label class="form-check-label" for="trad-8">
                                <?php echo e(__('ETC')); ?>

                            </label>
                        </div>

                        <div class="sp_site_radio">
                            <input type="radio" class="form-check-input currency" id="trad-9" name="currency"
                                value="BCH">
                            <label class="form-check-label" for="trad-9">
                                <?php echo e(__('BCH')); ?>

                            </label>
                        </div>
                    </div>

                    <div>
                        <button class="btn btn-sm sp_theme_btn order"><?php echo e(__('Place Order')); ?></button>
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
                    url: "<?php echo e(route('user.tradeClose')); ?>",
                    method: "GET",
                    success: function(response) {
                        if (response) {
                            document.getElementById(elementId).innerHTML = "COMPLETE";
                            return
                        }

                        window.location.href = "<?php echo e(url()->current()); ?>"
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
                        <h5 class="card-header-item"><?php echo e(__('Current Balance')); ?> :
                            <?php echo e(Config::formatter(auth()->user()->balance)); ?></h5>
                        <form action="" method="get" class="row justify-content-md-end g-3 card-header-item">
                            <div class="col-auto">
                                <input type="text" name="trx" class="form-control form-control-sm me-2"
                                    placeholder="transaction id">
                            </div>
                            <div class="col-auto">
                                <input type="date" class="form-control form-control-sm me-3" 
                                    name="date">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-sm sp_theme_btn"><?php echo e(__('Search')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table sp_site_table">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Ref')); ?></th>
                                    <th><?php echo e(__('Currency Sym')); ?></th>
                                    <th><?php echo e(__('Trade Price At')); ?></th>
                                    <th><?php echo e(__('Trade Type')); ?></th>
                                    <th><?php echo e(__('Trade Close At')); ?></th>
                                    <th><?php echo e(__('Profit/Loss')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $trades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $trade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e(strtoupper($trade->ref)); ?></td>
                                        <td><?php echo e($trade->currency); ?></td>
                                        <td><?php echo e(Config::formatter($trade->current_price)); ?></td>

                                        <td>
                                            <?php if($trade->trade_type == 'buy'): ?>
                                                <i class="fas fa-arrow-alt-circle-up text-success"></i>
                                                <?php echo e($trade->trade_type); ?>

                                            <?php else: ?>
                                                <i class="fas fa-arrow-alt-circle-down text-danger"></i>
                                                <?php echo e($trade->trade_type); ?>

                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <p id="count_<?php echo e($loop->iteration); ?>" class="mb-2">
                                                <?php if($trade->profit_type != null): ?>
                                                    <span class="sp_badge sp_badge_success">
                                                        <?php echo e($trade->trade_stop_at); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </p>
                                            <script>
                                                <?php if($trade->profit_type == null): ?>
                                                    getCountDown("count_<?php echo e($loop->iteration); ?>",
                                                        "<?php echo e(now()->gt($trade->trade_stop_at) ? 0 : now()->diffInSeconds($trade->trade_stop_at)); ?>"
                                                    )
                                                <?php endif; ?>
                                            </script>
                                        </td>

                                        <td>
                                            <?php if($trade->profit_type == '+'): ?>
                                                <span class="text-success"><?php echo e(__('+' . $trade->profit_amount)); ?></span>
                                            <?php elseif($trade->profit_type == '-'): ?>
                                                <span class="text-danger"><?php echo e(__('-' . $trade->loss_amount)); ?></span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php if($trade->status): ?>
                                                <span class="text-success"><i class="far fa-check-circle"></i></span>
                                            <?php else: ?>
                                                <span class="text-danger"><i class="fas fa-spinner fa-spin"></i></span>
                                            <?php endif; ?>
                                        </td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-center" colspan="100%">
                                            <?php echo e(__('No Trades Found')); ?>

                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
                <?php if($trades->hasPages()): ?>
                    <div class="sp_card_footer">
                        <?php echo e($trades->links()); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="order" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('Place Order')); ?></h5>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-between">
                            <h5 id="currentPrice" class="mb-4"><?php echo e(__('Current Price')); ?> : </h5>
                        </div>
                        <input type="hidden" name="trade_cur">
                        <input type="hidden" name="trade_price">
                        <div class="form-group mb-3">
                            <label for=""><?php echo e(__('Trade Duration')); ?> <span class="sp_theme_color">(
                                    <?php echo e(__('in Minutes')); ?> )</span> </label>
                            <input type="text" name="duration" class="form-control" placeholder="ex. 1">
                        </div>

                        <div class="row">
                            <div class="col-auto">
                                <div class="sp_form_check">
                                    <input class="form-check-input" id="trading-buy" type="radio" name="type"
                                        value="buy" checked>
                                    <label class="form-check-label" for="trading-buy">
                                        <?php echo e(__('BUY')); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="sp_form_check">
                                    <input class="form-check-input" id="trading-sell" type="radio" name="type"
                                        value="sell">
                                    <label class="form-check-label" for="trading-sell">
                                        <?php echo e(__('SELL')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex">
                        <button type="submit" class="btn sp_theme_btn"><?php echo e(__('Confirm')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="spinner"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
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
<?php $__env->stopPush(); ?>


<?php $__env->startPush('external-script'); ?>
    <script src="<?php echo e(Config::jsLib('frontend', 'lib/apex.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
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
                url: "<?php echo e(route('user.current-price')); ?>",
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
                url: "<?php echo e(route('ticker')); ?>",
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make(Config::theme() . 'layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/crypto-script/main/resources/views/frontend/light/user/trading.blade.php ENDPATH**/ ?>