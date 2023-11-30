<form action="{{ route('admin.general.basic') }}" method="post">
    @csrf

    <input type="hidden" name="type" value="others">
    <div class="card">
        <div class="card-header">
            <h4 class="m-0">{{ __('Copyright') }}</h4>
        </div>
        <div class="card-body">
            <div class="row">


                <div class="mb-4 col-md-12">
                    <label for="">{{ __('Copyright') }}</label>
                    <input type="text" name="copyright" class="form-control"
                        value="{{ $general->copyright }}">
                </div>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="m-0">{{ __('Custom Font Settings') }}</h4>
        </div>
        <div class="card-body">
            <div class="row">


                <div class="mb-4 col-md-6">
                    <label for="">{{ __('Heading Fonts url') }}</label>
                    <input type="text" name="fonts[heading_font_url]" class="form-control"
                        value="{{ $general->fonts->heading_font_url }}">
                </div>

                <div class="mb-4 col-md-6">
                    <label for="">{{ __('Heading Font Family') }}</label>
                    <input type="text" name="fonts[heading_font_family]" class="form-control"
                        value="{{ $general->fonts->heading_font_family }}">
                </div>


                <div class="mb-4 col-md-6">
                    <label for="">{{ __('Paragraph Fonts url') }}</label>
                    <input type="text" name="fonts[paragraph_font_url]" class="form-control"
                        value="{{ $general->fonts->paragraph_font_url }}">
                </div>

                <div class="mb-4 col-md-6">
                    <label for="">{{ __('Paragraph Font Family') }}</label>
                    <input type="text" name="fonts[paragraph_font_family]" class="form-control"
                        value="{{ $general->fonts->paragraph_font_family }}">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="m-0">{{ __('Seo Settings') }}</h4>
        </div>
        <div class="card-body">
            <div class="row">


                <div class="mb-4 col-md-12">
                    <label for="">{{ __('Seo Meta Tag') }}</label>
                    <select name="seo_tags[]" class="form-control js-example-tokenizer" multiple>
                        @if ($general->seo_tags != null)
                            @foreach ($general->seo_tags as $tag)
                                <option value="{{ $tag }}" selected>{{ $tag }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>


                <div class="mb-4 col-md-12">
                    <label for="">{{ __('Seo Description') }}</label>
                    <textarea name="seo_description" id="" cols="30" rows="10" class="form-control">{{ __($general->seo_description) }}</textarea>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <h4>{{ __('Cookie Settings') }}</h4>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="mb-4 col-md-8">
                    <label for="">{{ __('Cookie Button Text') }}</label>
                    <input type="text" name="button_text" class="form-control" value="{{ $general->button_text }}">
                </div>

                <div class="mb-4 col-md-4">
                    <label for="">{{ __('Allow Cookie Modal') }}</label>
                    <input type="checkbox" name="allow_modal" {{ $general->allow_modal == 1 ? 'checked' : '' }}
                        data-toggle="toggle" data-on="Active" data-off="Disabled" data-onstyle="success"
                        data-offstyle="danger" data-width="100%" data-height="43px">
                </div>

                <div class="mb-4 col-md-12">
                    <label for="">{{ __('Cookie Details') }}</label>
                    <textarea name="cookie_text" cols="30" rows="10" class="form-control">{{ __($general->cookie_text) }}</textarea>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="mb-4 col-md-12">
            <button type="submit" class="btn btn-primary float-right"> <i class="fas fa-sync-alt mr-2"></i>
                {{ __('Update Others Settings') }}</button>
        </div>
    </div>

</form>
