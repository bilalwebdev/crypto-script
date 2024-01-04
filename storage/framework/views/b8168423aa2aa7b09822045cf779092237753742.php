<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title><?php echo e(Config::config()->appname); ?></title>

    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(Config::fetchImage('icon', Config::config()->favicon, true)); ?>">

    <link href="<?php echo e(Config::cssLib('backend', 'all.min.css')); ?>" rel="stylesheet">


    <link href="<?php echo e(Config::cssLib('backend', 'line-awesome.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(Config::cssLib('backend', 'perfect-scrollbar.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(Config::cssLib('backend', 'metisMenu.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(Config::cssLib('backend', 'uploader.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(Config::cssLib('backend', 'iconpicker.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(Config::cssLib('backend', 'jquery.dataTables.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(Config::cssLib('backend', 'summernote-bs4.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(Config::cssLib('backend', 'ui.css')); ?>" rel="stylesheet">

    <?php if(Config::config()->alert === 'izi'): ?>
        <link href="<?php echo e(Config::cssLib('backend', 'izitoast.min.css')); ?>" rel="stylesheet">
    <?php elseif(Config::config()->alert === 'toast'): ?>
        <link href="<?php echo e(Config::cssLib('backend', 'toastr.min.css')); ?>" rel="stylesheet">
    <?php else: ?>
        <link href="<?php echo e(Config::cssLib('backend', 'sweetalert.min.css')); ?>" rel="stylesheet">
    <?php endif; ?>

    <?php echo $__env->yieldPushContent('external-style'); ?>

    <link href="<?php echo e(Config::cssLib('backend', 'main.css')); ?>" rel="stylesheet">

    <?php echo $__env->yieldPushContent('style'); ?>

</head>
<body>

    <div id="main-wrapper">

        <?php echo $__env->make('backend.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('backend.layout.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="content-body">
            <div id="overlay">
                <div class="cv-spinner">
                    <span class="spinner"></span>
                </div>
            </div>
            <div class="container-fluid">
                <?php echo $__env->make('backend.layout.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php echo $__env->yieldContent('element'); ?>

            </div>
        </div>

        <?php echo $__env->make('backend.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>

    <script src="<?php echo e(Config::jsLib('backend', 'global.min.js')); ?>"></script>

    <script src="<?php echo e(Config::jsLib('backend', 'feather.min.js')); ?>"></script>

    <script src="<?php echo e(Config::jsLib('backend', 'quixnav-init.js')); ?>"></script>

    <script src="<?php echo e(Config::jsLib('backend', 'metismenu.min.js')); ?>"></script>

    <script src="<?php echo e(Config::jsLib('backend', 'perfectscroll.min.js')); ?>"></script>

    <script src="<?php echo e(Config::jsLib('backend', 'jquery.dataTables.min.js')); ?>"></script>

    <script src="<?php echo e(Config::jsLib('backend', 'jquery.uploadPreview.min.js')); ?>"></script>

    <script src="<?php echo e(Config::jsLib('backend', 'summernote-bs4.min.js')); ?>"></script>

    <script src="<?php echo e(Config::jsLib('backend', 'ui.js')); ?>"></script>

    <script src="<?php echo e(Config::jsLib('backend', 'apex-chart.min.js')); ?>"></script>

    <script src="<?php echo e(Config::jsLib('backend', 'iconpicker.js')); ?>"></script>

    <?php if(Config::config()->alert === 'izi'): ?>
        <script src="<?php echo e(Config::jsLib('backend', 'izitoast.min.js')); ?>"></script>
    <?php elseif(Config::config()->alert === 'toast'): ?>
        <script src="<?php echo e(Config::jsLib('backend', 'toastr.min.js')); ?>"></script>
    <?php else: ?>
        <script src="<?php echo e(Config::jsLib('backend', 'sweetalert.min.js')); ?>"></script>
    <?php endif; ?>

    <?php echo $__env->yieldPushContent('external-script'); ?>

    <script src="<?php echo e(Config::jsLib('backend', 'custom.js')); ?>"></script>

    <?php echo $__env->yieldPushContent('script'); ?>
    <?php echo $__env->make('backend.layout.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        $(function() {
            'use strict'
            
            $('.summernote').summernote({
                height: 250,
            });

            var url = "<?php echo e(route('admin.changeLang')); ?>";

            $(".changeLang").change(function() {
                if ($(this).val() == '') {
                    return false;
                }
                window.location.href = url + "?lang=" + $(this).val();
            });
        })
    </script>

</body>

</html>
<?php /**PATH D:\personal\crypto-script\resources\views/backend/layout/master.blade.php ENDPATH**/ ?>