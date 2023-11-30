@extends(Config::theme() . 'layout.auth')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="sp_site_card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('Transfer Money') }}</h4>
                    <p class="mb-0">{{ __('Current Balance') }} :
                    <span class="text-white">{{ Config::formatter(auth()->user()->balance)}}</span></p>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">{{ __('Receiver Email') }}</label>
                            <input type="text" name="email" id="refer-link" class="form-control"
                                placeholder="Transfer account email" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">{{ __('Amount') }}</label>
                            <input type="text" name="amount" id="amount" class="form-control"
                                placeholder="Transfer Amount" data-type="{{ Config::config()->transfer_type }}"
                                data-charge="{{ Config::config()->transfer_charge }}" required>

                            <p id="totalAmount" class="sp_text_secondary mt-3"></p>
                        </div>

                        <p class="text-center mb-3">{{ __('Transfer Charge') }}
                            {{ number_format(Config::config()->transfer_charge,2) . ' ' . (Config::config()->transfer_type === 'fixed' ? Config::config()->currency : '%') }}
                        </p>

                        <ul class="list-group mb-4">
                            <li
                                class="list-group-item d-flex flex-wrap align-items-center justify-content-between px-0 border-0 py-0 bg-transparent">
                                <span>{{ __('Min Transfer Amount') }}</span>
                                <span>{{ Config::formatter(Config::config()->transfer_min_amount)}}</span>
                            </li>
                            <hr>
                            <li
                                class="list-group-item d-flex flex-wrap align-items-center justify-content-between px-0 border-0 py-0 bg-transparent">
                                <span>{{ __('Max Transfer Amount') }}</span>
                                <span>{{ Config::formatter(Config::config()->transfer_max_amount)}}</span>
                            </li>
                        </ul>

                        <button type="submit" class="btn sp_theme_btn w-100"
                            id="basic-addon2">{{ __('Transfer Money') }}</button>
                    </form>
                </div>
               
            </div>
        </div>
    </div>


@endsection

@push('script')
    <script>
        $(function() {
            'use strict'
            let commission = 0;
            let total = 0;

            $('#amount').on('keyup', function() {

                if ($(this).val() == '') {
                    $('#totalAmount').text('')
                    return
                }

                if (/\D/g.test(this.value)) {

                    this.value = this.value.replace(/\D/g, '');

                    return
                }

                let charge = $(this).data('charge');

                if ($(this).data('type') === 'percent') {
                    commission = (parseFloat($(this).val()) * parseFloat(charge)) / 100;
                } else {
                    commission = parseFloat(charge)
                }

                total = parseFloat($(this).val()) + commission;


                $('#totalAmount').text('Total Amount with Charge - ' + total)



            })
        })
    </script>
@endpush
