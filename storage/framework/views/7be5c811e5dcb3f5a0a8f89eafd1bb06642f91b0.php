<?php
    $singleElement = Config::builder('contact');
    $socials = Config::builder('socials', true);
?>


<header class="sp_header">
    <div class="sp_header_info_bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 header-top-left">
                    <ul class="hc-list justify-content-lg-start justify-content-center">
                        <li><a href="mailto:<?php echo e($singleElement->content->email ?? ''); ?>"><i class="fas fa-envelope"></i>
                                <?php echo e($singleElement->content->email ?? ''); ?></a></li>
                        <li><a href="tel:<?php echo e($singleElement->content->phone ?? ''); ?>"><i class="fas fa-phone-alt"></i>
                                <?php echo e($singleElement->content->phone ?? ''); ?></a></li>
                    </ul>
                </div>
                <div class="col-lg-6 header-top-right d-lg-block d-none">
                    <ul class="hc-list justify-content-lg-end justify-content-center">
                        <li>
                            <ul class="social-icons">
                                <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e($social->content->link); ?>"><i
                                                class="<?php echo e($social->content->icon); ?>"></i></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                        <li>
                            <select class="custom-select-form selectric ms-3 rounded changeLang nav-link scrollto"
                                aria-label="Default select example">
                                <?php $__currentLoopData = Config::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($language->code); ?>"
                                        <?php echo e(Config::languageSelection($language->code)); ?>>
                                        <?php echo e(__(ucwords($language->name))); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- header-top end -->

    <div class="sp_header_main">
        <div class="container">
            <nav class="navbar navbar-expand-xl p-0 align-items-center">
                <a class="site-logo site-title" href="<?php echo e(route('home')); ?>">
                    <img src="<?php echo e(Config::getFile('logo', Config::config()->logo, true)); ?>" alt="logo">
                </a>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="menu-toggle"></span>
                </button>
                <div class="collapse navbar-collapse mt-lg-0 mt-3" id="mainNavbar">
                    <ul class="nav navbar-nav sp_site_menu ms-auto">
                        <?= Config::navbarMenus() ?>
                    </ul>

                    <select class="custom-select-form  rounded changeLang nav-link mb-3 d-xl-none">
                        <?php $__currentLoopData = Config::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($language->code); ?>" <?php echo e(Config::languageSelection($language->code)); ?>>
                                <?php echo e(__(ucwords($language->name))); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <div class="navbar-action">
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('user.dashboard')); ?>" class="btn sp_theme_btn btn-sm"><?php echo e(__('Dashboard')); ?>

                                <i class="las la-long-arrow-alt-right ms-2"></i></a>
                        <?php else: ?>
                            <a href="<?php echo e(route('user.login')); ?>" class="me-3 text-p"><?php echo e(__('Sign In')); ?></a>
                            <a href="<?php echo e(route('user.register')); ?>" class="btn sp_theme_btn btn-sm"><?php echo e(__('Sign up')); ?> <i
                                    class="las la-long-arrow-alt-right ms-2"></i></a>
                        <?php endif; ?>

                    </div>
                </div>
            </nav>
        </div>
    </div><!-- header-bottom end -->
</header>
<!-- header-section end  -->
<?php /**PATH D:\personal\crypto-script\resources\views/frontend/default/layout/header.blade.php ENDPATH**/ ?>