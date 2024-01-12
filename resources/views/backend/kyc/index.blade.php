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
                                    <th>{{ __('Delete') }}</th>
                                    <th>{{ __('Time') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kyc_docs as $key => $doc)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $doc->user->email }}</td>
                                        <td>{{ $doc->type }}</td>
                                        <td><a data-lightbox="roadtrip{{ $doc->id }}"
                                                href="{{ Config::getFile('kyc', $doc->file, true) }}">
                                                <img src="{{ Config::getFile('kyc', $doc->file, true) }}"
                                                    style="width:50px; height:50px; margin-right:8px" alt="">
                                            </a>
                                        <td>{{ $doc->user->username }}</td>
                                        <td>
                                            @if ($doc->status === 1)
                                                <span class="badge badge-success">Approve</span>
                                            @elseif($doc->status === 2)
                                                <span class="badge badge-primary">Pending</span>
                                            @else
                                                <span class="badge badge-danger">Reject</span>
                                            @endif
                                        </td>
                                        <td><a href="{{ route('admin.kyc-doc.approve', $doc->id) }}"
                                                class="btn btn-sm btn-success @if ($doc->status != 2) disabled @endif">Confirm</a>
                                        </td>
                                        <td><a href="{{ route('admin.kyc-doc.reject', $doc->id) }}"
                                                class="btn btn-sm btn-warning @if ($doc->status != 2) disabled @endif">Reject</a>
                                        </td>
                                        <td><a href="{{ route('admin.kyc-doc.delete', $doc->id) }}"
                                                class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                        <td>{{ $doc->created_at }}</td>
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
@push('script')
    <script>
        lightbox.option({
            'resizeDuration': 500,
            'wrapAround': true,
        })
    </script>
@endpush
