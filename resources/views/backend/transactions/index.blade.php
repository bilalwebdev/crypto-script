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
                                    {{-- <th>{{ __('Action') }}</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($accounts as $key => $manual)
                                    <tr>

                                        <td>
                                            <span>
                                                {{ $manual->user->username }}
                                            </span>
                                        </td>
                                        <td> <span>
                                                {{ $manual->user?->email }}
                                            </span></td>
                                        <td> <span>
                                                {{ $manual['login'] }}
                                            </span></td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm">
                                        </td>



                                        <td>
                                            <select name="transac_type" class="form-control form-control-sm" id="">
                                                <option value=""></option>
                                                <option value="with">Winthdraw</option>
                                                <option value="with">Deposit</option>
                                            </select>
                                        </td>
                                        <td>
                                            {{-- <a class="btn btn-sm btn-outline-primary details"
                                                href="{{ route('admin.withdraw.details', $manual->id) }}">
                                                <i class="far fa-eye"></i></a> --}}


                                            <a class="btn
                                                  @if ($manual->status != 2) disabled @endif btn-sm btn-outline-primary accept"
                                                data-url="{{ route('admin.withdraw.accept', $manual->id) }}"><i
                                                    class="fas fa-check"></i></a>
                                            <a class="btn @if ($manual->status != 2) disabled @endif  btn-sm btn-outline-danger reject"
                                                data-url="{{ route('admin.withdraw.reject', $manual->id) }}"><i
                                                    class="fas fa-times"></i></a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">{{ __('No Data Found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($withdraws->hasPages())
                    {{ $withdraws->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection
