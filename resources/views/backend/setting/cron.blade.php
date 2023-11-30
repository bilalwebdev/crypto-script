<div class="card">
    <div class="card-header">
        <h4 class="m-0">{{ __('Cron Job Settings') }}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="mb-4 col-md-12">
                <div class="input-group">
                    <input type="text" class="form-control copy-text" value="/usr/local/bin/php /home/migrat97/public_html/{foldername}/main/artisan queue:work --stop-when-empty" readonly>
                    <button type="button" class="input-group-text sp_bg_base px-4 copy
                        ">{{ __('Copy') }}</button>
                </div>
            </div>

        </div>

        <div class="mb-4 col-md-12">
            <div class="input-group">
                <input type="text" class="form-control copy-text3"
                    value="@if (env('DEMO')) ------------ @else {{ route('trading-interest') }} @endif"
                    readonly>
                <button type="button"
                    class="input-group-text sp_bg_base px-4 copy3
                    ">{{ __('Copy') }}</button>
            </div>
        </div>

    </div>
</div>
