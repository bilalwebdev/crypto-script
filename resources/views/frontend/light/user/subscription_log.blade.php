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
                                    <th>{{ __('User') }}</th>
                                    <th>{{ __('Plan') }}</th>
                                    <th>{{ __('Plan Exired At') }}</th>
                                    <th>{{ __('Subscribe At') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($subscriptions as $subs)
                                    <tr>
                                        <td>{{ $subs->user->username }}</td>
                                        <td>{{ $subs->plan->name }}</td>
                                        <td>{{ $subs->plan_expired_at->format('d M Y') }}</td>
                                        <td>{{ $subs->created_at->format('d M Y') }}</td>
                                        <td>
                                            @if ($subs->is_current)
                                                <span class="sp_badge sp_badge_success">{{ __('Active') }}</span>
                                            @else
                                                <span class="sp_badge sp_badge_danger">{{ __('Previous') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center">{{__('No Subscription Found')}}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($subscriptions->hasPages())
                    <div class="card-footer">
                        {{$subscriptions->links()}}
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
