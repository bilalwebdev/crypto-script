@extends(Config::theme() . 'layout.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sp_site_card">
                <div class="card-header d-flex justify-content-between">
                 
                   <h5 class="mb-0 fw-medium">{{ __('Payment Methods') }}</h5>

                    <button id="new_p_method" class="btn sp_theme_btn btn-sm">{{ __('Create Payment Method ') }} </button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table sp_site_table">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($p_methods as $p_method)
                                    <tr>
                                        <td data-caption="{{ __('Name') }}">{{ $p_method->name }}</td>
                                       <td>
                                           <div class="custom-control custom-switch">
                                                <input type="checkbox" name="status" {{ $p_method->status ? 'checked' : '' }}
                                                    class="custom-control-input status" id="status{{ $p_method->id }}"
                                                    data-id="{{ $p_method->id }}"
                                                    data-route="{{ route('user.user-payment-method.changestatus', $p_method) }}">
                                                <label class="custom-control-label"
                                                    for="status{{ $p_method->id }}"></label>
                                           </div>
                                        </td>
                                       
                                        <td data-caption="{{ __('Action') }}">
                                                 <button data-route="{{ route('user.user-payment-method.update', $p_method->id) }}"
                                                data-p_method="{{ $p_method }}"
                                                data-message="{{ $p_method->where('id', $p_method->id)->first() }}"
                                                class="view-btn view-sp_btn_primary edit-modal"><i
                                                    class="fas fa-pen"></i></button>


                                            <a data-route="{{ route('user.user-payment-method.destroy', $p_method->id) }}"
                                                class="view-btn view-sp_btn_danger delete"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td data-caption="{{ __('Status') }}" class="text-center" colspan="100%">
                                            {{ __('No Data Found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

 

    <div class="modal fade " id="add" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('user.user-payment-method.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ">{{ __('Create Payment Method') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" name="name" class="form-control" required=""
                                        placeholder="{{ __('Name here') }}" value="{{ old('name') }}">
                                </div>

                            </div>
                           <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __('Wallet') }}</label>
                                    <input type="text" name="wallet_address" class="form-control" required=""
                                        placeholder="{{ __('Wallet here') }}" value="{{ old('wallet_address') }}">
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm sp_btn_secondary"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-sm sp_theme_btn">{{ 'Create Payment-Method' }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade " id="edit_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <form  enctype="multipart/form-data" method="post">
                @csrf
                @method('PUT')
              <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ">{{ __('Update Payment Method') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" name="name" class="form-control" required=""
                                        placeholder="{{ __('Name here') }}" value="{{ old('name') }}">
                                </div>

                            </div>
                           <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __('Wallet') }}</label>
                                    <input type="text" name="wallet_address" class="form-control" required=""
                                        placeholder="{{ __('Wallet here') }}" value="{{ old('wallet_address') }}">
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm sp_btn_secondary"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-sm sp_theme_btn">{{ 'Create Payment-Method' }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>




    <div class="modal fade" tabindex="-3" id="delete" role="dialog">
        <div class="modal-dialog" role="document">
            <form  method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-content bg1">
                    <div class="modal-header ">
                        <h5 class="modal-title">{{ __('Delete Payment Metgod') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <p>{{ __('Are you sure to delete this payment method') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm sp_btn_secondary"
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-sm sp_btn_danger">{{ __('Delete') }}</button>
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

            $('#new_p_method').on('click', function() {

                const modal = $('#add');

                modal.modal('show');

            })

            $('.edit-modal').on('click', function(e) {

                e.preventDefault();

                const modal = $('#edit_modal');

                modal.find('form').attr('action', $(this).data('route'));

                modal.find('input[name=name]').val($(this).data('p_method').name)
                modal.find('input[name=wallet_address]').val($(this).data('p_method').wallet_address)
                modal.modal('show');
            })

            $('.delete').on('click', function(e) {

                e.preventDefault();

                const modal = $('#delete');

                modal.find('form').attr('action', $(this).data('route'));

                modal.modal('show');

            })

            $('.status').on('change', function() {

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
