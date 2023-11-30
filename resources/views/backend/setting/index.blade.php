@extends('backend.layout.master')

@section('element')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs page-link-list border-bottom-0" role="tablist">
                        <li>
                            <a class=" active" data-toggle="tab" href="#general">
                                <i class="las la-home"></i>
                                {{ __('General Settings') }}
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#api">
                                <i class="las la-cloud"></i>
                                {{ __('API Settings') }}
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#kyc">
                                <i class="las la-user-shield"></i>
                                {{ __('KYC Settings') }}
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#other">
                                <i class="las la-cog"></i>
                                {{ __('Others Settings') }}
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#preference">
                                <i class="las la-cookie-bite"></i>
                                {{ __('Preferences') }}
                            </a>
                        </li>

                        <li>
                            <a data-toggle="tab" href="#cron">
                                <i class="las la-cookie-bite"></i>
                                {{ __('Cron Job Settings') }}
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                </div>
            </div>

            <div class="tab-content tabcontent-border">
                <div class="tab-pane fade show active" id="general" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="pt-4">
                                @include('backend.setting.general_setting')
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="api" role="tabpanel">

                    @include('backend.setting.api')

                </div>
                <div class="tab-pane fade" id="kyc" role="tabpanel">

                    @include('backend.setting.kyc')

                </div>
                <div class="tab-pane fade" id="other" role="tabpanel">

                    @include('backend.setting.others')

                </div>

                <div class="tab-pane fade" id="preference" role="tabpanel">

                    @include('backend.setting.preference')

                </div>


                <div class="tab-pane fade" id="cron" role="tabpanel">

                    @include('backend.setting.cron')

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="ins" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Instuction') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ Config::getFile('browsers', 'telegram-bot.png', true) }}" alt="" width="100%"
                        height="600px">
                    <p>
                        Open Telegram 📲on your Android device.
                        Click on the pen icon at the bottom of the screen and select New Group on the following screen.
                    </p>
                    <p>
                        Enter a name for your Group in the Group name field. Optionally, you can add a description to
                        describe your Telegram Group if you feel so.
                    </p>
                    <p>

                        Tap on the camera icon adjacent to your Group name and select a picture as the display picture
                        for your Telegram picture.
                    </p>

                    <p>

                        Tap the tick button on the top-right corner.
                    </p>

                    <p>

                        Select the Group type between Public Group or Private Group depending on what kind of
                        Group you want to create.
                    </p>

                    <p>
                        If it’s a public Group, set a permanent link for your Group. This link is what people would
                        use to search for and join your Group.

                    </p>

                    <p>
                        Tap the tick icon again to confirm.
                    </p>

                    <p>
                        Telegram will ask you to add subscribers to your Telegram Group, and select the contacts you’d
                        like to add. This is optional, and you can choose not to add any members for now.
                    </p>

                    <p>
                        Tap the right-pointing arrow👉🏹 to continue and create your Group on Telegram.
                    </p>

                    <p>
                        Once you have created the Group you should add the created Bot and make it an Admin
                    </p>
                    <p>
                        In a Telegram group, to promote a member to an Admin, you can follow any of the following two
                        methods:
                    </p>

                    <p>
                        Open the Member list
                    </p>

                    <p>
                        Tap and hold on to that member that you want to promote to an admin, two options will pop up on
                        the screen.
                    </p>

                    <p>
                        Tap on Promote to admin
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('external-style')
    <link rel="stylesheet" href="{{ Config::cssLib('backend', 'toogle.min.css') }}">
    <link rel="stylesheet" href="{{ Config::cssLib('backend', 'bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ Config::cssLib('backend', 'select2.min.css') }}">
@endpush

@push('external-script')
    <script src="{{ Config::jsLib('backend', 'toogle.min.js') }}"></script>
    <script src="{{ Config::jsLib('backend', 'bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ Config::jsLib('backend', 'select2.min.js') }}"></script>
@endpush

