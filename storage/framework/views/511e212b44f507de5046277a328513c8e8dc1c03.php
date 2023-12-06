


<?php $__env->startSection('element'); ?>
    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">

                <div class="card-body text-center">
                    <ul class="list-group">
                        

                        <li class="list-group-item d-flex justify-content-between">

                            <span><?php echo e(__('Payment Date')); ?></span>
                            <span><?php echo e($deposit->created_at->format('d F Y')); ?></span>

                        </li>
                        <li class="list-group-item d-flex justify-content-between">

                            <span><?php echo e(__('Payment Amount')); ?></span>
                            <span><?php echo e($deposit->amount); ?></span>

                        </li>
                        <li class="list-group-item d-flex justify-content-between">

                            <span><?php echo e(__('Payment Method')); ?></span>
                            <span><?php echo e($deposit->payment->name); ?></span>

                        </li>
                          <li class="list-group-item d-flex justify-content-between">

                            <span><?php echo e(__('Payment Status')); ?></span>
                          
                                <?php if($deposit->status == 2): ?>
                                <span class="badge badge-warning"><?php echo e(__('Pending')); ?></span>
                                <?php elseif($deposit->status == 1): ?>
                                    <span class="badge badge-success"><?php echo e(__('Approved')); ?></span>
                                <?php elseif($deposit->status == 3): ?>
                                    <span class="badge badge-danger"><?php echo e(__('Rejected')); ?></span>
                                <?php endif; ?>
                                

                        </li>
                        

                    </ul>


                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/backend/deposit/details.blade.php ENDPATH**/ ?>