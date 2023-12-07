@extends('backend.layout.master')

@section('element')
    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">

                <div class="card-body text-center">
                    <ul class="list-group">

                        @if ($info['kycinfo'] != null)
                            @foreach ($info['kycinfo'] as $key => $proof)
                                @if (is_array($proof))
                                    <li class="list-group-item d-flex justify-content-between" style="">

                                        <span style="white-space: nowrap">
                                            @if ($proof['type'] == 'proof_id1')
                                                {{ __('Proof of ID 1') }}
                                            @elseif ($proof['type'] == 'proof_id2')
                                                {{ __('Proof of ID 2') }}
                                            @elseif ($proof['type'] == 'proof_address1')
                                                {{ __('Proof of Address 1') }}
                                            @else
                                                {{ __('Proof of Address 2') }}
                                            @endif
                                        </span>
                                        <span class="text-right"><img src="{{ asset('asset/images/kyc/' . $proof['file']) }}"
                                                alt="" class="w-50 "></span>

                                    </li>

                                    @continue
                                @endif

                                <li class="list-group-item d-flex justify-content-between">

                                    <span>{{ __(str_replace('_', ' ', ucwords($key))) }}</span>
                                    <span>{{ __($proof) }}</span>

                                </li>
                            @endforeach
                        @endif

                    </ul>


                    @if ($info['is_kyc_verified'] == 2)
                        <div class="col-md-12 mt-4 text-right">

                            <button class="btn btn-success approve"
                                data-url="{{ route('admin.user.kyc.status', ['approve', $info['id']]) }}">
                                <i class="fa fa-check"></i>
                                {{ __('Approve') }}
                            </button>


                            <button class="btn btn-danger reject"
                                data-url="{{ route('admin.user.kyc.status', ['reject', $info['id']]) }}">
                                <i class="fa fa-times"></i>
                                {{ __('Reject') }}
                            </button>
                        </div>
                    @endif






                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="approve" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('KYC Request Update') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Are You Sure to Approve?') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Approve') }}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="reject" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('KYC Request Update') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Are You Sure to Reject?') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Reject') }}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            'use strict'

            $('.approve').on('click', function() {
                const modal = $('#approve')


                modal.find('form').attr('action', $(this).data('url'))


                modal.modal('show')
            })


            $('.reject').on('click', function() {
                const modal = $('#reject')


                modal.find('form').attr('action', $(this).data('url'))


                modal.modal('show')
            })
        })
    </script>
@endpush
