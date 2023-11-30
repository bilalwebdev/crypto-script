@extends('backend.layout.master')


@section('element')

    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-header justify-content-end">
                    <a href="{{ route('admin.plan.index') }}" class="btn btn-outline-primary btn-sm"><i
                            class="fa fa-arrow-left mr-2"></i>{{ __('Back') }}</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.plan.update', $plan->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-sm-6 my-3">
                                <label class="form-label">{{ __('Plan Name') }} <code>*</code> </label>
                                <input type="text" class="form-control" name="plan_name" value="{{ $plan->name }}">

                            </div>

                            <div class="col-md-6 my-3">
                                <label class="form-label">{{ __('Plan Type') }} <code>*</code> </label>
                                <select name="plan_type" class="form-control" id="plan_type">
                                    <option value="unlimited" {{ $plan->plan_type == 'unlimited' ? 'selected' : '' }}>
                                        {{ __('Unlimited') }}</option>
                                    <option value="limited" {{ $plan->plan_type == 'limited' ? 'selected' : '' }}>
                                        {{ __('Limited') }}</option>
                                </select>
                            </div>

                            <div class="col-md-6 my-3" id="append">
                                <label class="form-label">{{ __('Price Type') }} <code>*</code> </label>
                                <select name="price_type" class="form-control" id="price_type">
                                    <option value="free" {{ $plan->price_type == 'free' ? 'selected' : '' }}>
                                        {{ __('Free') }}</option>
                                    <option value="paid" {{ $plan->price_type == 'paid' ? 'selected' : '' }}>
                                        {{ __('Paid') }}</option>
                                </select>
                            </div>

                            @if ($plan->plan_type === 'limited')
                                <div class="col-md-6 my-3" id="duration">
                                    <label class="form-label">{{ __('Duration (In Days)') }}</label>
                                    <input type="number" class="form-control" name="duration"
                                        value="{{ $plan->duration }}">
                                </div>
                            @endif

                            @if ($plan->price_type === 'paid')
                                <div class="col-md-6 my-3" id="price_append">
                                    <label class="form-label">{{ __('Plan Price') }}</label>
                                    <input type="number" class="form-control" name="price" value="{{ Config::formatOnlyNumber($plan->price) }}">
                                </div>
                            @endif

                            <div class="col-sm-12 my-4">
                                <div class="d-flex flex-wrap justify-content-between">
                                    <h4 class="mb-0">
                                        {{ __('Create Features') }}
                                    </h4>
                                    <button type="button" class="btn btn-primary btn-sm add">
                                         <i class="las la-plus-circle"></i>
                                         {{ __('Add New') }}
                                    </button>
                                </div>
                                <div class="row" id="feature">
                                    @if ($plan->feature != null)
                                        @foreach ($plan->feature as $feature)
                                            <div class="col-md-6 remove mt-3">
                                                <div class="input-group">
                                                    <input type="text" name="feature[]" class="form-control"
                                                        value="{{ $feature }}">
                                                    <button class="btn btn-outline-secondary border-left-0 delete"><i
                                                            class="fa fa-times text-danger"></i></button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div><!-- Col -->
                        </div>



                        <div class="row">
                            <div class="col-xxl-5-items col-lg-4 col-sm-6 mb-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="whatsapp" class="custom-control-input" id="whatsapp"
                                        {{ $plan->whatsapp ? 'checked' : '' }}>
                                    <label class="custom-control-label"
                                        for="whatsapp">{{ __('Whatsapp notification') }}</label>
                                </div>
                            </div>

                            <div class="col-xxl-5-items col-lg-4 col-sm-6 mb-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="telegram" class="custom-control-input" id="telegram"
                                        {{ $plan->telegram ? 'checked' : '' }}>
                                    <label class="custom-control-label"
                                        for="telegram">{{ __('Telegram notification') }}</label>
                                </div>
                            </div>

                            <div class="col-xxl-5-items col-lg-4 col-sm-6 mb-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="email" class="custom-control-input" id="email"
                                        {{ $plan->email ? 'checked' : '' }}>
                                    <label class="custom-control-label"
                                        for="email">{{ __('Email notification') }}</label>
                                </div>
                            </div>

                            <div class="col-xxl-5-items col-lg-4 col-sm-6 mb-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="sms" class="custom-control-input" id="sms"
                                        {{ $plan->sms ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="sms">{{ __('SMS notification') }}</label>
                                </div>
                            </div>

                            <div class="col-xxl-5-items col-lg-4 col-sm-6 mb-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="dashboard" class="custom-control-input" id="dashboard"
                                        {{ $plan->dashboard ? 'checked' : '' }}>
                                    <label class="custom-control-label"
                                        for="dashboard">{{ __('Dashboard notification') }}</label>
                                </div>
                            </div>
                        </div><!-- Row -->
                        <button type="submit" class="btn btn-primary mt-4">{{ __('Plan Update') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        $(function() {

            'use strict'

            let price = `
            <div class="col-md-6 my-3" id="price_append">
                    <label class="form-label">{{ __('Plan Price') }}</label>
                    <input type="number" class="form-control" name="price">
                
            </div>
        `;

            let duration = `
            <div class="col-md-6 my-3" id="duration">
                    <label class="form-label">{{ __('Duration (In Days)') }}</label>
                    <input type="number" class="form-control" name="duration">
                </div>
        `;

            let feature = `
            <div class="col-md-6 remove mt-3">
                <div class="input-group">
                    <input type="text" name="feature[]" class="form-control">
                    <button class="btn btn-outline-secondary border-left-0 delete"><i class="fa fa-times text-danger"></i></button>
                </div>
            </div>
        `;


            $('#plan_type').on('change', function() {
                let value = $(this).val();

                if (value === 'limited') {
                    $('#append').after(duration)

                    return
                }

                $('#duration').remove();

            })

            $('#price_type').on('change', function() {
                let value = $(this).val();

                if (value === 'paid') {
                    $('#append').after(price)

                    return
                }

                $('#price_append').remove()

            })


            $('.add').on('click', function() {
                $('#feature').append(feature)
            })

            $(document).on('click', '.delete', function() {
                $(this).closest('.remove').remove()
            })



        })
    </script>
@endpush
