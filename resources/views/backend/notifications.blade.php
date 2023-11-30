@extends('backend.layout.master')

@section('element')
    <div class="row">
        <div class="col-md-12">


            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs page-link-list border-0" role="tablist">
                        <li>
                            <a class="{{ request()->query('notifications') || request()->query->count() == 0 ? 'active' : '' }}"
                                data-toggle="tab" href="#general">
                                <span class="text-uppercase">
                                    <i class="las la-home"></i>
                                    {{ __('All Notifications') }}
                                </span>
                            </a>
                        </li>

                        <li>
                            <a class="{{ request()->query('depositNotifications') ? 'active' : '' }}" data-toggle="tab"
                                href="#deposit">
                                <span class="text-uppercase">
                                    <i class="las la-home"></i>
                                    {{ __('Deposit Notifications') }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="{{ request()->query('subscriptionNotifications') ? 'active' : '' }}" data-toggle="tab"
                                href="#subscription">
                                <span class="text-uppercase">
                                    <i class="las la-cog"></i>
                                    {{ __('Subscription Notification') }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="{{ request()->query('withdrawNotifications') ? 'active' : '' }}" data-toggle="tab"
                                href="#withdraw">
                                <span class="text-uppercase">
                                    <i class="las la-cog"></i>
                                    {{ __('Withdraw Notifications') }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="{{ request()->query('supportNotifications') ? 'active' : '' }}" data-toggle="tab"
                                href="#support">
                                <span class="text-uppercase">
                                    <i class="las la-cookie-bite"></i>
                                    {{ __('Support Notifications') }}
                                </span>
                            </a>
                        </li>


                        <li>
                            <a class="{{ request()->query('kycNotifications') ? 'active' : '' }}" data-toggle="tab"
                                href="#kyc">
                                <span class="text-uppercase">
                                    <i class="las la-cookie-bite"></i>
                                    {{ __('KYC Notifications') }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="tab-content tabcontent-border">
                <div class="tab-pane fade {{ request()->query('notifications') || request()->query->count() == 0 ? 'show active' : '' }}"
                    id="general" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="pt-4">
                                <div class="notification-ui_dd-content">

                                    @foreach ($notifications as $notification)
                                        <div class="notification-list {{ $notification->read_at == null ? 'notification-list--unread' : 'notification-list--read' }}"
                                            id="remove-{{ $notification->id }}">
                                            <div class="notification-list_content">
                                                <div class="notification-list_detail">
                                                    <p class="text-muted">{{ $notification->data['message'] }}</p>
                                                    <p class="text-primary">
                                                        <i class="las la-clock"></i>
                                                        <small>{{ $notification->created_at->diffforhumans() }}</small>
                                                    </p>
                                                </div>
                                            </div>
                                            <label class="toggle">
                                                <input type="checkbox"
                                                    data-url="{{ route('admin.markNotification.single', $notification->id) }}"
                                                    class="check" {{ $notification->read_at != null ? 'checked' : '' }}
                                                    data-id="#remove-{{ $notification->id }}">
                                                <span></span>
                                            </label>
                                        </div>
                                    @endforeach

                                    @if ($notifications->hasPages())
                                        <div class="card">
                                            <div class="card-footer">
                                                {{ $notifications->links() }}
                                            </div>
                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane {{ request()->query('depositNotifications') ? 'show active' : '' }}" id="deposit"
                    role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="pt-4">
                                <div class="notification-ui_dd-content">

                                    @foreach ($depositNotifications as $notification)
                                        <div class="notification-list {{ $notification->read_at == null ? 'notification-list--unread' : 'notification-list--read' }}"
                                            id="remove-{{ $notification->id }}">
                                            <div class="notification-list_content">
                                                <div class="notification-list_detail">
                                                    <p class="text-muted">{{ $notification->data['message'] }}</p>
                                                    <p class="text-primary">
                                                        <i class="las la-clock"></i>
                                                        <small>{{ $notification->created_at->diffforhumans() }}</small>
                                                    </p>
                                                </div>
                                            </div>
                                            <label class="toggle">
                                                <input type="checkbox"
                                                    data-url="{{ route('admin.markNotification.single', $notification->id) }}"
                                                    class="check" {{ $notification->read_at != null ? 'checked' : '' }}
                                                    data-id="#remove-{{ $notification->id }}">
                                                <span></span>
                                            </label>
                                        </div>
                                    @endforeach

                                    @if ($depositNotifications->hasPages())
                                        <div class="card">
                                            <div class="card-footer">
                                                {{ $depositNotifications->links() }}
                                            </div>
                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade {{ request()->query('subscriptionNotifications') ? 'show active' : '' }}"
                    id="subscription" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="pt-4">
                                <div class="notification-ui_dd-content">

                                    @foreach ($subscriptionNotifications as $notification)
                                        <div class="notification-list {{ $notification->read_at == null ? 'notification-list--unread' : 'notification-list--read' }}"
                                            id="remove-{{ $notification->id }}">
                                            <div class="notification-list_content">
                                                <div class="notification-list_detail">
                                                    <p class="text-muted">{{ $notification->data['message'] }}</p>
                                                    <p class="text-primary">
                                                        <i class="las la-clock"></i>
                                                        <small>{{ $notification->created_at->diffforhumans() }}</small>
                                                    </p>
                                                </div>
                                            </div>
                                            <label class="toggle">
                                                <input type="checkbox"
                                                    data-url="{{ route('admin.markNotification.single', $notification->id) }}"
                                                    class="check" {{ $notification->read_at != null ? 'checked' : '' }}
                                                    data-id="#remove-{{ $notification->id }}">
                                                <span></span>
                                            </label>
                                        </div>
                                    @endforeach

                                    @if ($subscriptionNotifications->hasPages())
                                        <div class="card">
                                            <div class="card-footer">
                                                {{ $subscriptionNotifications->links() }}
                                            </div>
                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade {{ request()->query('withdrawNotifications') ? 'show active' : '' }}"
                    id="withdraw" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="pt-4">
                                <div class="notification-ui_dd-content">

                                    @foreach ($withdrawNotifications as $notification)
                                        <div class="notification-list {{ $notification->read_at == null ? 'notification-list--unread' : 'notification-list--read' }}"
                                            id="remove-{{ $notification->id }}">
                                            <div class="notification-list_content">
                                                <div class="notification-list_detail">
                                                    <p class="text-muted">{{ $notification->data['message'] }}</p>
                                                    <p class="text-primary">
                                                        <i class="las la-clock"></i>
                                                        <small>{{ $notification->created_at->diffforhumans() }}</small>
                                                    </p>
                                                </div>
                                            </div>
                                            <label class="toggle">
                                                <input type="checkbox"
                                                    data-url="{{ route('admin.markNotification.single', $notification->id) }}"
                                                    class="check" {{ $notification->read_at != null ? 'checked' : '' }}
                                                    data-id="#remove-{{ $notification->id }}">
                                                <span></span>
                                            </label>
                                        </div>
                                    @endforeach

                                    @if ($withdrawNotifications->hasPages())
                                        <div class="card">
                                            <div class="card-footer">
                                                {{ $withdrawNotifications->links() }}
                                            </div>
                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade {{ request()->query('supportNotifications') ? 'show active' : '' }}"
                    id="support" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="pt-4">
                                <div class="notification-ui_dd-content">

                                    @foreach ($ticketNotifications as $notification)
                                        <div class="notification-list {{ $notification->read_at == null ? 'notification-list--unread' : 'notification-list--read' }}"
                                            id="remove-{{ $notification->id }}">
                                            <div class="notification-list_content">
                                                <div class="notification-list_detail">
                                                    <p class="text-muted">{{ $notification->data['message'] }}</p>
                                                    <p class="text-primary">
                                                        <i class="las la-clock"></i>
                                                        <small>{{ $notification->created_at->diffforhumans() }}</small>
                                                    </p>
                                                </div>
                                            </div>
                                            <label class="toggle">
                                                <input type="checkbox"
                                                    data-url="{{ route('admin.markNotification.single', $notification->id) }}"
                                                    class="check" {{ $notification->read_at != null ? 'checked' : '' }}
                                                    data-id="#remove-{{ $notification->id }}">
                                                <span></span>
                                            </label>
                                        </div>
                                    @endforeach

                                    @if ($ticketNotifications->hasPages())
                                        <div class="card">
                                            <div class="card-footer">
                                                {{ $ticketNotifications->links() }}
                                            </div>
                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade {{ request()->query('kycNotifications') ? 'show active' : '' }}" id="kyc"
                    role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="pt-4">
                                <div class="notification-ui_dd-content">

                                    @foreach ($kycNotifications as $notification)
                                        <div class="notification-list {{ $notification->read_at == null ? 'notification-list--unread' : 'notification-list--read' }}"
                                            id="remove-{{ $notification->id }}">
                                            <div class="notification-list_content">
                                                <div class="notification-list_detail">
                                                    <p class="text-muted">{{ $notification->data['message'] }}</p>
                                                    <p class="text-primary">
                                                        <i class="las la-clock"></i>
                                                        <small>{{ $notification->created_at->diffforhumans() }}</small>
                                                    </p>
                                                </div>
                                            </div>
                                            <label class="toggle">
                                                <input type="checkbox"
                                                    data-url="{{ route('admin.markNotification.single', $notification->id) }}"
                                                    class="check" {{ $notification->read_at != null ? 'checked' : '' }}
                                                    data-id="#remove-{{ $notification->id }}">
                                                <span></span>
                                            </label>
                                        </div>
                                    @endforeach

                                    @if ($kycNotifications->hasPages())
                                        <div class="card">
                                            <div class="card-footer">
                                                {{ $kycNotifications->links() }}
                                            </div>
                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <style>
        .toggle span {
            display: block;
            width: 40px;
            height: 24px;
            border-radius: 99em;
            background-color: #e9ecf4;
            box-shadow: inset 1px 1px 1px 0 rgba(0, 0, 0, 0.05);
            position: relative;
            transition: 0.15s ease;
        }

        .toggle span:before {
            content: "";
            display: block;
            position: absolute;
            left: 3px;
            top: 3px;
            height: 18px;
            width: 18px;
            background-color: #ffffff;
            border-radius: 50%;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.15);
            transition: 0.15s ease;
        }

        .toggle input {
            clip: rect(0 0 0 0);
            -webkit-clip-path: inset(50%);
            clip-path: inset(50%);
            height: 1px;
            overflow: hidden;
            position: absolute;
            white-space: nowrap;
            width: 1px;
        }

        .toggle input:checked+span {
            background-color: #434ce8;
        }

        .toggle input:checked+span:before {
            transform: translateX(calc(100% - 2px));
        }

        .toggle input:focus+span {
            box-shadow: 0 0 0 4px #ecf3fe;
        }



        .notification-ui_dd-content {
            margin-bottom: 30px;
        }

        .notification-list {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            margin-bottom: 7px;
            background: #fff;
            -webkit-box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
        }

        .notification-list--unread {
            border-left: 2px solid #ea8c08;
        }

        .notification-list--read {
            border-left: 2px solid #03ae30;
        }

        .notification-list .notification-list_content {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        .notification-list .notification-list_content .notification-list_img img {
            height: 48px;
            width: 48px;
            border-radius: 50px;
            margin-right: 20px;
        }

        .notification-list .notification-list_content .notification-list_detail p {
            margin-bottom: 5px;
            line-height: 1.2;
        }

        .notification-list .notification-list_feature-img img {
            height: 48px;
            width: 48px;
            border-radius: 5px;
            margin-left: 20px;
        }
    </style>
@endpush

@push('script')
    <script>
        $(function() {
            'use strict'

            $('.check').on('change', function() {
                $.ajax({
                    url: $(this).data('url'),
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": $(this).data('id')
                    },
                    success: function(response) {
                        if (response.success) {

                            $(response.id).fadeOut(300, function() {
                                $(this).remove();
                            });

                            @if (Config::config()->alert === 'izi')
                                iziToast.success({
                                    position: 'topRight',
                                    message: "Notification Mark As Read",
                                });
                            @elseif (Config::config()->alert === 'toast')
                                toastr.success("Notification Mark As Read", {
                                    positionClass: "toast-top-right"

                                })
                            @else
                                Swal.fire({
                                    icon: 'success',
                                    title: "Notification Mark As Read"
                                })
                            @endif

                            return
                        }


                        @if (Config::config()->alert === 'izi')
                            iziToast.error({
                                position: 'topRight',
                                message: "Something went wrong",
                            });
                        @elseif (Config::config()->alert === 'toast')
                            toastr.error("Something went wrong", {
                                positionClass: "toast-top-right"

                            })
                        @else
                            Swal.fire({
                                icon: 'error',
                                title: "Something went wrong"
                            })
                        @endif
                    }
                })
            })
        })
    </script>
@endpush
