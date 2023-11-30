@extends('backend.layout.master')

@section('element')
    <div class="content-main pt-0">
        <div class="row">
            @foreach ($gateways as $gateway)
            <div class="col-xxl-3 col-lg-4 col-md-6 mb-4">
                <article class="card payment-card mb-0 h-100">
                    <div class="card-header align-items-center">
                        <div>
                            <span><img src="{{ Config::getFile('gateways', $gateway->image, true) }}" /></span>

                        </div>
                        <label class="toggle mb-0">
                            <input type="checkbox" {{ $gateway->status ? 'checked' : '' }}
                                data-url="{{ route('admin.payment.status', $gateway->id) }}" class="check">
                            <span></span>
                        </label>
                    </div>

                    <div class="card-body pb-0 d-flex flex-wrap justify-content-between w-50-percent">
                        <p><span class="fw-600">{{ __('Currency :') }}</span>
                            <span>{{ optional($gateway->parameter)->gateway_currency }}</span>
                        </p>
                        <p><span class="fw-600">{{ __('Rate :') }}</span> <span>{{ Config::formatter($gateway->rate) }}</span></p>
                        <p><span class="fw-600">{{ __('Charge :') }}</span> <span>{{ Config::formatter($gateway->charge) }}</span>
                        </p>
                        <p><span class="fw-600">{{ __('Type :') }}</span> <span>
                                @if ($gateway->type)
                                    {{ __('Online') }}
                                @else
                                    {{ __('Offline') }}
                                @endif
                            </span></p>
                    </div>

                    <div class="card-footer justify-content-between align-items-center">
                        @if ($gateway->type)
                            <h5 class="text-dark fw-600">
                                {{ Str::ucfirst(str_replace('_', ' ', $gateway->name)) }}</h5>
                            <a href="{{ route('admin.payment.gateway', $gateway->name) }}"
                                class="d-flex align-items-center"><i class="las la-eye fs-25 mr-2"></i>
                                {{ __('View integration') }}</a>
                        @else
                            <h5 class="text-dark fw-600">
                                {{ Str::ucfirst(str_replace('_', ' ', $gateway->name)) }}</h5>
                            <a href="{{ route('admin.payment.offline.edit', $gateway->id) }}"
                                class="d-flex align-items-center"><i class="las la-eye fs-25 mr-2"></i>
                                {{ __('View integration') }}</a>
                        @endif
                    </div>
                </article>
            </div>
            @endforeach

            @if (request()->routeIs('admin.payment.offline'))
            <div class="col-xxl-3 col-lg-4 col-md-6 mb-4">
                <article class="card payment-card mb-0 h-100">
                    <div class="card-header">
                        <div>
                            <h4 class="text-dark">{{ __('Create Offline Gateway') }}</h4>
                        </div>

                    </div>
                    <div class="card-body d-flex flex-wrap justify-content-center align-items-center text-center">
                        <a href="{{ route('admin.payment.offline.create') }}">
                            <i class="las la-plus-circle fs-50 text-muted mb-3"></i>
                            <br>
                            {{ __('Create Offline Gateway') }}
                        </a>
                    </div>
                </article>
            </div>
            @else
            @endif

        </div>
    </div>
@endsection

@push('style')
    <style>
        .content-main {
            --c-text-primary: #282a32;
            --c-text-secondary: #686b87;
            --c-text-action: #404089;
            --c-accent-primary: #434ce8;
            --c-border-primary: #eff1f6;
            --c-background-primary: #ffffff;
            --c-background-secondary: #fdfcff;
            --c-background-tertiary: #ecf3fe;
            --c-background-quaternary: #e9ecf4;
        }

        .content-main {
            padding-top: 2rem;
            padding-bottom: 6rem;
            flex-grow: 1;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            -moz-column-gap: 1.5rem;
            column-gap: 1.5rem;
            row-gap: 1rem;
        }

        @media (min-width: 600px) {
            .card-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1200px) {
            .card-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        .card {
            background-color: var(--c-background-primary);
            box-shadow: 0 3px 3px 0 rgba(0, 0, 0, 0.05), 0 5px 15px 0 rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            margin-bottom: .5rem;
        }

        .card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .card-header div {
            display: flex;
            align-items: center;
        }

        .card-header div span {
            height: 40px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .card-header div span img {
            max-height: 100%;
        }

        .card-header div h4 {
            margin-left: 0.75rem;
            font-weight: 500;
        }

        .toggle span {
            display: block;
            width: 40px;
            height: 24px;
            border-radius: 99em;
            background-color: var(--c-background-quaternary);
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
            background-color: var(--c-background-primary);
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
            background-color: var(--c-accent-primary);
        }

        .toggle input:checked+span:before {
            transform: translateX(calc(100% - 2px));
        }

        .toggle input:focus+span {
            box-shadow: 0 0 0 4px var(--c-background-tertiary);
        }

        .card-body {
            padding: 1rem 1.25rem;
            font-size: 0.875rem;
        }

        .card-footer {
            margin-top: auto;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            border-top: 1px solid var(--c-border-primary);
        }

        .card-footer a {
            color: var(--c-text-action);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
        }

        @media (max-width: 1399px) {
            .payment-card h5 {
                font-size: 14px;
            }

            .payment-card a {
                font-size: 13px;
            }
        }
        
        .w-50-percent p{
            width: 50%;
        }
        .w-50-percent p:nth-child(2),
        .w-50-percent p:nth-child(4){
            text-align: right;
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
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {

                            @if (Config::config()->alert === 'izi')
                                iziToast.success({
                                    position: 'topRight',
                                    message: "Gateway Status changed Successfully",
                                });
                            @elseif (Config::config()->alert === 'toast')
                                toastr.success("Gateway Status changed Successfully", {
                                    positionClass: "toast-top-right"

                                })
                            @else
                                Swal.fire({
                                    icon: 'success',
                                    title: "Gateway Status changed Successfully"
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
