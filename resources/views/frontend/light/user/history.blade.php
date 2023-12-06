@extends(Config::theme() . 'layout.auth')

@section('content')
    <div class="row">


        <div class="col-sm-12 col-lg-3">
            <div class="sp_site_card mb-4">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0 ">Select transaction type</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('history/filter') }}" method="post">
                        <input type="hidden" name="_token" value="g3TvDwyj3LQSms88hy4duVAnFsUgK4r131aaAdfJ">
                        <div class="form-group mb-3">
                            <label for="">TRANSACTIONS TYPE</label>
                            <select class="form-control" name="type">
                                <option value="dep">Deposit</option>
                                <option value="with">Withdraw</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">ACCOUNT NUMBER</label>

                            <select class="form-control" name="login">
                                <option value=""></option>
                                @foreach ($accounts as $acc)
                                    <option value="{{ $acc->login }}">{{ $acc->login }}</option>
                                @endforeach

                            </select>
                        </div>


                        <button type="submit" class="btn sp_theme_btn btn-md text-uppercase"><i class="fas fa-history"
                                aria-hidden="true"></i>&nbsp;Apply</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-lg-9">
            <div class="sp_site_card mb-4">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0 ">Transaction History</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                        </div>
                        <table class="table sp_site_table mb-2" name="incidents" id="incidents">
                            <thead>
                                <tr>
                                    <th class="default-cell">Account No<span uk-icon="triangle-down"
                                            class="ng-star-inserted uk-icon"></span></th>
                                    <th class="default-cell">Transaction type<span uk-icon="triangle-down"
                                            class="ng-star-inserted uk-icon"></span></th>
                                    <th class="default-cell">Payment type<span uk-icon="triangle-down"
                                            class="ng-star-inserted uk-icon"></span></th>
                                    <th class="default-cell">Amount<span uk-icon="triangle-down"
                                            class="ng-star-inserted uk-icon"></span></th>
                                    <th class="default-cell">Status<span uk-icon="triangle-down"
                                            class="ng-star-inserted uk-icon"></span></th>
                                    <th class="default-cell">Action<span uk-icon="triangle-down"
                                            class="ng-star-inserted uk-icon"></span></th>
                                    <th class="default-cell">Date<span uk-icon="triangle-down"
                                            class="ng-star-inserted uk-icon"></span></th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($requests as $dreq)
                                    <tr>
                                        <td>{{ $dreq->login }}</td>
                                        <td>Deposit</td>
                                        <td>{{ $dreq->payment?->name }}</td>
                                        <td>{{ $dreq->amount }}</td>
                                        @if ($dreq->status == 2)
                                            <td>Pending</td>
                                        @elseif($dreq->status == 1)
                                            <td>Approved</td>
                                        @else
                                            <td>Rejected</td>
                                        @endif
                                        <td><a href="{{ route('user.history.delete', $dreq->id) }}"
                                                style="font-style:italic;text-decoration:underline;font-size:11px;color:silver">Cancel</a>&nbsp;&nbsp;&nbsp;
                                        </td>
                                        <td>{{ date($dreq->created_at) }}</td>

                                    </tr>
                                @empty
                                    <span>No request found!</span>
                                @endforelse

                            </tbody>
                        </table>

                        <table class="table align-items-center table-flush table-borderless" name="incidents"
                            id="incidents">
                            @if ($requests->hasPages())
                                <div class="col-md-12">
                                    {{ $requests->links() }}
                                </div>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>










    </div>
@endsection

@push('external-css')
    <link rel="stylesheet" href="{{ Config::cssLib('frontend', 'lib/apex.min.css') }}">
@endpush
