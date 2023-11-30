<div class="row align-items-center page-top">
    <div class="col-sm-6">
        <div class="welcome-text">
            <h4 class="mb-0"><?php echo e(__($title)); ?></h4>
        </div>
    </div>
    <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.home')); ?>"><?php echo e(__('Home')); ?></a></li>
            <li class="breadcrumb-item active"><a href="<?php echo e(url()->current()); ?>"><?php echo e(__($title)); ?></a></li>
        </ol>
    </div>
</div><?php /**PATH C:\xampp\htdocs\crypto-script\main\resources\views/backend/layout/breadcrumb.blade.php ENDPATH**/ ?>