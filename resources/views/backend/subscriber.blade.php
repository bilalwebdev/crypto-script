@extends('backend.layout.master')


@section('element')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header justify-content-end">
                    <button class="btn btn-primary btn-sm sendMail"><i class="fas fa-mail-bulk"></i>
                        {{ __('Bulk Mail') }}</button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th>{{ __('SL') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Subscription Date') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subscribers as $subscribe)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $subscribe->email }}</td>
                                        <td>{{ $subscribe->created_at->format('dS M ,Y') }}</td>
                                        <td>
                                            <button class="btn btn-outline-primary btn-sm singlemail" data-url="{{route('admin.subscribers.single', $subscribe->email)}}"><i
                                                    class="fas fa-envelope"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>

                                        <td class="text-center" colspan="100%">
                                            {{ __('No Data Found') }}
                                        </td>

                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($subscribers->hasPages())
                    <div class="card-footer">
                        {{ $subscribers->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="mail">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('admin.subscribers.bulk') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Send Mail to user') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">{{ __('Subject') }}</label>
                            <input type="text" name="subject" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('Message') }}</label>
                            <textarea name="message" id="" cols="30" rows="10" class="form-control summernote"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="las la-envelope"></i>
                            {{ __('Send Mail') }}</button>
                        <button type="button" class="btn btn-sm btn-danger"
                            data-dismiss="modal">{{ __('Close') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="singlemail">
        <div class="modal-dialog modal-lg" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Send Mail to user') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">{{ __('Subject') }}</label>
                            <input type="text" name="subject" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('Message') }}</label>
                            <textarea name="message" id="" cols="30" rows="10" class="form-control summernote"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="las la-envelope"></i>
                            {{ __('Send Mail') }}</button>
                        <button type="button" class="btn btn-sm btn-danger"
                            data-dismiss="modal">{{ __('Close') }}</button>
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
            $('.sendMail').on('click', function(e) {
                e.preventDefault();
                const modal = $('#mail');
                modal.modal('show');
            })

            $('.singlemail').on('click', function(e) {
                e.preventDefault();
                const modal = $('#singlemail');

                modal.find('form').attr('action', $(this).data('url'));
                modal.modal('show');
            })
        })
    </script>
@endpush
