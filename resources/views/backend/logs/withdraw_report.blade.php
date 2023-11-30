@extends('backend.layout.master')

@section('element')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    @include('backend.logs.tab_list')
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <form action="">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control form-control-sm"
                                placeholder="Search Trx">
                            <a href="javascript:void(0)"
                                class="btn btn-outline-secondary daterange-btn btn-sm btn-d icon-left btn-icon filterData"><i
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
                                    <th>{{ __('Trx') }}</th>
                                    <th>{{ __('User') }}.</th>
                                    <th>{{ __('Gateway') }}</th>
                                    <th>{{ __('Withdraw Amount') }}</th>
                                    <th>{{ __('Charge') }}</th>
                                    <th>{{ __('Getable Amount') }}</th>
                                    <th>{{ __('Withdraw Date') }}</th>
                                </tr>
                            </thead>
                            <tbody id="filter_data">

                                @forelse($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->trx }}</td>
                                        <td>
                                            <a href="{{ route('admin.user.details', $transaction->user->id) }}">
                                                <img src="{{ Config::getFile('user', $transaction->user->image, true) }}"
                                                    alt="" class="image-table">
                                                <span>
                                                    {{ $transaction->user->username }}
                                                </span>
                                            </a>
                                        </td>
                                        <td>{{ optional($transaction->withdrawMethod)->name }}</td>
                                        <td>{{ Config::formatter($transaction->withdraw_amount) }}</td>
                                        <td>{{ Config::formatter($transaction->withdraw_charge) }}</td>
                                        <td>{{ Config::formatter($transaction->total) }}</td>
                                        <td>{{ $transaction->created_at->format('d M , Y') }}</td>



                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">{{ __('No Data Found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

                </div>

                @if ($transactions->hasPages())
                    <div class="card-footer">
                        {{ $transactions->links() }}
                    </div>
                @endif
            </div>
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




@push('script')
    <script>
        'use strict'
        $(function() {

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
                        url: "{{ route('admin.withdraw.report') }}",
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
                    url: "{{ route('admin.withdraw.report') }}",
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



        })
    </script>
@endpush
