<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="sp_site_card">
                <div class="card-header">
                    <h4 class="mb-0"><?php echo e(__('Change Password')); ?></h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('user.update.password')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class=" mt-2 mb-2"><?php echo e(__('Old Password')); ?></label>
                            <input type="password" class="form-control" name="oldpassword">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class=" mt-2 mb-2"><?php echo e(__('New Password')); ?></label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class=" mt-2 mb-2"><?php echo e(__('Confirm Password')); ?></label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                        <div class="row mt-4">
                            <div class="col-xs-12 d-grid gap-2">
                                <button class="btn sp_theme_btn w-100" type="submit"><?php echo e(__('Update')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(Config::theme() . 'layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\personal\crypto-script\resources\views/frontend/light/user/changepassword.blade.php ENDPATH**/ ?>