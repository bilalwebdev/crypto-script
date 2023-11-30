@extends(Config::theme() . 'layout.auth')

@section('content')
    <div class="row justify-content-center gy-4">
        <div class="col-md-7">
            <div class="sp_site_card h-100">
                <div class="card-header">
                    <h5>{{ __('Payment Preview') }}</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @if (!(session('type') == 'deposit'))
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ __('Plan Name') }}:</span>

                                <span>{{ $deposit->plan->name }}</span>

                            </li>
                        @endif
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ __('Gateway Name') }}:</span>

                            <span>{{ str_replace('_', ' ', $deposit->gateway->name) }}</span>

                        </li>

                       


                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ __('Amount') }}:</span>
                            <span>{{ Config::formatOnlyNumber($deposit->amount) }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ __('Charge') }}:</span>
                            <span>{{ Config::formatOnlyNumber($deposit->charge) }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ __('Conversion Rate') }}:</span>
                            <span>{{ '1 ' . Config::config()->currency . ' = ' . Config::formatOnlyNumber($deposit->rate) . ' ' . $deposit->gateway->parameter->gateway_currency }}</span>
                        </li>



                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ __('Total Payable Amount') }}:</span>
                            <span>{{ Config::formatOnlyNumber($deposit->total) . ' ' . $deposit->gateway->parameter->gateway_currency }}</span>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

        @if ($gateway->name === 'stripe')
            <div class="col-md-7 col-xl-7">
                <div class="sp_site_card">
                    <div class="card-body">
                        <form role="form" action="" method="post" class="require-validation"
                            data-cc-on-file="false"
                            data-stripe-publishable-key="{{ $gateway->parameter->stripe_client_id }}" id="payment-form">
                            @csrf
                            <div class="row">

                                <div class='form-group col-md-12'>
                                    <div class='col-xs-12 form-group required'>
                                        <label class='control-label mb-2'>{{ __('Name on Card') }}</label> <input
                                            class='form-control ' size='4' type='text'
                                            placeholder="{{ __('Enter name on card') }}">
                                    </div>
                                </div>

                                <div class='form-group col-md-12'>
                                    <div class='col-xs-12 form-group required'>
                                        <label class='control-label mb-2 mt-2'>{{ __('Card Number') }}</label>
                                        <input autocomplete='off' class='form-control  card-number' size='20'
                                            type='text' placeholder="Enter card number">
                                    </div>
                                </div>

                                <div class='form-group col-md-12'>
                                    <div class="row">
                                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                                            <label class='control-label mb-2 mt-2'>{{ __('CVC') }}</label>
                                            <input autocomplete='off' class='form-control  card-cvc' size='4'
                                                type='text' placeholder="{{ __('CVC') }}">
                                        </div>
                                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                            <label class='control-label mb-2 mt-2'>{{ __('Expiration Month') }}</label>
                                            <input class='form-control  card-expiry-month' size='2' type='text'
                                                placeholder="{{ __('Expiration Month') }}">
                                        </div>
                                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                            <label class='control-label mb-2 mt-2 '>{{ __('Expiration Year') }}</label>
                                            <input class='form-control  card-expiry-year' size='4' type='text'
                                                placeholder="{{ __('Expiration Year') }}">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class='form-group col-md-'>
                                <div class='col-md-12 error form-group d-none'>
                                    <div class='alert-danger alert'>
                                        {{ __('Please correct the errors and try again.') }}</div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-xs-12 d-grid gap-2">
                                    <button class="btn sp_theme_btn" type="submit">{{ __('Pay Now') }}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        @elseif($gateway->name === 'paypal')
            <div class="col-md-7">
                <div class="sp_site_card">
                    <div class="card-footer">
                        <div class="text-end">
                            <form action="" method="POST">
                                @csrf
                                <input type="hidden" name="amount" value="{{ number_format($deposit->total, 2) }}">
                                <button type="submit" class="btn sp_theme_btn">{{ __('Pay With Paypal') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($gateway->name === 'vougepay')
            <div class="col-md-7">
                <div class="sp_site_card">
                    <div class="card-footer">
                        <div class="text-end">
                            <form method='POST' action='https://pay.voguepay.com'>
                                <input type="hidden" name='v_merchant_id' value="{{ $vouguePayParams->marchant_id }}" />
                                <input type="hidden" name='merchant_ref' value="{{ $vouguePayParams->merchant_ref }}" />
                                <input type="hidden" name='memo' value="{{ $vouguePayParams->memo }}" />
                                <input type="hidden" name='item_1' value='Plan Purchase' />
                                <input type="hidden" name='description_1' value='Payment' />
                                <input type="hidden" name='price_1' value='{{ $vouguePayParams->amount }}' />
                                <input type="hidden" name='cur' value="{{ $vouguePayParams->currency }}" />
                                <input type="hidden" name='developer_code' value='5a61be72ab323' />
                                <input type="hidden" name='total' value="{{ $vouguePayParams->amount }}" />
                                <input type="hidden" name='custom' value="{{ $deposit->transaction_id }}" />
                                <input type="hidden" name='name' value='Customer name' />
                                <input type="hidden" name='address' value='Customer Address' />
                                <input type="hidden" name='city' value='Customer City' />
                                <input type="hidden" name='state' value='Customer State' />
                                <input type="hidden" name='zipcode' value='Customer Zip/Post Code' />
                                <input type="hidden" name='email' value='ajayishegs@gmail.com' />
                                <input type="hidden" name='phone' value='Customer phone' />

                                <input type="hidden" name='success_url'
                                    value="{{ route('user.payment.success',$gateway->name) }}" />
                                <button type='submit' class="btn sp_theme_btn">{{ __('Pay Via Voguepay') }}</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        @elseif($gateway->name === 'razorpay')
            <div class="col-md-7">
                <div class="sp_site_card">
                    <div class="card-footer">
                        <div class="text-end">
                            <form role="form" action="" method="POST">
                                @csrf
                                <input type="hidden" name="amount" class="form-control amount"
                                    placeholder="Enter Amount" value="{{ number_format($deposit->total, 2, '.', '') }}">
                                <button id="rzp-button1" data-href="{{ route('user.payment.success', $gateway->name) }}"
                                    class="btn sp_theme_btn">{{ __('Pay Now') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($gateway->name === 'coinpayments')
            <div class="col-md-7">
                <div class="sp_site_card">
                    <div class="card-footer">
                        <div class="text-end">
                            <form action="https://www.coinpayments.net/index.php" method="post">
                                <input type="hidden" name="cmd" value="_pay_simple">
                                <input type="hidden" name="reset" value="1">
                                <input type="hidden" name="merchant" value="{{$deposit->gateway->parameter->merchant_id}}">
                                <input type="hidden" name="item_name" value="payment">
                                <input type="hidden" name="currency" value="{{Config::config()->currency}}">
                                <input type="hidden" name="amountf" value="{{$deposit->total}}">
                                <input type="hidden" name="want_shipping" value="0">
                                <input type="hidden" name="success_url" value="{{route('user.payment.success', $deposit->gateway->name)}}">
                                <input type="hidden" name="cancel_url" value="test">
                                <input type="hidden" name="ipn_url" value="{{route('user.payment.success', $deposit->gateway->name)}}">
                                <input type="image" src="https://www.coinpayments.net/images/pub/buynow-grey.png" alt="Buy Now with CoinPayments.net">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($gateway->name === 'mollie')
            <div class="col-md-7">
                <div class="sp_site_card">

                    <div class="card-footer">
                        <div class="text-end">
                            <form action="" method="POST">
                                @csrf
                                <input type="hidden" name="amount" value="{{ number_format($deposit->total, 2) }}">
                                <button type="submit" class="btn sp_theme_btn ">{{ __('Pay With Mollie') }}</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($gateway->name === 'nowpayments')
            <div class="col-md-7">
                <div class="sp_site_card">

                    <div class="card-footer">
                        <div class="text-end">
                            <form action="" method="POST">
                                @csrf
                                <input type="hidden" name="amount" value="{{ number_format($deposit->total, 2) }}">
                                <button type="submit" class="btn sp_theme_btn ">{{ __('Pay With NowPayments') }}</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($gateway->name === 'flutterwave')
            <div class="col-md-7">
                <div class="sp_site_card">
                    <div class="card-footer text-end">
                        <button type="submit" class="btn sp_theme_btn flutter"
                            data-amount="{{ number_format($deposit->total, 2) }}">{{ __('Pay With Flutterwave') }}</button>
                    </div>

                </div>
            </div>
        @elseif($gateway->name === 'paytm')
            <div class="col-md-7">
                <div class="sp_site_card">
                    <div class="card-footer text-end">
                        <form action="" method="POST">
                            @csrf
                            <input type="hidden" name="amount" value="{{ number_format($deposit->total, 2) }}">
                            <button type="submit" class="btn sp_theme_btn">{{ __('Pay With PayTm') }}</button>

                        </form>
                    </div>

                </div>
            </div>
        @elseif($gateway->name === 'mercadopago')
            <div class="col-md-7">
                <div class="sp_site_card">
                    <div class="card-footer text-end">
                        <form action="" method="post">
                            @csrf
                            <button type="submit" class="btn sp_theme_btn">{{ __('Pay with ' . $gateway->name) }}</button>
                        </form>
                    </div>

                </div>
            </div>
        @elseif($gateway->name === 'perfectmoney')
            <div class="col-md-7">
                <div class="sp_site_card">
                    <div class="card-footer text-end">
                        <form action="https://perfectmoney.is/api/step1.asp" method="POST">
                            <input type="hidden" name="PAYEE_ACCOUNT"
                                value="{{ $deposit->gateway->parameter->accountid }}">
                            <input type="hidden" name="PAYEE_NAME" value="{{ Config::config()->sitename }}">
                            <input type="hidden" name="PAYMENT_AMOUNT" value="{{ round($deposit->total, 2) }}"
                                placeholder="Amount" class="form-control" readonly>
                            <input type="hidden" name="PAYMENT_UNITS"
                                value="{{ $deposit->gateway->parameter->gateway_currency }}">
                            <input type="hidden" name="PAYMENT_URL" value="{{ route('user.dashboard') }}">
                            <input type="hidden" name="NOPAYMENT_URL" value="{{ route('user.dashboard') }}">

                            <input type="hidden" name="PAYMENT_ID" value="{{ $deposit->trx }}">

                            <input type="hidden" name="STATUS_URL"
                                value="{{ route('user.payment.success', $gateway->name) }}">

                            <input type="hidden" name="PAYMENT_URL_METHOD" value="GET">

                            <input type="hidden" name="NOPAYMENT_URL_METHOD" value="GET">

                            <input type="hidden" name="SUGGESTED_MEMO" value="{{ auth()->user()->username }}">

                            <input type="submit" class="btn sp_theme_btn" value="Pay with Perfect Money">
                        </form>
                    </div>

                </div>
            </div>
        @elseif(strstr($gateway->name, 'gourl'))
            <div class="col-md-7">
                <div class="sp_site_card">
                    <div class="card-footer text-end">
                        <form action="" method="post">
                            @csrf

                            <button type="submit"
                                class="btn sp_theme_btn">{{ __('Pay with ' . str_replace('_', ' ', $deposit->gateway->name)) }}</button>
                        </form>
                    </div>
                </div>
            </div>
        @elseif($gateway->name == 'paghiper')
            <div class="col-md-7">
                <div class="sp_site_card">
                    <div class="card-footer">
                        <form action="" method="POST">
                            @csrf
                            <input type="hidden" name="amount" value="{{ number_format($deposit->total, 2) }}">

                            <div class="form-group">
                                <label for="">{{ __('CPF OR CNPJ') }}</label>
                                <input type="text" name="cpf" class="form-control" required>
                            </div>

                            <button type="submit" class="btn sp_theme_btn mt-3">{{ __('Pay With Paghiper') }}</button>

                        </form>
                    </div>
                </div>
            </div>
        @elseif($gateway->name == 'paystack')
            <div class="col-md-7">
                <div class="sp_site_card">
                    <div class="card-footer">
                        <button type="submit" class="btn sp_theme_btn paystack"
                            data-amount="{{ number_format($deposit->total, 2, '.', '') }}">{{ __('Pay With Paystack') }}</button>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection

@push('script')
    <script src="https://js.stripe.com/v2/"></script>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script src="https://js.paystack.co/v1/inline.js"></script>

    <script src="https://checkout.flutterwave.com/v3.js"></script>

    <script>
        'use strict'
        $(function() {
            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }



            @if ($gateway->name === 'flutterwave')


                function makePayment(amount) {
                    FlutterwaveCheckout({
                        public_key: "{{ $deposit->gateway->parameter->public_key }}",
                        tx_ref: "{{ $deposit->gateway->parameter->reference_key }}",
                        amount: amount,
                        currency: "{{ $deposit->gateway->parameter->gateway_currency }}",
                        payment_options: "card, banktransfer, ussd",
                        redirect_url: "{{ route('user.payment.success', $deposit->gateway->name) }}",
                        meta: {
                            consumer_id: 23,
                            consumer_mac: "92a3-912ba-1192a",
                        },
                        customer: {
                            email: "{{ auth()->user()->email }}",
                            name: "{{ auth()->user()->username }}",
                        },
                        customizations: {
                            title: "{{ Config::config()->sitename }}",
                            description: "Payment for purchasing a plan",
                            logo: "{{ Config::getFile('logo', Config::config()->logo) }}",
                        },
                    });
                }



                $('.flutter').on('click', function(e) {
                    e.preventDefault();

                    makePayment($(this).data('amount'))
                })
            @endif

        });

        @if ($gateway->name === 'razorpay')

            $('body').on('click', '#rzp-button1', function(e) {
                e.preventDefault();
                var amount = $('.amount').val();
                var total_amount = amount * 100;
                let url = $(this).data('href');
                var options = {
                    "key": "{{ $gateway->parameter->razor_key }}",
                    "amount": total_amount,
                    "currency": "{{ $gateway->parameter->gateway_currency }}",
                    "name": "{{ Config::config()->site_name }}",
                    "description": "Transaction",
                    "image": "{{ Config::getFile('logo', Config::config()->logo, true) }}",
                    "order_id": "",
                    "callback_url": url,
                    "prefill": {
                        "name": "{{ auth()->user()->username }}",
                        "email": "{{ auth()->user()->email }}",
                        "contact": "{{ auth()->user()->phone }}"
                    },
                    "notes": {
                        "address": "test test"
                    },
                    "theme": {
                        "color": "#9c0ac1"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
            });
        @endif
    </script>

    @if ($gateway->name === 'paystack')
        <script>
            $(function() {
                'use strict'
                $('.paystack').on('click', function(e) {
                    e.preventDefault();
                    payWithPaystack($(this).data('amount'))
                })
            })

            function payWithPaystack(amount) {
                var handler = PaystackPop.setup({
                    key: "{{ $deposit->gateway->parameter->paystack_key }}", // Replace with your public key
                    email: "{{ auth()->user()->email }}",
                    amount: amount *
                        100, // the amount value is multiplied by 100 to convert to the lowest currency unit
                    currency: "{{ $deposit->gateway->parameter->gateway_currency }}", // Use GHS for Ghana Cedis or USD for US Dollars
                    ref: "{{ $deposit->transaction_id }}", // Replace with a reference you generated
                    callback: function(response) {

                        var reference = response.reference;

                        window.location = "{{ route('user.payment.success', $gateway->name) }}?reference=" + response.reference
                    },
                    onClose: function() {
                        alert('Transaction was not completed, window closed.');
                    },
                });
                handler.openIframe();
            }
        </script>
    @endif
@endpush
