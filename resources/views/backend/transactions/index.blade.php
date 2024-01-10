@extends('backend.layout.master')

@section('element')
    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">

                <div class="card-header">
                    <form action="" method="get">
                        <div class="input-group">

                            <input type="text" name="date" class="form-control form-control-sm datepicker"
                                placeholder="dates" autocomplete="off">
                            <button class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th>{{ __('Sr') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Account') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Trans. Type') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    @foreach ($user->accounts as $key => $acc)
                                        <form id="" action="{{ route('admin.transac.store') }}" method="POST">
                                            @csrf
                                            <tr>
                                                <td>
                                                    <span>
                                                        {{ $key + 1 }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>
                                                        {{ $acc->user->username }}
                                                    </span>
                                                </td>
                                                <td> <span>
                                                        {{ $acc->user?->email }}
                                                    </span></td>
                                                <td> <span>
                                                        {{ $acc['login'] }}

                                                    </span></td>
                                                <td>
                                                    <input type="number" name="amount"
                                                        class="form-control form-control-sm" required>
                                                </td>

                                                <td>
                                                    <select name="transac_type" class="form-control form-control-sm"
                                                        id="transac_type" required>

                                                        <option value="dep">Deposit</option>
                                                        <option value="with">Winthdraw</option>

                                                    </select>
                                                </td>
                                                <td>

                                                    <input type="hidden" name="login" value="{{ $acc['login'] }}" />
                                                    <input type="hidden" name="user_id" value="{{ $acc['user_id'] }}" />
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                        href="">Submit</button>

                                                </td>
                                            </tr>
                                        </form>
                                    @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($users->hasPages())
                    {{ $users->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection
