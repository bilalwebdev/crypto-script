@extends(Config::theme() . 'layout.auth')


@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="sp_site_card">
                <div class="card-header">
                    <h4 class="mb-0">{{ __('Change Password') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update.password') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class=" mt-2 mb-2">{{ __('Old Password') }}</label>
                            <input type="password" class="form-control" name="oldpassword">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class=" mt-2 mb-2">{{ __('New Password') }}</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class=" mt-2 mb-2">{{ __('Confirm Password') }}</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                        <div class="row mt-4">
                            <div class="col-xs-12 d-grid gap-2">
                                <button class="btn sp_theme_btn w-100" type="submit">{{ __('Update') }}</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
