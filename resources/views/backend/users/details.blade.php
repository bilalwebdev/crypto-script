@extends('backend.layout.master')

@section('element')

    <div class="row gy-4">
        <div class="col-lg-9">
            <div class="p-4 bg-white rounded-lg">
                <h5>{{ $user->username }}</h5>
                <p>{{ $user->email }}</p>
                <div class="row pb-1">
                    <div class="col-xxl-2 col-md-4 col-sm-6 mb-xxl-0 mb-4">
                        <div class="sp-user-box">
                            <div class="sp-user-box_icon gr-bg-1">
                                <i class="las la-hand-holding-usd"></i>
                            </div>
                            <div class="sp-user-box_content">
                                <h4 class="mb-1"> {{ $user->currentplan->first() ?  $user->currentplan->first()->plan->name : 'N/A'}}</h4>
                                <p>{{ __('Current Plan') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6 mb-xxl-0 mb-4">
                        <div class="sp-user-box">
                            <div class="sp-user-box_icon gr-bg-2">
                                <i class="las la-users"></i>
                            </div>
                            <div class="sp-user-box_content">
                                <h4 class="mb-1">{{ $totalRef }}</h4>
                                <p>{{ __('Total Refferal') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6 mb-xxl-0 mb-4">
                        <div class="sp-user-box">
                            <div class="sp-user-box_icon gr-bg-3">
                                <i class="las la-dollar-sign"></i>
                            </div>
                            <div class="sp-user-box_content">
                                <h4 class="mb-1"> {{ Config::formatter($userCommission)}}</h4>
                                <p>{{ __('Total Commission') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6 mb-sm-0 mb-4">
                        <div class="sp-user-box">
                            <div class="sp-user-box_icon gr-bg-4">
                                <i class="las la-hand-holding-usd"></i>
                            </div>
                            <div class="sp-user-box_content">
                                <h4 class="mb-1"> {{ Config::formatter($withdrawTotal)}}</h4>
                                <p>{{ __('Total Withdraw') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6 mb-sm-0 mb-4">
                        <div class="sp-user-box">
                            <div class="sp-user-box_icon gr-bg-5">
                                <i class="las la-credit-card"></i>
                            </div>
                            <div class="sp-user-box_content">
                                <h4 class="mb-1"> {{ Config::formatter($totalDeposit)}}</h4>
                                <p>{{ __('Total Deposit') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6">
                        <div class="sp-user-box">
                            <div class="sp-user-box_icon gr-bg-6">
                                <i class="las la-credit-card"></i>
                            </div>
                            <div class="sp-user-box_content">
                                <h4 class="mb-1"> {{ Config::formatter($totalInvest)}}</h4>
                                <p>{{ __('Total Invest amount') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 mt-4 bg-white rounded-lg">
                <h4 class="mb-3">{{ __('User Profile Settings') }}</h4>
                <form action="{{ route('admin.user.update', $user->id) }}" method="post">
                    @csrf
                    <div class="row">

                        <div class="form-group col-sm-6 mb-3 ">
                            <label>{{ __('Phone') }}</label>
                            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                        </div>
                        <div class="form-group col-sm-6 mb-3 ">
                            <label>{{ __('Country') }}</label>
                            <input type="text" name="country" class="form-control"
                                value="{{ optional($user->address)->country }}">
                        </div>

                        <div class="col-sm-6 mb-3">

                            <label>{{ __('city') }}</label>
                            <input type="text" name="city" class="form-control form_control"
                                value="{{ optional($user->address)->city }}">
                        </div>

                        <div class="col-sm-6 mb-3">

                            <label>{{ __('zip') }}</label>
                            <input type="text" name="zip" class="form-control form_control"
                                value="{{ optional($user->address)->zip }}">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>{{ __('state') }}</label>
                            <input type="text" name="state" class="form-control form_control"
                                value="{{ optional($user->address)->state }}">
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="row">
                                <div class="col-xl-3 col-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" {{ $user->is_email_verified ? 'checked' : '' }} name="email_status"
                                            class="custom-control-input" id="useCheck1">
                                        <label class="custom-control-label"
                                            for="useCheck1">{{ __('Email Verified') }}</label>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="sms_status" {{ $user->is_sms_verified ? 'checked' : '' }}
                                            class="custom-control-input" id="useCheck2">
                                        <label class="custom-control-label"
                                            for="useCheck2">{{ __('SMS Verified') }}</label>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="kyc_status" {{ $user->is_kyc_verified ? 'checked' : '' }}
                                            class="custom-control-input" id="useCheck3">
                                        <label class="custom-control-label"
                                            for="useCheck3">{{ __('KYC Verified') }}</label>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="status" {{ $user->status ? 'checked' : '' }}
                                            class="custom-control-input" id="useCheck4">
                                        <label class="custom-control-label"
                                            for="useCheck4">{{ __('Status') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xxl-3 col-xl-4 mt-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-sync-alt"></i>
                                {{ 'Update User' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="p-4 bg-white rounded-lg">
                <div class="sp-widget-user-thumb">
                    <img src="{{ Config::getFile('user', $user->image,true) }}">
                </div>
                <div class="text-center mt-3">
                    <div>{{ __('Total Balance') }}</div>
                    <h2 class="mb-0 mt-1 sp_d_user_balance"> {{ Config::formatter($user->balance)}}</h2>
                </div>

                <div class="sp_balance_btns mt-4">
                    <button type="button" id="addBtn" class="btn btn-sm py-2 btn-success">{{ __('Add Balance') }}</button>
                    <button type="button" id="subBtn" class="btn btn-sm py-2 btn-danger">{{ __('Subtract Balance') }}</button>
                </div>

                <form action="{{ route('admin.user.balance.update', $user->id) }}" method="post" id="addBalance" class="mt-3">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" class="form-control" name="type" value="add">
                        <input type="number" class="form-control" name="balance" min="1"
                            placeholder="add balance">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </form>
                <form action="{{ route('admin.user.balance.update', $user->id) }}" method="post" id="subBalance" class="mt-3">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" class="form-control" name="type" value="minus">
                        <input type="number" class="form-control" name="balance" min="1"
                            placeholder="Subtract Balance">
                        <button class="btn btn-danger" type="submit">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="mt-4 p-4 bg-white rounded-lg">
                <h4 class="mb-3">{{ __('Quick Links') }}</h4>
                <ul class="user-action-list pb-2">
                    <li>
                        <a href="#" class="user-action-btn sendMail">
                            <i class="fas fa-envelope mr-2"></i>
                            {{ __('Send Email') }} 
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.user.login', $user->id) }}" target="_blank"
                        class="user-action-btn">
                            <i class="fas fa-user-alt mr-2"></i>
                            {{ __('Login As User') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.commision', $user) }}" class="user-action-btn">
                            <i class="fas fa-percentage mr-2"></i>
                            {{ __('Commission Log') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.deposit.log', $user) }}" class="user-action-btn">
                            <i class="fas fa-file-alt mr-2"></i>
                            {{ __('Deposit Log') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.payment.report', $user) }}" class="user-action-btn">
                            <i class="fas fa-file-invoice-dollar mr-2"></i>
                            {{ __('Payment Log') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.withdraw.report', $user) }}" class="user-action-btn">
                            <i class="fas fa-file-alt mr-2"></i>
                            {{ __('Withdraw Log') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.ticket.index', ['user' => $user->id]) }}"
                        class="user-action-btn">
                            <i class="fas fa-life-ring mr-2"></i>
                            {{ __('User Ticket') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.transaction', $user) }}" class="user-action-btn">
                            <i class="fas fa-exchange-alt mr-2"></i>
                            {{ __('User Transactions') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @php
        $reference = $user
            ->refferals()
            ->with('refferals')
            ->get();
    @endphp

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">{{ __('Reference Tree') }}</h5>
                </div>
                <div class="card-body">
                    @if ($reference->count() > 0)
                        <ul class="sp-referral">
                            <li class="single-child root-child">
                                <p>
                                    <img src="{{ Config::getFile('user', $user->image, true) }}">
                                    <span class="mb-0">{{ $user->username }}</span>
                                </p>
                                <ul class="sub-child-list step-2">
                                    @foreach ($reference as $us)
                                        <li class="single-child">
                                            <p>
                                                <img src="{{ Config::getFile('user', $user->image, true) }}">
                                                <span class="mb-0">{{ $us->username }}</span>
                                            </p>

                                            <ul class="sub-child-list step-3">
                                                @foreach ($us->refferals()->with('refferals')->get() as $ref)
                                                    <li class="single-child">
                                                        <p>
                                                            <img src="{{ Config::getFile('user', $ref->image, true) }}">
                                                            <span class="mb-0">{{ $ref->username }}</span>
                                                        </p>

                                                        <ul class="sub-child-list step-4">
                                                            @foreach ($ref->refferals as $ref2)
                                                                <li class="single-child">
                                                                    <p>
                                                                        <img src="{{ Config::getFile('user', $ref2->image) }}">
                                                                        <span class="mb-0">{{ $ref2->username }}</span>
                                                                    </p>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    @else
                        <div class="col-md-12 text-center mt-5">
                            <i class="las la-envelope-open display-1"></i>
                            <p class="mt-2">
                                {{ __('No Reference User Found') }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    

    <div class="modal fade" tabindex="-1" role="dialog" id="mail">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('admin.user.mail', $user->id) }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Send Mail to user') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">{{ __('Subject') }}</label>
                            <input type="text" name="subject" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('Message') }}</label>
                            <textarea name="message" id="" cols="30" rows="10" class="form-control summernote"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-dark"
                            data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary"><i class="las la-envelope"></i>
                            {{ __('Send Mail') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="confirmation" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Confirmation') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" class="form-control" name="type" value="">
                        <input type="hidden" class="form-control" name="balance" value="">
                        <p>{{ __('Are you sure to perform this action') }} ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Close') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('external-style')
    <link rel="stylesheet" href="{{ Config::cssLib('backend', 'toogle.min.css') }}">
@endpush

@push('external-script')
    <script src="{{ Config::jsLib('backend', 'toogle.min.js') }}"></script>
@endpush

@push('style')
    <style>
        .sp-referral {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .sp-referral .single-child {
            padding: 6px 10px;
            border-radius: 5px;
        }

        .sp-referral .single-child+.single-child {
            margin-top: 15px;
        }

        .sp-referral .single-child p {
            display: flex;
            align-items: center;
            margin-bottom: 0;
        }

        .sp-referral .single-child p img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            -o-object-fit: cover;
            border: 2px solid #e5e5e5;
        }

        .sp-referral .single-child p span {
            width: calc(100% - 35px);
            font-size: 14px;
            padding-left: 10px;
        }

        .sub-child-list {
            position: relative;
            padding-left: 35px;
            list-style: none;
            margin-bottom: 0
        }

        .sub-child-list::before {
            position: absolute;
            content: '';
            top: 0;
            left: 17px;
            width: 1px;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.2);
        }

        .sp-referral>.single-child.root-child>p img {
            border: 2px solid #5463ff;
        }

        .sub-child-list>.single-child {
            position: relative;
        }

        .sub-child-list>.single-child::before {
            position: absolute;
            content: '';
            left: -18px;
            top: 21px;
            width: 30px;
            height: 5px;
            border-left: 1px solid rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 0 0 0 5px;
        }

        .sub-child-list.step-2>.single-child>p img {
            border: 2px solid #0aa27c;
        }

        .sub-child-list.step-3>.single-child>p img {
            border: 2px solid #a20a0a;
        }

        .sub-child-list.step-4>.single-child>p img {
            border: 2px solid #f562e6;
        }

        .sub-child-list.step-5>.single-child>p img {
            border: 2px solid #a20a0a;
        }

        #user_action_slider {
            display: none;
        }
    </style>
@endpush


@push('script')
    <script>
        
        
        $(function() {
            'use strict'

            let addBalance = $("#addBalance");
            let subBalance = $("#subBalance");

            addBalance.addClass('d-none');
            subBalance.addClass('d-none');

            $("#addBtn").on('click', function(){
                addBalance.toggleClass('d-none');
                if(subBalance.hasClass('d-none')) {
                    return true;
                } else {
                    subBalance.addClass('d-none');
                }
            });

            $("#subBtn").on('click', function(){
                subBalance.toggleClass('d-none');
                if(addBalance.hasClass('d-none')) {
                    return true;
                } else {
                    addBalance.addClass('d-none');
                }
            });
            
            $('#addBalance').on('submit', function(e) {
                e.preventDefault();

                let formData = $(this).serializeArray();

                const modal = $('#confirmation');

                modal.find('input[name=type]').val(formData[2].value)
                modal.find('input[name=balance]').val(formData[3].value)

                modal.find('form').attr('action', $(this).attr('action'))

                modal.modal('show')
            })


            $('#subBalance').on('submit', function(e) {
                e.preventDefault();

                let formData = $(this).serializeArray();

                const modal = $('#confirmation');

                modal.find('input[name=type]').val(formData[2].value)
                modal.find('input[name=balance]').val(formData[3].value)

                modal.find('form').attr('action', $(this).attr('action'))

                modal.modal('show')

            })

            $('.sendMail').on('click', function(e) {
                e.preventDefault();

                const modal = $('#mail');

                modal.modal('show');
            })
        })
    </script>
@endpush
