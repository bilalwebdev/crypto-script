


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
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $kyc_docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dco): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key); ?></td>
                                    <td><?php echo e($doc->user->email); ?></td>
                                    <td><?php echo e($doc->type); ?></td>
                                    <td><img src="<?php echo e(Config::getFile('kyc', $doc->file, true)); ?>"
                                        alt="" class=""
                                        style="width:50px; height:50px; margin-right:8px"></td>
                                    <td><?php echo e($doc->user->username); ?></td>
                                    <td>Pending</td>
                                    <td>Pending</td>
                                    <td>Pending</td>
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
<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\personal\crypto-script\resources\views/backend/kyc/index.blade.php ENDPATH**/ ?>