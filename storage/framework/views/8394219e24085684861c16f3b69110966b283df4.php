<ul class="page-link-list">
    <li>
        <a href="<?php echo e(route('admin.transaction')); ?>" class="<?php echo e(Config::activeMenu(route('admin.transaction'))); ?>">
            <i class="las la-user"></i>
            <?php echo e(__('Transction Log')); ?>

        </a>
    </li>
    <li>
        <a href="<?php echo e(route('admin.trade')); ?>" class="<?php echo e(Config::activeMenu(route('admin.trade'))); ?>">
            <i class="las la-user"></i>
            <?php echo e(__('Trade Log')); ?>

        </a>
    </li>
    
    <li>
        <a href="<?php echo e(route('admin.commision')); ?>"
            class="<?php echo e(Config::activeMenu(route('admin.commision'))); ?>">
            <i class="las la-user-check"></i>
            <?php echo e(__('Refferal Commission')); ?>

        </a>
    </li>
    <li>
        <a href="<?php echo e(route('admin.deposit.log')); ?>"
            class="<?php echo e(Config::activeMenu(route('admin.deposit.log'))); ?>">
            <i class="las la-user-slash"></i>
            <?php echo e(__('Deposit report')); ?>

           
        </a>
    </li>
    <li>
        <a href="<?php echo e(route('admin.payment.report')); ?>"
            class="<?php echo e(Config::activeMenu(route('admin.payment.report'))); ?>">
            <i class="las la-envelope"></i>
            <?php echo e(__('Payment report')); ?>

           
        </a>
    </li>
    <li>
        <a href="<?php echo e(route('admin.withdraw.report')); ?>"
            class="<?php echo e(Config::activeMenu(route('admin.withdraw.report'))); ?>">
            <i class="las la-comments"></i>
            <?php echo e(__('Withdraw Report')); ?>

            
        </a>
    </li>
    <li>
        <a href="<?php echo e(route('admin.transfer.report')); ?>" class="<?php echo e(Config::activeMenu(route('admin.transfer.report'))); ?>">
            <i class="las la-user-shield"></i>
            <?php echo e(__('Money Transfer Report')); ?>

            
        </a>
    </li>
   
</ul>
<?php /**PATH C:\xampp\htdocs\code_sig\Scripts\main\resources\views/backend/logs/tab_list.blade.php ENDPATH**/ ?>