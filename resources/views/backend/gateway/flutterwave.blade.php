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
                                <label class="col-form-label">{{ __('Flutterwave Image') }}</label>

                                <div id="image-preview" class="image-preview"
                                    style="background-image:url({{ Config::getFile('gateways', $gateway->image, true) }});">
                                    <label for="image-upload" id="image-label">{{ __('Choose File') }}</label>
                                    <input type="file" name="image" id="image-upload" />
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row mt-5">




                                    <div class="form-group col-md-6">

                                        <label for="">{{ __('Flutter API Key') }}</label>
                                        <input type="text" name="parameter[public_key]" class="form-control"
                                            value="{{ env('DEMO') ? '------' : $gateway->parameter->public_key ?? old('public_key') }}">
                                    </div>

                                    <div class="form-group col-md-6">

                                        <label for="">{{ __('Flutter Reference key') }}</label>
                                        <input type="text" name="parameter[reference_key]" class="form-control"
                                            value="{{ env('DEMO') ? '------' : $gateway->parameter->reference_key ?? old('reference_key') }}">
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="">{{ __('Gateway Currency') }}</label>
                                        <input type="text" name="parameter[gateway_currency]"
                                            class="form-control site-currency"
                                            value="{{ $gateway->parameter->gateway_currency ?? old('gateway_currency') }}">
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>{{ __('Conversion Rate') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    {{ '1 ' . Config::config()->currency . ' = ' }}
                                                </div>
                                            </div>
                                            <input type="text" class="form-control form_control currency" name="rate"
                                                value="{{ Config::formatter($gateway->rate) ?? 0 }}">

                                            <div class="input-group-append">
                                                <div class="input-group-text append_currency">

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit"
                                    class="btn btn-primary float-right">{{ __('Update FlutterWave Information') }}</button>
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
