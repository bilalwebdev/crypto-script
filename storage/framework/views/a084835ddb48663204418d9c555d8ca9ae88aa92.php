

<?php $__env->startSection('content'); ?>
    <?php $__currentLoopData = $page->widgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <?= Section::render($section->sections) ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(Config::theme() . 'layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\personal\crypto-script\main\resources\views/frontend/light/home.blade.php ENDPATH**/ ?>