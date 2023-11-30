@extends(Config::theme() . 'layout.auth')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sp_site_card">
                <div class="card-header">
                    <form action="" method="get" class="row justify-content-md-end g-3">
                        <div class="col-auto">
                            <input type="date" class="form-control form-control-sm me-3" placeholder="Search User" name="date">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-sm sp_theme_btn">{{ __('Search') }}</button>
                        </div>
                    </form>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table sp_site_table">
                            <thead>
                                <tr>
                                    <th>{{ __('Commison From') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Commision Date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($commison as $item)
                                    <tr>
                                        <td data-caption="From">
                                            {{ $item->whoSendTheMoney->username }}
                                        </td>
                                        <td data-caption="To">{{ Config::formatter($item->amount) }}</td>
                                        <td data-caption="{{ __('date') }}">{{ $item->created_at->format('d M , Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td data-caption="Data" class="text-center" colspan="100%">{{ __('No Data Found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($commison->hasPages())
                    <div class="card-footer">
                        {{ $commison->links() }}

                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
