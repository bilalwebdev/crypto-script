@extends('backend.layout.master')


@section('element')
    <div class="row ">
        <div class="col-md-12">
            {{-- <div class="card mb-4">
                <div class="card-body">
                    @include('backend.users.tab_list')
                </div>
            </div> --}}
            <div class="card">
                <div class="card-header site-card-header justify-content-between align-items-center">
                    <div class="card-header-left ">
                        <div class="row gap-2">
                            <form action="" method="get">
                                <div class="input-group flex-wrap user-search-area">
                                    <input type="text" class="form-control form-control-sm"
                                        placeholder="username or email or phone" name="search">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary btn-sm" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="m-1">
                                <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-sm"><i
                                        class="fas fa-plus"></i> Add Wallet</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-header-right">
                        <form action="" method="post">
                            @csrf
                            <div class="row d-flex" style="gap: 5px">
                                <div class="form-group ">
                                    <select name="admin" class="form-control" style="height:35px">

                                        <option value="-">Select Admin</option>
                                        @foreach (@$admins as $key => $admin)
                                            <option value="{{ $key }}">
                                                {{ $admin }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="text" id="checkedUsers" class="form-control d-none" name="checkedUsers">
                                <div class="">
                                    <button class="btn btn-sm btn-primary">{{ __('Submit') }}</button>
                                </div>
                            </div>

                        </form>
                    </div>


                    {{-- <div  class="card-header-right">
                            <button class="btn btn-sm btn-primary sendMail"><i class="las la-mail-bulk mr-2"></i>{{ __('Bulk Mail') }}</button>
                        </div> --}}
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>

                                    <th>{{ __('Sl') }}</th>
                                    <th>{{ __('Username') }}</th>
                                    {{-- <th>{{ __('Acc. No') }}</th> --}}
                                    <th>{{ __('Phone') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Reg. Date') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $key => $user)
                                    <tr onclick="rowSelected({{ $user->id }})" id="user_{{ $user->id }}">
                                        {{-- <td><input type="checkbox" name="user" id="usercheck_{{ $user->id }}"
                                                class="d-none form-input user_check">
                                        </td> --}}
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->username }}</td>
                                        {{-- <td>{{ $user->id }}</td> --}}
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            @if ($user->status)
                                                <span class='badge badge-success'>{{ __('Active') }}</span>
                                            @else
                                                <span class='badge badge-danger'>{{ __('Inactive') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.user.details', $user) }}"
                                                class="btn btn-sm btn-primary">View</a>
                                            <a href="{{ url('admin/user/upload-kyc/' . $user->id) }}"
                                                class="btn btn-info btn-sm">Uplaod Kyc</a>
                                            <a href="" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">{{ __('No Data Found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($users->hasPages())
                    <div class="card-footer">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="mail">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('admin.user.bulk') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Send Mail to user') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">{{ __('Subject') }}</label>
                            <input type="text" name="subject" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('Message') }}</label>
                            <textarea name="message" id="" cols="30" rows="10" class="form-control summernote"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="las la-envelope"></i>
                            {{ __('Send Mail') }}</button>
                        <button type="button" class="btn btn-sm btn-danger"
                            data-dismiss="modal">{{ __('Close') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .bg-blue {
            background-color: #b0bed9;
        }
    </style>
@endpush

@push('script')
    <script>
        $(function() {
            'use strict'
            $('.sendMail').on('click', function(e) {
                e.preventDefault();
                const modal = $('#mail');
                modal.modal('show');
            })
        })

        var user_id = '';
        var usersChecked = [];
        var isChecked = false;

        function rowSelected(id) {
            // alert('#user_' + id);
            user_id = id;
            isChecked = !isChecked;
            $('#usercheck_' + id).prop("checked", isChecked);
            $('.user_check').removeClass('d-none');
            $('#user_' + id).toggleClass('bg-blue');

            usersChecked.push(id);
            // $('#usercheck_' + id).dbclick(function() {
            //     $('#user_' + id).removeClass('bg-gray');
            //     usersChecked.pop(id);
            // });

            $('#checkedUsers').val(usersChecked.join(', '));
        }
    </script>
@endpush
