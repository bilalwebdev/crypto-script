


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
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Email')); ?></th>
                                    <th><?php echo e(__('Account')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $manual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>

                                        <td>
                                            <span>
                                                <?php echo e($manual->user->username); ?>

                                            </span>
                                        </td>
                                        <td> <span>
                                                <?php echo e($manual->user?->email); ?>

                                            </span></td>
                                        <td> <span>
                                                <?php echo e($manual['login']); ?>

                                            </span></td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm">
                                        </td>



                                        <td>
                                            <select name="transac_type" class="form-control form-control-sm" id="">
                                                <option value=""></option>
                                                <option value="with">Winthdraw</option>
                                                <option value="with">Deposit</option>
                                            </select>
                                        </td>
                                        <td>
                                            


                                            <a class="btn
                                                  <?php if($manual->status != 2): ?> disabled <?php endif; ?> btn-sm btn-outline-primary accept"
                                                data-url="<?php echo e(route('admin.withdraw.accept', $manual->id)); ?>"><i
                                                    class="fas fa-check"></i></a>
                                            <a class="btn <?php if($manual->status != 2): ?> disabled <?php endif; ?>  btn-sm btn-outline-danger reject"
                                                data-url="<?php echo e(route('admin.withdraw.reject', $manual->id)); ?>"><i
                                                    class="fas fa-times"></i></a>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-center" colspan="100%"><?php echo e(__('No Data Found')); ?>

                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if($withdraws->hasPages()): ?>
                    <?php echo e($withdraws->links()); ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/backend/transactions/index.blade.php ENDPATH**/ ?>