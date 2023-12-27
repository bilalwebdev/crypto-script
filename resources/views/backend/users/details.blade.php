@extends('backend.layout.master')



@section('element')
    <div class="card">
        <div class="row">
            <div class="col-md-12">
                <div class="tab" role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="tab-xx active"><a href="#acc" aria-controls="home" role="tab"
                                data-toggle="tab">Live Accounts</a></li>
                        <li role="presentation" class="tab-xx"><a href="#details" aria-controls="profile" role="tab"
                                data-toggle="tab">Personal Details</a></li>
                        <li role="presentation" class="tab-xx"><a href="#docs" aria-controls="messages" role="tab"
                                data-toggle="tab">Documents</a></li>
                        <li role="presentation" class="tab-xx"><a href="#dep" aria-controls="messages" role="tab"
                                data-toggle="tab">Deposit</a></li>
                        <li role="presentation" class="tab-xx"><a href="#with" aria-controls="messages" role="tab"
                                data-toggle="tab">Withdraw</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content tabs">
                        <div role="tabpanel" class="tab-pane fade  active show" id="acc">
                            <h3>LIVE ACCOUNTS</h3>
                            <div class="table-responsive">
                                <table class="table student-data-table m-t-20">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Sr. No') }}</th>
                                            <th>{{ __('MT5 A/C No') }}</th>
                                            <th>{{ __('Reg. Data') }}</th>
                                            <th>{{ __('Currency') }}</th>
                                            <th>{{ __('A/C Type') }}</th>
                                            <th>{{ __('Leverage') }}</th>
                                            <th>{{ __('Balance') }}</th>
                                            <th>{{ __('Equity') }}</th>
                                            <th>{{ __('Floating P/L') }}</th>
                                            <th>{{ __('Password') }}</th>
                                            <th>{{ __('Investor Password') }}</th>
                                            <th>{{ __('Delete') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($user->accounts as $key => $acc)
                                            <tr>

                                                @php
                                                    $accDetails = $mt5->getAccount($acc->login);
                                                @endphp

                                                <td>
                                                    <span>{{ $key + 1 }}</span>
                                                </td>
                                                <td> <span>
                                                        {{ $acc->login }}
                                                    </span></td>
                                                <td> <span>
                                                        {{ $acc->created_at }}
                                                    </span></td>
                                                <td> <span>
                                                        {{ strtoupper($acc->currency) }}
                                                    </span></td>
                                                <td> <span>
                                                        @if ($acc->account_type == 1)
                                                            Standard Account
                                                        @elseif($acc->account_type == 2)
                                                            Premium Account
                                                        @else
                                                            VIP Account
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>{{ $acc->leverage }}</span>
                                                </td>
                                                <td>
                                                    <span>{{ $accDetails['balance'] ?? '' }}</span>
                                                </td>
                                                <td>
                                                    <span>{{ $accDetails['equity'] ?? '' }}</span>
                                                </td>
                                                <td>
                                                    <span>{{ $accDetails['floating'] ?? '' }}</span>
                                                </td>
                                                <td>
                                                    <span>{{ $acc->master_pass }}</span>
                                                </td>
                                                <td>
                                                    <span>{{ $acc->investor_pass }}</span>
                                                </td>
                                                <td>
                                                    <button class="btn-sm btn-danger del-modal"><i
                                                            class=""></i>&times;</button>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="100%">{{ __('No Data Found') }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="details">
                            <h3>USER DETAILS</h3>
                            <ul class="list-group col-md-6">

                                <li class="list-group-item d-flex justify-content-between">

                                    <span>{{ __('First Name') }}</span>
                                    <span>{{ $user->username }}</span>

                                </li>
                                <li class="list-group-item d-flex justify-content-between">

                                    <span>{{ __('Last Name') }}</span>
                                    <span>{{ $user->username }}</span>

                                </li>
                                <li class="list-group-item d-flex justify-content-between">

                                    <span>{{ __('Email') }}</span>
                                    <span>{{ $user->email }}</span>

                                </li>
                                <li class="list-group-item d-flex justify-content-between">

                                    <span>{{ __('Phone') }}</span>
                                    <span>{{ $user->phone }}</span>

                                </li>
                                <li class="list-group-item d-flex justify-content-between">

                                    <span>{{ __('Address') }}</span>
                                    <span>{{ $user->address->city . ', ' . $user->address->city . ', ' . $user->address->city }}</span>

                                </li>
                                <li class="list-group-item d-flex justify-content-between">

                                    <span>{{ __('Country') }}</span>
                                    <span>{{ $user->address->country }}</span>

                                </li>
                                <li class="list-group-item d-flex justify-content-between">

                                    <span>{{ __('Reg. Date') }}</span>
                                    <span>{{ $user->created_at }}</span>

                                </li>


                            </ul>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="docs">
                            <div class="tab-pane active col-md-12" id="DOCUMENT">
                                <h3>DOCUMENT</h3>
                                <form action="{{ url('admin/users/kyc-approve') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}" />
                                    <table class="table table-bordered table-striped datatable ">
                                        <thead>
                                            <tr>
                                                <th>Document Type</th>
                                                <th>Document</th>
                                                <th>Verify</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($user->kycinfo as $key => $doc)
                                                <tr>
                                                    <td>
                                                        @if ($doc->type == 'proof_id1')
                                                            Proof of ID 1
                                                        @elseif ($doc->type == 'proof_id2')
                                                            Proof of ID 2
                                                        @elseif ($doc->type == 'proof_address1')
                                                            Proof of Address 1
                                                        @else
                                                            Proof of Address 2
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <img src="{{ Config::getFile('kyc', $doc->file, true) }}"
                                                            alt="" class=""
                                                            style="width:50px; height:50px; margin-right:8px">
                                                        <!-- Replace "path/to/your/image.jpg" with the actual path or URL of your image -->
                                                        <a href="{{ Config::getFile('kyc', $doc->file, true) }}"
                                                            class="btn-sm btn-primary" download>
                                                            Download
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="docs[]" name="docs[]"
                                                            @if ($doc->status == 1) checked @endif
                                                            value="{{ $doc->id }}">
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="text-center" colspan="100%">{{ __('No Data Found') }}
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td colspan="3" align="center">
                                                    <button class="btn-sm btn-primary" type="submit">verify</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>

                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="dep">
                            <h3>DEPOSITS</h3>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table student-data-table m-t-20">
                                        <thead>
                                            <tr>

                                                <th>{{ __('Payment Type') }}</th>
                                                <th>{{ __('A/C No') }}</th>
                                                <th>{{ __('Email') }}</th>
                                                <th>{{ __('Trans. Date') }}</th>
                                                <th>{{ __('Amount') }}</th>
                                                <th>{{ __('status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($user->deposits as $key => $manual)
                                                <tr>


                                                    <td> <span>
                                                            {{ $manual->payment->name }}
                                                        </span></td>
                                                    <td> <span>
                                                            {{ $manual->login }}
                                                        </span></td>
                                                    <td> <span>
                                                            {{ $manual->user->email }}
                                                        </span></td>
                                                    <td> <span>
                                                            {{ $manual->created_at }}
                                                        </span></td>
                                                    <td>{{ Config::formatter($manual->amount) }}</td>

                                                    <td>
                                                        @if ($manual->status == 2)
                                                            <span class="badge badge-warning">{{ __('Pending') }}</span>
                                                        @elseif($manual->status == 1)
                                                            <span class="badge badge-success">{{ __('Approved') }}</span>
                                                        @elseif($manual->status == 3)
                                                            <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{-- <a class="btn btn-sm btn-outline-primary details"
                                                        href="{{ route('admin.deposit.details', $manual->id) }}">
                                                        <i class="far fa-eye"></i></a> --}}

                                                        <a class="btn
                                                          @if ($manual->status != 2) disabled @endif btn-sm btn-outline-primary accept"
                                                            data-url="{{ route('admin.deposit.accept', $manual->id) }}"><i
                                                                class="fas fa-check"></i></a>
                                                        <a class="btn @if ($manual->status != 2) disabled @endif  btn-sm btn-outline-danger reject"
                                                            data-url="{{ route('admin.deposit.reject', $manual->id) }}"><i
                                                                class="fas fa-times"></i></a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="text-center" colspan="100%">{{ __('No Data Found') }}
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="with">
                            <h3>WITHDRAWS</h3>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table student-data-table m-t-20">
                                        <thead>
                                            <tr>

                                                <th>{{ __('Payment Type') }}</th>
                                                <th>{{ __('A/C No') }}</th>
                                                <th>{{ __('Email') }}</th>
                                                <th>{{ __('Trans. Date') }}</th>
                                                <th>{{ __('Amount') }}</th>
                                                <th>{{ __('status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($user->withdraws as $key => $manual)
                                                <tr>


                                                    <td> <span>
                                                            {{ $manual->payment?->name }}
                                                        </span></td>
                                                    <td> <span>
                                                            {{ $manual->login }}
                                                        </span></td>
                                                    <td> <span>
                                                            {{ $manual->user->email }}
                                                        </span></td>
                                                    <td> <span>
                                                            {{ $manual->created_at }}
                                                        </span></td>
                                                    <td>{{ Config::formatter($manual->amount) }}</td>

                                                    <td>
                                                        @if ($manual->status == 2)
                                                            <span class="badge badge-warning">{{ __('Pending') }}</span>
                                                        @elseif($manual->status == 1)
                                                            <span class="badge badge-success">{{ __('Approved') }}</span>
                                                        @elseif($manual->status == 3)
                                                            <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{-- <a class="btn btn-sm btn-outline-primary details"
                                                            href="{{ route('admin.withdraw.details', $manual->id) }}">
                                                            <i class="far fa-eye"></i></a> --}}


                                                        <a class="btn
                                                              @if ($manual->status != 2) disabled @endif btn-sm btn-outline-primary accept"
                                                            data-url="{{ route('admin.withdraw.accept', $manual->id) }}"><i
                                                                class="fas fa-check"></i></a>
                                                        <a class="btn @if ($manual->status != 2) disabled @endif  btn-sm btn-outline-danger reject"
                                                            data-url="{{ route('admin.withdraw.reject', $manual->id) }}"><i
                                                                class="fas fa-times"></i></a>

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="text-center" colspan="100%">{{ __('No Data Found') }}
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="accept" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Payment Accept') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <p>{{ __('Are you sure to you want to delete this account') }}?</p>

                            <div class="d-flex" style="gap: 8px">
                                <div class="">
                                    <input type="checkbox" name="mt5" id="" class="mr-1"><span>Mt5</span>
                                </div>
                                <div class="">
                                    <input type="checkbox" name="admin_panel" id="" class="mr-1"><span> Admin
                                        Panel</span>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Accept') }}</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <style>
        a:hover,
        a:focus {
            outline: none;
            text-decoration: none;
        }

        .tab .nav-tabs {
            border-bottom: 2px solid #e8e8e8;
        }

        .tab .nav-tabs li a {
            display: block;
            padding: 10px 20px;
            margin: 0 5px 1px 0;
            background: #fff;
            font-size: 14px;
            font-weight: 700;
            color: #112529;
            text-align: center;
            border: none;
            border-radius: 0;
            z-index: 2;
            position: relative;
            transition: all 0.3s ease 0s;
        }

        .tab .nav-tabs li a:hover,
        .tab .nav-tabs li.active a {
            color: #198df8;
            border: none;
        }

        .tab .nav-tabs li.active a:before {
            content: "";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 25px;
            font-weight: 700;
            color: #198df8;
            margin: 0 auto;
            position: absolute;
            bottom: -30px;
            left: 0;
            right: 0;
        }

        .tab .nav-tabs li.active a:after {
            content: "";
            width: 100%;
            height: 3px;
            background: #198df8;
            position: absolute;
            bottom: -1px;
            left: 0;
            z-index: -1;
            transition: all 0.3s ease 0s;
        }

        .tab .tab-content {
            padding: 30px 20px 20px;
            margin-top: 0;
            background: #fff;
            font-size: 15px;
            color: #7a9181;
            line-height: 30px;
            border-radius: 0 0 5px 5px;
        }

        .tab .tab-content h3 {
            font-size: 24px;
            margin-top: 0;
        }

        @media only screen and (max-width: 479px) {
            .tab .nav-tabs li {
                width: 100%;
                text-align: center;
            }

            .tab .nav-tabs li.active a:before {
                content: "\f105";
                bottom: 15%;
                left: 0;
                right: auto;
            }
        }
    </style>
    @push('script')
        <script>
            $(document).ready(function() {
                // Add click event listener to tabs
                $('.tab-xx').click(function() {

                    // Remove "active" class from all tabs
                    $('.tab-xx').removeClass('active');

                    // Add "active" class to the clicked tab
                    $(this).addClass('active');
                });
            });


            $('.del-modal').on('click', function() {
                const modal = $('#accept');

                modal.find('form').attr('action', $(this).data('url'));
                modal.modal('show');
            })
        </script>
    @endpush
@endsection
