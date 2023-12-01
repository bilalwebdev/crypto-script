<form action="<?php echo e(route('admin.general.basic')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="type" value="pref">
    <div class="card">
        <div class="card-header">
            <h4 class="m-0"><?php echo e(__('Preferences')); ?></h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-4 col-md-3">
                    <label for="" class="w-100"><?php echo e(__('Email Verification On')); ?> </label>
                    <input type="checkbox" name="is_email_verification_on"
                        <?php echo e($general->is_email_verification_on ? 'checked' : ''); ?> data-toggle="toggle" data-on="Active"
                        data-off="Disabled" data-onstyle="success" data-offstyle="danger" data-width="100%"
                        data-height="45px">
                </div>

                <div class="mb-4 col-md-3">
                    <label for="" class="w-100"><?php echo e(__('SMS Verification On')); ?> </label>
                    <input type="checkbox" name="is_sms_verification_on"
                        <?php echo e($general->is_sms_verification_on ? 'checked' : ''); ?> data-toggle="toggle" data-on="Active"
                        data-off="Disabled" data-onstyle="success" data-offstyle="danger" data-width="100%"
                        data-height="45px">
                </div>

                <div class="mb-4 col-md-3">
                    <label for="" class="w-100"><?php echo e(__('User Registration')); ?> </label>
                    <input type="checkbox" name="user_reg" <?php echo e($general->reg_enabled ? 'checked' : ''); ?>

                        data-toggle="toggle" data-on="Active" data-off="Disabled" data-onstyle="success"
                        data-offstyle="danger" data-width="100%" data-height="45px">
                </div>

                <div class="mb-4 col-md-3">
                    <label for="" class="w-100"><?php echo e(__('User KYC Verification')); ?> </label>
                    <input type="checkbox" name="user_kyc" <?php echo e($general->is_allow_kyc ? 'checked' : ''); ?>

                        data-toggle="toggle" data-on="Active" data-off="Disabled" data-onstyle="success"
                        data-offstyle="danger" data-width="100%" data-height="45px">
                </div>

                <div class="mb-4 col-md-3">
                    <label for=""><?php echo e(__('Allow Preloader')); ?></label>
                    <input type="checkbox" name="preloader_status" <?php echo e($general->preloader_status == 1 ? 'checked' : ''); ?>

                        data-toggle="toggle" data-on="Active" data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                        data-width="100%" data-height="43px">
                </div>


            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt mr-2"></i>
                <?php echo e(__('Update Preference Settings')); ?></button>
        </div>
    </div>
</form>
<?php /**PATH D:\personal\crypto-script\resources\views/backend/setting/preference.blade.php ENDPATH**/ ?>