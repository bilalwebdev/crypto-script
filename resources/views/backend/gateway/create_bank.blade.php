@extends('backend.layout.master')

@section('element')
    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header justify-content-end">
                    <a href="{{route('admin.payment.offline')}}" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> {{__('Back')}}</a>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">

                        @csrf

                        <div class="row">

                            <div class="form-group col-md-3">
                                <label>{{ __('Gateway Image') }}</label>

                                <div id="image-preview" class="image-preview"
                                    style="background-image:url({{ Config::getFile('gateways', '', true) }});">
                                    <label for="image-upload" id="image-label">{{ __('Choose File') }}</label>
                                    <input type="file" name="image" id="image-upload" />
                                </div>


                                <label class="mt-3 qr">{{ __('Qr Code Image') }}</label>

                                <div id="image-preview-1" class="image-preview qr"
                                    style="background-image:url({{ Config::getFile('gateways', '', true) }});">
                                    <label for="image-upload-1" id="image-label-1">{{ __('Choose File') }}</label>
                                    <input type="file" name="qr_code" id="image-upload-1" />
                                </div>

                            </div>

                            <div class="col-md-9">

                                <div class="row">

                                    <div class="mb-4 col-md-6">
                                        <label for="">{{ __('Gateway Name') }}</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="">{{ __('Gateway Type') }}</label>
                                        <select name="gateway_type" id="type" class="form-control">
                                            <option value="bank">{{ __('Bank') }}</option>
                                            <option value="crypto">{{ __('Crypto') }}</option>
                                        </select>
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="">{{ __('Gateway Currency') }}</label>
                                        <input type="text" name="gateway_currency" class="form-control site-currency">
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label>{{ __('Conversion Rate') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    {{ '1 ' . Config::config()->site_currency . ' = ' }}
                                                </div>
                                            </div>
                                            <input type="text" class="form-control currency" name="rate">

                                            <div class="input-group-append">
                                                <div class="input-group-text append_currency">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4 col-md-6" id="append">
                                        <label>{{ __('Charge') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    {{ Config::config()->site_currency }}
                                                </div>
                                            </div>
                                            <input type="text" class="form-control currency" name="charge">
                                        </div>
                                    </div>

                                    <div class="mb-4 col-md-12">
                                        <label for="">{{ __('Payment Instruction') }}</label>
                                        <textarea name="payment_instruction" cols="30" rows="10" class="form-control summernote"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card border">
                                    <div class="card-header">
                                        <h5>{{ __('User Proof Requirements') }}</h5>
                                        <button type="button" class="btn btn-primary ml-auto payment btn-sm"> <i
                                                class="fa fa-plus"></i>
                                            {{ __('Add Payment Requirements') }}</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="payment-instruction">
                                            <div class="user-data">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create gateway') }}</button>
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

            var i = 0;

            let crypto = `
            <div class="form-group col-md-6 delete">
                <label for="">{{ __('Bank Account Number') }}</label>
                <input type="text" name="account_number" class="form-control">
            </div>
            <div class="form-group col-md-6 delete">
                <label for="">{{ __('Bank Routing Number') }}</label>
                <input type="text" name="routing_number" class="form-control">
            </div>
            <div class="form-group col-md-6 delete">
                <label for="">{{ __('Bank Branch Name') }}</label>
                <input type="text" name="branch_name" class="form-control">
            </div>
            `;


            $('.qr').addClass('d-none')
            $('#append').after(crypto)


            $('#type').on('change', function() {
                if ($(this).val() === 'bank') {
                    $('#append').after(crypto);
                    $('.qr').removeClass('d-block').addClass('d-none')
                    $('.qr').find('input[name=qr_code]').val('')
                } else {
                    $('.qr').removeClass('d-none').addClass('d-block')
                    $('.delete').remove();
                }
            })

            $('.payment').on('click', function() {
                var html = `
                <div class="user-data">
                    <div class="form-group mb-4">
                        <div class="input-group">
                            <div class="col-md-4">
                                <label>{{ __('Field Name') }}</label>
                                <input name="user_proof_param[${i}][field_name]" class="form-control rounded-5 form_control" type="text" value="" required >
                            </div>
                            <div class="col-md-3 mt-md-0 mt-2">
                                <label>{{ __('Field Type') }}</label>
                                <select name="user_proof_param[${i}][type]" class="form-control rounded-5 selectric">
                                    <option value="text" > {{ __('Input Text') }} </option>
                                    <option value="textarea" > {{ __('Textarea') }} </option>
                                    <option value="file"> {{ __('File upload') }} </option>
                                </select>
                            </div>
                            <div class="col-md-3 mt-md-0 mt-2">
                                <label>{{ __('Field Validation') }}</label>
                                <select name="user_proof_param[${i}][validation]"
                                        class="form-control rounded-5 selectric">
                                    <option value="required"> {{ __('Required') }} </option>
                                    <option value="nullable">  {{ __('Optional') }} </option>
                                </select>
                            </div>
                            <div class="col-md-2 text-right my-auto">
                                <button class="btn btn-danger btn-lg remove w-100 mt-4" type="button">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>`;
                $('.payment-instruction').append(html);

                i++;

            })

            $(document).on('click', '.remove', function() {
                $(this).closest('.user-data').remove();
            });

            $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "{{ __('Choose File') }}", // Default: Choose File
                label_selected: "{{ __('Update Image') }}", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });

            $.uploadPreview({
                input_field: "#image-upload-1", // Default: .image-upload
                preview_box: "#image-preview-1", // Default: .image-preview
                label_field: "#image-label-1", // Default: .image-label
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
