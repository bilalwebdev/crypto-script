@extends(Config::theme() . 'layout.auth')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="sp_site_card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h3><i class="fa fa-info-circle" aria-hidden="true" style="color:#28a745">
                        </i> New Live MT5 Account Details</h3>

                </div>
                <div class="card-body">
                    <div class="panel-body">
                        <table class="table row-border datatable" style="margin-top:20px;padding:50px">
                            <thead>
                                <tr>
                                    <td style="border-top: 1px !important;padding:7px"><strong>Account No.
                                            :</strong></td>
                                    <td style="border-top: 1px !important;">{{ $acc_created->login }}</td>
                                </tr>
                                <tr>
                                    <td style="border-top: 1px solid #014d65 !important;padding:7px"><strong>Account Type
                                            :</strong></td>
                                    <td style="border-top: 1px solid #014d65 !important;padding:7px">
                                        &nbsp;&nbsp;&nbsp;&nbsp; <span class="tdStyle">
                                            @if ($acc_created->account_type == 1)
                                                Standard
                                            @elseif($acc_created->account_type == 2)
                                                Premium
                                            @elseif($acc_created->account_type == 3)
                                                VIP
                                            @else
                                                Demo
                                            @endif
                                        </span></td>
                                </tr>

                                <tr>
                                    <td style="border-top: 1px solid #014d65 !important;padding:7px"><strong>Master's
                                            Password :</strong></td>
                                    <td style="border-top: 1px solid #014d65 !important;padding:7px">
                                        &nbsp;&nbsp;&nbsp;&nbsp;{{ $acc_created->master_pass }}</td>
                                </tr>
                                <tr>
                                    <td style="border-top: 1px solid #014d65 !important;padding:7px"><strong>Investor's
                                            Password :</strong></td>
                                    <td style="border-top: 1px solid #014d65 !important;padding:7px">
                                        &nbsp;&nbsp;&nbsp;&nbsp;{{ $acc_created->investor_pass }}</td>
                                </tr>


                            </thead>
                        </table>
                    </div>
                    <div class="return-link1">
                        <br>
                        <a href="/dashboard"><button class="btn sp_theme_btn btn-md text-uppercase" type="button"
                                style="">GO
                                BACK <i class="fas fa-arrow-circle-o-left  " style="color:white;font-size:17px"
                                    ;aria-hidden="true"></i></button></a>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('external-css')
    <link rel="stylesheet" href="{{ Config::cssLib('frontend', 'lib/apex.min.css') }}">
@endpush
