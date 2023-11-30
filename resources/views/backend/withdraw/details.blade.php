@extends('backend.layout.master')

@section('element')
    <div class="row">

        <div class="col-lg-4 col-sm-6">
            <div class="card rounded-xl link-item">
                <div class="sp-widget-1 sp-widget-1-two card-body justify-content-between p-3">
                    <div class="widget-content pl-0 pr-3">
                        <div>{{ __('Total Withdraw') }}</div>
                        <h4 class="mb-0 mt-1"> {{ Config::formatter($total)}}</h4>
                    </div>
                    <div class="widget-icon avatar-icon-1 widget-icon-two rounded-xl">
                        <i class="las la-money-bill-wave"></i>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-4 col-sm-6">
            <div class="card rounded-xl link-item">
                <div class="sp-widget-1 sp-widget-1-two card-body justify-content-between p-3">
                    <div class="widget-content pl-0 pr-3">
                        <div>{{ __('Pending Withdraw') }}</div>
                        <h4 class="mb-0 mt-1"> {{ Config::formatter($pending)}}</h4>
                    </div>
                    <div class="widget-icon avatar-icon-3 widget-icon-two rounded-xl">
                        <i class="las la-money-bill-wave"></i>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-4 col-sm-6">
            <div class="card rounded-xl link-item">
                <div class="sp-widget-1 sp-widget-1-two card-body justify-content-between p-3">
                    <div class="widget-content pl-0 pr-3">
                        <div>{{ __('Rejected Withdraw') }}</div>
                        <h4 class="mb-0 mt-1"> {{ Config::formatter($rejected)}}</h4>
                    </div>
                    <div class="widget-icon avatar-icon-2 widget-icon-two rounded-xl">
                        <i class="las la-money-bill-wave"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <canvas id="current" width="400" height="250"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <canvas id="previous" width="400" height="250"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <canvas id="full" width="400" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h4>{{__('Withdraw Logs')}}</h4>
                    <form method="GET" action="">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" placeholder="Search Transaction Id" name="search">
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
                                    <th>{{ __('Withdraw Amount') }}</th>
                                    <th>{{ __('User Will Get') }}</th>
                                    <th>{{ __('Charge Type') }}</th>
                                    <th>{{ __('Charge') }}</th>
                                    <th>{{ __('status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($logs as $key => $withdrawlog)
                                    <tr>
                                        <td>{{ $withdrawlog->trx }}</td>

                                        <td>{{ Config::formatter($withdrawlog->withdraw_amount)}}
                                        </td>
                                        <td>

                                            {{ Config::formatter($withdrawlog->total) }}

                                        </td>
                                        <td>
                                            {{ ucwords($withdrawlog->withdrawMethod->type) }}
                                        </td>
                                        <td>
                                            {{ Config::formatter($withdrawlog->withdraw_charge)}}
                                        </td>
                                        <td>
                                            @if ($withdrawlog->status == 1)
                                                <span class="badge badge-outline-success">{{ __('Success') }}</span>
                                            @elseif($withdrawlog->status == 2)
                                                <span class="badge badge-outline-danger">{{ __('Rejected') }}</span>
                                            @else
                                                <span class="badge badge-outline-warning">{{ __('Pending') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary details"
                                                data-user_data="{{ json_encode($withdrawlog->proof) }}"
                                                data-transaction="{{ $withdrawlog->trx }}"
                                                data-provider="{{ $withdrawlog->user->username }}"
                                                data-method_name="{{ $withdrawlog->withdrawMethod->name }}"
                                                data-date="{{ __($withdrawlog->created_at->format('d F Y')) }}"><i
                                                    class="fa fa-eye"></i></button>
                                            @if ($withdrawlog->status == 0)
                                                <button class="btn btn-sm btn-outline-success accept"
                                                    data-url="{{ route('admin.withdraw.accept', $withdrawlog) }}"><i
                                                        class="fa fa-check"></i></button>
                                                <button class="btn btn-sm btn-outline-danger reject"
                                                    data-url="{{ route('admin.withdraw.reject', $withdrawlog) }}"><i
                                                        class="fa fa-times"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">{{ __('No Data Found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($logs->hasPages())
                    <div class="card-header">

                        {{ $logs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">


            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Withdraw Details') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="withdraw-details">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>

                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="accept" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true"> 
        <div class="modal-dialog" role="document"> 
            <form action="" method="post"> 
                @csrf 
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Withdraw Accept') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Are you sure to Accept this withdraw request') }}?</p>
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
    <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Withdraw Reject') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="">{{ __('Reason Of Reject') }}</label>
                        <textarea name="reason_of_reject" id="" cols="30" rows="10" class="form-control"> </textarea>
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

@push('external-script')
    <script src="{{ Config::jsLib('backend', 'chartjs.min.js') }}"></script>
@endpush

@push('script')
    <script>
        $(function() {
            'use strict'
            $('.details').on('click', function() {
                const modal = $('#details');
                let html = `
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Withdraw Method Email') }}
                            <span>${$(this).data('user_data').email}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Withdraw Account Information') }}
                            <span>${$(this).data('user_data').account_information}</span>
                        </li> 
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Transaction Id') }}
                            <span>${$(this).data('transaction')}</span>
                        </li>  
                        
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('User Name') }}
                            <span>${$(this).data('provider')}</span>
                        </li> 
                        
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Withdraw Method') }}
                            <span>${$(this).data('method_name')}</span>
                        </li> 
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Withdraw Date') }}
                            <span>${$(this).data('date')}</span>
                        </li> 
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Note For Withdraw') }}
                            <span>${$(this).data('user_data').note}</span>
                        </li>
                        
                    </ul>
                `;
                modal.find('.withdraw-details').html(html);
                modal.modal('show');
            })

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

        const current = document.getElementById("current").getContext('2d');
        const previous = document.getElementById("previous").getContext('2d');
        const full = document.getElementById("full").getContext('2d');

        new Chart(current, {
            type: 'bar',
            data: {
                defaultFontFamily: 'Poppins',
                labels: @json($currentMonthDay),
                datasets: [{
                    label: "Current Month Withdraw",
                    data: @json($currentMonthWithdraw),
                    borderColor: 'rgba(26, 51, 213, 1)',
                    borderWidth: "0",
                    backgroundColor: 'rgba(26, 51, 213, 1)'
                }]
            },
            options: {
                legend: false,

            }
        });

        new Chart(previous, {
            type: 'bar',
            data: {
                defaultFontFamily: 'Poppins',
                labels: @json($previousMonthDay),
                datasets: [{
                    label: "Previous Month Withdraw",
                    data: @json($previousMonthWithdraw),
                    borderColor: 'rgba(26, 51, 213, 1)',
                    borderWidth: "0",
                    backgroundColor: 'rgba(26, 51, 213, 1)'
                }]
            },
            options: {
                legend: false,

            }
        });

        new Chart(full, {
            type: 'bar',
            data: {
                defaultFontFamily: 'Poppins',
                labels: @json($lastYearMonth),
                datasets: [{
                    label: "Full Year Withdraw",
                    data: @json($lastYearWithdraw),
                    borderColor: 'rgba(26, 51, 213, 1)',
                    borderWidth: "0",
                    backgroundColor: 'rgba(26, 51, 213, 1)'
                }]
            },
            options: {
                legend: false,
            }
        });
    </script>
@endpush