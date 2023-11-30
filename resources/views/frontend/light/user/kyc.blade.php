@extends(Config::theme(). 'layout.auth')

@section('content')
    <div class="row gy-4">

        <div class="col-md-12">
            <div class="sp_site_card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="mb-0">{{ __('KYC Verification') }}</h4>
                    @if (auth()->user()->kyc == 2)
                        <div class="alert alert-warning p-2">
                            <p>{{ __('Kyc Verification Requst is Pending') }}</p>
                        </div>
                    @elseif(auth()->user()->kyc == 3)
                        <div class="alert alert-danger p-2">
                            <p>{{ __('Kyc Verification Requst is Rejected! Please Re-submit again') }}</p>
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            @foreach (Config::config()->kyc as $proof)
                                @if ($proof['type'] == 'text')
                                    <div class="form-group col-md-12">
                                        <label for="" class="mb-2 mt-2">{{ __($proof['field_label']) }}</label>
                                        <input type="text"
                                            name="{{ strtolower(str_replace(' ', '_', $proof['field_name'])) }}"
                                            class="form-control "
                                            {{ $proof['validation'] == 'required' ? 'required' : '' }}>
                                    </div>
                                @endif
                                @if ($proof['type'] == 'textarea')
                                    <div class="form-group col-md-12">
                                        <label for="" class="mb-2 mt-2">{{ __($proof['field_label']) }}</label>
                                        <textarea name="{{ strtolower(str_replace(' ', '_', $proof['field_name'])) }}" class="form-control "
                                            {{ $proof['validation'] == 'required' ? 'required' : '' }}></textarea>
                                    </div>
                                @endif

                                @if ($proof['type'] == 'file')
                                    <div class="form-group col-md-12">
                                        <label for="" class="mb-2 mt-2">{{ __($proof['field_label']) }}</label>
                                        <input type="file"
                                            name="{{ strtolower(str_replace(' ', '_', $proof['field_name'])) }}"
                                            class="form-control "
                                            {{ $proof['validation'] == 'required' ? 'required' : '' }}>
                                    </div>
                                @endif
                            @endforeach


                            <div class="form-group">
                                <button class="btn sp_theme_btn mt-4" type="submit">{{ __('KYC Verification') }}</button>
                            </div>




                        </div>



                    </form>



                </div>

            </div>




        </div>
    </div>
@endsection
