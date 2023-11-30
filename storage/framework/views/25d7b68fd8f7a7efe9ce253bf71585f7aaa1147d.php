<ul class="page-link-list">
  <li>
    <a href="<?php echo e(route('admin.user.index')); ?>" class="<?php echo e(Config::activeMenu(route('admin.user.index'))); ?>">
      <i class="las la-user"></i> 
      <?php echo e(__('All Users')); ?>

    </a>
  </li>
  <li>
    <a href="<?php echo e(route('admin.user.filter', 'active')); ?>" class="<?php echo e(Config::activeMenu(route('admin.user.filter', 'active'))); ?>">
      <i class="las la-user-check"></i> 
      <?php echo e(__('Active Users')); ?>

    </a>
  </li>
  <li>
    <a href="<?php echo e(route('admin.user.filter', 'deactive')); ?>" class="<?php echo e(Config::activeMenu(route('admin.user.filter', 'deactive'))); ?>">
      <i class="las la-user-slash"></i> 
      <?php echo e(__('Deactive Users')); ?>

      <?php if(Config::sidebarData()['deactiveUser']): ?>
          <span class="noti-count"><?php echo e(Config::sidebarData()['deactiveUser']); ?></span>
      <?php endif; ?>
    </a>
  </li>
  <li>
    <a href="<?php echo e(route('admin.user.filter', 'email-unverified')); ?>" class="<?php echo e(Config::activeMenu(route('admin.user.filter', 'email-unverified'))); ?>">
      <i class="las la-envelope"></i> 
      <?php echo e(__('Email Unverified')); ?>

      <?php if(Config::sidebarData()['emailUnverified']): ?>
          <span class="noti-count"><?php echo e(Config::sidebarData()['emailUnverified']); ?></span>
      <?php endif; ?>
    </a>
  </li>
  <li>
    <a href="<?php echo e(route('admin.user.filter', 'sms-unverified')); ?>" class="<?php echo e(Config::activeMenu(route('admin.user.filter', 'sms-unverified'))); ?>">
      <i class="las la-comments"></i> 
      <?php echo e(__('Sms Unverified')); ?>

      <?php if(Config::sidebarData()['smsUnverified']): ?>
          <span class="noti-count"><?php echo e(Config::sidebarData()['smsUnverified']); ?></span>
      <?php endif; ?>
    </a>
  </li>
  <li>
    <a href="<?php echo e(route('admin.user.kyc.req')); ?>" class="<?php echo e(Config::activeMenu(route('admin.user.kyc.req'))); ?>">
      <i class="las la-user-shield"></i> 
      <?php echo e(__('KYC Verify')); ?>

      <?php if(Config::sidebarData()['kyc_req']): ?>
          <span class="noti-count"><?php echo e(Config::sidebarData()['kyc_req']); ?></span>
      <?php endif; ?>
    </a>
  </li>
  <li>
    <a href="<?php echo e(route('admin.user.filter', 'kyc-unverified')); ?>" class="<?php echo e(Config::activeMenu(route('admin.user.filter', 'kyc-unverified'))); ?>">
      <i class="las la-user-times"></i> 
      <?php echo e(__('KYC Unverified')); ?>

      <?php if(Config::sidebarData()['kycUnverified']): ?>
          <span class="noti-count"><?php echo e(Config::sidebarData()['kycUnverified']); ?></span>
      <?php endif; ?>
    </a>
  </li>
</ul><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/crypto-script/main/resources/views/backend/users/tab_list.blade.php ENDPATH**/ ?>