@extends('backend.layout.master')

@section('element')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h4 class="card-title">{{ __('Admin Edit') }}</h4>
                    <a href="{{ route('admin.admins.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> {{ __('Go Back') }}</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.admins.update', $admin) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <label class="col-form-label">{{ __('Admin Image') }}</label>

                                <div id="image-preview" class="image-preview"
                                    style="background-image:url({{ Config::getFile('admin', $admin->image, true)}});">
                                    <label for="image-upload" id="image-label"
                                        class="mb-0">{{ __('Choose File') }}</label>
                                    <input type="file" name="admin_image" id="image-upload" />
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                   

                                    <div class="form-group col-md-6">
                                        <label for="">{{ __('Username') }}</label>
                                        <input type="text" name="username" class="form-control" required
                                            value="{{ $admin->username }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{ __('Email') }}</label>
                                        <input type="email" name="email" class="form-control" required
                                            value="{{ $admin->email }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{ __('Roles') }}</label>
                                        <select name="roles[]" class="form-control js-example-tokenizer" multiple>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}"
                                                    {{ $admin->hasRole($role->name) ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{ __('Password') }}</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{ __('Password Confirmation') }}</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>



                                    <div class="col-md-6">

                                        <button class="btn btn-primary" type="admin">
                                            <i class="las la-sync"></i>
                                            {{ __('Update Admin') }}</button>
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
        $(function() {
            'use strict'
            
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
