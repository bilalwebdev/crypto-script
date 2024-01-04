


<?php $__env->startSection('element'); ?>
    <div class="row withdraw-row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form method="GET" action="">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" placeholder="Search" name="search">
                            <input type="text" class="form-control form-control-sm" placeholder="date" name="dates"
                                autocomplete="off">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('TRX')); ?></th>
                                    <th><?php echo e(__('User')); ?></th>
                                    <th><?php echo e(__('Plan')); ?></th>
                                    <th><?php echo e(__('Gateway')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th><?php echo e(__('Charge')); ?></th>
                                    <th><?php echo e(__('Rate')); ?></th>
                                    <th><?php echo e(__('Final Amount')); ?></th>
                                    <th><?php echo e(__('Payment date')); ?></th>
                                    <?php if(request()->type == 'offline'): ?>
                                        <th><?php echo e(__('Status')); ?></th>
                                        <th><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($payment->trx); ?></td>
                                        <td><?php echo e(optional($payment->user)->username); ?></td>
                                        <td><?php echo e(optional($payment->plan)->name); ?></td>
                                        <td>
                                            <span class="badge badge-primary">
                                                <?php echo e(optional($payment->gateway)->name ?? 'Using balance'); ?>

                                            </span>
                                        </td>
                                        <td><?php echo e(Config::formatter($payment->amount)); ?></td>
                                        <td><?php echo e(Config::formatter($payment->charge)); ?></td>
                                        <td><?php echo e(Config::formatOnlyNumber($payment->rate) . ' ' . optional($payment->gateway->parameter)->gateway_currency); ?>

                                        </td>
                                        <td><?php echo e(Config::formatOnlyNumber($payment->total) . ' ' . optional($payment->gateway->parameter)->gateway_currency); ?>

                                        </td>
                                        <td><?php echo e($payment->created_at->format('d M, Y')); ?></td>
                                        <?php if(request()->type === 'offline'): ?>
                                            <td>
                                                <?php if($payment->status == 2): ?>
                                                    <span class="badge badge-warning"><?php echo e(__('Pending')); ?></span>
                                                <?php elseif($payment->status == 3): ?>
                                                    <span class="badge badge-danger"><?php echo e(__('Rejected')); ?></span>
                                                <?php else: ?>
                                                    <span class="badge badge-success"><?php echo e(__('Accepted')); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-outline-info"
                                                    href="<?php echo e(route('admin.payments.details', $payment->id)); ?>"><i
                                                        class="fas fa-eye"></i></a>
                                                <?php if($payment->status == 2): ?>
                                                    <button class="btn btn-sm btn-outline-primary accept"
                                                        data-url="<?php echo e(route('admin.payments.accept', $payment->trx)); ?>"><i
                                                            class="fas fa-check"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger reject"
                                                        data-url="<?php echo e(route('admin.payments.reject', $payment->trx)); ?>"><i
                                                            class="fas fa-times"></i></button>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-center" colspan="100%"><?php echo e(__('No Payments Found')); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if($payments->hasPages()): ?>
                        <div class="card-footer">
                            <?php echo e($payments->links()); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="accept" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form action="" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> <i class="fa fa-check"></i> <?php echo e(__('Payment Accept')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <p><?php echo e(__('Are you sure to Accept this Payment request')); ?>?</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Accept')); ?></button>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form action="" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> <?php echo e(__('Payment Reject')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for=""><?php echo e(__('Reject Reason')); ?></label>
                            <textarea name="reason" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-danger"><?php echo e(__('Reject')); ?></button>

                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('external-style'); ?>
    <link rel="stylesheet" href="<?php echo e(Config::cssLib('backend', 'daterangepicker.css')); ?>">
<?php $__env->stopPush(); ?>


<?php $__env->startPush('external-script'); ?>
    <script src="<?php echo e(Config::jsLib('backend', 'moment.js')); ?>"></script>
    <script src="<?php echo e(Config::jsLib('backend', 'daterangepicker.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('script'); ?>
    <script>
        $(function() {
            'use strict'

            $('input[name="dates"]').daterangepicker({

                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format(
                    'MM/DD/YYYY'));
            });

            $('.accept').on('click', function() {
                const modal = $('#accept');

                modal.find('form').attr('action', $(this).data('url'));
                modal.modal('show');
            })

            $('.reject').on('click', function() {
                const modal = $('#reject');

                modal.find('form').attr('action', $(this).data('url'));
                modal.modal('show');
            })

        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/backend/payments/index.blade.php ENDPATH**/ ?>