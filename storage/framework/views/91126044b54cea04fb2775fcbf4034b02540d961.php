

<?php $__env->startSection('content'); ?>


    <div class="row g-sm-4 g-3">
        <div class="col-xxl-12 col-xl-12">
            <div class="d-left-wrapper">
                <div class="d-left-countdown">
                    <div id="countdownTwo"></div>
                </div>
                <div class="row g-sm-4 g-3">
                    <div class="col-xl-4 col-12">
                        <div class="d-card">
                            <div>
                                <h5 style="white-space: nowrap"><?php echo e(__('Start trading with ---')); ?></h5>
                                <div class="text-center">
                                    <a class="btn sp_theme_btn btn-sm text-uppercase mt-4 w-100"
                                        href="<?php echo e(route('user.open-account')); ?>"><?php echo e(__('Open Live Account!')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-12">
                        <div class="d-card">
                            <div>
                                <h5 style="white-space: nowrap"><?php echo e(__('Top up your trading accounts now')); ?></h5>
                                <div class="text-center">
                                    <a class="btn sp_theme_btn btn-sm text-uppercase mt-4 w-100"
                                        href="<?php echo e(route('user.deposit')); ?>"><?php echo e(__('Fund Your Account!')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>



        <?php if($liveAccounts): ?>
            <div class="col-xxl-12 col-xl-12">
                <div class="col-md-12 mt-2">
                    <div class="sp_site_card">
                        <div class="card-header">
                            <div class="card-header-items">
                                <h6 class="card-header-item text-capitalize"><?php echo e(__('Live Accounts')); ?></h6>

                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table sp_site_table">
                                    <thead>
                                        <tr>
                                            <th>LOGIN</th>
                                            <th>ACCOUNT TYPE</th>
                                            <th>BASE CURRENCY</th>
                                            <th>BALANCE</th>
                                            <th></th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $__currentLoopData = $liveAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <span class="tdStyle"><b><?php echo e($item->login); ?></b></span>
                                                </td>
                                                <td>
                                                    <span class="tdStyle">
                                                        <?php if($item->account_type == 1): ?>
                                                            Standard
                                                        <?php elseif($item->account_type == 2): ?>
                                                            Premium
                                                        <?php elseif($item->account_type == 3): ?>
                                                            VIP
                                                        <?php else: ?>
                                                        <?php endif; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="tdStyle text-uppercase"><?php echo e($item->currency); ?></span>
                                                </td>
                                                <td>
                                                    <span class="tdStyle border-0"><b><?php echo e($item->balance); ?> <span
                                                                class="text-uppercase"><?php echo e($item->currency); ?></span></b></span>
                                                </td>
                                                <td>
                                                    <a href="<?php echo e(route('user.deposit')); ?>"
                                                        class="btn sp_theme_btn btn-sm text-uppercase">Fund Now</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if($demoAccounts): ?>
            <div class="col-xxl-12 col-xl-12">
                <div class="col-md-12 mt-2">
                    <div class="sp_site_card">
                        <div class="card-header">
                            <div class="card-header-items">
                                <h6 class="card-header-item text-capitalize"><?php echo e(__('Demo Accounts')); ?></h6>

                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table sp_site_table">
                                    <thead>
                                        <tr>
                                            <th>LOGIN</th>
                                            <th>ACCOUNT TYPE</th>
                                            <th>BASE CURRENCY</th>
                                            <th class="text-lg-start">BALANCE</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $__currentLoopData = $demoAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <span class="tdStyle"><b><?php echo e($item->login); ?></b></span>
                                                </td>
                                                <td>
                                                    <span class="tdStyle">
                                                        DEMO
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="tdStyle text-uppercase"><?php echo e($item->currency); ?></span>
                                                </td>
                                                <td class="text-lg-start">
                                                    <span class="tdStyle border-0"><b><?php echo e($item->balance); ?> <span
                                                                class="text-uppercase"><?php echo e($item->currency); ?></span></b></span>
                                                </td>

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>




    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('external-css'); ?>
    <link rel="stylesheet" href="<?php echo e(Config::cssLib('frontend', 'lib/apex.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php echo $__env->make(Config::theme() . 'layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\crypto-script\main\resources\views/frontend/light/user/dashboard.blade.php ENDPATH**/ ?>