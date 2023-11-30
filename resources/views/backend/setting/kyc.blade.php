<form action="{{ route('admin.general.basic') }}" method="post">
    @csrf
    <input type="hidden" name="type" value="kyc">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-sm btn-primary payment"> <i class="fa fa-plus text-white"></i>
                {{ __('Add KYC Requirements') }}</button>
        </div>
        <div class="card-body">
            <div class="row payment-instruction">
                @if ($general->kyc != null)
                    @foreach ($general->kyc as $key => $param)
                        <div class="col-md-12 user-data">
                            <div class="mb-4">
                                <div class="row mb-md-0 mb-4">

                                    <div class="col-md-3">
                                        <label>{{ __('Field Label') }}</label>
                                        <input name="kyc[{{ $key }}][field_label]"
                                            class="form-control form_control" type="text"
                                            value="{{ $param['field_label'] }}" required>
                                    </div>


                                    <div class="col-md-3">
                                        <label>{{ __('Field Name') }}</label>
                                        <input name="kyc[{{ $key }}][field_name]"
                                            class="form-control form_control fieldName" type="text"
                                            value="{{ $param['field_name'] }}" required>
                                    </div>
                                    <div class="col-md-2 mt-md-0 mt-2">
                                        <label>{{ __('Field Type') }}</label>
                                        <select name="kyc[{{ $key }}][type]" class="form-control selectric">
                                            <option value="text" {{ $param['type'] == 'text' ? 'selected' : '' }}>
                                                {{ __('Input Text') }}
                                            </option>
                                            <option value="textarea"
                                                {{ $param['type'] == 'textarea' ? 'selected' : '' }}>
                                                {{ __('Textarea') }}
                                            </option>
                                            <option value="file" {{ $param['type'] == 'file' ? 'selected' : '' }}>
                                                {{ __('File upload') }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mt-md-0 mt-2">
                                        <label>{{ __('Field Validation') }}</label>
                                        <select name="kyc[{{ $key }}][validation]"
                                            class="form-control selectric">
                                            <option value="required"
                                                {{ $param['validation'] == 'required' ? 'selected' : '' }}>
                                                {{ __('Required') }}
                                            </option>
                                            <option value="nullable"
                                                {{ $param['validation'] == 'nullable' ? 'selected' : '' }}>
                                                {{ __('Optional') }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 text-right my-auto ">

                                        <button class="btn btn-danger btn-lg remove w-100 mt-4" type="button">
                                            <i class="fa fa-times"></i>
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12 user-data">
                        <div class="row">
                            <div class="col-md-12 user-data">
                                <div class="mb-4">
                                    <div class="row mb-md-0 mb-4">

                                        <div class="col-md-3">
                                            <label>{{ __('Field Label') }}</label>
                                            <input name="kyc[0][field_label]" class="form-control form_control"
                                                type="text" value="" required>
                                        </div>


                                        <div class="col-md-3">
                                            <label>{{ __('Field Name') }}</label>
                                            <input name="kyc[0][field_name]" class="form-control form_control fieldName"
                                                type="text" value="" required>
                                        </div>
                                        <div class="col-md-2 mt-md-0 mt-2">
                                            <label>{{ __('Field Type') }}</label>
                                            <select name="kyc[0][type]" class="form-control selectric">
                                                <option value="text"> {{ __('Input Text') }} </option>
                                                <option value="textarea"> {{ __('Textarea') }} </option>
                                                <option value="file"> {{ __('File upload') }} </option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 mt-md-0 mt-2">
                                            <label>{{ __('Field Validation') }}</label>
                                            <select name="kyc[0][validation]" class="form-control selectric">
                                                <option value="required"> {{ __('Required') }} </option>
                                                <option value="nullable"> {{ __('Optional') }} </option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 text-right my-auto">

                                            <button class="btn btn-danger btn-lg remove w-100 mt-4" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            <button type="submit" class="btn btn-primary"> <i class="fas fa-sync-alt mr-2"></i>
                {{ __('Update KYC Settings') }}</button>
        </div>
    </div>
</form>
