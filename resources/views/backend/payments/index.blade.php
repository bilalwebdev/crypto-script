@extends('backend.layout.master')


@section('element')
    <div class="row withdraw-row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form method="GET" action="">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" placeholder="Search" name="search">
                            <input type="text" class="form-control form-control-sm" placeholder="date" name="dates"
                                autocomplete="off">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
                            </div>
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
                                    <th>{{ __('Plan') }}</th>
                                    <th>{{ __('Gateway') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Charge') }}</th>
                                    <th>{{ __('Rate') }}</th>
                                    <th>{{ __('Final Amount') }}</th>
                                    <th>{{ __('Payment date') }}</th>
                                    @if (request()->type == 'offline')
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->trx }}</td>
                                        <td>{{ optional($payment->user)->username }}</td>
                                        <td>{{ optional($payment->plan)->name }}</td>
                                        <td>
                                            <span class="badge badge-primary">
                                                {{ optional($payment->gateway)->name ?? 'Using balance' }}
                                            </span>
                                        </td>
                                        <td>{{ Config::formatter($payment->amount) }}</td>
                                        <td>{{ Config::formatter($payment->charge) }}</td>
                                        <td>{{ Config::formatOnlyNumber($payment->rate) . ' ' . optional($payment->gateway->parameter)->gateway_currency }}
                                        </td>
                                        <td>{{ Config::formatOnlyNumber($payment->total) . ' ' . optional($payment->gateway->parameter)->gateway_currency }}
                                        </td>
                                        <td>{{ $payment->created_at->format('d M, Y') }}</td>
                                        @if (request()->type === 'offline')
                                            <td>
                                                @if ($payment->status == 2)
                                                    <span class="badge badge-warning">{{ __('Pending') }}</span>
                                                @elseif($payment->status == 3)
                                                    <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                                @else
                                                    <span class="badge badge-success">{{ __('Accepted') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-outline-info"
                                                    href="{{ route('admin.payments.details', $payment->id) }}"><i
                                                        class="fas fa-eye"></i></a>
                                                @if ($payment->status == 2)
                                                    <button class="btn btn-sm btn-outline-primary accept"
                                                        data-url="{{ route('admin.payments.accept', $payment->trx) }}"><i
                                                            class="fas fa-check"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger reject"
                                                        data-url="{{ route('admin.payments.reject', $payment->trx) }}"><i
                                                            class="fas fa-times"></i></button>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">{{ __('No Payments Found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($payments->hasPages())
                        <div class="card-footer">
                            {{ $payments->links() }}
                        </div>
                    @endif
                </div>
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
                        <h5 class="modal-title"> <i class="fa fa-check"></i> {{ __('Payment Accept') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <p>{{ __('Are you sure to Accept this Payment request') }}?</p>

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
                        <h5 class="modal-title"> {{ __('Payment Reject') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">{{ __('Reject Reason') }}</label>
                            <textarea name="reason" id="" cols="30" rows="10" class="form-control"></textarea>
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

            $('input[name="dates"]').daterangepicker({

                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
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
