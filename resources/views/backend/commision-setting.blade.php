@extends('backend.layout.master')

@section('element')
    <div class="row card">
        <div class="col-md-12">
            <div class="">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                    <h4>{{ __('Upload KYC Documents') }}</h4>

                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.commision-save') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <div class="col-6">
                                <label for="">Select Account Type</label>
                                <select name="acc_type" id="" class="form-control" required>
                                    <option value=""></option>
                                    <option value="standard">Standard Account</option>
                                    <option value="vip">VIP Account</option>
                                </select>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="">Commision %</label>
                                <input type="text" name="commision_percent" class="form-control" required id="">
                            </div>

                            <div class="col-6 mt-2">
                                <button type="submit" class="btn btn-primary ">
                                    <i class="fas fa-sync-alt"></i>
                                    {{ 'Update' }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
