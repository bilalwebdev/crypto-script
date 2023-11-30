@extends('backend.layout.master')


@section('element')
    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    @include('backend.logs.tab_list')
                </div>
            </div>

            <div class="card">

                <div class="card-header">
                    <form action="" method="get">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control form-control-sm"
                                placeholder="transaction id">
                            <a href="javascript:void(0)"
                                class="btn btn-outline-secondary rounded-0 daterange-btn btn-sm btn-d icon-left btn-icon filterData"><i
                                    class="fas fa-calendar"></i> {{ __('Filter By Date') }}
                            </a>
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
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
                                    <th>{{ __('Gateway') }}</th>
                                    <th>{{ __('User') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Charge') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody id="filter_data">
                                @forelse ($deposits as $key => $manual)
                                    <tr>
                                        <td>{{ $manual->trx }}</td>
                                        <td>{{ $manual->gateway->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.user.details', $manual->user->id) }}">
                                                <img src="{{ Config::getFile('user', $manual->user->image, true) }}" alt=""
                                                    class="image-table">
                                                <span>
                                                    {{ $manual->user->username }}
                                                </span>
                                            </a>
                                        </td>
                                        <td>{{ Config::formatter($manual->amount, 2) . ' ' . Config::config()->currency }}
                                        </td>
                                        <td>
                                            {{ Config::formatter($manual->charge, 2) . ' ' . Config::config()->currency }}
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
                                            {{$manual->created_at->format('d M ,Y')}}
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-primary details"
                                                href="{{ route('admin.deposit.details', $manual->trx) }}">
                                                <i class="far fa-eye"></i></a>

                                            @if ($manual->status == 2)
                                                <a class="btn  btn-sm btn-outline-primary accept"
                                                    data-url="{{ route('admin.deposit.accept', $manual->trx) }}"><i
                                                        class="fas fa-check"></i></a>
                                                <a class="btn  btn-sm btn-outline-danger reject"
                                                    data-url="{{ route('admin.deposit.reject', $manual->trx) }}"><i
                                                        class="fas fa-times"></i></a>
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
                    <div class="card-footer">
                        {{ $deposits->links() }}
                    </div>
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
                        <button type="button" class="btn btn-secondary text-dark"
                            data-dismiss="modal">{{ __('Close') }}</button>
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
                        <button type="button" class="btn btn-secondary text-dark"
                            data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('Reject') }}</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .ranges {
            padding: 10px !important;
            margin-top: 10px !important;
        }

        .daterangepicker .ranges li.active {
            background-color: #6777ee !important;
        }

        .daterangepicker .ranges li:hover {
            background-color: #f5f5f5 !important;
            color: #6777ee;
        }

        #overlay {
            position: fixed;
            top: 0;
            z-index: 100;
            width: 100%;
            height: 100%;
            display: none;
            background: rgba(0, 0, 0, 0.6);
        }

        .cv-spinner {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 4px #ddd solid;
            border-top: 4px #068cfa solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }

        @keyframes sp-anime {
            100% {
                transform: rotate(360deg);
            }
        }

        .is-hide {
            display: none;
        }
    </style>
@endpush
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

            $('.daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            }, function(start, end) {
                $('.daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                    'MMMM D, YYYY'))
            });


            $('.ranges ul li').each(function(index) {
                $(this).on('click', function() {
                    let key = $(this).data('range-key')
                    $("#overlay").fadeIn(300);
                    $.ajax({
                        url: "{{ route('admin.deposit.log') }}",
                        data: {
                            key: key
                        },
                        method: "GET",
                        success: function(response) {

                            $('#filter_data').html(response);
                        },
                        complete: function() {
                            $("#overlay").fadeOut(300);
                        }

                    })


                })
            })


            $(document).on('click', '.applyBtn', function() {

                let date = $('.drp-selected').text()

                let key = 'Custom Range'

                $("#overlay").fadeIn(300);

                $.ajax({
                    url: "{{ route('admin.deposit.log') }}",
                    data: {
                        key: key,
                        date: date
                    },
                    method: "GET",
                    success: function(response) {

                        $('#filter_data').html(response);
                    },
                    complete: function() {
                        $("#overlay").fadeOut(300);
                    }

                })
            })

            $(document).on('click', '.accept' ,function() {
                const modal = $('#accept');

                modal.find('form').attr('action', $(this).data('url'));
                modal.modal('show');
            })

            $(document).on('click','.reject', function() {
                const modal = $('#reject');

                modal.find('form').attr('action', $(this).data('url'));
                modal.modal('show');
            })

        })
    </script>
@endpush
