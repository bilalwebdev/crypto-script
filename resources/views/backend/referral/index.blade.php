@extends('backend.layout.master')

@section('element')
    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header justify-content-between no-gutters">
                    <h5 class="col-md-8">{{ __('Payment Commission') }}</h5>
                    <div class="col-md-4">
                        <div class="custom-control custom-switch text-lg-right">
                            <input data-status="{{ optional($invest_referral)->status }}"
                                data-url="{{ route('admin.refferal.refferalstatus', optional($invest_referral)->id) }}"
                                type="checkbox" name="status" {{ optional($invest_referral)->status ? 'checked' : '' }}
                                class="custom-control-input" id="investstatus">
                            <label class="custom-control-label" for="investstatus">{{ __('Active / Deactive') }}</label>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="text-right">
                        <button type="button" class="btn btn-sm btn-primary append_invest">
                            <i class="fas fa-plus"></i>
                            {{ __('Add New Level') }}
                        </button>
                    </div>

                    @php
                        $payment = count($invest_referral->level) + 1;
                        $referral = count($interest_referral->level) + 1;
                    @endphp

                    <div class="append_table">
                        <form method="POST" action="{{ route('admin.refferal.invest') }}">
                            @csrf
                            <input type="text" name="type" value="invest" hidden>

                            <div class="row mt-4" id="append_invest">
                                @if ($invest_referral)
                                    @foreach ($invest_referral->level as $key => $level)
                                        <div class="col-auto">
                                            <div class="sp_referral_box mb-4">
                                                <input class="referral-level-btn" type="text" name=level[]
                                                    value="{{ $level }}" readonly>



                                                <div class="input-group">

                                                    <input type="number" required class="form-control" name=commision[]
                                                        placeholder="Commision %"
                                                        value="{{ $invest_referral->commission[$key] }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">%</span>
                                                    </div>
                                                </div>



                                                <button class="sp_referral_del_btn delete_invest" type="button"><i
                                                        class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>


                            <button class="btn btn-primary w-100 create-invest" type="submit">
                                <i class="fas fa-sync-alt mr-2"></i>
                                {{ __('Update Payment Refferal') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header no-gutters justify-content-between">
                    <h5 class="col-md-8">{{ __('Referral Commission') }}</h5>
                    <div class="col-md-4">
                        <div class="custom-control custom-switch text-lg-right">
                            <input data-status="{{ optional($interest_referral)->status }}"
                                data-url="{{ route('admin.refferal.refferalstatus', optional($interest_referral)->id) }}"
                                type="checkbox" name="status" {{ optional($interest_referral)->status ? 'checked' : '' }}
                                class="custom-control-input" id="intereststatus">
                            <label class="custom-control-label" for="intereststatus">{{ __('Active / Deactive') }}</label>
                        </div>
                    </div>
                </div>

                <div class="card-body">


                    <div class="text-right">
                        <button type="button" class="btn btn-sm btn-primary" id="referral_com">
                            <i class="fas fa-plus"></i>
                            {{ __('Add New Level') }}
                        </button>
                    </div>

                    <div class="append_table">

                        <form method="POST" action="{{ route('admin.refferal.invest') }}">
                            @csrf

                            <div class="row mt-4" id="append_interest">
                                @if ($interest_referral)
                                    @foreach ($interest_referral->level as $key => $level)
                                        <div class="col-auto">
                                            <div class="sp_referral_box mb-4">
                                                <input class="referral-level-btn" type="text" name=level[]
                                                    value="{{ $level }}" readonly>

                                                <div class="input-group">

                                                    <input type="number" required class="form-control" name=commision[]
                                                    placeholder="Commision %"
                                                    value="{{ $interest_referral->commission[$key] }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">
                                                            {{__('Fixed')}}
                                                        </span>
                                                    </div>
                                                </div>


                                              

                                                <button class="sp_referral_del_btn delete_interest" type="button"><i
                                                        class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>



                            <input type="text" name="type" value="interest" hidden>

                            <button class="btn btn-primary w-100 create-interest" type="submit"><i
                                    class="fas fa-sync-alt mr-2"></i> {{ __('Update Refferal Commission') }}</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        'use strict';

        $(document).ready(function() {

            let level = "{{ $payment }}";

            $('.append_invest').on('click', function() {

                let viewHtml = `
                                
                    <div class="col-auto removeItem">
                        <div class="sp_referral_box mb-4">
                            <input class="referral-level-btn" type="text" name=level[] value="level ${level}" readonly>

                            <input type="number" required class="form-control" name=commision[] placeholder="Commision %" value="">

                            <button class="sp_referral_del_btn delete_invest" type="button"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                `

                $('#append_invest').append(viewHtml).slideDown('slow');

                level++;

            });

            $(document).on('click', '.delete_invest', function() {

                $(this).parent().parent().remove()

            });

            let referral_level = "{{ $referral }}";

            $('#referral_com').on('click', function() {

                let viewHtml = `
                                
                    <div class="col-auto removeItem">
                        <div class="sp_referral_box mb-4">
                            <input class="referral-level-btn" type="text" name=level[] value="level ${referral_level}" readonly>

                            <input type="number" required class="form-control" name=commision[] placeholder="Commision %" value="">

                            <button class="sp_referral_del_btn delete_interest" type="button"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                `

                $('#append_interest').append(viewHtml).slideDown('slow');

                referral_level++;

            });



            $(document).on('click', '.delete_interest', function() {
                $(this).parent().parent().remove();
            });
        });

        $(function() {

            $('#investstatus').on('change', function() {
                let status = $(this).data('status');
                let url = $(this).data('url');

                $.ajax({

                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },

                    url: url,

                    data: {
                        status: status
                    },

                    method: "POST",

                    success: function(response) {
                        if (response.success) {

                            @if (Config::config()->alert === 'izi')
                                iziToast.success({
                                    position: 'topRight',
                                    message: "Refferal changed Successfully",
                                });
                            @elseif (Config::config()->alert === 'toast')
                                toastr.success("Refferal changed Successfully", {
                                    positionClass: "toast-top-right"

                                })
                            @else
                                Swal.fire({
                                    icon: 'success',
                                    title: "Refferal changed Successfully"
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

        $(function() {

            $('#intereststatus').on('change', function() {
                let status = $(this).data('status');
                let url = $(this).data('url');

                $.ajax({

                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },

                    url: url,

                    data: {
                        status: status
                    },

                    method: "POST",

                    success: function(response) {
                        if (response.success) {

                            @if (Config::config()->alert === 'izi')
                                iziToast.success({
                                    position: 'topRight',
                                    message: "Refferal changed Successfully",
                                });
                            @elseif (Config::config()->alert === 'toast')
                                toastr.success("Refferal changed Successfully", {
                                    positionClass: "toast-top-right"

                                })
                            @else
                                Swal.fire({
                                    icon: 'success',
                                    title: "Refferal changed Successfully"
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
