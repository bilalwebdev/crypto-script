@extends(Config::theme() . 'layout.auth')


@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="sp_site_card">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                    <h4>{{ __('Profile Settings') }}</h4>
                    <a href="{{ route('user.change.password') }}"
                        class="btn btn-sm sp_theme_btn mb-2">{{ __('Change Password') }}</a>
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

                                    <label for="imageUpload" class="editImg btn btn-md sp_theme_btn w-100">Choose
                                        File</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">

                                    <div class="mb-3 col-md-6">
                                        <label>{{ __('Username') }}</label>
                                        <input type="text" class="form-control text-white" name="username"
                                            value="{{ Auth::user()->username }}" placeholder="{{ __('Enter User Name') }}"
                                            disabled>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label>{{ __('Email address') }}</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ Auth::user()->email }}" placeholder="{{ __('Enter Email') }}"
                                            disabled>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label>{{ __('Phone') }}</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ Auth::user()->phone }}" placeholder="{{ __('Enter Phone') }}">
                                    </div>



                                    <div class="form-group col-md-6 mb-3 ">
                                        <label>{{ __('Country') }}</label>
                                        <input type="text" name="country" class="form-control"
                                            value="{{ optional(Auth::user()->address)->country }}">
                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>{{ __('city') }}</label>
                                        <input type="text" name="city" class="form-control form_control"
                                            value="{{ optional(Auth::user()->address)->city }}">

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>{{ __('zip') }}</label>
                                        <input type="text" name="zip" class="form-control form_control"
                                            value="{{ optional(Auth::user()->address)->zip }}">

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>{{ __('state') }}</label>
                                        <input type="text" name="state" class="form-control form_control"
                                            value="{{ optional(Auth::user()->address)->state }}">

                                    </div>


                                    <div class="col-md-6 mb-3">

                                        <label>{{ __('Telegram Username') }}</label>
                                        <input type="text" name="telegram_id" class="form-control form_control"
                                            value="{{ Auth::user()->telegram_id }}" required>

                                    </div>

                                </div>

                                <button class="btn sp_theme_btn mt-3 w-100">{{ __('Update') }}</button>
                            </div>




                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="sp_site_card">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                    <h4>{{ __('Upload KYC Documents') }}</h4>

                </div>
                <div class="card-body">
                    <form method="post" action="{{ url('/kyc-file-upload') }}" id="uploadForm"
                        enctype="multipart/form-data">
                        <div class="row gy-4 justify-content-center">
                            <div class="col-md-6">
                                <label for="">Select Document Type:</label>
                                <select name="doc_type" id="doc_type" class="form-control">
                                    <option value=""></option>
                                    <option value="proof_id1">Proof of ID 1</option>
                                    <option value="proof_id2">Proof of ID 2</option>
                                    <option value="proof_address1">Proof of Address 1</option>
                                    <option value="proof_address2">Proof of Address 2</option>
                                </select>

                                <img class="rounded doc-id-preview" id="doc-id-preview"
                                    src="{{ Config::getFile('user', Auth::user()->image, true) }}" style="display: none"
                                    alt="pp">

                            </div>

                            <div class="col-md-4 pe-lg-5 mt-4 pe-md-4 justify-content-center">
                                <div class="img-choose-div text-center">
                                    {{-- <p class="mb-2">{{ __('Profile Picture') }}</p> --}}


                                    <input type="file" name="file" id="docUpload" class=""
                                        accept=".png, .jpg, .jpeg" hidden>
                                    <label for="docUpload" class="file-upload" id="upload_label"
                                        style="display: none"></label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="sp_site_card mb-4">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                <h6 class="mb-0 ">Uploaded Documents</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="table-responsive">
                    </div>
                    <table class="table sp_site_table mb-2" name="incidents" id="incidents">
                        <thead>
                            <tr>
                                <th class="default-cell">Type<span uk-icon="triangle-down"
                                        class="ng-star-inserted uk-icon"></span></th>
                                <th class="default-cell">Status<span uk-icon="triangle-down"
                                        class="ng-star-inserted uk-icon"></span></th>
                                <th class="default-cell">Date<span uk-icon="triangle-down"
                                        class="ng-star-inserted uk-icon"></span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($docs->isNotEmpty())
                                @foreach ($docs as $doc)
                                    <tr>
                                        <td>
                                            @if ($doc->type == 'proof_id1')
                                                Proof of ID 1
                                            @elseif ($doc->type == 'proof_id2')
                                                Proof of ID 2
                                            @elseif ($doc->type == 'proof_address1')
                                                Proof of Address 1
                                            @else
                                                Proof of Address 2
                                            @endif
                                        </td>
                                        @if (auth()->user()->is_kyc_verified == 2)
                                            <td> <span class="status-btn status-btn-warning"><i class="fas fa-clock"
                                                        aria-hidden="true"></i>
                                                    Pending</span></td>
                                        @elseif(auth()->user()->is_kyc_verified == 1)
                                            <td> <span class="status-btn status-btn-success">
                                                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                                    Approved</span></td>
                                        @else
                                            <td> <span class="status-btn status-btn-danger">
                                                    <i class="fas fa-ban" aria-hidden="true"></i>
                                                    Rejected</span></td>
                                        @endif

                                        <td>{{ date($doc->created_at) }}</td>

                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>


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

        .doc-id-preview {
            max-height: 200px;
            display: none;
            margin-top: 10px;
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



        $('#doc_type').on('change', () => {

            $('#upload_label').show();

            var val = $('#doc_type').val();

            if (val == 'proof_id1') {
                $('#upload_label').html('Uplaod your Proof of ID 1');
            }
            if (val == 'proof_id2') {
                $('#upload_label').html('Uplaod your Proof of ID 2');
            }
            if (val == 'proof_address1') {
                $('#upload_label').html('Uplaod your Proof of Address 1');
            }
            if (val == 'proof_address2') {
                $('#upload_label').html('Uplaod your Proof of Address 2');
            }
        })
        $('#docUpload').on('change', function() {

            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("doc-id-preview");
                preview.src = src;
                preview.style.display = "block";
                document.getElementById("doc-id-preview").style.visibility = "visible";
            }

            $("#uploadForm").submit();

        });
        // }
    </script>
@endpush
