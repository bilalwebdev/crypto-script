@extends('backend.layout.master')


@section('element')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header site-card-header d-flex justify-content-between">
                    <div class="card-header-right">
                        <a href="{{ route('admin.language.index') }}" class="btn btn-sm btn-primary"> <i
                                class="fa fa-arrow-left"></i>
                            {{ __('Back') }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs page-link-list border-bottom-0" role="tablist">
                        <li>
                            <a class=" active" data-toggle="tab" href="#general">
                                <i class="las la-home"></i>
                                {{ __('General Content') }}
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#frontend">
                                <i class="las la-cloud"></i>
                                {{ __('Frontend Section Content') }}
                            </a>
                        </li>
                    </ul>


                </div>

                <div class="tab-content tabcontent-border">
                    <div class="tab-pane fade show active" id="general" role="tabpanel">
                        <div class="card">

                            <div class="row mt-2">
                                <div class="col-lg-6">
                                    <div class="card-header-left">
                                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Search key" id="search">
                                    </div>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table student-data-table language-table" id="translate">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Key') }}</th>
                                                <th>{{ __('Value') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <form method="POST"
                                                action="{{ route('admin.language.ajax', request()->lang) }}">
                                                @csrf

                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="type" value="content">
                                                    </td>
                                                </tr>
                                                @forelse ($translators as $key => $lang)
                                                    <tr class="filt">
                                                        <td class="font-weight-bold white-space-wrap">{{ $key }}
                                                        </td>

                                                        <td>
                                                            <input type="hidden" name="key[]"
                                                                value="{{ $key }}">
                                                            <textarea name="value[]" class="form-control lang-field">{{ $lang }}</textarea>

                                                        </td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-danger delete"
                                                                data-lang_key="{{ $key }}" data-type="content"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-center" colspan="100%">{{ __('No Data Found') }}
                                                        </td>
                                                    </tr>
                                                @endforelse

                                                <button class="btn btn-sm btn-primary float-btn">
                                                    <i class="fa fa-spinner"></i>
                                                    {{ __('Update') }}
                                                </button>
                                            </form>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane fade" id="frontend" role="tabpanel">
                        <div class="card">
                            <div class="row mt-2">
                                <div class="col-lg-6">
                                    <div class="card-header-left">
                                        <input type="text" name="search" class="form-control form-control-sm"
                                            placeholder="Search key" id="searchContent">
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table student-data-table language-table" id="translateContent">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Key') }}</th>
                                                <th>{{ __('Value') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <form method="POST"
                                                action="{{ route('admin.language.ajax', request()->lang) }}">
                                                @csrf

                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="type" value="section">
                                                    </td>
                                                </tr>
                                                @forelse ($frontendtranslators as $key => $lang)
                                                    <tr class="filt">
                                                        <td class="font-weight-bold white-space-wrap">{{ $key }}
                                                        </td>

                                                        <td>
                                                            <input type="hidden" name="key[]"
                                                                value="{{ $key }}">
                                                            <textarea name="value[]" class="form-control lang-field">{{ $lang }}</textarea>

                                                        </td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-danger delete"
                                                                data-lang_key="{{ $key }}" data-type="section"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-center" colspan="100%">{{ __('No Data Found') }}
                                                        </td>
                                                    </tr>
                                                @endforelse

                                                <button class="btn btn-sm btn-primary float-btn">
                                                    <i class="fa fa-spinner"></i>
                                                    {{ __('Update') }}
                                                </button>


                                            </form>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addmore" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add Translation Data') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">{{ __('Translation Key') }}</label>
                            <textarea type="text" name="key" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('Translation Value') }}</label>
                            <textarea type="text" name="value" class="form-control"></textarea>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Close') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="delete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.language.key.delete', request()->lang) }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Delete Language Key') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Are you sure to delete this key') }}</p>
                        <input type="hidden" name="key" value="">
                        <input type="hidden" name="type" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Close') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('external-css')
    <link rel="stylesheet" href="{{ Config::cssLib('backend', 'datatable.min.css') }}">
@endpush

@push('external-script')
    <script src="{{ Config::jsLib('backend', 'datatable.min.js') }}"></script>
@endpush

@push('style')
    <style>
        .float-btn {
            position: fixed;
            bottom: 40px;
            right: 36%;
            width: 200px;
            height: 67px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0, 0.1);
        }

        .language-table .filt td:first-child {
            width: 550px;

        }

        .language-table .filt td:last-child {
            width: 70px;

        }
    </style>
@endpush

@push('script')
    <script>
        $(function() {
            'use strict'


            $('.update').on('click', function() {
                var data = $('#seri').submit();


                return false;
            });


            $('.addmore').on('click', function() {
                const modal = $('#addmore')

                modal.modal('show')
            })

            $('.delete').on('click', function(e) {
                e.preventDefault();
                const modal = $('#delete')

                modal.find('input[name=key]').val($(this).data('lang_key'))
                modal.find('input[name=type]').val($(this).data('type'))

                modal.modal('show')
            })

            $("#search").on("keyup", function() {

                var value = $(this).val().toLowerCase();

                $("#translate .filt").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });


            $("#searchContent").on("keyup", function() {

                var value = $(this).val().toLowerCase();

                $("#translateContent .filt").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });


        })
    </script>
@endpush
