@extends('backend.layout.master')


@section('element')
    <div class="row">

        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    @include('backend.users.tab_list')
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <form action="" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" placeholder="username or email or phone"
                                name="search">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" type="submit"> <i class="fa fa-search"></i>
                                    {{ __('Search') }}</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>

                                    <th>{{ __('Sl') }}</th>
                                    <th>{{ __('Username') }}</th>
                                    <th>{{ __('Phone') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Country') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>

                                </tr>

                            </thead>

                            <tbody id="filter_data">

                                @forelse($infos as $key => $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->address->country ?? 'N/A' }}</td>
                                        <td>

                                            @if ($user->status)
                                                <span class='badge badge-success'>{{ __('Active') }}</span>
                                            @else
                                                <span class='badge badge-danger'>{{ __('Inactive') }}</span>
                                            @endif

                                        </td>

                                        <td>

                                            <a href="{{ route('admin.user.kyc.details', $user) }}"
                                                class="btn btn-sm btn-outline-secondary"><i class="fa fa-eye"></i></a>
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


                @if ($infos->hasPages())
                    <div class="card-footer">
                        {{ $infos->links('backend.partial.paginate') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
