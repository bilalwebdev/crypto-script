<script>
    'use strict'

    <?php if(session()->has('error')): ?>
        <?php if(Config::config()->alert === 'sweet'): ?>
            Swal.fire({
                icon: 'error',
                title: "<?php echo e(session('error')); ?>"
            })
        <?php elseif(Config::config()->alert === 'toast'): ?>
            toastr.error("<?php echo e(session('error')); ?>", {
                positionClass: "toast-top-right"

            })
        <?php else: ?>
            iziToast.error({
                position: 'topRight',
                message: "<?php echo e(session('error')); ?>",
            });
        <?php endif; ?>
    <?php endif; ?>


    <?php if(session()->has('success')): ?>

        <?php if(Config::config()->alert === 'sweet'): ?>
            Swal.fire({
                icon: 'success',
                title: "<?php echo e(session('success')); ?>"
            })
        <?php elseif(Config::config()->alert === 'toast'): ?>
            toastr.success("<?php echo e(session('success')); ?>", {
                positionClass: "toast-top-right"

            })
        <?php else: ?>
            iziToast.success({
                position: 'topRight',
                message: "<?php echo e(session('success')); ?>",
            });
        <?php endif; ?>
    <?php endif; ?>


    <?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(Config::config()->alert === 'sweet'): ?>
                Swal.fire({
                    icon: 'error',
                    title: "<?php echo e($error); ?>"
                })
            <?php elseif(Config::config()->alert === 'toast'): ?>
                toastr.error("<?php echo e($error); ?>", {
                    positionClass: "toast-top-right"

                })
            <?php else: ?>
                iziToast.error({
                    position: 'topRight',
                    message: "<?php echo e($error); ?>",
                });
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</script>
<?php /**PATH D:\personal\crypto-script\resources\views/backend/layout/alert.blade.php ENDPATH**/ ?>