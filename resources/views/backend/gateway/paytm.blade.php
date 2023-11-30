@extends('backend.layout.master')

@section('element')
    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">

                <div class="card-body">
                    <form action="{{ route('admin.payment.update.online', $gateway->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3 mb-3">
                                <label class="col-form-label">{{ __('PayTm Image') }}</label>

                                <div id="image-preview" class="image-preview"
                                    style="background-image:url({{ Config::getFile('gateways', $gateway->image, true) }});">
                                    <label for="image-upload" id="image-label">{{ __('Choose File') }}</label>
                                    <input type="file" name="image" id="image-upload" />
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="">{{ __('Gateway Currency') }}</label>
                                        <input type="text" name="parameter[gateway_currency]"
                                            class="form-control site-currency"
                                            value="{{ $gateway->parameter->gateway_currency ?? old('gateway_currency') }}">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="">{{ __('Payment Mode') }}</label>
                                        <select name="parameter[mode]" id="" class="form-control">
                                            <option value="0"
                                                {{ optional($gateway->parameter)->mode ? '' : 'selected' }}>
                                                {{ __('Sandbox') }}</option>
                                            <option value="1"
                                                {{ optional($gateway->parameter)->mode ? 'selected' : '' }}>
                                                {{ __('Live') }}</option>
                                        </select>

                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="">{{ __('Merchant Id') }}</label>
                                        <input type="text" name="parameter[merchant_id]" class="form-control"
                                            value="{{ env('DEMO') ? '------' : $gateway->parameter->merchant_id ?? old('merchant_id') }}">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="">{{ __('Merchant Key') }}</label>
                                        <input type="text" name="parameter[merchant_key]" class="form-control"
                                            value="{{  env('DEMO') ? '------' : $gateway->parameter->merchant_key ?? old('merchant_key') }}">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="">{{ __('Merchant Website') }}</label>
                                        <input type="text" name="parameter[merchant_website]" class="form-control"
                                            value="{{  env('DEMO') ? '------' : $gateway->parameter->merchant_website ?? old('merchant_website') }}">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="">{{ __('Merchant Channel') }}</label>
                                        <input type="text" name="parameter[merchant_channel]" class="form-control"
                                            value="{{  env('DEMO') ? '------' : $gateway->parameter->merchant_channel ?? old('merchant_channel') }}">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="">{{ __('Merchant Industry Type') }}</label>
                                        <input type="text" name="parameter[merchant_industry]" class="form-control"
                                            value="{{  env('DEMO') ? '------' : $gateway->parameter->merchant_industry ?? old('merchant_industry') }}">
                                    </div>

                                    <div class="col-md-6 col-12 mb-4">
                                        <label>{{ __('Conversion Rate') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    {{ '1 ' . Config::config()->currency . ' = ' }}
                                                </div>
                                            </div>
                                            <input type="text" class="form-control form_control currency" name="rate"
                                                value="{{ number_format($gateway->rate ?? 0, 4) ?? 0 }}">

                                            <div class="input-group-append">
                                                <div class="input-group-text append_currency">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary float-right">
                                    {{ __('Update Paytm Information') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        $(function() {
            'use strict'

            $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "{{ __('Choose File') }}", // Default: Choose File
                label_selected: "{{ __('Update Image') }}", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });

            $('.site-currency').on('keyup', function() {
                $('.append_currency').text($(this).val())
            })

            $('.append_currency').text($('.site-currency').val())
        })
    </script>
@endpush
