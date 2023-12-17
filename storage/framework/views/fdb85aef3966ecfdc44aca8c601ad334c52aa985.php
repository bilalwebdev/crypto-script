<!-- Sidebar start -->
<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="<?php echo e(route('admin.home')); ?>" aria-expanded="false">
                    <i data-feather="home"></i>
                    <span class="nav-text"><?php echo e(__('Dashboard')); ?></span>
                </a>
            </li>

            

            

            




            

            


            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i data-feather="activity"></i><span
                        class="nav-text"><?php echo e(__('Transactions')); ?></span></a>
                <ul aria-expanded="false">
                    <?php if(auth()->guard('admin')->user()->can('manage-deposit')): ?>
                        <li><a class="" href="<?php echo e(route('admin.transac')); ?>"
                                aria-expanded="false"><?php echo e(__('Transaction into account')); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if(auth()->guard('admin')->user()->can('manage-withdraw')): ?>
                        <li><a class="" href="<?php echo e(route('admin.withdraws')); ?>"
                                aria-expanded="false"><?php echo e(__('Manage Withdraw')); ?></a>
                            
                        </li>
                    <?php endif; ?>
                    <?php if(auth()->guard('admin')->user()->can('manage-deposit')): ?>
                        <li><a class="" href="<?php echo e(route('admin.deposits')); ?>"
                                aria-expanded="false"><?php echo e(__('Manage Deposit')); ?></a>
                            
                        </li>
                    <?php endif; ?>

                </ul>

            </li>


            <?php if(auth()->guard('admin')->user()->can('manage-user')): ?>
                <li><a href="<?php echo e(route('admin.user.index')); ?>"><i data-feather="user"></i><span
                            class="nav-text"><?php echo e(__('Manage Users')); ?></span></a>
                </li>
            <?php endif; ?>
            <?php if(auth()->guard('admin')->user()->can('manage-gateway')): ?>
                <li><a href="<?php echo e(route('admin.payment-method.index')); ?>" aria-expanded="false"><i
                            data-feather="credit-card"></i><span
                            class="nav-text"><?php echo e(__('Payment Methods')); ?></span></a>
                </li>
            <?php endif; ?>

            



            


            

            <li class="nav-label"><?php echo e(__('Current Version') . ' - ' . Config::APP_VERSION); ?></li>
        </ul>
    </div>
</div>
<!-- Sidebar end -->
<?php /**PATH E:\personal\crypto-script\resources\views/backend/layout/sidebar.blade.php ENDPATH**/ ?>