@extends('backend.layout.master')
@section('element')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header site-card-header justify-content-between">
                    <div class="card-header-left">
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control form-control-sm" placeholder="search ID">
                                <select name="type" id="" class="form-control form-control-sm">
                                    <option value="draft">{{__('Draft')}}</option>
                                    <option value="sent">{{__('Sent')}}</option>
                                </select>
                                <button class="btn btn-sm btn-primary"> <i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="card-header-right">
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.signals.create') }}"> <i class="fa fa-plus"></i>
                            {{ __('Create Signal') }}</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th>{{ __('Signal Id') }}</th>
                                    <th>{{ __('Plans') }}</th>
                                    <th>{{ __('Pair') }}</th>
                                    <th>{{ __('Time Frame') }}</th>
                                    <th>{{ __('Opening point') }}</th>
                                    <th>{{ __('Stop Loss') }}</th>
                                    <th>{{ __('Take Profit') }}</th>
                                    <th>{{ __('Movement Direction') }}</th>
                                    <th>{{ __('Is Sent') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($signals as $signal)
                                    <tr>
                                        <td>{{ $signal->id }}</td>
                                       
                                        <td>
                                            @foreach ($signal->plans as $plan)
                                                <span class="badge badge-info">{{ $plan->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ optional($signal->pair)->name }}
                                        </td>

                                        <td>
                                            {{ optional($signal->time)->name }}
                                        </td>

                                        <td>
                                            {{ $signal->open_price }}
                                        </td>

                                        <td>
                                            {{ $signal->sl }}
                                        </td>

                                        <td>
                                            {{ $signal->tp }}
                                        </td>

                                        <td>
                                            @if ($signal->direction === 'buy')
                                                <span class="badge badge-success">{{ $signal->direction }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ $signal->direction }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($signal->is_published)
                                                <span class="badge badge-success">{{ __('Sent') }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ __('Draft') }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.signals.edit', $signal->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            @if (!$signal->is_published)
                                                <button data-href="{{ route('admin.signals.sent', $signal->id) }}"
                                                    class="btn btn-sm btn-outline-success sent"><i class="fa fa-paper-plane"></i></button>
                                            @endif
                                            <button data-href="{{ route('admin.signals.destroy', $signal->id) }}"
                                                class="btn btn-sm btn-outline-danger delete"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">{{ __('No Signals Found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>

                @if ($signals->hasPages())
                    <div class="card-footer">
                        {{ $signals->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>


    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-exclamation-triangle"></i>
                            {{ __('Confirmation') }} !</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <strong>{{ __('Are you sure you want to Delete') }} ?</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>
                            {{ __('Close') }}</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>
                            {{ __('DELETE') }}</button>

                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" id="sent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-exclamation-triangle"></i>
                            {{ __('Confirmation') }} !</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <strong>{{ __('Are you sure you want to Send This Signal') }} ?</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>
                            {{ __('Close') }}</button>
                        <button type="submit" class="btn btn-success">
                            {{ __('Sent') }}</button>

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

            $('.delete').on('click', function() {
                const modal = $('#delete')

                modal.find('form').attr('action', $(this).data('href'))
                modal.modal('show')
            })

            $('.sent').on('click', function() {
                const modal = $('#sent')

                modal.find('form').attr('action', $(this).data('href'))
                modal.modal('show')
            })
        })
    </script>
@endpush
