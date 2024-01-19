@extends('backend.layout.master')

@section('element')
    <div class="row card">
        <div class="col-md-6">
            <div class="">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                    <h4>{{ __('Commision Setting') }}</h4>

                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.commision-save') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="">
                            @php
                                $selectedAccType = isset($commision) ? $commision->account_type : null;
                            @endphp
                            <label for="">Select Account Type</label>
                            <select name="acc_type" id="" class="form-control" required>

                                <option value=""></option>
                                <option @if ($selectedAccType == 'standard') selected @endif value="standard">Standard Account
                                </option>
                                <option @if ($selectedAccType == 'vip') selected @endif value="vip">VIP Account
                                </option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="">Commision Rate Per Lot</label>
                            <input type="text" value="{{ $commision->commision_rate ?? '' }}" name="commision_rate"
                                class="form-control" required id="">
                        </div>

                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary ">
                                <i class="fas fa-sync-alt"></i>
                                {{ 'Update' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table student-data-table m-t-20">
                        <thead>
                            <tr>
                                <th>{{ __('Acount Type') }}</th>
                                <th>{{ __('Commision Rate Per Lot') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($com_settings as $setting)
                                <tr>
                                    <td>
                                        @if ($setting->account_type == 'standard')
                                            Standard Account
                                        @else
                                            VIP Account
                                        @endif
                                    </td>
                                    <td>{{ $setting->commision_rate }}</td>
                                    <td>
                                        <a href="{{ route('admin.commision-setting', $setting->id) }}"
                                            class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="100%">
                                        {{ __('No Commision created Yet') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
