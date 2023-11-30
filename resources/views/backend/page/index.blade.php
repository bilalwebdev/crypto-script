@extends('backend.layout.master')

@section('element')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header site-card-header justify-content-between">
                    <div class="card-header-left">
                        <h4>{{ __('All Pages') }}</h4>
                    </div>
                    <div class="card-header-right">
                        <a href="{{ route('admin.frontend.pages.create') }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus mr-2"></i>
                            {{ __('Create Page') }}
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table" id="example">
                            <thead>
                                <tr>

                                    <th>{{ __('Page Name') }}</th>
                                    <th>{{ __('Page Order') }}</th>
                                    <th>{{ __('Dropdown') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pages as $key => $page)
                                    <tr>

                                        <td>
                                            {{ $page->name }}
                                        </td>

                                        <td>
                                            {{ $page->order }}
                                        </td>

                                        <td>
                                            @if ($page->is_dropdown)
                                                <span class="badge badge-primary">{{ __('Yes') }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ __('No') }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($page->status)
                                                <span class="badge badge-success">{{ __('Active') }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ __('In active') }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.frontend.pages.edit', $page) }}"
                                                class="btn btn-sm btn-outline-primary edit">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            @if (!$loop->first)
                                                <a href="#" class="btn btn-sm btn-outline-danger delete"
                                                    data-url="{{ route('admin.frontend.pages.delete', $page) }}"><i
                                                        class="fa fa-trash"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center text-danger" colspan="100%">
                                            {{ __('No Data Found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($pages->hasPages())
                    <div class="card-footer">
                        {{ $pages->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>



    <div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Delete Page') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf

                        <p>{{ __('Are You Sure To Delete Pages') }}?</p>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-sm btn-secondary text-dark mr-3"
                                data-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete Page') }}</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        'use strict'
        $(function() {
            $('.delete').on('click', function() {
                const modal = $('#deleteModal');

                modal.find('form').attr('action', $(this).data('url'))
                modal.modal('show')
            })
        })
    </script>
@endpush
