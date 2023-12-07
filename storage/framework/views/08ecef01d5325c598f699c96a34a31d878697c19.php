


<?php $__env->startSection('element'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header site-card-header justify-content-between">
                    <div class="card-header-left">
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control form-control-sm" placeholder="Plan Name">
                                <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="card-header-right">
                        <a href="<?php echo e(route('admin.plan.create')); ?>" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i>
                            <?php echo e(__('Create Plan')); ?></a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('SL')); ?>.</th>
                                    <th><?php echo e(__('Plan Name')); ?></th>
                                    <th><?php echo e(__('Plan Type')); ?></th>
                                    <th><?php echo e(__('Price Type')); ?></th>
                                    <th><?php echo e(__('Price')); ?></th>
                                    <th><?php echo e(__('Duration')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($plan->name); ?></td>
                                        <td>
                                            <span class="badge badge-info"><?php echo e($plan->plan_type); ?></span>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary"><?php echo e($plan->price_type); ?></span>
                                        </td>
                                        <td><?php echo e(Config::formatter($plan->price)); ?></td>
                                        <td><?php echo e(($plan->duration ?? 0) . ' Days'); ?></td>
                                        <td>

                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="status" <?php echo e($plan->status ? 'checked' : ''); ?>

                                                    class="custom-control-input plan_status" id="status<?php echo e($plan->id); ?>"
                                                    data-id="<?php echo e($plan->id); ?>"
                                                    data-route="<?php echo e(route('admin.plan.changestatus', $plan)); ?>">
                                                <label class="custom-control-label"
                                                    for="status<?php echo e($plan->id); ?>"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('admin.plan.edit', $plan->id)); ?>"
                                                class="btn btn-sm btn-outline-primary"><i
                                                    class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-center" colspan="100%">
                                            <?php echo e(__('No Plan Created Yet')); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if($plans->hasPages()): ?>
                    <div class="card-footer">
                        <?php echo e($plans->links()); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startPush('script'); ?>
    <script>
        $(function() {
            'use strict'

            $('.plan_status').on('change', function() {

                let id = $(this).data('id');
                let route = $(this).data('route');

                $.ajax({

                    url: route,
                    method: "POST",
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(response) {
                        <?php echo $__env->make('backend.layout.ajax_alert', [
                            'message' => 'Successfully change status',
                            'message_error' => '',
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    }

                })




            })
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/backend/plan/index.blade.php ENDPATH**/ ?>