@extends('backend.layout.master')
@section('element')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('All Email Templates') }}</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th>{{ __('Sl') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Subject') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($emailTemplates as $key => $email)
                                    <tr>
                                        <td>{{ $key + $emailTemplates->firstItem() }}</td>
                                        <td>{{ str_replace('_', ' ', $email->name) }}</td>
                                        <td>{{ $email->subject }}</td>
                                        <td>
                                            @if ($email->status)
                                                <span class="badge badge-success">{{ __('Active') }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.email.templates.edit', $email) }}"
                                                class="btn btn-sm btn-outline-primary"><i class="fa fa-pen"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">{{ __('No Email Template Found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($emailTemplates->hasPages())
                    <div class="card-footer">
                        {{ $emailTemplates->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
