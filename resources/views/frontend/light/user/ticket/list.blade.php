@extends(Config::theme() . 'layout.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sp_site_card">
                <div class="card-header d-flex justify-content-between">
                    <div class="tab-btn-group">
                        <a href="{{ route('user.ticket.index') }}"
                            class="tab-btn {{ request()->status == '' ? 'active' : '' }}"><i class="fa fa-inbox fa-lg"
                                aria-hidden="true"></i>
                            {{ __('All Ticket') }} <span class="num">{{ $tickets_all }}</span>
                        </a>
                        <a href="{{ route('user.ticket.status', 'answered') }}"
                            class="tab-btn {{ request()->status == 'answered' ? 'active' : '' }}">{{ __('Answered') }}
                            <span class="num">{{ $tickets_answered }}</span>
                        </a>
                        <a href="{{ route('user.ticket.status', 'pending') }}"
                            class="tab-btn {{ request()->status == 'pending' ? 'active' : '' }}">
                            {{ __('Pending') }} <span class="num">{{ $tickets_pending }}</span>
                        </a>
                    </div>

                    <button id="new-ticket" class="btn sp_theme_btn btn-sm">{{ __('Create Ticket') }} <i class="fa fa-envelope"
                            aria-hidden="true"></i></button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table sp_site_table">
                            <thead>
                                <tr>
                                    <th>{{ __('Ticket ID') }}</th>
                                    <th>{{ __('Subject') }}</th>

                                    <th>{{ __('Total Reply') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tickets as $ticket)
                                    <tr>
                                        <td data-caption="{{ __('Ticket ID') }}">{{ $ticket->support_id }}</td>
                                        <td data-caption="{{ __('Subject') }}">{{ $ticket->subject }}</td>

                                        <td data-caption="{{ __('Total Reply') }}">({{ $ticket->ticketReplies()->where('admin_id','!=', null)->count() }})
                                        </td>
                                        <td data-caption="{{ __('Action') }}">
                                            <button data-route="{{ route('user.ticket.update', $ticket->id) }}"
                                                data-ticket="{{ $ticket }}"
                                                data-message="{{ $ticket->ticketReplies()->where('ticket_id', $ticket->id)->first() }}"
                                                class="view-btn view-sp_btn_primary edit-modal"><i
                                                    class="fas fa-pen"></i></button>

                                            <a href="{{ route('user.ticket.show', $ticket->id) }}"
                                                class="view-btn view-sp_btn_info"><i class="fas fa-eye"></i></a>

                                            <a data-route="{{ route('user.ticket.destroy', $ticket->id) }}"
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
            <form action="{{ route('user.ticket.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ">{{ __('Create Ticket') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __('Subject') }}</label>
                                    <input type="text" name="subject" class="form-control" required=""
                                        placeholder="{{ __('subject here') }}" value="{{ old('subject') }}">
                                </div>

                            </div>
                            <div class="row align-items-center mt-2">
                                <div class="col-lg-12">
                                    <div class="form-group ticket-comment-box">
                                        <label for="exampleFormControlTextarea1">{{ __('Message') }}</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" cols="30" name="message"
                                            placeholder="Massage">{{ old('message') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label"
                                            class="">{{ __('Choose File') }}</label>
                                        <input type="file" name="file" id="image-upload" class="form-control" />
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm sp_btn_secondary"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-sm sp_theme_btn">{{ 'Create Ticket' }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade " id="edit_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <form action="" enctype="multipart/form-data" method="post">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ">{{ __('Create Ticket') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __('Subject') }}</label>
                                    <input type="text" name="subject" class="form-control" required=""
                                        placeholder="{{ __('subject here') }}" value="{{ old('subject') }}">
                                </div>

                            </div>
                            <div class="row align-items-center mt-2">
                                <div class="col-lg-12">
                                    <div class="form-group ticket-comment-box">
                                        <label for="exampleFormControlTextarea1">{{ __('Message') }}</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" cols="30" name="message"
                                            placeholder="Massage">{{ old('message') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label"
                                            class="">{{ __('Choose File') }}</label>
                                        <input type="file" name="file" id="image-upload" class="form-control" />
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm sp_btn_secondary"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-sm sp_theme_btn">{{ 'Update Ticket' }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>




    <div class="modal fade" tabindex="-3" id="delete" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-content bg1">
                    <div class="modal-header ">
                        <h5 class="modal-title">{{ __('Delete Support Ticket') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <p>{{ __('Are you sure to delete this ticket') }}</p>
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

            $('#new-ticket').on('click', function() {

                const modal = $('#add');

                modal.modal('show');

            })

            $('.edit-modal').on('click', function(e) {

                e.preventDefault();

                const modal = $('#edit_modal');

                modal.find('form').attr('action', $(this).data('route'));

                modal.find('input[name=subject]').val($(this).data('ticket').subject)
                modal.find('textarea[name=message]').val($(this).data('message').message)

                modal.modal('show');
            })

            $('.delete').on('click', function(e) {

                e.preventDefault();

                const modal = $('#delete');

                modal.find('form').attr('action', $(this).data('route'));

                modal.modal('show');

            })
        })
    </script>
@endpush
