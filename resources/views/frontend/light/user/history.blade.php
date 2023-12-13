@extends(Config::theme() . 'layout.auth')

@section('content')
    <div class="row">


        <div class="col-sm-12 col-lg-3">
            <div class="sp_site_card mb-4">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0 ">Select transaction type</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('history/filter') }}" method="get">

                        <div class="form-group mb-3">
                            <label for="">TRANSACTIONS TYPE</label>
                            <select class="form-control" name="type">
                                <option @if ($type == 'dep') selected @endif value="dep">Deposit</option>
                                <option @if ($type == 'with') selected @endif value="with">Withdraw</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">ACCOUNT NUMBER</label>

                            <select class="form-control" name="login">
                                <option value=""></option>
                                @foreach ($accounts as $acc)
                                    <option @if ($login == $acc->login) selected @endif value="{{ $acc->login }}">
                                        {{ $acc->login }}</option>
                                @endforeach

                            </select>
                        </div>


                        <button type="submit" class="btn sp_theme_btn btn-md text-uppercase"><i class="fas fa-history"
                                aria-hidden="true"></i>&nbsp;Apply</button>
                        {{-- <a href="/history" class="btn sp_theme_btn btn-md text-uppercase"><i class="fa fa-refresh"
                                aria-hidden="true"></i>&nbsp;Reset</a> --}}
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

                                @forelse ($requests as $req)
                                    <tr>
                                        <td>{{ $req->login }}</td>
                                        @if ($type == 'dep')
                                            <td>Deposit</td>
                                        @else
                                            <td>Withdraw</td>
                                        @endif
                                        <td>{{ $req->payment?->name }}</td>
                                        <td>{{ $req->amount }}</td>
                                        @if ($req->status == 2)
                                            <td> <span class="status-btn status-btn-warning">
                                                    <i class="fas fa-clock" aria-hidden="true"></i>
                                                    Pending</span></td>
                                        @elseif($req->status == 1)
                                            <td> <span class="status-btn status-btn-success">
                                                    <i class="fas fa-thumbs-up" aria-hidden="true"></i>
                                                    Approved</span></td>
                                        @else
                                            <td> <span class="status-btn status-btn-danger">
                                                    <i class="fas fa-ban" aria-hidden="true"></i>
                                                    Rejected</span></td>
                                        @endif

                                        <td>
                                            @if ($req->status == 2)
                                                <div onclick="cancelTrans('{{ $req->id }}')"
                                                    class="cancel cursor-pointer"
                                                    style="font-style:italic;text-decoration:underline;font-size:11px;color:silver; pointer-events:auto;">
                                                    Cancel</div>
                                            @endif
                                        </td>

                                        <td>{{ date($req->created_at) }}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center">No request found!</td>
                                    </tr>
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


        <div class="modal fade" tabindex="-3" id="delete" role="dialog">
            <div class="modal-dialog" role="document">
                <div>


                    <div class="modal-content bg1">
                        <div class="modal-header ">
                            <h5 class="modal-title">{{ __('Cancel Transaction') }}</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body ">
                            <p>{{ __('Are you sure to cancel this transaction?') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm sp_btn_secondary"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="button" onclick="confirmCancel()"
                                class="btn btn-sm sp_btn_danger">{{ __('Yes') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('external-css')
    <link rel="stylesheet" href="{{ Config::cssLib('frontend', 'lib/apex.min.css') }}">
@endpush
@push('script')
    <script>
        var hid = '';

        function cancelTrans(id) {

            const modal = $('#delete');

            modal.modal('show');

            hid = id;

        }

        function confirmCancel() {
            window.location.href = '/history/delete/' + hid;
        }
    </script>
@endpush
