@extends('backend.layout.master')


@section('element')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header site-card-header align-items-center justify-content-between">
                    <div class="card-header-left">
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" placeholder="Role" name="role">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="submit"> <i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-header-right">
                        <button data-href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-primary add"> <i class="fa fa-plus"></i> {{ __('Add Role') }}</button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th>{{ __('SL') }}.</th>
                                    <th>{{ __('Role Name') }}</th>
                                    <th>{{ __('Permissions') }}</th>
                                    <th>{{ __('Total Admins') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($roles as $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @foreach ($role->permissions as $permission)
                                                <span class="badge badge-primary">{{$permission->name}}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $role->users->count() }}</td>
                                        <td>

                                            <button class="btn btn-outline-primary btn-sm edit" data-name="{{ $role->name }}"
                                                data-href="{{ route('admin.roles.update', $role) }}"
                                                data-permissons="{{ $role->permissions->pluck('name') }}">
                                                <i class="fa fa-pen"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">{{__('No Roles Found')}}</td>
                                    </tr>
                              
                                @endforelse


                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($roles->hasPages())
                    <div class="card-footer">
                        {{ $roles->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>




    <div class="modal fade" id="role" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.roles.store') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Create Role') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">{{ __('Role Name') }}</label>
                            <input type="text" name="role" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">{{ __('Role Permission') }}</label>
                            <select name="permission[]" class="js-example-tokenizer" multiple>
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary"> <i class="fas fa-sync-alt"></i>
                            {{ __('Create Role') }}</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i>
                            {{ __('Close') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <div class="modal fade" id="role_edit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Create Role') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">{{ __('Role Name') }}</label>
                            <input type="text" name="role" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">{{__('Permissions')}}</label>

                            <select name="permission[]" class="js-example-tokenizer form-control" multiple id="edit_select">
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary"> <i class="fas fa-sync-alt"></i>
                            {{ __('Update Role') }}</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i>
                            {{ __('Close') }}</button>
                    </div>
                </div>
            </form>
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
                placeholder: "Give Permission",
                tags: true,
                tokenSeparators: [',', ' ']
            })

            $('.status').on('change', function() {

                let status = $(this).data('status');
                let url = $(this).data('url');

                $.ajax({

                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },

                    url: url,

                    data: {
                        status: status
                    },

                    method: "POST",

                    success: function(response) {
                        iziToast.success({

                            message: response.success,
                            position: 'topRight'
                        });
                    }
                })
            })


            $('.add').on('click', function() {
                const modal = $('#role')


                modal.modal('show')
            })


            $('.edit').on('click', function() {
                const modal = $('#role_edit')

                modal.find('input[name=role]').val($(this).data('name'));

                modal.find('form').attr('action', $(this).data('href'));


                modal.find('#edit_select').val($(this).data('permissons'));

                modal.find('#edit_select').trigger('change')



                modal.modal('show')
            })

        })
    </script>
@endpush
