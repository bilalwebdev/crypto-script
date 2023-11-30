@extends('backend.layout.master')


@section('element')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header site-card-header justify-content-between">
                    <div class="card-header-left">
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control form-control-sm" placeholder="Plan Name">
                                <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="card-header-right">
                        <a href="{{ route('admin.plan.create') }}" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i>
                            {{ __('Create Plan') }}</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th>{{ __('SL') }}.</th>
                                    <th>{{ __('Plan Name') }}</th>
                                    <th>{{ __('Plan Type') }}</th>
                                    <th>{{ __('Price Type') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Duration') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($plans as $plan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $plan->name }}</td>
                                        <td>
                                            <span class="badge badge-info">{{ $plan->plan_type }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary">{{ $plan->price_type }}</span>
                                        </td>
                                        <td>{{ Config::formatter($plan->price) }}</td>
                                        <td>{{ ($plan->duration ?? 0) . ' Days' }}</td>
                                        <td>

                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="status" {{ $plan->status ? 'checked' : '' }}
                                                    class="custom-control-input plan_status" id="status{{ $plan->id }}"
                                                    data-id="{{ $plan->id }}"
                                                    data-route="{{ route('admin.plan.changestatus', $plan) }}">
                                                <label class="custom-control-label"
                                                    for="status{{ $plan->id }}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.plan.edit', $plan->id) }}"
                                                class="btn btn-sm btn-outline-primary"><i
                                                    class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">
                                            {{ __('No Plan Created Yet') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($plans->hasPages())
                    <div class="card-footer">
                        {{ $plans->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection



@push('script')
    <script>
        $(function() {
            'use strict'

            $('.plan_status').on('change', function() {

                let id = $(this).data('id');
                let route = $(this).data('route');

                $.ajax({

                    url: route,
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        @include('backend.layout.ajax_alert', [
                            'message' => 'Successfully change status',
                            'message_error' => '',
                        ])
                    }

                })




            })
        })
    </script>
@endpush
