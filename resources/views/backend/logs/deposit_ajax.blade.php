@forelse ($deposits as $key => $manual)
<tr>
    <td>{{ $manual->trx }}</td>
    <td>{{ $manual->gateway->name }}</td>
    <td>
        <a href="{{ route('admin.user.details', $manual->user->id) }}">
            <img src="{{ Config::getFile('user', $manual->user->image, true) }}" alt=""
                class="image-table">
            <span>
                {{ $manual->user->username }}
            </span>
        </a>
    </td>
    <td>{{ Config::formatter($manual->amount, 2) . ' ' . Config::config()->currency }}
    </td>
    <td>
        {{ Config::formatter($manual->charge, 2) . ' ' . Config::config()->currency }}
    </td>
    <td>
        @if ($manual->status == 2)
            <span class="badge badge-warning">{{ __('Pending') }}</span>
        @elseif($manual->status == 1)
            <span class="badge badge-success">{{ __('Approved') }}</span>
        @elseif($manual->status == 3)
            <span class="badge badge-danger">{{ __('Rejected') }}</span>
        @endif
    </td>
    <td>
        {{$manual->created_at->format('d M ,Y')}}
    </td>
    <td>
        <a class="btn btn-sm btn-outline-primary details"
            href="{{ route('admin.deposit.details', $manual->trx) }}">
            <i class="far fa-eye"></i></a>

        @if ($manual->status == 2)
            <a class="btn  btn-sm btn-outline-primary accept"
                data-url="{{ route('admin.deposit.accept', $manual->trx) }}"><i
                    class="fas fa-check"></i></a>
            <a class="btn  btn-sm btn-outline-danger reject"
                data-url="{{ route('admin.deposit.reject', $manual->trx) }}"><i
                    class="fas fa-times"></i></a>
        @endif
    </td>
</tr>
@empty
<tr>
    <td class="text-center" colspan="100%">{{ __('No Data Found') }}
    </td>
</tr>
@endforelse