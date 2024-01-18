@extends(Config::theme() . 'layout.auth')
@section('content')

    <div class="dashboard-body-part">
        <div class="sp_site_card row" style="padding: 14px">
            <div class="col-lg-6">
                <h6 class="mb-2">{{ __('Your Referral Link:-    ') }}</h6>
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control copy-text" placeholder="Referral link"
                            value="{{ route('user.register', auth()->user()->username) }}" readonly>
                        <button type="button" class="text-white sp_bg_base btn copy">{{ __('Copy') }}</button>
                    </div>
                </form>

            </div>
            <div class="col-lg-2">
                <div id="copied_msg" class="alert alert-success mt-4 d-none">Copied!</div>
            </div>

        </div>
        <div class="sp_site_card mt-4" style="padding: 18px; font-size:18px;">
            <div class="row">
                <div class="col-md-4">
                    <strong>
                        IB Account no: 3360
                    </strong>
                </div>
                <div class="col-md-4">
                    <strong>
                        Total clients in the network: 2
                    </strong>
                </div>
                <div class="col-md-4">
                    <strong>

                        Total Team Volume : $ 0
                    </strong>
                </div>
                <div class="col-md-4">
                    <strong>
                        Total earned commission: 0 + -
                    </strong>
                </div>
                <div class="col-md-4">
                    <strong>
                        Available for withdrawal : $ 0
                    </strong>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="sp_site_card">
                    <div class="card-header">
                        <h5 class="mb-0 fw-medium">{{ __('Reference Tree') }}</h5>
                    </div>
                    <div class="card-body">
                        @if ($reference->count() > 0)
                            <ul class="sp-referral">
                                <li class="single-child root-child">
                                    <p>
                                        <img src="{{ Config::getFile('user', auth()->user()->image, true) }}">
                                        <span class="mb-0">{{ auth()->user()->username }}</span>
                                    </p>
                                    <ul class="sub-child-list step-2">
                                        @foreach ($reference as $user)
                                            <li class="single-child">
                                                <p>
                                                    <img src="{{ Config::getFile('user', $user->image, true) }}">
                                                    <span class="mb-0">{{ $user->username }}</span>
                                                </p>

                                                <ul class="sub-child-list step-3">
                                                    @foreach ($user->refferals as $ref)
                                                        <li class="single-child">
                                                            <p>
                                                                <img src="{{ Config::getFile('user', $ref->image, true) }}">
                                                                <span class="mb-0">{{ $ref->username }}</span>
                                                            </p>

                                                            <ul class="sub-child-list step-4">
                                                                @foreach ($ref->refferals as $ref2)
                                                                    <li class="single-child">
                                                                        <p>
                                                                            <img
                                                                                src="{{ Config::getFile('user', $ref2->image, true) }}">
                                                                            <span
                                                                                class="mb-0">{{ $ref2->username }}</span>
                                                                        </p>
                                                                    </li>
                                                                @endforeach
                                                            </ul>

                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                            </ul>
                        @else
                            <div class="col-md-12 text-center mt-5">
                                <i class="far fa-folder-open display-1"></i>
                                <p class="mt-2">
                                    {{ __('No Reference User Found') }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .sp-referral {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .sp-referral .single-child {
            padding: 6px 10px;
            border-radius: 5px;
        }

        .sp-referral .single-child+.single-child {
            margin-top: 15px;
        }

        .sp-referral .single-child p {
            display: flex;
            align-items: center;
            margin-bottom: 0;
        }

        .sp-referral .single-child p img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            -o-object-fit: cover;
            border: 2px solid #e5e5e5;
        }

        .sp-referral .single-child p span {
            width: calc(100% - 35px);
            font-size: 14px;
            padding-left: 10px;
        }

        .sub-child-list {
            position: relative;
            padding-left: 35px;
            list-style: none;
            margin-bottom: 0
        }

        .sub-child-list::before {
            position: absolute;
            content: '';
            top: 0;
            left: 17px;
            width: 1px;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.2);
        }

        .sp-referral>.single-child.root-child>p img {
            border: 2px solid #5463ff;
        }

        .sub-child-list>.single-child {
            position: relative;
        }

        .sub-child-list>.single-child::before {
            position: absolute;
            content: '';
            left: -18px;
            top: 21px;
            width: 30px;
            height: 5px;
            border-left: 1px solid rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 0 0 0 5px;
        }

        .sub-child-list.step-2>.single-child>p img {
            border: 2px solid #0aa27c;
        }

        .sub-child-list.step-3>.single-child>p img {
            border: 2px solid #a20a0a;
        }

        .sub-child-list.step-4>.single-child>p img {
            border: 2px solid #f562e6;
        }

        .sub-child-list.step-5>.single-child>p img {
            border: 2px solid #a20a0a;
        }

        #user_action_slider {
            display: none;
        }
    </style>
@endpush

@push('script')
    <script>
        var copyButton = document.querySelector('.copy');
        var copiedMsg = document.querySelector('#copied_msg');
        var copyInput = document.querySelector('.copy-text');
        copyButton.addEventListener('click', function(e) {
            e.preventDefault();
            var text = copyInput.select();
            document.execCommand('copy');
            copiedMsg.classList.remove('d-none');
        });
        copyInput.addEventListener('click', function() {
            this.select();
        });
    </script>
@endpush
