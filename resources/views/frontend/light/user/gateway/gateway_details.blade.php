<ul class="list-group">
    @if (!(session('type') == 'deposit'))
        <li class="list-group-item d-flex justify-content-between">
            <span>{{ __('Plan Name') }}:</span>

            <span>{{ $deposit->plan->name }}</span>

        </li>
    @endif
    <li class="list-group-item d-flex justify-content-between">
        <span>{{ __('Gateway Name') }}:</span>

        <span>{{ str_replace('_',' ',$deposit->gateway->name) }}</span>

    </li>
    <li class="list-group-item d-flex justify-content-between">
        <span>{{ __('Amount') }}:</span>
        <span>{{ Config::formatter($deposit->amount) }}</span>
    </li>

    <li class="list-group-item d-flex justify-content-between">
        <span>{{ __('Charge') }}:</span>
        <span>{{ Config::formatter($deposit->charge) }}</span>
    </li>


    <li class="list-group-item d-flex justify-content-between">
        <span>{{ __('Conversion Rate') }}:</span>
        <span>{{ '1 ' . $general->site_currency . ' = ' . number_format($deposit->rate, 2) . ' ' . $deposit->gateway->gateway_parameters->gateway_currency }}</span>
    </li>



    <li class="list-group-item d-flex justify-content-between">
        <span>{{ __('Total Payable Amount') }}:</span>
        <span>{{ number_format($deposit->final_amount, 2) . ' ' . $deposit->gateway->gateway_parameters->gateway_currency }}</span>
    </li>
</ul>
