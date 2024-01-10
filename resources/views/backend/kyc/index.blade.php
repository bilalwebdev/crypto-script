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
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Document') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Confirm') }}</th>
                                    <th>{{ __('Reject') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kyc_docs as $key => $doc)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $doc->user->email }}</td>
                                        <td>{{ $doc->type }}</td>
                                        <td><img src="{{ Config::getFile('kyc', $doc->file, true) }}" alt=""
                                                class="" style="width:50px; height:50px; margin-right:8px"></td>
                                        <td>{{ $doc->user->username }}</td>
                                        <td>Pending</td>
                                        <td>Pending</td>
                                        <td>Pending</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
