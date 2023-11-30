@forelse($transfers as $key => $transaction)
    <tr>
        <td>{{ $transaction->trx }}</td>
        <td>

            <a href="{{ route('admin.user.details', $transaction->sender->id) }}">
                <img src="{{ Config::getFile('user', $transaction->sender->image, true) }}" alt="" class="image-table">
                <span>
                    {{ $transaction->sender->username }}
                </span>
            </a>

        </td>
        <td>
            <a href="{{ route('admin.user.details', $transaction->receiver->id) }}">
                <img src="{{ Config::getFile('user', $transaction->receiver->image, true) }}" alt="" class="image-table">
                <span>
                    {{ $transaction->receiver->username }}
                </span>
            </a>
        </td>
        <td>{{ Config::formatter($transaction->amount) }}</td>
        <td>{{ Config::formatter($transaction->charge) }}</td>

        <td>{{ $transaction->created_at->format('d F, Y') }}</td>
    </tr>
@empty


    <tr>

        <td class="text-center" colspan="100%">
            {{ __('No Transfer Found') }}
        </td>

    </tr>
@endforelse
