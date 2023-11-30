@extends('backend.layout.master')

@section('element')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header justify-content-end">
                    <a href="{{ route('admin.admins.index') }}" class="btn btn-sm btn-primary"> <i
                            class="fa fa-arrow-left"></i>
                        {{ __('Go Back') }}</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.admins.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-7">
                                <label class="col-form-label">{{ __('Admin Image') }}</label>
                                <div id="image-preview" class="image-preview"
                                    style="background-image:url({{ Config::getFile('admins', '') }});">
                                    <label for="image-upload" id="image-label">{{ __('Choose File') }}</label>
                                    <input type="file" name="admin_image" id="image-upload" />
                                </div>
                            </div>


                            <div class="col-xxl-9 col-xl-8 col-lg-8">
                                <div class="row">

                                    

                                    <div class="form-group col-md-6">
                                        <label for="">{{ __('Username') }}</label>
                                        <input type="text" name="username" class="form-control" required
                                            value="{{ old('username') }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{ __('Email') }}</label>
                                        <input type="email" name="email" class="form-control" required
                                            value="{{ old('email') }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{ __('Roles') }}</label>
                                        <select name="roles[]" class="form-control js-example-tokenizer" multiple>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{ __('Password') }}</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{ __('Password Confirmation') }}</label>
                                        <input type="password" name="password_confirmation" class="form-control" required>
                                    </div>

                                    

                                    <div class="form-group col-md-6">

                                        <button class="btn btn-primary" type="admin"> <i class="fa fa-save"></i>
                                            {{ __('Create Admin') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

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
                placeholder: "Select Role"
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
