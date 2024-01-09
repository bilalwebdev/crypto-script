


<?php $__env->startSection('element'); ?>
    <div class="row">

        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <?php echo $__env->make('backend.users.tab_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <form action="" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" placeholder="username or email or phone"
                                name="search">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" type="submit"> <i class="fa fa-search"></i>
                                    <?php echo e(__('Search')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>

                                    <th><?php echo e(__('Sl')); ?></th>
                                    <th><?php echo e(__('Username')); ?></th>
                                    <th><?php echo e(__('Phone')); ?></th>
                                    <th><?php echo e(__('Email')); ?></th>
                                    <th><?php echo e(__('Country')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>

                                </tr>

                            </thead>

                            <tbody id="filter_data">

                                <?php $__empty_1 = true; $__currentLoopData = $infos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($user->username); ?></td>
                                        <td><?php echo e($user->phone); ?></td>
                                        <td><?php echo e($user->email); ?></td>
                                        <td><?php echo e($user->address->country ?? 'N/A'); ?></td>
                                        <td>

                                            <?php if($user->status): ?>
                                                <span class='badge badge-success'><?php echo e(__('Active')); ?></span>
                                            <?php else: ?>
                                                <span class='badge badge-danger'><?php echo e(__('Inactive')); ?></span>
                                            <?php endif; ?>

                                        </td>

                                        <td>

                                            <a href="<?php echo e(route('admin.user.kyc.details', $user)); ?>"
                                                class="btn btn-sm btn-outline-secondary"><i class="fa fa-eye"></i></a>
                                        </td>


                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-center" colspan="100%"><?php echo e(__('No Data Found')); ?></td>
                                    </tr>
                                <?php endif; ?>



                            </tbody>
                        </table>
                    </div>
                </div>


                <?php if($infos->hasPages()): ?>
                    <div class="card-footer">
                        <?php echo e($infos->links('backend.partial.paginate')); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/backend/users/kyc_req.blade.php ENDPATH**/ ?>