@extends(Config::theme() . 'layout.auth')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-lg-4">

            <div class="sp_site_card mb-4">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0 ">Deposit Funds</h6>
                </div>
                <div class="card-body">

                    <form action="create/deposit" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">ACCOUNT NUMBER</label>
                            <select id="account_number" class="form-control" name="login">
                                <option value=""></option>
                                @foreach ($accounts as $item)
                                    <option data-currency="{{ $item->currency }}" data-login="{{ $item->login }}"
                                        value="{{ $item->login }}">{{ $item->login }}
                                        {{ $item->account_type == '4' ? '(DEMO)' : '' }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group mb-3">
                            <label for="">PAYMENT METHOD</label>
                            <select disabled class="form-control" name="payment_method_id" id="payment_method_id">
                                <option value=""></option>
                                @foreach ($payment_methods as $item)
                                    <option data-amount="{{ $item['min_amount'] }}"
                                        data-waddress="{{ $item['wallet_address'] }}" data-name ="{{ $item['name'] }}"
                                        value="{{ $item['id'] }}">
                                        {{ $item['name'] }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group mb-3">
                            <label for="">AMOUNT</label>
                            <input type="number" min="" class="form-control" name="amount" id="amount" required
                                placeholder="Amount in USD">
                        </div>
                        <button type="submit" class="btn sp_theme_btn btn-md text-uppercase"><i class="fas fa-dollar-sign"
                                aria-hidden="true"></i>&nbsp;Deposit Funds</button>
                    </form>
                </div>
            </div>


        </div>

        <div class="col-sm-12 col-lg-5">

            <div class="sp_site_card mb-4">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0 ">Deposit details</h6>
                </div>
                <div class="card-body">
                    <div class="text-center account_default_text">Please select account number on your left</div>
                    <span id="accountnoselected" style="display:none;">&nbsp;Selected account:
                        <span id="accounttab" class="acc-no"></span>
                    </span>
                    <br>
                    <span id="amountentered" class="amt-txt" style="display:none;">&nbsp;Deposit amount(USD):
                        <span id="amounttab" class=""></span>
                    </span>
                    <br><br>

                    <div class="mt-6" style="display: none" id="payment_info">

                        <span id="">&nbsp;Deposit method:
                            <span id="deposit_mathod" class="depo-info"></span>
                        </span>
                        <br>
                        <span id="">&nbsp;Wallet:
                            <span id="wallet_add" class="depo-info"></span>
                        </span>
                        <br>
                        <span id="">&nbsp;Min deposit:
                            <span id="min_deposit" class="depo-info"></span>
                        </span>


                    </div>

                </div>
            </div>
        </div>

        <div class="col-sm-12 col-lg-3">

            <div class="sp_site_card mb-4">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0 ">Real account status</h6>
                </div>
                <div class="card-body">

                    <div class="account-item-value pt-0">
                        <label>Available fund</label>
                        <span class="account-item-pin green"> </span>
                        <span class="balance">0 </span> <span class="currency"></span>
                        <span class="loading" style="display:none"><img
                                src="{{ Config::getFile('icon', 'loading.gif', true) }}" width="27px"></span>
                    </div>


                    <div class="account-item-value">
                        <label>Total Profit</label>
                        <span class="account-item-pin yellow"> </span>
                        <span class="profit">0 </span> <span class="currency"></span>
                        <span class="loading" style="display:none"><img
                                src="{{ Config::getFile('icon', 'loading.gif', true) }}" width="27px"></span>
                    </div>


                    <div class="account-item-value">
                        <label>Floating P/L</label>
                        <span class="account-item-pin purple"> </span>
                        <span class="floating">0 </span> <span class="currency"></span>
                        <span class="loading" style="display:none"><img
                                src="{{ Config::getFile('icon', 'loading.gif', true) }}" width="27px"></span>
                    </div>



                    <div class="account-item-value">
                        <label>Free Margin</label>
                        <span class="account-item-pin yellow"> </span>
                        <span class="margin">0 </span> <span class="currency"></span>
                        <span class="loading" style="display:none"><img
                                src="{{ Config::getFile('icon', 'loading.gif', true) }}" width="27px"></span>
                    </div>


                    <div class="account-item-value border-0">
                        <label>Equity</label>
                        <span class="account-item-pin red"> </span>
                        <span class="equity">0 </span> <span class="currency"></span>
                        <span class="loading" style="display:none"><img
                                src="{{ Config::getFile('icon', 'loading.gif', true) }}" width="27px"></span>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection


@push('external-css')
    <link rel="stylesheet" href="{{ Config::cssLib('frontend', 'lib/apex.min.css') }}">
@endpush

@push('script')
    <script>
        $(function() {
            'use strict'

            $('#account_number').on('change', function() {

                $('#payment_method_id').removeAttr('disabled');


                var selectedValue = $(this).val();
                var selectedOption = $(this).find('option:selected');
                var login = selectedOption.data('login');



                $('#accountnoselected').hide();
                $('.account-item-value').find('.balance').html(0);
                $('.account-item-value').find('.profit').html(0);
                $('.account-item-value').find('.floating').html(0);
                $('.account-item-value').find('.margin').html(0);
                $('.account-item-value').find('.equity').html(0);

                if (selectedValue == 0) {
                    $('.account_default_text').show();
                    $('.account-item-value').find('.loading').hide();
                    return false;
                }

                $('.account_default_text').hide();
                $('#accountnoselected').show();
                $('#accounttab').html(login);

                $('.account-item-value').find('.loading').show();
                var currency = selectedOption.data('currency').toUpperCase();
                $.ajax({
                    url: '{{ route('user.getAccount') }}',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        login: login,
                    },
                    success: function(response) {
                        $('.account-item-value').find('.loading').hide();
                        $('.account-item-value').find('.balance').html(currency + ' ' + response
                            .balance);
                        $('.account-item-value').find('.profit').html(currency + ' ' + response
                            .profit);
                        $('.account-item-value').find('.floating').html(currency + ' ' +
                            response.floating);
                        $('.account-item-value').find('.margin').html(currency + ' ' + response
                            .margin);
                        $('.account-item-value').find('.equity').html(currency + ' ' + response
                            .equity);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });

            });

            $('#amount').on('input', function() {

                var val = $(this).val();

                $('#amountentered').show();

                $('#amounttab').html(val);


            });

            $('#payment_method_id').on('change', function() {

                $('#amountentered').show();
                $('#payment_info').show();
                var amt = $(this).find(':selected').data('amount');
                var w_address = $(this).find(':selected').data('waddress');
                var name = $(this).find(':selected').data('name');

                $('#min_deposit').html(amt);
                $('#wallet_add').html(w_address);
                $('#deposit_mathod').html(name);

            });
        })
    </script>
@endpush
