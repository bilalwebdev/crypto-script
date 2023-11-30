@extends(Config::theme() . 'layout.auth')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sp_site_card">
                <div class="card-header">
                    <form action="" method="get" class="row justify-content-md-end g-3">
                        <div class="col-auto">
                            <input type="text" name="trx" class="form-control form-control-sm me-2" placeholder="transaction id">
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control form-control-sm me-3" placeholder="Search User" name="date">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-sm sp_theme_btn">{{ __('Search') }}</button>
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
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($deposits as $key => $deposit)
                                    <tr>
                                        <td data-caption="{{ __('Trx') }}">{{ $deposit->trx }}</td>
                                        <td data-caption="{{ __('User') }}">
                                            {{ $deposit->user->username }}</td>
                                        <td data-caption="{{ __('Gateway') }}">
                                            {{ $deposit->gateway->name ?? 'Account Transfer' }}</td>
                                        <td data-caption="{{ __('Amount') }}">{{ Config::formatter($deposit->amount) }}</td>
                                        <td data-caption="{{ __('Currency') }}">{{ Config::config()->currency }}</td>
                                        <td data-caption="{{ __('Charge') }}">
                                            {{ Config::formatter($deposit->charge) }}</td>

                                        <td data-caption="{{ __('Payment Date') }}">
                                            {{ $deposit->created_at->format('Y-m-d') }}
                                        </td>

                                        <td data-caption="{{ __('Status') }}">
                                            @if ($deposit->status == 1)
                                                <span class="sp_badge sp_badge_success">{{ __('Successfull') }}</span>
                                            @elseif($deposit->status == 2)
                                                <span class="sp_badge sp_badge_warning">{{ __('Pending') }}</span>
                                            @else
                                                <span class="sp_badge sp_badge_danger">{{ __('Reject') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">
                                            {{ __('No Deposits Found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>


                    </div>
                </div>


                @if ($deposits->hasPages())
                    <div class="card-footer">
                        {{ $deposits->links() }}
                    </div>
                @endif


            </div>

        </div>

    </div>
@endsection
