 <!-- Nav header start -->
 <div class="nav-header">
     <a href="<?php echo e(route('admin.home')); ?>" class="brand-logo">
         <img class="brand-title" src="<?php echo e(Config::fetchImage('logo', Config::config()->logo, true)); ?>" alt="">
     </a>
     <div class="nav-control">
         <div class="hamburger">
             <span class="line"></span><span class="line"></span><span class="line"></span>
         </div>
     </div>
 </div>
 <!-- Nav header end -->

 <!-- Header start -->
 <div class="header">
     <div class="header-content">
         <nav class="navbar navbar-expand">
             <div class="collapse navbar-collapse justify-content-between">
                 <div class="header-left">
                     <button type="button" class="sidebar-open">
                         <span class="line"></span>
                     </button>
                     <a href="<?php echo e(route('admin.home')); ?>" class="mobile-brand-logo">
                         <img class="brand-title"
                             src="<?php echo e(Config::fetchImage('icon', Config::config()->favicon, true)); ?>" alt="">
                     </a>
                     <div class="header-search d-lg-block d-none">
                         <button type="button" class="header-search-res-btn">
                             <i data-feather="search"></i>
                         </button>
                         <div class="form">
                             <input class="form-control searchNav" type="text" placeholder="Search"
                                 aria-label="Search">
                             <ul class="search-item">

                             </ul>
                             <button type="search"><i class="las la-search"></i></button>
                         </div>
                     </div>
                 </div>

                 <ul class="navbar-nav header-right">
                     
                     <li class="nav-item dropdown notification_dropdown">
                         <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                             <i data-feather="bell"></i>
                             <?php if(Config::notifications()->count() > 0): ?>
                                 <div class="pulse-css"></div>
                             <?php endif; ?>
                         </a>
                         <div class="dropdown-menu dropdown-menu-right">
                             <ul class="list-unstyled">
                                 <?php $__empty_1 = true; $__currentLoopData = Config::notifications(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                     <li class="media dropdown-item">
                                         <span class="success"><i class="las la-envelope"></i></span>
                                         <div class="media-body">
                                             <a href="<?php echo e($notification->data['url']); ?>">
                                                 <p>
                                                     <?php echo e($notification->data['message']); ?>

                                                 </p>
                                             </a>
                                         </div>
                                         <span
                                             class="notify-time"><?php echo e($notification->created_at->format('h:m A')); ?></span>
                                     </li>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                     <li class="media dropdown-item">

                                         <div class="media-body ">

                                             <p class="text-center">
                                                 <?php echo e(__('No Notifications')); ?>

                                             </p>

                                         </div>

                                     </li>
                                 <?php endif; ?>
                             </ul>
                             <a class="all-notification"
                                 href="<?php echo e(route('admin.notifications')); ?>"><?php echo e(__('See all notifications')); ?> <i
                                     class="ti-arrow-right"></i></a>
                         </div>
                     </li>
                     <li class="nav-item dropdown header-profile">
                         <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                             <i data-feather="user"></i>
                         </a>
                         <div class="dropdown-menu dropdown-menu-right">
                             <a href="<?php echo e(route('admin.profile')); ?>" class="dropdown-item">
                                 <i class="las la-user"></i>
                                 <span class="ml-2"><?php echo e(__('Profile')); ?> </span>
                             </a>

                             <a href="<?php echo e(route('admin.logout')); ?>" class="dropdown-item">
                                 <i class="las la-sign-out-alt"></i>
                                 <span class="ml-2"><?php echo e(__('Logout')); ?> </span>
                             </a>
                         </div>
                     </li>
                     <li class="d-lg-none d-flex justify-content-center align-items-center pl-md-0">
                         <div class="header-search">
                             <button type="button" class="header-search-res-btn">
                                 <i data-feather="search"></i>
                             </button>
                             <div class="form">
                                 <input class="form-control searchNav" type="text" placeholder="Search"
                                     aria-label="Search">
                                 <ul class="search-item">

                                 </ul>
                                 <button type="search"><i class="las la-search"></i></button>
                             </div>
                         </div>
                     </li>
                 </ul>
             </div>
         </nav>
     </div>
 </div>
 <!-- Header end -->


 <!-- mobile bottom menu start -->
 <div class="mobile-bottom-menu">
     <a href="<?php echo e(route('admin.notifications')); ?>">
         <i data-feather="bell"></i>
         <p><?php echo e(__('Notification')); ?></p>
     </a>
     <a href="<?php echo e(route('admin.profile')); ?>" class="profile-img">
         <img src="<?php echo e(asset('asset/backend/images/' .auth()->guard('admin')->user()->image)); ?>" alt="image">
     </a>
     <a href="<?php echo e(route('home')); ?>">
         <i data-feather="globe"></i>
         <p><?php echo e(__('Visit Frontend')); ?></p>
     </a>
 </div>
 <!-- mobile bottom menu end -->
<?php /**PATH D:\pratice\crypto-script\resources\views/backend/layout/header.blade.php ENDPATH**/ ?>