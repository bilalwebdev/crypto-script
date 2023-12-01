<aside class="user-sidebar">
    <a href="<?php echo e(route('user.dashboard')); ?>" class="site-logo">
        <img src="<?php echo e(Config::getFile('dark_logo', Config::config()->dark_logo, true)); ?>" alt="image">
    </a>

    <div class="user-sidebar-bottom">
        <div id="countdown"></div>
    </div>

    <ul class="sidebar-menu">
        <li class="<?php echo e(Config::singleMenu('user.dashboard')); ?>"><a href="<?php echo e(route('user.dashboard')); ?>" class="active"><i
                    class="fas fa-home"></i>
                <?php echo e(__('Dashboard')); ?></a></li>

        <li class="<?php echo e(Config::singleMenu('user.deposit')); ?>"><a href="<?php echo e(route('user.deposit')); ?>"><i
                    class="fas fa-credit-card"></i><?php echo e(__('Deposit')); ?></a></li>
        
        <li class="<?php echo e(Config::singleMenu('user.withdraw')); ?>"><a href="<?php echo e(route('user.withdraw')); ?>"><i
                    class="fas fa-hand-holding-usd"></i> <?php echo e(__('Withdraw')); ?></a></li>
        
        
        <li class="<?php echo e(Config::singleMenu('user.history')); ?>"><a href="<?php echo e(route('user.history')); ?>"><i
                    class="fas fa-history"></i> <?php echo e(__('Transactions History')); ?></a></li>









        

        

        

        


        

        <li class="<?php echo e(Config::singleMenu('user.refferalLog')); ?>"><a href="<?php echo e(route('user.refferalLog')); ?>"><i
                    class="fas fa-user-cog"></i> <?php echo e(__('Refferal Log')); ?></a></li>

        <li class="<?php echo e(Config::singleMenu('user.ticket.index')); ?>"><a href="<?php echo e(route('user.ticket.index')); ?>"><i
                    class="fas fa-ticket-alt"></i> <?php echo e(__('Support Ticket')); ?></a></li>

        <li class="<?php echo e(Config::singleMenu('user.profile')); ?>"><a href="<?php echo e(route('user.profile')); ?>"><i
                        class="fas fa-user-cog"></i> <?php echo e(__('Profile Settings')); ?></a></li>

        <li class="<?php echo e(Config::singleMenu('user.logout')); ?>"><a href="<?php echo e(route('user.logout')); ?>"><i
                    class="fas fa-sign-out-alt"></i> <?php echo e(__('Logout')); ?></a></li>
    </ul>
</aside>

<!-- mobile bottom menu start -->
<div class="mobile-bottom-menu-wrapper">
    <ul class="mobile-bottom-menu">

        <li>
            <a href="<?php echo e(route('user.deposit')); ?>" class="<?php echo e(Config::activeMenu(route('user.deposit'))); ?>">
                <i class="fas fa-wallet"></i>
                <span><?php echo e(__('Deposit')); ?></span>
            </a>
        </li>

        <li>
            <a href="<?php echo e(route('user.history')); ?>"
                class="<?php echo e(Config::activeMenu(route('user.history'))); ?>">
                <i class="fas fa-history"></i>
                <span><?php echo e(__('History')); ?></span>
            </a>
        </li>
        
        <li>
            <a href="<?php echo e(route('user.dashboard')); ?>" class="<?php echo e(Config::activeMenu(route('user.dashboard'))); ?>">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
        </li>

        <li>
            <a href="<?php echo e(route('user.withdraw')); ?>" class="<?php echo e(Config::activeMenu(route('user.withdraw'))); ?>">
                <i class="fas fa-hand-holding-usd"></i>
                <span><?php echo e(__('Withdraw')); ?></span>
            </a>
        </li>

        <li class="sidebar-open-btn">
            <a href="#0" class="">
                <i class="fas fa-bars"></i>
                <span><?php echo e(__('Menu')); ?></span>
            </a>
        </li>
    </ul>
</div>

<?php /**PATH D:\personal\crypto-script\resources\views/frontend/light/layout/user_sidebar.blade.php ENDPATH**/ ?>