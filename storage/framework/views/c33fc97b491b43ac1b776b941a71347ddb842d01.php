if (response.success) {

    <?php if(Config::config()->alert === 'izi'): ?>
        iziToast.success({
            position: 'topRight',
            message: "<?php echo e($message); ?>",
        });
    <?php elseif(Config::config()->alert === 'toast'): ?>
        toastr.success("<?php echo e($message); ?>", {
            positionClass: "toast-top-right"

        })
    <?php else: ?>
        Swal.fire({
            icon: 'success',
            title: "<?php echo e($message); ?>"
        })
    <?php endif; ?>

    return
}


<?php if(Config::config()->alert === 'izi'): ?>
    iziToast.error({
        position: 'topRight',
        message: "<?php echo e($message_error); ?>",
    });
<?php elseif(Config::config()->alert === 'toast'): ?>
    toastr.error("<?php echo e($message_error); ?>", {
        positionClass: "toast-top-right"

    })
<?php else: ?>
    Swal.fire({
        icon: 'error',
        title: "<?php echo e($message_error); ?>"
    })
<?php endif; ?><?php /**PATH E:\personal\crypto-script\resources\views/frontend/light/layout/ajax_alert.blade.php ENDPATH**/ ?>