@extends('backend.layout.master')

@section('element')
    <div class="row card">
        <div class="">
            <div class="">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                    <h4>{{ __('Commision Setting / Lot') }}</h4>

                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.commision-save') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mt-2 col-md-2 ">
                                <label for="">Level 1:</label>
                                <input type="text" value="{{ $commision->level_1_rate ?? '' }}" name="level_1_rate"
                                    class="form-control" required id="">
                            </div>
                            <div class="mt-2 col-md-2 ">
                                <label for="">Level 2:</label>
                                <input type="text" value="{{ $commision->level_2_rate ?? '' }}" name="level_2_rate"
                                    class="form-control" required id="">
                            </div>
                            <div class="mt-2 col-md-2 ">
                                <label for="">Level 3:</label>
                                <input type="text" value="{{ $commision->level_3_rate ?? '' }}" name="level_3_rate"
                                    class="form-control" required id="">
                            </div>
                            <div class="mt-2 col-md-2 ">
                                <label for="">Level 4:</label>
                                <input type="text" value="{{ $commision->level_4_rate ?? '' }}" name="level_4_rate"
                                    class="form-control" required id="">
                            </div>
                            <div class="mt-2 col-md-2 ">
                                <label for="">Level 5:</label>
                                <input type="text" value="{{ $commision->level_5_rate ?? '' }}" name="level_5_rate"
                                    class="form-control" required id="">
                            </div>


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


        </div>

    </div>
@endsection
