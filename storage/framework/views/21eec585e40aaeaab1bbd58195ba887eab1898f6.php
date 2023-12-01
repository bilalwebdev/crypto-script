<div class="card">
    <div class="card-header">
        <h4 class="m-0"><?php echo e(__('Cron Job Settings')); ?></h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="mb-4 col-md-12">
                <div class="input-group">
                    <input type="text" class="form-control copy-text" value="/usr/local/bin/php /home/migrat97/public_html/{foldername}/main/artisan queue:work --stop-when-empty" readonly>
                    <button type="button" class="input-group-text sp_bg_base px-4 copy
                        "><?php echo e(__('Copy')); ?></button>
                </div>
            </div>

        </div>

        <div class="mb-4 col-md-12">
            <div class="input-group">
                <input type="text" class="form-control copy-text3"
                    value="<?php if(env('DEMO')): ?> ------------ <?php else: ?> <?php echo e(route('trading-interest')); ?> <?php endif; ?>"
                    readonly>
                <button type="button"
                    class="input-group-text sp_bg_base px-4 copy3
                    "><?php echo e(__('Copy')); ?></button>
            </div>
        </div>

    </div>
</div>
<?php /**PATH D:\personal\crypto-script\resources\views/backend/setting/cron.blade.php ENDPATH**/ ?>