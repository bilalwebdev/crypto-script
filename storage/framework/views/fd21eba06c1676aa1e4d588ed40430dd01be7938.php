<?php
    $content = Config::builder('footer');
    
    $links = Config::builder('links', true);

    $socials = Config::builder('socials', true);

    $element = Config::builder('brand', true);
?>


<div class="sp_brand_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sp_brand_slider">
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="sp_brand_slide">
                            <div class="sp_brand_item">
                                <img src="<?php echo e(Config::getFile('brand', $brand->content->image_one)); ?>" alt="brand image">
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </div>
    </div>
</div><!-- sp_brand_wrapper end -->

<!-- footer section start -->
<footer class="footer-section">
    <div class="sp_footer_menu_area">
        <div class="back-to-top">
            <div class="back-to-top-inner">
                <a href="#"><i class="las la-arrow-up"></i></a>
            </div>
        </div>

        <div class="container">
            <div class="row gy-4 justify-content-between">
                <div class="col-lg-4 pe-xl-5">
                    <div class="sp_footer_item">
                        <a href="<?php echo e(route('home')); ?>" class="site-logo"><img src="<?php echo e(Config::getFile('footer', $content->content->image_one)); ?>" alt="logo"></a>
                        <p class="mt-4"><?php echo e(Config::trans($content->content->footer_short_details)); ?></p>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="sp_footer_item">
                        <h5 class="sp_footer_item_title"><?php echo e(__('Company')); ?></h5>

                        <ul class="sp_footer_menu">
                            <?php $__currentLoopData = Config::pages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('pages', $page->slug)); ?>"><?php echo e(__($page->name)); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="sp_footer_item">
                        <h5 class="sp_footer_item_title"><?php echo e(__('Links')); ?></h5>
                        <ul class="sp_footer_menu">
                            <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('links', [$item->id, Str::slug($item->content->page_title)])); ?>"><?php echo e(Config::trans($item->content->page_title)); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="sp_footer_item">
                        <h5 class="sp_footer_item_title"><?php echo e(__('Newsletter')); ?></h5>
                        <form class="sp_subscription_form" id="subscribe" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="email" name="email" class="form-control subscribe-email"
                                placeholder="Email Address">
                            <button type="submit" class="subs-btn"><i class="far fa-paper-plane"></i></button>
                        </form>
                        <h5 class="mt-4 text-white"><?php echo e(__('Social Links')); ?></h5>
                        <ul class="sp_social_links mt-2">
                            <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e($social->content->link); ?>"><i class="<?php echo e($social->content->icon); ?>"></i></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- footer-top end -->
    <div class="sp_copy_right_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p><?php echo e(Config::config()->copyright); ?></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer section end -->
<?php /**PATH D:\personal\crypto-script\resources\views/frontend/light/widgets/footer.blade.php ENDPATH**/ ?>