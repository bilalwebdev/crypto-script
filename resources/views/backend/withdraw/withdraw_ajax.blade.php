@forelse ($data['withdraws'] as $key => $withdrawlog)
    <tr>
        <td>
            <img src="{{ Config::getFile('user', $withdrawlog->user->image, true) }}" alt="" class="image-table">
            <span>
                <a href="{{ route('admin.user.details', $withdrawlog->user->id) }}">
                    {{ $withdrawlog->user->username }}
                </a>
            </span>
        </td>
        <td>{{ $withdrawlog->trx }}</td>
        <td>
            {{ Config::formatter($withdrawlog->withdraw_amount) }}
        </td>
        <td>
            {{ Config::formatter($withdrawlog->withdraw_charge) }}
        </td>
        <td>
            {{ Config::formatter($withdrawlog->total) }}

        </td>
        <td>
            {{ ucwords($withdrawlog->withdrawMethod->type) }}
        </td>

        <td>
            {{ $withdrawlog->created_at->format('d , M Y') }}
        </td>

        <td>
            @if ($withdrawlog->status == 1)
                <span class="badge badge-success">{{ __('Success') }}</span>
            @elseif($withdrawlog->status == 2)
                <span class="badge badge-danger">{{ __('Rejected') }}</span>
            @else
                <span class="badge badge-warning">{{ __('Pending') }}</span>
            @endif
        </td>
        <td>
            <button class="btn btn-sm btn-outline-primary details"
                data-user_data="{{ json_encode($withdrawlog->proof) }}"
                data-transaction="{{ $withdrawlog->trx }}"
                data-provider="{{ $withdrawlog->user->username }}" data-email="{{ $withdrawlog->user->email }}"
                data-method_name="{{ $withdrawlog->withdrawMethod->name }}"
                data-date="{{ __($withdrawlog->created_at->format('d F Y')) }}"><i class="fas fa-eye"></i></button>
            @if ($withdrawlog->status == 0)
                <button class="btn btn-sm btn-outline-success accept"
                    data-url="{{ route('admin.withdraw.accept', $withdrawlog) }}"><i class="fas fa-check"></i></button>
                <button class="btn btn-sm btn-outline-danger reject"
                    data-url="{{ route('admin.withdraw.reject', $withdrawlog) }}"><i class="fas fa-times"></i></button>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td class="text-center" colspan="100%">{{ __('No Data Found') }}</td>
    </tr>
@endforelse
