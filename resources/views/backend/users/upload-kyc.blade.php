@extends('backend.layout.master')


@section('element')
    <div class="row card">
        <div class="col-md-12">
            <div class="">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                    <h4>{{ __('Upload KYC Documents') }}</h4>

                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('admin/user/kyc-submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <div class="col-6">
                                <label for="">Select Document Type</label>
                                <select name="file_type" id="" class="form-control" required>
                                    <option value=""></option>
                                    <option value="proof_id">Identity Proof</option>
                                    <option value="proof_address">Address Proof</option>
                                </select>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="">Select Document</label>
                                <input type="file" name="file" class="form-control" required id="">
                            </div>
                            <input type="hidden" name="user_id" value="{{ $user_id }}" class="form-control"
                                id="">
                            <div class="col-6 mt-2">
                                <button type="submit" class="btn btn-md btn-primary ">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
