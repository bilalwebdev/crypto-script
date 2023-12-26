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



            <li><a href="<?php echo e(route('admin.user.index')); ?>"><i data-feather="user"></i><span
                        class="nav-text"><?php echo e(__('Manage Users')); ?></span></a>
            </li>

            <?php if(auth()->guard('admin')->user()->can('manage-gateway')): ?>
                <li><a href="<?php echo e(route('admin.payment-method.index')); ?>" aria-expanded="false"><i
                            data-feather="credit-card"></i><span
                            class="nav-text"><?php echo e(__('Payment Methods')); ?></span></a>
                </li>
            <?php endif; ?>

            



            


            

            <?php if(auth()->guard('admin')->user()->can('manage-role') ||
                    auth()->guard('admin')->user()->can('manage-admin')): ?>
                <li class="nav-label"><?php echo e(__('Administration')); ?></li>
            <?php endif; ?>

            <?php if(auth()->guard('admin')->user()->can('manage-role')): ?>
                <li>
                    <a href="<?php echo e(route('admin.roles.index')); ?>" aria-expanded="false">
                        <i data-feather="users"></i>
                        <span class="nav-text"><?php echo e(__('Manage Roles')); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(auth()->guard('admin')->user()->can('manage-admin')): ?>
                <li>
                    <a href="<?php echo e(route('admin.admins.index')); ?>" aria-expanded="false">
                        <i data-feather="user-check"></i>
                        <span class="nav-text"><?php echo e(__('Manage Admins')); ?></span>
                    </a>
                </li>
            <?php endif; ?>



            <li class="nav-label"><?php echo e(__('Others')); ?></li>
            <?php if(auth()->guard('admin')->user()->can('manage-logs')): ?>
                <li>
                    <a href="<?php echo e(route('admin.transaction')); ?>" aria-expanded="false">
                        <i data-feather="file-text"></i>
                        <span class="nav-text"><?php echo e(__('Manage Logs')); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(auth()->guard('admin')->user()->can('manage-ticket')): ?>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            data-feather="inbox"></i><span class="nav-text"><?php echo e(__('Support Ticket')); ?></span></a>
                    <ul aria-expanded="false">

                        <li><a href="<?php echo e(route('admin.ticket.index')); ?>"><?php echo e(__('All Tickets')); ?></a></li>

                        <li><a href="<?php echo e(route('admin.ticket.status', 'pending')); ?>"><?php echo e(__('Pending Ticket')); ?>

                                <?php if(Config::sidebarData()['pendingTicket'] > 0): ?>
                                    <span class="noti-count"><?php echo e(Config::sidebarData()['pendingTicket']); ?></span>
                                <?php endif; ?>
                            </a></li>

                        <li><a href="<?php echo e(route('admin.ticket.status', 'answered')); ?>"><?php echo e(__('Answered Ticket')); ?></a>
                        </li>

                        <li><a href="<?php echo e(route('admin.ticket.status', 'closed')); ?>"><?php echo e(__('Closed Ticket')); ?></a>
                        </li>


                    </ul>
                </li>
            <?php endif; ?>

            <?php if(auth()->guard('admin')->user()->can('manage-subscriber')): ?>
                <li><a href="<?php echo e(route('admin.subscribers')); ?>" aria-expanded="false"><i
                            data-feather="at-sign"></i><span class="nav-text"><?php echo e(__('Subscribers')); ?></span></a>
                </li>
            <?php endif; ?>

            <li><a href="<?php echo e(route('admin.notifications')); ?>" aria-expanded="false"><i data-feather="feather"></i><span
                        class="nav-text"><?php echo e(__('All Notification')); ?></span></a>
            </li>

            <li><a href="<?php echo e(route('admin.general.cacheclear')); ?>" aria-expanded="false"><i
                        data-feather="feather"></i><span class="nav-text"><?php echo e(__('Clear Cache')); ?></span></a>
            </li>

            <li class="nav-label"><?php echo e(__('Current Version') . ' - ' . Config::APP_VERSION); ?></li>
        </ul>
    </div>
</div>
<!-- Sidebar end -->
<?php /**PATH D:\personal\crypto-script\resources\views/backend/layout/sidebar.blade.php ENDPATH**/ ?>