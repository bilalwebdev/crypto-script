@extends(Config::theme().'layout.auth')


@section('content')
     <div class="row">
            <div class="col-md-12">
                <div class="sp_site_card">
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                        <h4>{{ __('Profile Settings') }}</h4>
                        <a href="{{ route('user.change.password') }}" class="btn sp_theme_btn mb-2">{{ __('Change Password') }}</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.profileupdate') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row gy-4 justify-content-center">
                                <div class="col-md-4 pe-lg-5 pe-md-4 justify-content-center">
                                    <div class="img-choose-div text-center">
                                        <p class="mb-4">{{ __('Profile Picture') }}</p>
        
                                            <img class=" rounded file-id-preview" id="file-id-preview"
                                                src="{{ Config::getFile('user', Auth::user()->image, true) }}" alt="pp">
        
                                        <input type="file" name="image" id="imageUpload" class="upload"
                                            accept=".png, .jpg, .jpeg" hidden>
        
                                        <label for="imageUpload"
                                            class="editImg btn sp_theme_btn w-100">{{ _('Choose file') }}</label>
        
        
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                       
                                        <div class="mb-3 col-md-6">
                                            <label>{{ __('Username') }}</label>
                                            <input type="text" class="form-control text-white" name="username"
                                                value="{{ Auth::user()->username }}"
                                                placeholder="{{ __('Enter User Name') }}" disabled>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>{{ __('Email address') }}</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ Auth::user()->email }}" placeholder="{{ __('Enter Email') }}" disabled>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>{{ __('Phone') }}</label>
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ Auth::user()->phone }}" placeholder="{{ __('Enter Phone') }}">
                                        </div>
                                    
                                      
        
                                        <div class="form-group col-md-6 mb-3 ">
                                            <label>{{ __('Country') }}</label>
                                            <input type="text" name="country" class="form-control"
                                                value="{{optional( Auth::user()->address)->country }}">
                                        </div>
        
                                        <div class="col-md-6 mb-3">
        
                                            <label>{{ __('city') }}</label>
                                            <input type="text" name="city" class="form-control form_control"
                                                value="{{optional( Auth::user()->address)->city }}">
        
                                        </div>
        
                                        <div class="col-md-6 mb-3">
        
                                            <label>{{ __('zip') }}</label>
                                            <input type="text" name="zip" class="form-control form_control"
                                                value="{{optional( Auth::user()->address)->zip }}">
        
                                        </div>
        
                                        <div class="col-md-6 mb-3">
        
                                            <label>{{ __('state') }}</label>
                                            <input type="text" name="state" class="form-control form_control"
                                                value="{{optional( Auth::user()->address)->state }}">
        
                                        </div>


                                        <div class="col-md-6 mb-3">
        
                                            <label>{{ __('Telegram Username') }}</label>
                                            <input type="text" name="telegram_id" class="form-control form_control"
                                                value="{{Auth::user()->telegram_id }}" required>
        
                                        </div>
        
                                    </div>
        
                                    <button class="btn sp_theme_btn mt-3 w-100">{{ __('Update') }}</button>
                                </div>
        
        
        
        
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
@endsection


@push('style')
    <style>
        .file-id-preview {
            max-height: 300px;
            display: inline-block !important;
        }
    </style>
@endpush


@push('script')
    <script>
        'use strict'

        document.getElementById("imageUpload").onchange = function() {
            show();
        };

        function show() {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-id-preview");
                preview.src = src;
                preview.style.display = "block";
                document.getElementById("file-id-preview").style.visibility = "visible";
            }
        }
    </script>
@endpush
