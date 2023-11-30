@extends(Config::theme(). 'layout.auth')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="sp_site_card">
                <div class="card-header">
                    <h5 class="mb-0">{{ __(optional($gateway->parameter)->name . ' Information') }}</h5>
                </div>
                <div class="card-body">
                    @if ($gateway->parameter->gateway_type == 'crypto')
                        <ul class="list-group">
                            <li class="list-group-item  d-flex justify-content-between">
                                <span>{{ __('Gateway Name') }}</span>
                                <span>{{ optional($gateway->parameter)->name ?? 'N/A' }}</span>
                            </li>

                            <li class="list-group-item  d-flex justify-content-between">
                                <span>{{ __('Method Currency') }}</span>
                                <span>{{ optional($gateway->parameter)->gateway_currency }}</span>
                            </li>

                            <li class="list-group-item"> 
                                <img src="{{Config::getFile('gateways', $gateway->parameter->qr_code, true )}}" alt="">
                            </li>

                            <li class="list-group-item ">
                               
                                <span class="w-100"><?= clean($gateway->parameter->payment_instruction) ?></span>

                            </li>

                        </ul>
                    @else
                        <ul class="list-group">
                            <li class="list-group-item  d-flex justify-content-between">
                                <span>{{ __('Gateway Name') }}</span>
                                <span>{{ optional($gateway->parameter)->name ?? 'N/A' }}</span>
                            </li>

                            <li class="list-group-item  d-flex justify-content-between">
                                <span>{{ __('Account Number') }}</span>
                                <span>{{ optional($gateway->parameter)->account_number ?? 'N/A' }}</span>
                            </li>

                            <li class="list-group-item  d-flex justify-content-between">
                                <span>{{ __('Routing Number') }}</span>
                                <span>{{ optional($gateway->parameter)->routing_number ?? 'N/A' }}</span>
                            </li>

                            <li class="list-group-item  d-flex justify-content-between">
                                <span>{{ __('Branch Name') }}</span>
                                <span>{{ optional($gateway->parameter)->branch_name ?? 'N/A' }}</span>
                            </li>

                            <li class="list-group-item  d-flex justify-content-between">
                                <span>{{ __('Method Currency') }}</span>
                                <span>{{ optional($gateway->parameter)->gateway_currency }}</span>
                            </li>

                            <li class="list-group-item ">
                               
                                <span class="w-100"><?= clean($gateway->parameter->payment_instruction) ?></span>

                            </li>

                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="sp_site_card h-100">
                <div class="card-header">
                    <h5 class="mb-0">{{ __('Payment Information') }}</h5>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item   d-flex justify-content-between">
                            <span>{{ __('Gateway Name') }}:</span>

                            <span>{{ str_replace('_', ' ', $deposit->gateway->name) }}</span>

                        </li>
                        <li class="list-group-item   d-flex justify-content-between">
                            <span>{{ __('Amount') }}:</span>
                            <span>{{ Config::formatter($deposit->amount)}}</span>
                        </li>

                        <li class="list-group-item   d-flex justify-content-between">
                            <span>{{ __('Charge') }}:</span>
                            <span>{{ Config::formatter($deposit->charge)}}</span>
                        </li>

                        <li class="list-group-item   d-flex justify-content-between">
                            <span>{{ __('Conversion Rate') }}:</span>
                            <span>{{ '1 ' . Config::config()->currency . ' = ' . Config::formatOnlyNumber($deposit->rate) }}</span>
                        </li>

                        <li class="list-group-item   d-flex justify-content-between">
                            <span>{{ __('Total Payable Amount') }}:</span>
                            <span>{{ Config::formatOnlyNumber($deposit->total) . ' ' . $deposit->gateway->parameter->gateway_currency }}</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="sp_site_card">
                <div class="card-header">
                    <h5 class="mb-0">{{ __('Requirments') }}</h5>
                </div>

                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                           
                            @foreach ($gateway->parameter->user_proof_param as $proof)

                            @php
                                $proof = (array) $proof
                            @endphp
                          

                                @if ($proof['type'] == 'text')
                                    <div class="form-group col-md-12">
                                        <label for="" class="mb-2 mt-2">{{ __($proof['field_name']) }}</label>
                                        <input type="text"
                                            name="{{ strtolower(str_replace(' ', '_', $proof['field_name'])) }}"
                                            class="form-control"
                                            {{ $proof['validation'] == 'required' ? 'required' : '' }}>
                                    </div>
                                @endif
                                @if ($proof['type'] == 'textarea')
                                    <div class="form-group col-md-12">
                                        <label for="" class="mb-2 mt-2">{{ __($proof['field_name']) }}</label>
                                        <textarea name="{{ strtolower(str_replace(' ', '_', $proof['field_name'])) }}" class="form-control"
                                            {{ $proof['validation'] == 'required' ? 'required' : '' }}></textarea>
                                    </div>
                                @endif

                                @if ($proof['type'] == 'file')
                                    <div class="form-group col-md-12">
                                        <label for="" class="mb-2 mt-2">{{ __($proof['field_name']) }}</label>
                                        <input type="file"
                                            name="{{ strtolower(str_replace(' ', '_', $proof['field_name'])) }}"
                                            class="form-control"
                                            {{ $proof['validation'] == 'required' ? 'required' : '' }}>
                                    </div>
                                @endif
                            @endforeach


                            <div class="form-group">
                                <button class="btn sp_theme_btn mt-4" type="submit">{{ __('Pay Now') }}</button>

                            </div>


                        </div>



                    </form>



                </div>

            </div>




        </div>
    </div>
@endsection
