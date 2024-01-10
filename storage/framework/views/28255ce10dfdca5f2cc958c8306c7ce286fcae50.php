

<?php $__env->startSection('element'); ?>
    <div class="row gy-4">
        <div class="col-lg-9">
            <div class="p-4  bg-white rounded-lg">
                <form action="<?php echo e(route('admin.user.submit')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="form-group col-sm-6 mb-3 ">
                            <label><?php echo e(__('Name')); ?></label>
                            <input type="text" name="username" class="form-control" value="">
                        </div>

                        <div class="form-group col-sm-6 mb-3 ">
                            <label><?php echo e(__('Email')); ?></label>
                            <input type="text" name="email" class="form-control" value="">
                        </div>
                        <div class="form-group col-sm-6 mb-3 ">
                            <label><?php echo e(__('Phone')); ?></label>
                            <input type="text" name="phone" class="form-control" value="">
                        </div>
                        <div class="form-group col-sm-6 mb-3 ">
                            <label><?php echo e(__('Country')); ?></label>
                            <input type="text" name="country" class="form-control" value="">
                        </div>

                        

                        

                        
                        <div class="col-md-6 mb-3">
                            <label><?php echo e(__('Password')); ?></label>
                            <input type="password" name="password" class="form-control form_control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><?php echo e(__('Confirm Password')); ?></label>
                            <input type="password" name="password_confirmation" class="form-control form_control">
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="row">
                                <div class="col-xl-3 col-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="email_status" class="custom-control-input"
                                            id="useCheck1">
                                        <label class="custom-control-label"
                                            for="useCheck1"><?php echo e(__('Email Verified')); ?></label>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="sms_status" class="custom-control-input"
                                            id="useCheck2">
                                        <label class="custom-control-label" for="useCheck2"><?php echo e(__('SMS Verified')); ?></label>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="kyc_status" class="custom-control-input"
                                            id="useCheck3">
                                        <label class="custom-control-label" for="useCheck3"><?php echo e(__('KYC Verified')); ?></label>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="status" class="custom-control-input" id="useCheck4">
                                        <label class="custom-control-label" for="useCheck4"><?php echo e(__('Status')); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xxl-3 col-xl-4 mt-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-sync-alt"></i>
                                <?php echo e('Add Wallet'); ?>

                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('external-style'); ?>
    <link rel="stylesheet" href="<?php echo e(Config::cssLib('backend', 'select2.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('external-script'); ?>
    <script src="<?php echo e(Config::jsLib('backend', 'select2.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict'

        $(function() {

            $(".js-example-tokenizer").select2({
                placeholder: "Select Admin"
            })
            $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "<?php echo e(__('Choose File')); ?>", // Default: Choose File
                label_selected: "<?php echo e(__('Update Image')); ?>", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pratice\crypto-script\resources\views/backend/users/create.blade.php ENDPATH**/ ?>