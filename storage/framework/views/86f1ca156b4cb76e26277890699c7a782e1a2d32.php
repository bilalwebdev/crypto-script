<section class="trade-section sp_pt_120 sp_pb_120 sp_separator_bg">
    <div class="trading-el">
        <img src="<?php echo e(Config::getFile('trade', $content->image_one)); ?>" alt="image">
    </div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-7 text-center">
        <div class="sp_theme_top  wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">
          <div class="sp_theme_top_caption"><i class="fas fa-bolt"></i> <?php echo e(Config::trans($content->section_header)); ?></div>
          <h2 class="sp_theme_top_title"><?= Config::colorText(optional($content)->title, optional($content)->color_text_for_title) ?></h2>
        </div>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
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
                    <a href="<?php echo e(route('user.trade')); ?>" class="btn sp_theme_btn order"><?php echo e(Config::trans($content->button_text)); ?></a>
                </div>
                </div>
                <div class="sp_card_body">
                    <div id="linechart"></div>
                </div>
            </div>
        </div>
    </div>
  </div>
</section>

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


<?php $__env->startPush('script'); ?>
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
<?php /**PATH C:\xampp\htdocs\code_sig\Scripts\main\resources\views/frontend/light/widgets/trade.blade.php ENDPATH**/ ?>