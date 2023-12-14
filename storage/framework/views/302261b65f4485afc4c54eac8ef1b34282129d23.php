


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
                                    <th><?php echo e(__('Trans. Type')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__empty_1 = true; $__currentLoopData = $user->accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $manual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <form id="transact_form" action="<?php echo e(route('admin.transac.store')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <tr>
                                                <td>
                                                    <span>
                                                        <?php echo e($key + 1); ?>

                                                    </span>
                                                </td>
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
                                                    <input type="number" name="amount"
                                                        class="form-control form-control-sm" required>
                                                </td>

                                                <td>
                                                    <select name="transac_type" class="form-control form-control-sm"
                                                        id="transac_type" required>
                                                        <option value=""></option>
                                                        <option value="with">Winthdraw</option>
                                                        <option value="dep">Deposit</option>
                                                    </select>
                                                </td>
                                                <td>

                                                    <input type="hidden" name="login" value="<?php echo e($manual['login']); ?>" />
                                                    <input type="hidden" name="user_id"
                                                        value="<?php echo e($manual['user_id']); ?>" />
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                        href="">Submit</button>

                                                </td>
                                            </tr>
                                        </form>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td class="text-center" colspan="100%"><?php echo e(__('No Data Found')); ?>

                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if($users->hasPages()): ?>
                    <?php echo e($users->links()); ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/backend/transactions/index.blade.php ENDPATH**/ ?>