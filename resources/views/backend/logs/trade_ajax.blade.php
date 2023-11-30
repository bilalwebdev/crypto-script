@forelse($trades as $key => $trade)
    <tr>
        <td>{{ strtoupper($trade->ref) }}</td>
        <td>

            <a href="{{ route('admin.user.details', $trade->user->id) }}">
                <img src="{{ Config::getFile('user', $trade->user->image, true) }}" alt="" class="image-table">
                <span>
                    {{ $trade->user->username }}
                </span>
            </a>
        </td>
        <td>{{ $trade->currency }}</td>
        <td>{{ Config::formatter($trade->current_price) }}</td>

        <td>
            @if ($trade->trade_type == 'buy')
                <i class="fas fa-arrow-alt-circle-up text-success"></i>
                {{ $trade->trade_type }}
            @else
                <i class="fas fa-arrow-alt-circle-down text-danger"></i>
                {{ $trade->trade_type }}
            @endif
        </td>

        <td>
            {{ $trade->trade_stop_at }}
        </td>

        <td>
            @if ($trade->profit_type == '+')
                <span class="text-success font-weight-bolder">{{ __('+' . $trade->profit_amount) }}</span>
            @elseif($trade->profit_type == '-')
                <span class="text-danger font-weight-bolder">{{ __('-' . $trade->loss_amount) }}</span>
            @endif
        </td>

        <td>
            @if ($trade->status)
                <span class="text-success "><i class="far fa-check-circle font-weight-bolder"></i></span>
            @else
                <span class="text-danger "><i class="fas fa-spinner fa-spin font-weight-bolder"></i></span>
            @endif
        </td>

    </tr>
@empty
    <tr>
        <td class="text-center" colspan="100%">
            {{ __('No Trades Found') }}
        </td>
    </tr>
@endforelse
