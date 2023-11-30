@extends('backend.layout.master')

@section('element')
    <div class="row withdraw-row"> 
        <div class="col-md-12"> 
            <div class="card"> 
                <div class="card-header site-card-header justify-content-between">
                    <div class="card-header-left">
                        <form method="GET" action="{{ route('admin.withdraw.search') }}">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" placeholder="Search" name="search">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-header-right">
                        <button class="btn btn-sm btn-primary add">
                            <i class="fa fa-plus mr-2"></i>
                            {{ __('Add Withdraw Method') }}
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th>{{ __('Sl') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Charge') }}</th>
                                    <th>{{ __('Charge Type') }}</th>
                                    <th>{{ __('Min Withdraw') }}</th>
                                    <th>{{ __('Max Withdraw') }}</th>
                                    <th>{{ __('status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($withdraws as $key => $withdraw)
                                    <tr>
                                        <td>{{ $key + $withdraws->firstItem() }}</td>
                                        <td>{{ $withdraw->name }}</td>
                                        <td>{{ number_format($withdraw->charge, 2) . ' ' . Config::config()->currency }}</td>
                                        <td>{{ ucwords($withdraw->type) }}</td>
                                        <td>{{ number_format($withdraw->min_withdraw_amount, 2) . ' ' . Config::config()->currency }}
                                        </td>
                                        <td>{{ number_format($withdraw->max_withdraw_amount, 2) . ' ' . Config::config()->currency }}
                                        </td>
                                        <td>
                                            @if ($withdraw->status)
                                                <div class="badge badge-success">{{ __('Active') }}</div>
                                            @else
                                                <div class="badge badge-danger">{{ __('In Active') }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.withdraw.log', $withdraw) }}" class="btn btn-sm btn-outline-info">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <button data-href="{{ route('admin.withdraw.update', $withdraw) }}" data-withdraw="{{ $withdraw }}" class="btn btn-sm btn-outline-primary update">
                                                <i class="fa fa-pen"></i>
                                            </button>
                                            <button data-url="{{ route('admin.withdraw.delete', $withdraw) }}" class="btn btn-sm btn-outline-danger delete">
                                                <i class="fa fa-trash"></i>
                                            </button>
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
                    @if ($withdraws->hasPages())
                        <div class="card-footer">
                            {{ $withdraws->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="" method="post">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="form-group col-md-6 col-12">
                                <label for="">{{ __('Withdraw Method Name') }} <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="">{{ __('Withdraw Method charge Type') }}</label>
                                <select name="charge_type" class="form-control">
                                    <option value="fixed">{{ __('Fixed') }}</option>
                                    <option value="percent">{{ __('Percent') }}</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="">{{ __('Withdraw Method charge') }}</label>
                                <div class="input-group">
                                    <input type="text" name="charge" class="form-control" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            {{ Config::config()->currency }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="">{{ __('Withdraw Min Amount') }}</label>
                                <input type="text" name="min_amount" class="form-control">
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="">{{ __('Withdraw Max Amount') }}</label>
                                <input type="text" name="max_amount" class="form-control">
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="">{{ __('Withdraw Method status') }}</label>
                                <select name="status" class="form-control">
                                    <option value="0">{{ __('Inactive') }}</option>
                                    <option value="1">{{ __('Active') }}</option>
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="">{{ __('Withdraw Instruction') }}</label>
                                <textarea name="withdraw_instruction" id="" cols="30" rows="10" class="form-control summernote">{{ old('withdraw_instruction') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-sm btn-primary">{{ __('Save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Delete Withdraw Method') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Are you sure to delete this method') }}?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary text-dark"
                            data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
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

            $('.add').on('click', function() {
                const modal = $('#modelId');
                modal.find('.modal-title').text("{{ __('Create Withdraw Method') }}")
                modal.find('input[name=name]').val('')
                modal.find('input[name=charge]').val('')
                modal.find('input[name=min_amount]').val('')
                modal.find('input[name=max_amount]').val('')
                modal.find('textarea[name=withdraw_instruction]').val('')
                modal.find('form').attr('action', '');


                modal.modal('show');
            })


            $('.site-currency').on('keyup', function() {
                $('.append_currency').text($(this).val())
            })

            $('.append_currency').text($('.site-currency').val())


            $('.update').on('click', function() {
                const modal = $('#modelId');



                modal.find('.modal-title').text("{{ __('Update Withdraw Method') }}")
                modal.find('input[name=name]').val($(this).data('withdraw').name)
                modal.find('input[name=charge]').val($(this).data('withdraw').charge)
                modal.find('input[name=min_amount]').val($(this).data('withdraw').min_withdraw_amount)
                modal.find('input[name=max_amount]').val($(this).data('withdraw').max_withdraw_amount)
                modal.find('select[name=status]').val($(this).data('withdraw').status)
                modal.find('select[name=charge_type]').val($(this).data('withdraw').type)
                modal.find('textarea[name=withdraw_instruction]').val($(this).data('withdraw')
                    .instruction)
                modal.find('form').attr('action', $(this).data('href'));

                $('.summernote').summernote('code', $(this).data('withdraw').instruction)
                modal.modal('show');
            })

            $('.delete').on('click', function() {
                const modal = $('#delete');
                modal.find('form').attr('action', $(this).data('url'));

                modal.modal('show');
            })
        })
    </script>
@endpush
