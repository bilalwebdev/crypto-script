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
                                    @if (request()->routeIs('user.transfer_money.log'))
                                        <th>{{ __('Receiver') }}</th>
                                    @else
                                        <th>{{ __('Sender') }}</th>
                                    @endif
                                    <th>{{ __('Amount') }}</th>

                                    <th>{{ __('Charge') }}</th>
                                    <th>{{ __('Details') }}</th>

                                    <th>{{ __('Transfer Date') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($transferMoneys as $key => $transfer)
                                    <tr>
                                        <td data-caption="{{ __('Trx') }}">{{ $transfer->trx }}</td>
                                        @if (request()->routeIs('user.transfer_money.log'))
                                            <td data-caption="{{ __('User') }}">
                                                {{ optional($transfer->receiver)->username }}</td>
                                        @else
                                            <td data-caption="{{ __('User') }}">
                                                {{ optional($transfer->sender)->username }}</td>
                                        @endif
                                        <td data-caption="{{ __('Amount') }}">{{ Config::formatter($transfer->amount) }}</td>

                                        <td data-caption="{{ __('Charge') }}">
                                            {{ Config::formatter($transfer->charge) }}</td>
                                        <td data-caption="{{ __('Details') }}">{{ $transfer->details }}</td>

                                        <td data-caption="{{ __('Transfer Date') }}">
                                            {{ $transfer->created_at->format('Y-m-d') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">
                                            {{ __('No Transfer Found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
                @if ($transferMoneys->hasPages())
                    <div class="card-footer">
                        {{ $transferMoneys->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
