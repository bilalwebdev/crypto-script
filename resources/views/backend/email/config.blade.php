@extends('backend.layout.master')

@section('element')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4>
                                {{__('SMTP Configuration')}}
                            </h4>  
                            <p class="text-info h6">{{__('If SMTP is disable, PHP mail is auto active.')}}</p>
                        </div>                      
                        <div class="custom-control custom-switch">
                            <input type="checkbox" {{ Config::config()->email_method === 'smtp' ? 'checked' : '' }}  name="smtp"
                                class="custom-control-input" id="useCheck1">
                            <label class="custom-control-label" for="useCheck1">{{ __('Disable/Active') }}</label>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">{{ __('Email Sent From') }}</label>
                                <input type="email" name="email_sent_from" class="form-control form_control"
                                    value="{{ Config::config()->email_sent_from }}">
                            </div>


                            <div class="form-group col-md-6">
                                <label for="">{{ __('SMTP HOST') }}</label>
                                <input type="text" name="email_config[smtp_host]" class="form-control"
                                    value="{{ env('DEMO') ? '------' : Config::config()->email_config->MAIL_HOST }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">{{ __('SMTP Username') }}</label>
                                <input type="text" name="email_config[smtp_username]" class="form-control"
                                    value="{{ env('DEMO') ? '------' : Config::config()->email_config->MAIL_USERNAME }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">{{ __('SMTP Password') }}</label>
                                <input type="text" name="email_config[smtp_password]" class="form-control"
                                    value="{{ env('DEMO') ? '------' : Config::config()->email_config->MAIL_PASSWORD }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">{{ __('SMTP port') }}</label>
                                <input type="text" name="email_config[smtp_port]" class="form-control"
                                    value="{{ Config::config()->email_config->MAIL_PORT }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">{{ __('SMTP Encryption') }}</label>
                                <select name="email_config[smtp_encryption]" id="encryption" class="form-control selectric">
                                    <option value="ssl"
                                        {{ Config::config()->email_config->MAIL_ENCRYPTION == 'ssl' ? 'selected' : '' }}>
                                        {{ __('SSL') }}</option>
                                    <option value="tls"
                                        {{ Config::config()->email_config->MAIL_ENCRYPTION == 'tls' ? 'selected' : '' }}>
                                        {{ __('TLS') }}</option>
                                </select>
                                <code class="hint"></code>
                            </div>


                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary"> <i class="fas fa-sync-alt mr-2"></i>
                                    {{ __('Update Email Configuration') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('script')
    <script>
        $(function() {
            'use strict'



            $(document).on('change', '#encryption', function() {

                if ($(this).val() == 'ssl') {
                    $('.hint').text("For SSL please add ssl:// before host otherwise it won't work")
                } else {
                    $('.hint').text('')
                }
            })
        })
    </script>
@endpush
