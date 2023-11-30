@extends('backend.layout.master')

@section('element')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-wrapper">
                <div class="card-header">
                    <div class="project-status-top">
                        <h4 class="project-status-heading"> {{ __('Subject') }}: {{ $ticket->subject }}</h4>
                        <div>
                            <p class="mb-0">{{ __('Ticket').' '.$ticket->support_id }} {{ __('Created by') }} {{ $ticket->user->username }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.ticket.reply', $ticket->id) }}" enctype="multipart/form-data"
                        method="post">
                        @csrf
                        <div class="row justify-content-md-between">
                            <div class="col-md-12">
                                <div class="form-group ticket-comment-box">
                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                    <label for="exampleFormControlTextarea1">{{ __('Message') }}</label>
                                    <textarea class="form-control textarea" id="exampleFormControlTextarea1" rows="3" name="message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="image-upload">{{ __('Choose File') }}</label>
                                    <input type="file" name="image" class="form-control" id="image-upload" />
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="form-group">
                                    <button type="submit" class="btn cms-submit ticket-reply btn btn-primary">
                                        <i class="fas fa-reply"> </i>
                                        {{ __('Reply') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="ticket-area">
        @foreach ($ticket_reply as $reply)
            <div class="single-reply">
                <div class="d-flex flex-wrap align-items-center">
                    <h5 class="mb-0">
                        {{ __('Reply From - ') }}
                        @if (!$reply->admin_id)
                            {{ $reply->ticket->user->fullname }}
                        @endif
                        @if ($reply->admin_id)
                            {{ $reply->admin->name ?? 'Admin' }}
                        @endif
                    </h5>
                    <p class="mb-0 ml-3">( {{ $reply->created_at->diffforhumans() }} )</p>
                </div>
                <p class="mt-3">{{ $reply->message }}</p>
                @if ($reply->file != null)
                    <div class="gallery">
                        <a href="{{ Config::getFile('Ticket', $reply->file, true) }}" class="glightbox">
                            <img src="{{ Config::getFile('Ticket', $reply->file, true) }}" alt="image" />
                        </a>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
@endsection

@push('external-style')
    <link rel="stylesheet" href="{{ Config::cssLib('backend', 'glightbox.min.css') }}">
@endpush

@push('external-script')
    <script src="{{ Config::jsLib('backend', 'glightbox.min.js') }}"></script>
@endpush

@push('style')
    <style>
        .glightbox img {
            width: 100px;
        }
    </style>
@endpush

@push('script')
    <script>
        $(function() {
            'use strict'

            const lightbox = GLightbox();

            $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "{{ __('Choose File') }}", // Default: Choose File
                label_selected: "{{ __('Update Image') }}", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });
        })
    </script>
@endpush
