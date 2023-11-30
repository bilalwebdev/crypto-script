@forelse($transactions as $transaction)
<tr>
    <td>{{ $transaction->trx }}</td>
    <td>
        <a href="{{ route('admin.user.details', $transaction->user->id) }}">
            <img src="{{ Config::getFile('user', $transaction->user->image, true) }}"
                alt="" class="image-table">
            <span>
                {{ $transaction->user->username }}
            </span>
        </a>
    </td>
    <td>{{ optional($transaction->withdrawMethod)->name }}</td>
    <td>{{ Config::formatter($transaction->withdraw_amount) }}</td>
    <td>{{ Config::formatter($transaction->withdraw_charge) }}</td>
    <td>{{ Config::formatter($transaction->total) }}</td>
    <td>{{ $transaction->created_at->format('d M , Y') }}</td>



</tr>
@empty
<tr>
    <td colspan="8" class="text-center">{{ __('No Data Found') }}
    </td>
</tr>
@endforelse