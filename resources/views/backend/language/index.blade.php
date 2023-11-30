@extends('backend.layout.master')

@section('element')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header site-card-header justify-content-between">
                    <div class="card-header-left">
                        <h4>{{ __('All Language') }}</h4>
                    </div>
                    <div class="card-header-right">
                        <button class="btn btn-primary btn-sm add"> <i class="fa fa-plus"></i>
                            {{ __('Create Language') }}</button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th>{{ __('Language Name') }}</th>
                                    <th>{{ __('Default') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($languages as $lang)
                                    <tr>
                                        <td>{{ $lang->name }}</td>
                                        <td>
                                            @if (!$lang->status)
                                                <span class="badge badge-primary">{{ __('Default') }}</span>
                                            @else
                                                <span class="badge badge-warning">{{ __('No') }}</span>
                                            @endif
                                        </td>
                                        <td>


                                            <button class="btn btn-sm btn-outline-primary edit mr-1"
                                                data-href="{{ route('admin.language.edit', $lang) }}"
                                                data-lang="{{ $lang }}"><i class="fa fa-pen"></i></button>

                                            @if ($lang->status == 1)
                                                <button class="btn btn-sm btn-outline-danger delete mr-1"
                                                    data-href="{{ route('admin.language.delete', $lang) }}"><i
                                                        class="fa fa-trash"></i></button>
                                            @endif


                                            <a href="{{ route('admin.language.translator', $lang->code) }}"
                                                class="btn btn-sm btn-outline-primary">{{ 'Transalator' }}</a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">{{ __('No Language Found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($languages->hasPages())
                    <div class="card-footer">
                        {{ $languages->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>






    <div class="modal fade" tabindex="-1" id="add" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add Language') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">{{ __('Language Name') }}</label>
                                <input type="text" name="language" class="form-control"
                                    placeholder="{{ __('Enter Language') }}">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="">{{ __('Language short Code') }}</label>
                                <input type="text" name="code" class="form-control"
                                    placeholder="{{ __('Enter Language Short Code') }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger"
                            data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-sm btn-primary">{{ __('Create') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="edit" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Edit Language') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">{{ __('Language Name') }}</label>
                                <input type="text" name="language" class="form-control"
                                    placeholder="{{ __('Enter Language') }}">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="">{{ __('Language short Code') }}</label>
                                <input type="text" name="code" class="form-control"
                                    placeholder="{{ __('Enter Language Short Code') }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger"
                            data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-sm btn-primary">{{ __('Update') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" id="delete" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Delete Language') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <p>{{ __('Are You Sure to Delete') }}?</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-primary"
                            data-dismiss="modal">{{ __('Close') }}</button>

                        <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
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

            $('.add').on('click', function() {
                const modal = $('#add');

                modal.modal('show')
            })

            $('.edit').on('click', function() {
                const modal = $('#edit');
                modal.find('form').attr('action', $(this).data('href'))
                modal.find('input[name=language]').val($(this).data('lang').name)
                modal.find('input[name=code]').val($(this).data('lang').code)

                modal.modal('show')
            })

            $('.delete').on('click', function() {
                const modal = $('#delete');

                modal.find('form').attr('action', $(this).data('href'));

                modal.modal('show');
            })

        })
    </script>
@endpush
