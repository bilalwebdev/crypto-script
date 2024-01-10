<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title><?php echo e(Config::config()->appname); ?></title>

    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(Config::fetchImage('icon', Config::config()->favicon, true)); ?>">

    
    <?php if(Config::config()->alert === 'izi'): ?>
        <link rel="stylesheet" href="<?php echo e(Config::cssLib('backend', 'izitoast.min.css')); ?>">
    <?php elseif(Config::config()->alert === 'toast'): ?>
        <link href="<?php echo e(Config::cssLib('backend', 'toastr.min.css')); ?>" rel="stylesheet">
    <?php else: ?>
        <link href="<?php echo e(Config::cssLib('backend', 'sweetalert.min.css')); ?>" rel="stylesheet">
    <?php endif; ?>

    <link href="<?php echo e(Config::cssLib('backend', 'main.css')); ?>" rel="stylesheet">

</head>

<body class="h-100">

    <div class="authincation">
        <div class="authincation-content rounded-xl">
            <div class="auth-form rounded-xl">
                <h3 class="text-center mb-4"><?php echo e($title); ?></h3>
                <?php echo $__env->yieldContent('element'); ?>
            </div>
        </div>
    </div>

    <script src="<?php echo e(Config::jsLib('backend', 'global.min.js')); ?>"></script>

    <?php if(Config::config()->alert === 'izi'): ?>
        <script src="<?php echo e(Config::jsLib('backend', 'izitoast.min.js')); ?>"></script>
    <?php elseif(Config::config()->alert === 'toast'): ?>
        <script src="<?php echo e(Config::jsLib('backend', 'toastr.min.js')); ?>"></script>
    <?php else: ?>
        <script src="<?php echo e(Config::jsLib('backend', 'sweetalert.min.js')); ?>"></script>
    <?php endif; ?>

    <?php echo $__env->make('alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <?php echo $__env->yieldPushContent('script'); ?>

</body>

</html>
<?php /**PATH E:\personal\crypto-script\resources\views/backend/auth/auth.blade.php ENDPATH**/ ?>