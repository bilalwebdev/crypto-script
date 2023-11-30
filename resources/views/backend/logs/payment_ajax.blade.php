@forelse($transactions as $transaction)
<tr>
    <td>
        <a href="{{ route('admin.user.details', $transaction->user->id) }}">
            <img src="{{ Config::getFile('user', $transaction->user->image, true) }}"
                alt="" class="image-table">
            <span>
                {{ $transaction->user->username }}
            </span>
        </a>
       
    </td>
    <td>{{ $transaction->gateway->name ?? 'Using Balance' }}</td>
    <td>{{ $transaction->trx }}</td>
    <td>{{ Config::formatter($transaction->amount) }}</td>
    <td>{{ Config::formatter($transaction->rate) }}</td>
    <td>{{ Config::formatter($transaction->charge) }}</td>
    <td>{{ Config::formatter($transaction->total) }}</td>
    <td>
        {{$transaction->created_at->format('d M , Y')}}
    </td>
    <td>
        @if ($transaction->type == 1)
            <span class="badge badge-success">{{ __('Autometic') }}</span>
        @else
            <span class="badge badge-info">{{ __('Manual') }}</span>
        @endif
    </td>

</tr>
@empty
<tr>
    <td colspan="8" class="text-center">{{ __('No Data Found') }}
    </td>
</tr>
@endforelse