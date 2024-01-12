@extends('backend.layout.master')

@section('element')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h6> Pleae review and confirm this Transaction? </h6>

                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead style="padding: 15px">
                                <tr>
                                    <td style=""><strong>Name
                                            :</strong></td>
                                    <td style="">{{ $dep->user->username }}</td>
                                </tr>
                                <tr>
                                    <td style=""><strong>Email
                                            :</strong></td>
                                    <td style="">{{ $dep->user->email }}</td>
                                </tr>
                                <tr>
                                    <td style=""><strong>Account No.
                                            :</strong></td>
                                    <td style="">{{ $dep->login }}</td>
                                </tr>
                                <tr>
                                    <td style=""><strong>Amount
                                            :</strong></td>
                                    <td style="">{{ $dep->amount }}</td>
                                </tr>
                                <tr>
                                    <td style=""><strong>Transaction Type
                                            :</strong></td>
                                    <td style="">
                                        <span>
                                            @if ($type == 'dep')
                                                Deposit
                                            @else
                                                Withdraw
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Select Payment Method:</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.transac.final') }}">
                                            @csrf
                                            <input type="hidden" value="{{ $dep->id }}" name="transac_id"
                                                id="">
                                            <input type="hidden" value="{{ $type }}" name="transac_type"
                                                id="">
                                            <select class="form-control" name="payment_method_id" id="payment_method_id">
                                                <option value=""></option>
                                                @foreach ($payment_methods as $item)
                                                    <option data-amount="{{ $item['min_amount'] }}"
                                                        data-waddress="{{ $item['wallet_address'] }}"
                                                        data-name ="{{ $item['name'] }}" value="{{ $item['id'] }}">
                                                        {{ $item['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button class="btn btn-sm btn-primary float-right mt-2"
                                                type="submit">Confirm</button>
                                        </form>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
