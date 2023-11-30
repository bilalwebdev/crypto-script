@extends(Config::theme() . 'layout.auth')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sp_site_card">
                <div class="card-header">
                    <form action="" method="get" class="row justify-content-md-end g-3">
                        <div class="col-auto">
                            <input type="text" name="trx" class="form-control me-2" placeholder="transaction id">
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control me-3" placeholder="Search User" name="date">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn sp_theme_btn">{{ __('Search') }}</button>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table sp_site_table">
                            <thead>
                                <tr>
                                    <th>{{ __('Trx') }}</th>
                                    <th>{{ __('User') }}</th>
                                    <th>{{ __('Gateway') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Currency') }}</th>
                                    <th>{{ __('Charge') }}</th>
                                    <th>{{ __('Payment Date') }}</th>
                                    <th>{{ __('Plan Expired At') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($investments as $key => $investment)
                                    <tr>
                                        <td data-caption="{{ __('Trx') }}">{{ $investment->trx }}</td>
                                        <td data-caption="{{ __('User') }}">
                                            {{ $investment->user->username }}</td>
                                        <td data-caption="{{ __('Gateway') }}">

                                            @if ($investment->gateway_id == null)
                                                {{ __('Invest Using Balance') }}
                                            @else
                                                {{ optional($investment->gateway)->name ?? 'Account Transfer' }}
                                            @endif
                                        </td>
                                        <td data-caption="{{ __('Amount') }}">{{ Config::formatter($investment->amount) }}</td>
                                        <td data-caption="{{ __('Currency') }}">
                                            @if ($investment->gateway_id == null)
                                                {{ Config::config()->currency }}
                                            @else
                                                {{ optional($investment->gateway)->parameter->gateway_currency ?? '' }}
                                            @endif

                                        </td>
                                        <td data-caption="{{ __('Charge') }}">
                                            {{ Config::formatter($investment->charge) }}</td>

                                        <td data-caption="{{ __('Payment Date') }}">
                                            {{ $investment->created_at->format('Y-m-d') }}
                                        </td>
                                        <td data-caption="{{ __('Plan Expired At') }}">
                                            {{ $investment->plan_expired_at }}
                                        </td>
                                        <td>
                                            @if($investment->status == 2)
                                                <span class="sp_badge sp_badge_warning">{{__('Pending')}}</span>
                                            @elseif($investment->status == 1)
                                                <span class="sp_badge sp_badge_success">{{__('Accept')}}</span>
                                            @elseif($investment->status == 3)
                                                <span class="sp_badge sp_badge_success">{{__('Rejected')}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">
                                            {{ __('No Invest Found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>



                    </div>
                </div>
                @if ($investments->hasPages())
                    <div class="card-footer">
                        {{ $investments->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
