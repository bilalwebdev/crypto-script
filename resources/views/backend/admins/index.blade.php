@extends('backend.layout.master')

@section('element')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header site-card-header align-items-center justify-content-between">
                    <div class="card-header-left">
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" placeholder="username / email" name="search">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="submit"> <i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-header-right">
                        <a href="{{ route('admin.admins.create') }}" class="btn btn-primary btn-sm add"> <i class="fa fa-plus mr-1"></i> {{ __('Create Admin') }}</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th>{{ __('SL') }}.</th>
                                    <th>{{ __('Role Name') }}</th>
                                    <th>{{ __('Username') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody id="filter_data">
                                @forelse ($admins as $admin)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @foreach ($admin->roles as $role)
                                                <span class="badge badge-primary">{{ $role->name }}</span>
                                            @endforeach
                                        </td>

                                        <td>{{ $admin->username }}</td>
                                        <td>{{ $admin->email }}</td>

                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="status" {{ $admin->status ? 'checked' : '' }}
                                                    class="custom-control-input status" id="status{{ $admin->id }}"
                                                    data-id="{{ $admin->id }}"
                                                    data-route="{{ route('admin.changestatus', $admin) }}">
                                                <label class="custom-control-label"
                                                    for="status{{ $admin->id }}"></label>
                                            </div>
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.admins.edit', $admin) }}"
                                                class="btn btn-outline-primary btn-sm"><i class="fa fa-pen"></i></a>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">
                                            {{ __('No Admins Found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($admins->hasPages())
                    <div class="card-footer">
                        {{ $admins->links() }}
                    </div>
                @endif
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
                placeholder: "Give Permission",
                tags: true,
                tokenSeparators: [',', ' ']
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


            $('.add').on('click', function() {
                const modal = $('#role')


                modal.modal('show')
            })


            $('.edit').on('click', function() {
                const modal = $('#role_edit')

                modal.find('input[name=role]').val($(this).data('name'));

                modal.find('form').attr('action', $(this).data('href'));


                modal.find('.js-example-tokenizer').val($(this).data('permission')).trigger('change')

            

                modal.modal('show')
            })

        })
    </script>
@endpush
