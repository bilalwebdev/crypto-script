


<?php $__env->startSection('element'); ?>
    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">

                <div class="card-header">
                    <form action="" method="get">
                        <div class="input-group">

                            <input type="text" name="date" class="form-control form-control-sm datepicker"
                                placeholder="dates" autocomplete="off">
                            <button class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Sr')); ?></th>
                                    <th><?php echo e(__('Email')); ?></th>
                                    <th><?php echo e(__('Type')); ?></th>
                                    <th><?php echo e(__('Document')); ?></th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Confirm')); ?></th>
                                    <th><?php echo e(__('Reject')); ?></th>
                                    <th><?php echo e(__('Delete')); ?></th>
                                    <th><?php echo e(__('Time')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $kyc_docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key + 1); ?></td>
                                        <td><?php echo e($doc->user->email); ?></td>
                                        <td><?php echo e($doc->type); ?></td>
                                        <td><a data-lightbox="roadtrip<?php echo e($doc->id); ?>"
                                                href="<?php echo e(Config::getFile('kyc', $doc->file, true)); ?>">
                                                <img src="<?php echo e(Config::getFile('kyc', $doc->file, true)); ?>"
                                                    style="width:50px; height:50px; margin-right:8px" alt="">
                                            </a>
                                        <td><?php echo e($doc->user->username); ?></td>
                                        <td>
                                            <?php if($doc->status === 1): ?>
                                                <span class="badge badge-success">Approve</span>
                                            <?php elseif($doc->status === 2): ?>
                                                <span class="badge badge-primary">Pending</span>
                                            <?php else: ?>
                                                <span class="badge badge-danger">Reject</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><a href="<?php echo e(route('admin.kyc-doc.approve', $doc->id)); ?>"
                                                class="btn btn-sm btn-success <?php if($doc->status != 2): ?> disabled <?php endif; ?>">Confirm</a>
                                        </td>
                                        <td><a href="<?php echo e(route('admin.kyc-doc.reject', $doc->id)); ?>"
                                                class="btn btn-sm btn-warning <?php if($doc->status != 2): ?> disabled <?php endif; ?>">Reject</a>
                                        </td>
                                        <td><a href="<?php echo e(route('admin.kyc-doc.delete', $doc->id)); ?>"
                                                class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                        <td><?php echo e($doc->created_at); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        lightbox.option({
            'resizeDuration': 500,
            'wrapAround': true,
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pratice\crypto-script\resources\views/backend/kyc/index.blade.php ENDPATH**/ ?>