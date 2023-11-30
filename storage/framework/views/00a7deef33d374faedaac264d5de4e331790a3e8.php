<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="description" content="<?php echo e($page->seo_description ?? Config::config()->seo_description); ?>" />
    <meta name="keywords" content="<?php echo e(implode(',', $page->seo_keywords ?? Config::config()->seo_tags)); ?> ">

    <title><?php echo e(Config::config()->appname); ?></title>

    <link rel="stylesheet" href="<?php echo e(optional(Config::config()->fonts)->heading_font_url); ?>">
    <link rel="stylesheet" href="<?php echo e(optional(Config::config()->fonts)->paragraph_font_url); ?>">

    <link rel="shortcut icon" type="image/png" href="<?php echo e(Config::getFile('icon', Config::config()->favicon, true)); ?>">

    <link rel="stylesheet" href="<?php echo e(Config::cssLib('frontend', 'lib/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(Config::cssLib('frontend', 'all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(Config::cssLib('frontend', 'line-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(Config::cssLib('frontend', 'lib/slick.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(Config::cssLib('frontend', 'lib/odometer.css')); ?>">

    <?php if(Config::config()->alert === 'izi'): ?>
        <link rel="stylesheet" href="<?php echo e(Config::cssLib('frontend', 'izitoast.min.css')); ?>">
    <?php elseif(Config::config()->alert === 'toast'): ?>
        <link href="<?php echo e(Config::cssLib('frontend', 'toastr.min.css')); ?>" rel="stylesheet">
    <?php else: ?>
        <link href="<?php echo e(Config::cssLib('frontend', 'sweetalert.min.css')); ?>" rel="stylesheet">
    <?php endif; ?>

    <link href="<?php echo e(Config::cssLib('frontend', 'main.css')); ?>" rel="stylesheet">

    <?php
        $heading = optional(Config::config()->fonts)->heading_font_family;
        $paragraph = optional(Config::config()->fonts)->paragraph_font_family;
    ?>

    <style>
        :root {
            --clr-main: <?= Config::config()->color[Config::config()->theme] ?? '#9c0ac1' ?>;
            --h-font: <?=$heading ?>;
            --p-font: <?=$paragraph ?>;
        }
    </style>

    <?php echo $__env->yieldPushContent('external-css'); ?>


</head>

<body>

    <?php if(Config::config()->preloader_status): ?>
        <div class="preloader-holder">
            <div class="preloader">
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
            </div>
        </div>
    <?php endif; ?>


    <?php if(Config::config()->analytics_status): ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(Config::config()->analytics_key); ?>"></script>
        <script>
            'use strict'
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag("js", new Date());
            gtag("config", "<?php echo e(Config::config()->analytics_key); ?>");
        </script>
    <?php endif; ?>

    <?php if(Config::config()->allow_modal): ?>
        <?php echo $__env->make('cookieConsent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php
        $content= App\Models\Content::where('name', 'auth')->where('theme', Config::config()->theme)->first();
    ?>
    

    <div class="account-page">
        <div class="form-wrapper">
            <div class="logo text-center">
                <a href="<?php echo e(route('home')); ?>" class="site-logo"><img src="<?php echo e(Config::getFile('dark_logo', Config::config()->dark_logo, true)); ?>"
                        alt="image"></a>
            </div>
            <div class="inner-wrapper">
                <h3 class="title"><?php echo e($content->content->title); ?></h3>
                <?php echo $__env->yieldContent('content'); ?>
            </div>
            <div class="copy-right-text">
                <p><?php echo e(__(Config::config()->copyright)); ?></p>
            </div>
        </div>
        <div class="img-wrapper">
            <img src="<?php echo e(Config::getFile('auth', $content->content->image_one)); ?>" class="account-line-bg" alt="image">
        </div>
    </div>

    <script src="<?php echo e(Config::jsLib('frontend', 'lib/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(Config::jsLib('frontend', 'lib/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(Config::jsLib('frontend', 'lib/slick.min.js')); ?>"></script>
    <script src="<?php echo e(Config::jsLib('frontend', 'lib/wow.min.js')); ?>"></script>
    <script src="<?php echo e(Config::jsLib('frontend', 'lib/jquery.paroller.min.js')); ?>"></script>
    <script src="<?php echo e(Config::jsLib('frontend', 'lib/TweenMax.min.js')); ?>"></script>
    <script src="<?php echo e(Config::jsLib('frontend', 'lib/odometer.min.js')); ?>"></script>
    <script src="<?php echo e(Config::jsLib('frontend', 'lib/viewport.jquery.js')); ?>"></script>

    <?php if(Config::config()->alert === 'izi'): ?>
        <script src="<?php echo e(Config::jsLib('frontend', 'izitoast.min.js')); ?>"></script>
    <?php elseif(Config::config()->alert === 'toast'): ?>
        <script src="<?php echo e(Config::jsLib('frontend', 'toastr.min.js')); ?>"></script>
    <?php else: ?>
        <script src="<?php echo e(Config::jsLib('frontend', 'sweetalert.min.js')); ?>"></script>
    <?php endif; ?>

    <script src="<?php echo e(Config::jsLib('frontend', 'main.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('script'); ?>


    <?php echo $__env->make('alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\crypto-script\main\resources\views/frontend/light/auth/master.blade.php ENDPATH**/ ?>