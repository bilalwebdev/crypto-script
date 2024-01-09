@extends('backend.layout.master')

@section('element')
    <div class="row gy-4">
        <div class="col-lg-9">
            <div class="p-4  bg-white rounded-lg">
                <form action="{{ route('admin.user.submit') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-sm-6 mb-3 ">
                            <label>{{ __('Name') }}</label>
                            <input type="text" name="username" class="form-control" value="">
                        </div>

                        <div class="form-group col-sm-6 mb-3 ">
                            <label>{{ __('Email') }}</label>
                            <input type="text" name="email" class="form-control" value="">
                        </div>
                        <div class="form-group col-sm-6 mb-3 ">
                            <label>{{ __('Phone') }}</label>
                            <input type="text" name="phone" class="form-control" value="">
                        </div>
                        <div class="form-group col-sm-6 mb-3 ">
                            <label>{{ __('Country') }}</label>
                            <input type="text" name="country" class="form-control" value="">
                        </div>

                        {{-- <div class="col-sm-6 mb-3">

                            <label>{{ __('City') }}</label>
                            <input type="text" name="city" class="form-control form_control">
                        </div> --}}

                        {{-- <div class="col-sm-6 mb-3">

                            <label>{{ __('Zip') }}</label>
                            <input type="text" name="zip" class="form-control form_control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{{ __('State') }}</label>
                            <input type="text" name="state" class="form-control form_control">
                        </div> --}}

                        {{-- <div class="form-group col-md-6">
                            <label for="">{{ __('Admins') }}</label>
                            <select name="admins" class="form-control js-example-tokenizer">
                                <option value=""></option>
                                @foreach ($admins as $key => $admin)
                                    <option value="{{ $key }}">
                                        {{ $admin }}</option>
                                @endforeach
                            </select>

                        </div> --}}
                        <div class="col-md-6 mb-3">
                            <label>{{ __('Password') }}</label>
                            <input type="password" name="password" class="form-control form_control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>{{ __('Confirm Password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control form_control">
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="row">
                                <div class="col-xl-3 col-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="email_status" class="custom-control-input"
                                            id="useCheck1">
                                        <label class="custom-control-label"
                                            for="useCheck1">{{ __('Email Verified') }}</label>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="sms_status" class="custom-control-input"
                                            id="useCheck2">
                                        <label class="custom-control-label" for="useCheck2">{{ __('SMS Verified') }}</label>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="kyc_status" class="custom-control-input"
                                            id="useCheck3">
                                        <label class="custom-control-label" for="useCheck3">{{ __('KYC Verified') }}</label>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="status" class="custom-control-input" id="useCheck4">
                                        <label class="custom-control-label" for="useCheck4">{{ __('Status') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xxl-3 col-xl-4 mt-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-sync-alt"></i>
                                {{ 'Add Wallet' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('external-style')
    <link rel="stylesheet" href="{{ Config::cssLib('backend', 'select2.min.css') }}">
@endpush

@push('external-script')
    <script src="{{ Config::jsLib('backend', 'select2.min.js') }}"></script>
@endpush

@push('script')
    <script>
        'use strict'

        $(function() {

            $(".js-example-tokenizer").select2({
                placeholder: "Select Admin"
            })
            $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "{{ __('Choose File') }}", // Default: Choose File
                label_selected: "{{ __('Update Image') }}", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });
        })
    </script>
@endpush
