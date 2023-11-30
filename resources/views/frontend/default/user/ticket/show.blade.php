@extends(Config::theme() . 'layout.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sp_site_card">
                <div class="card-header d-flex justify-content-between">
                    <h4>{{ $ticket->support_id }} - {{ $ticket->subject }} </h4>

                    <a href="{{ route('user.ticket.index') }}" class="color-change"><i class="fas fa-arrow-left"></i>
                        {{ __('Back to Ticket List') }}</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.ticket.reply', $ticket->id) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row justify-content-md-between">
                            <div class="col-md-12">
                                <div class="form-group ticket-comment-box">
                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                    <label for="exampleFormControlTextarea1">{{ __('Message') }}</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 form-group mt-3">
                                <div id="image-preview" class="image-preview">
                                    <label for="image-upload" id="image-label">{{ __('Choose File') }}</label>
                                    <input type="file" name="file" id="image-upload" class="form-control" />
                                </div>
                            </div>

                            <div class="col-lg-12 mt-3 text-end">
                                <button type="submit" class="btn sp_theme_btn ticket-reply"><i class="fas fa-reply me-2"></i>
                                    {{ __('Reply') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="ticket-reply-area">
                        @forelse($ticket_reply as $ticket)
                            <div class="single-reply {{ $ticket->admin_id != null ? 'admin-reply' : '' }} mt-5">
                                <span class="text-small sp_text_secondary mb-2">{{ 'Reply In' }}
                                    {{ $ticket->created_at->format('Y-m-d H:i:s') }}</span>
                                <p>
                                    {{ $ticket->message }}
                                </p>
                                @if ($ticket->file)
                                    <p class="mb-0 mt-2">
                                        <a class="color-change" href="{{ route('user.ticket.download', $ticket->id) }}"> <i
                                                class="fas fa-cloud-download-alt"></i> {{ __('View Attachement') }}</a>
                                    </p>
                                @endif
                            </div>
                            <hr>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
