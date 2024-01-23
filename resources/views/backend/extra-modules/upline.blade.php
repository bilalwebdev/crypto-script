@extends('backend.layout.master')

@section('element')
    <div class="card">
        <div class="card-body">
            <table id="example" class="table table-striped" style="width:100%; padding:10px;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Account No.</th>
                        <th>Email</th>
                        <th>Sponsor</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    @endforeach
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>2233</td>
                        <td>{{ $user->email }}</td>
                        <td>2233</td>
                        <td><a href="{{ route('admin.upline.check', $user->id) }}" class="btn btn-info btn-sm">
                                <i class="las la-arrow-up"></i>
                                Check Upline</a></td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>
@endsection
@push('script')
    <script>
        new DataTable('#example');
    </script>
@endpush
