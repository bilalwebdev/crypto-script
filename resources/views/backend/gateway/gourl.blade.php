@extends('backend.layout.master')

@section('element')
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body d-flex flex-wrap align-items-center">
                    <h4 class="mb-0">{{ __($title) }}</h4>
                    <div class="input-group ml-auto w-auto d-inline-flex">
                        <select class="form-select px-2" id="currency">
                            @foreach ($currency as $key => $cur)
                                <option value="{{ $cur['currency'] }}" data-currency="{{ $cur['currency'] }}">
                                    {{ Str::ucfirst($key) }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="addNew"> <i
                                    class="fa fa-plus"></i>
                                {{ __('Add New') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">

                <div class="card-body">
                    <form action="{{ route('admin.payment.update.gourl') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="payment-wrapper">
                            @foreach ($gateways as $gateway)
                                <div class="row" id="appear">
                                    <div class="form-group col-md-3 mb-3">
                                        <label>{{ __('Gourl Image') }}</label>

                                        <div id="image-preview-{{ optional($gateway->parameter)->gateway_currency ?? 'BTC' }}"
                                            class="image-preview payment-img-preview"
                                            style="background-image:url({{ Config::getFile('gateways', $gateway->image, true) }});">
                                            <label for="image-upload-{{ optional($gateway->parameter)->gateway_currency ?? 'BTC' }}"
                                                id="image-label-{{ optional($gateway->parameter)->gateway_currency ?? 'BTC' }}">{{ __('Choose File') }}</label>
                                            <input type="file"
                                                name="parameter[{{ optional($gateway->parameter)->gateway_currency ?? 'BTC' }}][image]"
                                                id="image-upload-{{ optional($gateway->parameter)->gateway_currency ?? 'BTC' }}"
                                                data-id="{{ optional($gateway->parameter)->gateway_currency ?? 'BTC' }}"
                                                class="imageUploader" />
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="">{{ __('Public Key') }}</label>
                                                <input type="text"
                                                    name="parameter[{{ optional($gateway->parameter)->gateway_currency ?? 'BTC' }}][public_key]"
                                                    class="form-control"
                                                    value="{{env('DEMO') ? '------' : optional($gateway->parameter)->public_key }}">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="">{{ __('Private Key') }}</label>
                                                <input type="text"
                                                    name="parameter[{{ optional($gateway->parameter)->gateway_currency ?? 'BTC' }}][private_key]"
                                                    class="form-control"
                                                    value="{{env('DEMO') ? '------' : optional($gateway->parameter)->private_key }}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="">{{ __('Gateway Currency') }}</label>
                                                <input type="text"
                                                    name="parameter[{{ optional($gateway->parameter)->gateway_currency ?? 'BTC' }}][gateway_currency]"
                                                    class="form-control site-currency"
                                                    value="{{ optional($gateway->parameter)->gateway_currency ?? 'BTC' }}" readonly>
                                            </div>

                                            <div class="form-group col-md-6 col-12">
                                                <label>{{ __('Conversion Rate') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            {{ '1 ' . Config::config()->currency . ' = ' }}
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control form_control currency"
                                                        name="parameter[{{ optional($gateway->parameter)->gateway_currency ?? 'BTC' }}][rate]"
                                                        value="{{ $gateway->rate }}">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text append_currency">
                                                            {{ optional($gateway->parameter)->gateway_currency ?? 'BTC' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-md-6 col-12 text-right">
                                <button type="submit" class="btn btn-primary ">
                                    {{ __('Update GoUrl.io Information') }}
                                </button>
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
            $(document).on('change', '.imageUploader', function() {
                showImagePreview(this, "#image-preview-" + $(this).data('id'));
            })

            function showImagePreview(input, id) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $(id).css('background-image', "url(" + e.target.result + ")");
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            let currencyAdded = @json($gateways->pluck('parameter.gateway_currency')->toArray());

            $('#addNew').on('click', function() {
                let currency = $('#currency option:selected').val();

                if (currencyAdded.includes(currency)) {
                    iziToast.error({
                        message: "Already Added This Currency",
                        position: 'topRight'
                    });
                    return
                }
                let html = `

                <div class="row removeEl" >
                    <div class="col-md-12 text-right">
                        <button class="btn btn-danger remove" data-currncy="${currency}"><i class="fa fa-times"></i></button>
                    </div>

                    <div class="form-group col-md-3 mb-3">
                        <label class="col-form-label">{{ __('Gourl Image') }}</label>

                        <div id="image-preview-${currency}" class="image-preview payment-img-preview">
                            <label for="image-upload-${currency}" id="image-label-${currency}">{{ __('Choose File') }}</label>
                            <input type="file" name="parameter[${currency}][gourl_image]" id="image-upload-${currency}" data-id="${currency}" class="imageUploader"/>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="row">
                            <div class="form-group col-md-12">

                                <label for="">{{ __('Public Key') }}</label>
                                <input type="text" name="parameter[${currency}][public_key]" class="form-control">
                            </div>

                            <div class="form-group col-md-12">

                                <label for="">{{ __('Private Key') }}</label>
                                <input type="text" name="parameter[${currency}][private_key]" class="form-control">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">{{ __('Gateway Currency') }}</label>

                                <input type="text" name="parameter[${currency}][gateway_currency]"
                                    class="form-control site-currency"
                                    value="${currency}" readonly>
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label>{{ __('Conversion Rate') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            {{ '1 ' . Config::config()->currency . ' = ' }}
                                        </div>
                                    </div>
                                    <input type="text" class="form-control form_control currency"
                                        name="parameter[${currency}][rate]" >
                                    <div class="input-group-append">
                                        <div class="input-group-text append_currency">
                                            ${currency}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
                `;

                currencyAdded.push(currency);
                $('#appear').after(html)
            })

            $(document).on('click', '.remove', function(e) {
                e.preventDefault();
                currencyAdded.splice(currencyAdded.indexOf($(this).data('currency')), 1);
                $(this).parents().find('.removeEl').remove()
            })

            $(document).on('keyup', '.site-currency', function() {
                $('.append_currency').text($(this).val())
            })
        })
    </script>
@endpush
