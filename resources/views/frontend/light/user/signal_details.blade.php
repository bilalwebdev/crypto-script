@extends(Config::theme() . 'layout.auth')

@section('content')
    <div class="row gy-4">
        <div class="col-xxl-8 col-lg-7">
            <div class="signal-details-wrapper">
                <div class="signal-details-thumb">
                    <img src="{{ Config::getFile('signal', $signal->image, true) }}" alt="">
                </div>
                <h3 class="title my-4">{{ __($signal->title) }}</h3>
                <?= clean($signal->description,'youtube') ?>
            </div>
        </div>
        <div class="col-xxl-4 col-lg-5">
            <div class="signal-widget">
                <h5 class="mb-4">{{ __('Signal Overview') }}</h5>
                <ul class="signal-widget-list">
                    <li>
                        <span class="caption"><i class="fas fa-id-badge"></i> {{__('Signal Id')}} :</span>
                        <span class="details">{{ $signal->id }}</span>
                    </li>
                    <li>
                        <span class="caption"><i class="far fa-handshake"></i> {{__('Pair')}} :</span>
                        <span class="details">{{ $signal->pair->name }}</span>
                    </li>
                    <li>
                        <span class="caption"><i class="fas fa-plane-departure"></i> {{__('Signal direction')}} :</span>
                        <span class="details">{{ $signal->direction }}</span>
                    </li>
                    <li>
                        <span class="caption"><i class="fas fa-hourglass-half"></i> {{ __('Stop Loss') }}:</span>
                        <span class="details">{{ $signal->sl }}</span>
                    </li>
                    <li>
                        <span class="caption"><i class="far fa-clock"></i> {{ __('Time Frame') }}:</span>
                        <span class="details">{{ $signal->time->name }}</span>
                    </li>
                    <li>
                        <span class="caption"><i class="fas fa-money-bill"></i> {{ __('Open') }}:</span>
                        <span class="details">{{ $signal->open_price }}</span>
                    </li>
                    <li>
                        <span class="caption"><i class="fas fa-hand-holding-usd"></i> {{ __('Take profit') }}:</span>
                        <span class="details">{{ $signal->tp }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
