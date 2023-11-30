@extends('backend.layout.master')

@section('element')
    <form action="" method="POST" class="col-md-12">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">{{ __('Page Name') }}</label>
                                <input type="text" name="page" class="form-control" required>
                            </div>

                            <div class="form-group col-md-6 ">
                                <label for="">{{ __('Page Order') }}</label>
                                <input type="number" name="order" class="form-control" placeholder="Page Order" required>
                            </div>

                            <div class="form-group col-md-6 ">
                                <label for="">{{ __('Is Dropdown') }}</label>
                                <select name="is_dropdown" class="form-control">
                                    <option value="1">
                                        {{ __('Yes') }}</option>
                                    <option value="0">
                                        {{ __('No') }}</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">{{ __('Status') }}</label>
                                <select name="status" class="form-control">
                                    <option value="1">
                                        {{ __('Active') }}</option>
                                    <option value="0">
                                        {{ __('Inactive') }}</option>
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="">{{ __('Seo Keywords') }}</label>
                                <select class="form-control tokenizer" name="keyword[]" multiple="multiple">
                                   
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="">{{ __('Seo Description') }}</label>
                                <textarea name="seo_description" id="" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="w-100">
                            <select name="" id="widgets" class="form-control">
                                <option value="">{{ __('Select Widgets') }}</option>
                                @foreach (Config::sectionConfig() as $key => $widgets)
                                    <option value="{{ $widgets }}" data-name="{{ $widgets }}">
                                        {{ Config::frontendformatter($widgets) }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="row mt-4 sp_section_box_wrapper" id="widgetAdd">
                           
                        </div>


                        <button type="submit" class="btn btn-primary float-right mt-3">{{ __('Update Page') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('style')
    <style>
        .sp_section_box {
            width: 124px;
            position: relative;
            padding: 15px 10px;
            border: 1px solid #e5e5e5;
            background-color: #f4faff;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 5px 15px #449ae71a;
            text-align: center;
            height: 100%;
        }

        .popup .close-popup {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 22px;
            height: 22px;
            font-size: 14px;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #ff6046;
            border: 1px solid #e5e5e5;
            border-radius: 50%;
        }
    </style>
@endpush

@push('external-style')
    <link href="{{ Config::cssLib('backend', 'select2.min.css') }}" rel="stylesheet">
@endpush

@push('external-script')
    <script src="{{ Config::jsLib('backend', 'select2.min.js') }}"></script>
@endpush

@push('script')
    <script>
        $(function() {
            'use strict'

            $('#widgets').on('change', function() {

                let name = $('#widgets option:selected').data('name')

                $('#widgetAdd').append(`


                    <div class="col-auto mb-4 removeItem">
                        <div class="popup sp_section_box">
                            <a href="#" class="close-popup"
                                data-item="${name}">&#x2716;</a>
                            <span>
                                ${name.replace(/_/g, ' ')}
                            </span>

                            <input type="hidden" name="sections[]" value="${name}">
                        </div>
                    </div>

                `);
            })


            $(document).on('click', '.close-popup', function() {
                $(this).parent().parent('.removeItem').remove();
            })



            $(".tokenizer").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            })
        })
    </script>
@endpush