@push('style')
    <style>
        .sp-replacer {
            padding: 0;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 5px 0 0 5px;
            border-right: none;
        }

        select.form-control:not([size]):not([multiple]) {
            height: calc(2.25rem + 9px);
        }

        .sp-preview {
            width: 100px;
            height: 46px;
            border: 0;
        }

        .sp-preview-inner {
            width: 110px;
        }

        .sp-dd {
            display: none;
        }
    </style>
@endpush


@push('script')
    <script>
        $(function() {
            'use strict'
            $('#cp1').colorpicker();


            $('.ins').on('click', function(e) {
                e.preventDefault();

                const modal = $('#ins');

                modal.modal('show')
            })


            var copyButton = document.querySelector('.copy');
            var copyInput = document.querySelector('.copy-text');
            copyButton.addEventListener('click', function(e) {
                e.preventDefault();
                var text = copyInput.select();
                document.execCommand('copy');
            });
            copyInput.addEventListener('click', function() {
                this.select();
            });

            var copyButton3 = document.querySelector('.copy3');
            var copyInput3 = document.querySelector('.copy-text3');
            copyButton3.addEventListener('click', function(e) {
                e.preventDefault();
                var text = copyInput3.select();
                document.execCommand('copy');
            });
            copyInput3.addEventListener('click', function() {
                this.select();
            });




            $(".js-example-tokenizer").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            })

            $.uploadPreview({
                input_field: "#image-upload",
                preview_box: "#image-preview",
                label_field: "#image-label",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });

            $.uploadPreview({
                input_field: "#image-upload-icon",
                preview_box: "#image-preview-icon",
                label_field: "#image-label-icon",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });

            $.uploadPreview({
                input_field: "#image-upload-login",
                preview_box: "#image-preview-login",
                label_field: "#image-label-login",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });

            $.uploadPreview({
                input_field: "#image-upload-login_image",
                preview_box: "#image-preview-login_image",
                label_field: "#image-label-login_image",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });

            $.uploadPreview({
                input_field: "#image-upload-breadcrumbs",
                preview_box: "#image-preview-breadcrumbs",
                label_field: "#image-label-breadcrumbs",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });

            $.uploadPreview({
                input_field: "#image-upload-main",
                preview_box: "#image-preview-main",
                label_field: "#image-label-main",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });


            
            $.uploadPreview({
                input_field: "#image-upload-dark",
                preview_box: "#image-preview-dark",
                label_field: "#image-label-dark",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });


            var i = {{ $general->kyc != null ? count($general->kyc) : 1 }};

            $('.payment').on('click', function() {

                var html = `
                <div class="col-md-12 user-data">
                    <div class="form-group">
                        <div class="row mb-md-0 mb-4">

                            <div class="col-md-3">
                                <label>{{ __('Field label') }}</label>
                                <input name="kyc[${i}][field_label]" class="form-control form_control" type="text" value="" required >
                            </div>


                            <div class="col-md-3">
                                <label>{{ __('Field Name') }}</label>
                                <input name="kyc[${i}][field_name]" class="form-control form_control fieldName" type="text" value="" required >
                            </div>
                            <div class="col-md-2 mt-md-0 mt-2">
                                <label>{{ __('Field Type') }}</label>
                                <select name="kyc[${i}][type]" class="form-control selectric">
                                    <option value="text" > {{ __('Input Text') }} </option>
                                    <option value="textarea" > {{ __('Textarea') }} </option>
                                    <option value="file"> {{ __('File upload') }} </option>
                                </select>
                            </div>
                            <div class="col-md-2 mt-md-0 mt-2">
                                <label>{{ __('Field Validation') }}</label>
                                <select name="kyc[${i}][validation]"
                                        class="form-control selectric">
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

            $(document).on('keyup', '.fieldName', function() {

                let data = $(this).val();


                $(this).val(data.replace(/[^a-zA-Z0-9 ]/g, ''));
            });
        })
    </script>
@endpush
