<form action="<?php echo e(route('admin.general.basic')); ?>" method="post" enctype="multipart/form-data">

    <?php echo csrf_field(); ?>

    <input type="hidden" name="type" value="general">

    <div class="row">

        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for="sitename"><?php echo e(__('Site Name')); ?></label>
            <input type="text" name="sitename" class="form-control form_control" value="<?php echo e(Config::config()->appname); ?>">
        </div>

        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for="site_currency"><?php echo e(__('Site Currency')); ?></label>
            <input type="text" name="site_currency" class="form-control" value="<?php echo e(Config::config()->currency ?? ''); ?>">
        </div>


        <div class="col-xxl-3 col-lg-4 col-sm-6">
            <label><?php echo e(__('Decimal precision')); ?></label>
            <div class="input-group">
                <input type="number" name="decimal_precision" class="form-control form_control"
                    value="<?php echo e(Config::config()->decimal_precision); ?>">
                <div class="input-group-append">
                    <span class="input-group-text bg-primary text-white" id="basic-addon2"><?php echo e(__('decimal precision')); ?></span>
                </div>
            </div>
        </div>

        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for="signup_bonus"><?php echo e(__('Sign Up Bonus')); ?></label>
            <input type="text" name="signup_bonus" class="form-control form_control"
                value="<?php echo e(Config::formatOnlyNumber(Config::config()->signup_bonus)); ?>">
        </div>

        <div class="col-xxl-3 col-lg-4 col-sm-6">
            <label><?php echo e(__('Withdraw Limit')); ?></label>
            <div class="input-group">
                <input type="number" name="withdraw_limit" class="form-control form_control"
                    value="<?php echo e(Config::config()->withdraw_limit); ?>">
                <div class="input-group-append">
                    <span class="input-group-text bg-primary text-white" id="basic-addon2"><?php echo e(__('Times per day')); ?></span>
                </div>
            </div>
        </div>

        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for="pagination_limit"><?php echo e(__('Pagination Limit')); ?></label>
            <input type="number" name="pagination_limit" class="form-control form_control"
                value="<?php echo e(Config::config()->pagination); ?>">
        </div>

        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for="timezone"><?php echo e(__('Timezone')); ?></label>
            <select name="timezone" id="" class="form-control">
                <?php $__currentLoopData = $timezone; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($zone); ?>" <?php echo e(env('APP_TIMEZONE') == $zone ? 'selected' : ''); ?>><?php echo e($zone); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for="alert"><?php echo e(__('Alert Type')); ?></label>
            <select name="alert" id="" class="form-control">
                <option value="izi" <?php echo e(Config::config()->alert === 'izi' ? 'selected' : ''); ?>><?php echo e(__('IziToast')); ?></option>
                <option value="toast" <?php echo e(Config::config()->alert === 'toast' ? 'selected' : ''); ?>><?php echo e(__('Toaster')); ?></option>
                <option value="sweet" <?php echo e(Config::config()->alert === 'sweet' ? 'selected' : ''); ?>><?php echo e(__('Sweetalert')); ?></option>
            </select>
        </div>


        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for=""><?php echo e(__('Transfer Limit Per Day')); ?></label>
            <input type="number" name="trans_limit" class="form-control"
                value="<?php echo e(Config::config()->transfer_limit); ?>">
        </div>

        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for=""><?php echo e(__('Transfer Charge')); ?></label>

            <div class="input-group">
                <div class="input-group-prepend">
                    <input type="number" name="trans_charge" class="form-control"
                        value="<?php echo e(Config::formatOnlyNumber(Config::config()->transfer_charge)); ?>">
                </div>
                <select class="form-control" id="inputGroupSelect01" name="trans_type">
                    <option value="fixed"
                        <?php echo e(Config::config()->transfer_type === 'fixed' ? 'selected' : ''); ?>>
                        <?php echo e(__('Fixed')); ?></option>
                    <option value="percent"
                        <?php echo e(Config::config()->transfer_type === 'fixed' ? '' : 'selected'); ?>>
                        <?php echo e(__('Percent')); ?></option>
                </select>
            </div>
        </div>


        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for=""><?php echo e(__('Transfer Min Amount')); ?></label>
            <input type="number" name="min_amount" class="form-control"
                value="<?php echo e(Config::formatOnlyNumber(Config::config()->transfer_min_amount)); ?>">
        </div>

        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for=""><?php echo e(__('Transfer Max Amount')); ?></label>
            <input type="number" name="max_amount" class="form-control"
                value="<?php echo e(Config::formatOnlyNumber(Config::config()->transfer_max_amount)); ?>">
        </div>


        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for=""><?php echo e(__('Trading Charge')); ?></label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="trade_charge"
                    value="<?php echo e(Config::formatOnlyNumber(Config::config()->trade_charge)); ?>">
                <span class="input-group-text" id="basic-addon2"><?php echo e(__('Percent')); ?></span>
            </div>
        </div>


        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for=""><?php echo e(__('Min Trade Balance')); ?></label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="min_trade_balance"
                    value="<?php echo e(Config::formatOnlyNumber(Config::config()->min_trade_balance)); ?>">
                <span class="input-group-text" id="basic-addon2"><?php echo e(Config::config()->currency); ?></span>
            </div>
        </div>

        <div class="mb-4 col-xxl-3 col-lg-4 col-sm-6">
            <label for=""><?php echo e(__('Per day limit')); ?></label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="trade_limit"
                    value="<?php echo e(Config::config()->trade_limit); ?>">
                <span class="input-group-text" id="basic-addon2"><?php echo e(Config::config()->currency); ?></span>
            </div>
        </div>

    </div>

    

    <div class="row">
        <div class="mb-4 col-md-3 mb-3">
            <label class="col-form-label"><?php echo e(__('White logo')); ?></label>
            <div id="image-preview" class="image-preview"
                style="background-image:url(<?php echo e(Config::getFile('logo', Config::config()->logo, true)); ?>);">
                <label for="image-upload" id="image-label"><?php echo e(__('Choose File')); ?></label>
                <input type="file" name="logo" id="image-upload" />
            </div>
        </div>

        <div class="mb-4 col-md-3 mb-3">
            <label class="col-form-label"><?php echo e(__('Dark logo')); ?></label>
            <div id="image-preview-dark" class="image-preview"
                style="background-image:url(<?php echo e(Config::getFile('dark_logo', Config::config()->dark_logo, true)); ?>);">
                <label for="image-upload-dark" id="image-label-dark"><?php echo e(__('Choose File')); ?></label>
                <input type="file" name="dark_logo" id="image-upload-dark" />
            </div>
        </div>

        <div class="mb-4 col-md-3 mb-3">
            <label class="col-form-label"><?php echo e(__('Icon')); ?></label>
            <div id="image-preview-icon" class="image-preview"
                style="background-image:url(<?php echo e(Config::getFile('icon', Config::config()->favicon, true)); ?>);">
                <label for="image-upload-icon" id="image-label-icon"><?php echo e(__('Choose File')); ?></label>
                <input type="file" name="icon" id="image-upload-icon" />
            </div>
        </div>

        <div class="mb-4 col-md-12 mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-sync-alt mr-2"></i>
                <?php echo e(__('Update General Settings')); ?>

            </button>
        </div>
    </div>

</form>
<?php /**PATH D:\personal\crypto-script\resources\views/backend/setting/general_setting.blade.php ENDPATH**/ ?>