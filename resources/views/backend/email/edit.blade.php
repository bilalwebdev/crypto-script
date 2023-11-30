@extends('backend.layout.master')

@section('element')
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form action="" method="post">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>
                            {{ Config::frontendFormatter($template->name) }}
                        </h4>

                        <div class="custom-control custom-switch">
                            <input type="checkbox" {{ $template->status ? 'checked' : ''}}
                                name="status" class="custom-control-input" id="useCheck1">
                            <label class="custom-control-label" for="useCheck1">{{ __('Disable/Active') }}</label>
                        </div>
                    </div>
                    <div class="card-body">
                        <code>

                        </code>
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">{{ __('Subject') }}</label>
                                <input type="text" name="subject" class="form-control" value="{{ $template->subject }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">{{ __('Template') }}</label>
                                <textarea name="template" class="form-control summernote">{{ clean($template->template) }}</textarea>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-sync-alt mr-2"></i>
                                    {{ __('Update Email Template') }}
                                </button>
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
            $('.summernote').summernote();
        })
    </script>
@endpush
