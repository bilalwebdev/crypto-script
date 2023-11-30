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
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Charge') }}</th>
                                    <th>{{ __('Details') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Date') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($transactions as $key => $transaction)
                                    <tr>
                                        <td data-caption="{{ __('Trx') }}">{{ $transaction->trx }}</td>
                                        <td data-caption="{{ __('User') }}">
                                            {{ optional($transaction->user)->username }}</td>
                                        <td data-caption="{{ __('Amount') }}">{{ Config::formatter($transaction->amount) }}</td>
                                        
                                        <td data-caption="{{ __('Charge') }}">
                                            {{ Config::formatter($transaction->charge) . ' ' . Config::config()->currency }}</td>
                                        <td data-caption="{{ __('Details') }}">{{ $transaction->details }}</td>
                                        <td data-caption="{{ __('Type') }}">
                                            @if ($transaction->type == '-')
                                                <span class="sp_text_danger fs-5"> {{ $transaction->type }}</span>
                                            @else
                                                <span class="sp_text_success fs-5"> {{ $transaction->type }}</span>
                                            @endif

                                        </td>
                                        <td data-caption="{{ __('Payment Date') }}">
                                            {{ $transaction->created_at->format('Y-m-d') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">
                                            {{ __('No Transaction Found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
                @if ($transactions->hasPages())
                    <div class="card-footer">
                        {{ $transactions->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
