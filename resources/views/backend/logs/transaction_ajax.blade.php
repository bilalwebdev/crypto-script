@forelse($transactions as $key => $transaction)
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
        <td>{{ Config::formatter($transaction->amount) }}</td>
                                      
        <td>{{ Config::formatter($transaction->charge)}}</td>
        <td>{{ $transaction->details }}</td>
        <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
    </tr>
@empty
    <tr>
        <td class="text-center" colspan="100%">
            {{ __('No Transaction Found') }}
        </td>

    </tr>
@endforelse
