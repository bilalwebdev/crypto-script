@extends('backend.layout.master')


@section('element')
    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">

                <div class="card-header">
                    <form action="" method="get">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control form-control-sm" placeholder="transaction id">
                            <input type="text" name="date" class="form-control form-control-sm datepicker" placeholder="dates" autocomplete="off">
                            <button class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th>{{ __('TRX') }}</th>
                                    <th>{{ __('User') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Charge') }}</th>
                                    <th>{{ __('status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($deposits as $key => $manual)
                                    <tr>
                                        <td>{{ $manual->trx }}</td>
                                        <td>
                                            <a href="{{ route('admin.user.details', $manual->user->id) }}">
                                                <img src="{{ Config::getFile('user', $manual->user->image, true) }}"
                                                    alt="" class="image-table">
                                                <span>
                                                    {{ $manual->user->username }}
                                                </span>
                                            </a>

                                           
                                        </td>
                                        <td>{{ Config::formatter($manual->amount)}}</td>
                                        <td>
                                            {{ Config::formatter($manual->charge)}}
                                        </td>
                                        <td>
                                            @if ($manual->status == 2)
                                                <span class="badge badge-warning">{{ __('Pending') }}</span>
                                            @elseif($manual->status == 1)
                                                <span class="badge badge-success">{{ __('Approved') }}</span>
                                            @elseif($manual->status == 3)
                                                <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-primary details"
                                                href="{{ route('admin.deposit.details', $manual->trx) }}">
                                                <i class="far fa-eye"></i></a>

                                            @if ($manual->status == 2)
                                                <a class="btn  btn-sm btn-outline-primary accept"
                                                    data-url="{{ route('admin.deposit.accept', $manual->trx) }}"><i class="fas fa-check"></i></a>
                                                <a class="btn  btn-sm btn-outline-danger reject"
                                                    data-url="{{ route('admin.deposit.reject', $manual->trx) }}"><i class="fas fa-times"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">{{ __('No Data Found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($deposits->hasPages())
                    {{ $deposits->links() }}
                @endif
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="accept" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Payment Accept') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <p>{{ __('Are you sure to Accept this Payment request') }}?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Accept') }}</button>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Payment Reject') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <p>{{ __('Are you sure to reject this payment') }}?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('Reject') }}</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('external-style')
    <link rel="stylesheet" href="{{ Config::cssLib('backend', 'daterangepicker.css') }}">
@endpush

@push('external-script')
    <script src="{{ Config::jsLib('backend', 'moment.js') }}"></script>
    <script src="{{ Config::jsLib('backend', 'daterangepicker.min.js') }}"></script>
@endpush


@push('script')
    <script>
        $(function() {
            'use strict'


            $('input[name="date"]').daterangepicker({

                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="date"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format(
                    'MM/DD/YYYY'));
            });

          

            $('.accept').on('click', function() {
                const modal = $('#accept');

                modal.find('form').attr('action', $(this).data('url'));
                modal.modal('show');
            })

            $('.reject').on('click', function() {
                const modal = $('#reject');

                modal.find('form').attr('action', $(this).data('url'));
                modal.modal('show');
            })

        })
    </script>
@endpush
