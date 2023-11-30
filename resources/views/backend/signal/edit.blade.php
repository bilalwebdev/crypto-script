@extends('backend.layout.master')
@section('element')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.signals.index') }}"> <i
                            class="fa fa-arrow-left"></i>
                        {{ __('Back') }}</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.signals.update', $signal->id) }}" method="post"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-form-label">{{ __('Signal Image') }}</label>
                                    <div id="image-preview" class="image-preview"
                                        style="background-image:url({{ Config::getFile('signal', $signal->image, true) }});">
                                        <label for="image-upload" id="image-label">{{ __('Choose File') }}</label>
                                        <input type="file" name="image" id="image-upload" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="">{{ __('Signal Title') }}</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ $signal->title }}">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="">{{ __('Plans') }} <input type="checkbox" id="checkbox"
                                                class="mx-3">{{ __('Select All') }}</label>
                                        @php
                                            $plansId =
                                                $signal
                                                    ->plans()
                                                    ->pluck('plan_id')
                                                    ->toArray() ?? [];
                                        @endphp

                                        <select name="plans[]" id="selectMulti" multiple>
                                            @foreach ($plans as $plan)
                                                <option value="{{ $plan->id }}"
                                                    {{ in_array($plan->id, $plansId) ? 'selected' : '' }}>
                                                    {{ $plan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="">{{ __('Currency pair') }}</label>
                                        <select name="currency_pair" class="form-control pair">
                                            @foreach ($pairs as $pair)
                                                <option value="{{ $pair->id }}"
                                                    {{ $pair->id == $signal->currency_pair_id ? 'selected' : '' }}>
                                                    {{ $pair->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="">{{ __('Time Frame') }}</label>
                                        <select name="time_frame" class="form-control frame">
                                            @foreach ($times as $time)
                                                <option value="{{ $time->id }}"
                                                    {{ $pair->id == $signal->time_frame_id ? 'selected' : '' }}>
                                                    {{ $time->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="">{{ __('Starting Point') }}</label>
                                        <input type="text" class="form-control" name="open_price"
                                            value="{{ $signal->open_price }}">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="">{{ __('Stop Loss') }}</label>
                                        <input type="text" class="form-control" name="sl"
                                            value="{{ $signal->sl }}">
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label for="">{{ __('Take profit') }}</label>
                                        <input type="text" class="form-control" name="tp"
                                            value="{{ $signal->tp }}">
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label for="">{{ __('Place Order Direction') }}</label>
                                        <select name="direction" class="form-control">
                                            <option value="buy" {{ $signal->direction === 'buy' ? 'selected' : '' }}>
                                                {{ __('BUY') }}</option>
                                            <option value="sell" {{ $signal->direction === 'sell' ? 'selected' : '' }}>
                                                {{ __('SELL') }}</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label for="">{{ __('Markets Type') }}</label>
                                        <select name="market" class="form-control">
                                            @foreach ($markets as $market)
                                                <option value="{{ $market->id }}"
                                                    {{ $signal->market_id == $market->id ? 'selected' : '' }}>
                                                    {{ $market->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="">{{ __('Description') }}</label>
                                        <textarea name="description" cols="30" rows="10" class="form-control summernote">{{ $signal->description }}</textarea>
                                    </div>

                                    <div class="col-md-12 mt-4">
                                        <input type="submit" class="btn btn-warning" name="type" value="Draft">
                                        <input type="submit" class="btn btn-primary" name="type" value="Send">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('external-style')
    <link rel="stylesheet" href="{{ Config::cssLib('backend', 'select2.min.css') }}">
@endpush

@push('external-script')
    <script src="{{ Config::jsLib('backend', 'select2.min.js') }}"></script>
    <script src="{{ Config::jsLib('backend', 'nic_edit.js') }}"></script>
@endpush

@push('script')
    <script>
        $(function() {

            'use strict'

            $("#selectMulti,.pair,.frame").select2();

            $("#checkbox").on('click', function() {

                if ($("#checkbox").is(':checked') === true) {
                    $("#selectMulti > option").prop("selected", "selected"); // Select All Options
                    $("#selectMulti").trigger("change"); // Trigger change to select 2
                } else {

                    $("#selectMulti > option").removeAttr("selected");
                    $("#selectMulti").trigger("change"); // Trigger change to select 2
                }


            });

            $.uploadPreview({
                input_field: "#image-upload",
                preview_box: "#image-preview",
                label_field: "#image-label",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });
        })
    </script>
@endpush
