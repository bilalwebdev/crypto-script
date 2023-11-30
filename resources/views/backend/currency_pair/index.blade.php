@extends('backend.layout.master')
@section('element')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header site-card-header justify-content-between">
                    <div class="card-header-left">
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control form-control-sm" placeholder="search pair">
                                <button class="btn btn-sm btn-primary"> <i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="card-header-right">
                        <button class="btn btn-sm btn-primary add"> <i class="fa fa-plus"></i> {{ __('Create Currency Pair') }}</button>
                    </div>
                </div>
                <div class="card-body p-0">

                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th>{{ __('Sl') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($pairs as $pair)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pair->name }}</td>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="status" {{ $pair->status ? 'checked' : '' }}
                                                    class="custom-control-input status" id="status{{ $pair->id }}"
                                                    data-id="{{ $pair->id }}"
                                                    data-route="{{ route('admin.currency-pair.changestatus', $pair) }}">
                                                <label class="custom-control-label"
                                                    for="status{{ $pair->id }}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary edit"
                                                data-pair="{{ $pair }}"
                                                data-url="{{ route('admin.currency-pair.update', $pair->id) }}"><i class="far fa-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-danger delete"
                                                data-url="{{ route('admin.currency-pair.destroy', $pair->id) }}"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="">{{ __('No Pair Found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

                </div>

                @if ($pairs->hasPages())
                    <div class="card-footer">
                        {{ $pairs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>


    <div class="modal fade" id="add" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">

            <form action="{{ route('admin.currency-pair.store') }}" method="post">

                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Create Currency Pair') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">{{ __('Pair Name') }}</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">{{ __('Currency Pair Status') }}</label>
                            <select name="status" class="form-control">
                                <option value="1">{{ __('Active') }}</option>
                                <option value="0">{{ __('Disable') }}</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i>
                            {{ __('Create') }}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    </div>
                </div>

            </form>

        </div>
    </div>


    <div class="modal fade" id="edit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">

            <form action="" method="post">

                @csrf

                @method('PUT')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Update Currency Pair') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">{{ __('Pair Name') }}</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">{{ __('Currency Pair Status') }}</label>
                            <select name="status" class="form-control">
                                <option value="1">{{ __('Active') }}</option>
                                <option value="0">{{ __('Disable') }}</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i>
                            {{ __('Update') }}</button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Close') }}</button>
                    </div>
                </div>

            </form>

        </div>
    </div>


    <div class="modal fade" id="delete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">

            <form action="" method="post">

                @csrf

                @method('DELETE')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Delete Currency Pair') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <p>{{ __('Are You sure to Delete this currency pair ?') }}</p>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger"> <i class="fa fa-trash"></i>
                            {{ __('Delete') }}</button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Close') }}</button>
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
                const modal = $('#add')

                modal.modal('show')
            })


            $('.edit').on('click', function() {
                const modal = $('#edit')

                modal.find('form').attr('action', $(this).data('url'))

                modal.find('input[name=name]').val($(this).data('pair').name)

                modal.find('select[name=status]').val($(this).data('pair').status)

                modal.modal('show')
            })

            $('.delete').on('click', function() {
                const modal = $('#delete')

                modal.find('form').attr('action', $(this).data('url'));

                modal.modal('show');
            })

            $('.status').on('change', function() {

                let id = $(this).data('id');
                let route = $(this).data('route');

                $.ajax({

                    url: route,
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        @include('backend.layout.ajax_alert', [
                            'message' => 'Successfully change status',
                            'message_error' => '',
                        ])
                    }

                })




            })
        })
    </script>
@endpush
