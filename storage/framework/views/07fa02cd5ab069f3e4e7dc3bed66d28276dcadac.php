

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="sp_site_card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0 ">Open MT5 Account</h6>

                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('user.open.account')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="form-group mb-3">
                            <label for="">ACCOUNT TYPE</label>
                            <select class="form-control" name="acc_type">
                                <?php if(!$isDemo): ?>
                                    <option value="1">Standard Account</option>
                                    <option value="2">Premium Account</option>
                                    <option value="3">VIP Account</option>
                                <?php else: ?>
                                    <option value="4">Demo Account</option>
                                <?php endif; ?>

                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">BASE CURRENCY</label>
                            <select class="form-control" name="currency">
                                <option value="usd" selected="">USD</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">LEVERAGE</label>
                            <select class="form-control" name="leverage">
                                <option value="100">1:100</option>
                                <option value="200">1:200</option>
                                <option value="500">1:500</option>
                                
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Investor Password</label>
                            <input type="password" class="form-control" name="investor_pass" id="" required
                                placeholder="Enter Investor Password">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Master Password</label>
                            <input type="password" class="form-control" name="master_pass" id="" required
                                placeholder="Enter Master Password">
                        </div>



                        <button type="submit" class="btn sp_theme_btn btn-md text-uppercase">Open account</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('external-css'); ?>
    <link rel="stylesheet" href="<?php echo e(Config::cssLib('frontend', 'lib/apex.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php echo $__env->make(Config::theme() . 'layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\personal\crypto-script\resources\views/frontend/light/user/open_account.blade.php ENDPATH**/ ?>