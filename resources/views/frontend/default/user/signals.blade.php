@extends(Config::theme() . 'layout.auth')

@section('content')

    <div class="sp_site_card">
        <div class="card-header">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <h4>{{ __($title) }}</h4>

                <form class="search-form" method="GET" action="">
                    <input type="text" name="search" class="form-control card-bg" placeholder="Search ID or Title">
                    <button type="submit" class="text-center"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="row gy-4">
                @forelse ($signals as $signal)
                <div class="col-xxl-3 col-lg-4 col-md-6">
                    <div class="singnal-card {{ $signal->direction === 'sell' ? 'border-warning' : 'border-success' }}">
                        <div class="singnal-card-top">
                            <div class="left">
                                <span
                                    class="status text-uppercase {{ $signal->direction === 'sell' ? 'sell' : 'buy' }}">{{ $signal->direction }}</span>
                                <span class="fw-medium">{{ $signal->pair->name }}
                                    @if ($signal->direction === 'sell')
                                        <i class="fas fa-arrow-down sp_text_danger"></i>
                                    @else
                                        <i class="fas fa-arrow-up sp_text_success"></i>
                                    @endif
                                </span>
                            </div>
                            <div class="right">
                                <p class="text-uppercase">{{ __('ID') }}: {{ $signal->id }}</p>
                            </div>
                        </div>
                        <div class="singnal-card-thumb">
                            <img src="{{ Config::getFile('signal', $signal->image, true) }}" alt="">
                        </div>
                        <div class="singnal-card-body">
                            <h5 class="title"><a
                                    href="{{ route('user.signal.details', ['id' => $signal->id, 'slug' => Str::slug($signal->title)]) }}">{{ $signal->title }}</a>
                            </h5>
                            <ul class="signal-info-list">
                                <li class="signal-single-list">
                                    <span class="caption"><i class="fas fa-id-badge"></i> {{ __('Stop Loss') }}:</span>
                                    <span class="value">{{ $signal->sl }}</span>
                                </li>
                                <li class="signal-single-list">
                                    <span class="caption"><i class="far fa-clock"></i> {{ __('Time Frame') }}:</span>
                                    <span class="value">{{ $signal->time->name }}</span>
                                </li>
                                <li class="signal-single-list">
                                    <span class="caption"><i class="fas fa-money-bill"></i> {{ __('Open') }}:</span>
                                    <span class="value">{{ $signal->open_price }}</span>
                                </li>
                                <li class="signal-single-list">
                                    <span class="caption"><i class="fas fa-hand-holding-usd"></i> {{ __('Take profit') }}:</span>
                                    <span class="value">{{ $signal->tp }}</span>
                                </li>
                            </ul>
                            <a href="{{ route('user.signal.details', ['id' => $signal->id, 'slug' => Str::slug($signal->title)]) }}" class="view-signal-btn w-100 text-center mt-3">{{__('View Details')}}</a>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-md-12">
                        <div class="text-center py-5">
                            <i class="far fa-folder-open display-3"></i>
                            <p class="mt-4">{{ __('No Signals Found') }}</p>
                        </div>
                    </div>
                @endforelse


                @if ($signals->hasPages())
                    <div class="col-md-12">
                        {{ $signals->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection