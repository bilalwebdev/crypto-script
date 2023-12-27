

<?php $__env->startSection('element'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" placeholder="support id"
                                name="search">
                            <select name="status" class="form-control form-control-sm">
                                <option value=""><?php echo e(__('Select Status')); ?></option>
                                <option value="closed"><?php echo e(__('Closed')); ?></option>
                                <option value="pending"><?php echo e(__('Pending')); ?></option>
                                <option value="answered"><?php echo e(__('Answered')); ?></option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" type="submit"> <i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Support Id')); ?></th>
                                    <th><?php echo e(__('Customer')); ?></th>
                                    <th><?php echo e(__('Subject')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Created Date')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td scope="row"><b><?php echo e($ticket->support_id); ?></b></td>
                                        <td><?php echo e($ticket->user->username); ?></td>
                                        <td><?php echo e($ticket->subject); ?></td>
                                        <td>
                                            <?php if($ticket->status == 1): ?>
                                                <span class="badge badge-danger"> <?php echo e(__('Closed')); ?> </span>
                                            <?php endif; ?>
                                            <?php if($ticket->status == 2): ?>
                                                <span class="badge badge-warning"> <?php echo e(__('Pending')); ?> </span>
                                            <?php endif; ?>
                                            <?php if($ticket->status == 3): ?>
                                                <span class="badge badge-success"> <?php echo e(__('Answered')); ?></span>
                                            <?php endif; ?>
                                        </td>

                                        <td><?php echo e($ticket->created_at->diffforhumans()); ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-primary btn-action"
                                                href="<?php echo e(route('admin.ticket.show', $ticket->id)); ?>">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button data-href="<?php echo e(route('admin.ticket.destroy', $ticket->id)); ?>"
                                                class="btn btn-sm btn-outline-danger delete_confirm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="7" class="text-center"><?php echo e(__('NO TICKET FOUND')); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if($tickets->hasPages()): ?>
                    <div class="card-footer">
                        <?php echo e($tickets->links()); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <!-- Start:: Delete Modal-->
    <div class="modal fade" id="delete_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo e(method_field('DELETE')); ?>

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('Delete Support Ticket')); ?> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                   
                    <div class="card-footer text-right">
                        <button class="btn btn-sm btn-danger" type="submit"> <i class="fa fa-times"></i> <?php echo e(__('Delete')); ?></button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" aria-label="Close">
                           <?php echo e(__('Close')); ?>

                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End:: Delete Modal-->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict'
        $('.delete_confirm').on('click', function() {
            const modal = $('#delete_modal')

            modal.find('form').attr('action', $(this).data('href'))
            modal.modal('show');
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/backend/ticket/list.blade.php ENDPATH**/ ?>