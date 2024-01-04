@extends('backend.layout.master')


@section('element')
    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">

                <div class="card-body text-center">
                    <ul class="list-group">
                        {{-- <li class="list-group-item d-flex justify-content-between">

                            <span>{{ __('Transaction Id') }}</span>
                            <span>{{ $deposit->id }}</span>

                        </li> --}}

                        <li class="list-group-item d-flex justify-content-between">

                            <span>{{ __('Payment Date') }}</span>
                            <span>{{ $deposit->created_at->format('d F Y') }}</span>

                        </li>
                        <li class="list-group-item d-flex justify-content-between">

                            <span>{{ __('Payment Amount') }}</span>
                            <span>{{ $deposit->amount }}</span>

                        </li>
                        <li class="list-group-item d-flex justify-content-between">

                            <span>{{ __('Payment Method') }}</span>
                            <span>{{ $deposit->payment->name }}</span>

                        </li>
                          <li class="list-group-item d-flex justify-content-between">

                            <span>{{ __('Payment Status') }}</span>
                          
                                @if ($deposit->status == 2)
                                <span class="badge badge-warning">{{ __('Pending') }}</span>
                                @elseif($deposit->status == 1)
                                    <span class="badge badge-success">{{ __('Approved') }}</span>
                                @elseif($deposit->status == 3)
                                    <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                @endif
                                

                        </li>
                        {{-- @if ($deposit->payment_proof != null)
                            @foreach ($deposit->payment_proof as $key => $proof)
                                @if (is_array($proof))
                                    <li class="list-group-item d-flex justify-content-between">

                                        <span>{{ __(str_replace('_', ' ', ucwords($key))) }}</span>
                                        <span class="text-right"><img src="{{ Config::getFile('manual_payment', $proof['file']) }}"
                                                alt="" class="w-50 "></span>

                                    </li>

                                    @continue
                                @endif

                                <li class="list-group-item d-flex justify-content-between">

                                    <span>{{ __(str_replace('_', ' ', ucwords($key))) }}</span>
                                    <span>{{ __($proof) }}</span>

                                </li>
                            @endforeach
                        @endif --}}

                    </ul>


                </div>
            </div>
        </div>
    </div>
@endsection
