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
                                aria-expanded="false"><?php echo e(__('Deposit/Withdrawal into account')); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if(auth()->guard('admin')->user()->can('manage-deposit')): ?>
                        <li><a class="" href="<?php echo e(route('admin.deposits')); ?>"
                                aria-expanded="false"><?php echo e(__('Deposits')); ?></a>
                            
                        </li>
                    <?php endif; ?>
                    <?php if(auth()->guard('admin')->user()->can('manage-withdraw')): ?>
                        <li><a class="" href="<?php echo e(route('admin.withdraws')); ?>"
                                aria-expanded="false"><?php echo e(__('Withdraws')); ?></a>
                            
                        </li>
                    <?php endif; ?>

                </ul>

            </li>


            <li> <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i data-feather="user"></i><span
                        class="nav-text"><?php echo e(__('Wallets/Leads')); ?></span></a>
                <ul aria-expanded="false">
                    <li><a href="<?php echo e(route('admin.user.index')); ?>"><span
                                class="nav-text"><?php echo e(__('Wallets/Leads')); ?></span></a>
                    </li>
                </ul>
            </li>


            <?php if(auth()->guard('admin')->user()->can('manage-gateway')): ?>
                <li><a href="<?php echo e(route('admin.payment-method.index')); ?>" aria-expanded="false"><i
                            data-feather="credit-card"></i><span
                            class="nav-text"><?php echo e(__('Payment Methods')); ?></span></a>
                </li>
            <?php endif; ?>

            



            


            

            
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i data-feather="settings"></i><span
                        class="nav-text"><?php echo e(__('Settings')); ?></span></a>
                <ul aria-expanded="false">
                    <?php if(auth()->guard('admin')->user()->can('manage-role')): ?>
                        <li>
                            <a href="<?php echo e(route('admin.roles.index')); ?>" aria-expanded="false">

                                <span class="nav-text"><?php echo e(__('User Roles')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->guard('admin')->user()->can('manage-admin')): ?>
                        <li>
                            <a href="<?php echo e(route('admin.admins.index')); ?>" aria-expanded="false">

                                <span class="nav-text"><?php echo e(__('Add User')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>



            
            


            <?php if(auth()->guard('admin')->user()->can('manage-ticket')): ?>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            data-feather="inbox"></i><span class="nav-text"><?php echo e(__('Suppor Center')); ?></span></a>
                    <ul aria-expanded="false">

                        <li><a href="<?php echo e(route('admin.ticket.index')); ?>"><?php echo e(__('Tickets')); ?></a></li>

                        


                    </ul>
                </li>
            <?php endif; ?>

            

            
        </ul>
    </div>
</div>
<!-- Sidebar end -->
<?php /**PATH D:\personal\crypto-script\resources\views/backend/layout/sidebar.blade.php ENDPATH**/ ?>