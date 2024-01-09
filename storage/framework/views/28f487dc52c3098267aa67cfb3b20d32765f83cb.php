

<?php $__env->startSection('content'); ?>
    <?php if($page->widgets): ?>
        <?php $__currentLoopData = $page->widgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?= Section::render($section->sections) ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(Config::theme() . 'layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/frontend/light/pages.blade.php ENDPATH**/ ?>