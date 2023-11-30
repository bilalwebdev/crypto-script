<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="sp_site_card">
                <div class="card-header">
                    <form action="" method="get" class="row justify-content-md-end g-3">
                        <div class="col-auto">
                            <input type="text" name="trx" class="form-control form-control-sm me-2" placeholder="transaction id">
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control form-control-sm me-3" placeholder="Search User" name="date">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-sm sp_theme_btn"><?php echo e(__('Search')); ?></button>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table sp_site_table">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Trx')); ?></th>
                                    <th><?php echo e(__('User')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th><?php echo e(__('Charge')); ?></th>
                                    <th><?php echo e(__('Details')); ?></th>
                                    <th><?php echo e(__('Type')); ?></th>
                                    <th><?php echo e(__('Date')); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td data-caption="<?php echo e(__('Trx')); ?>"><?php echo e($transaction->trx); ?></td>
                                        <td data-caption="<?php echo e(__('User')); ?>">
                                            <?php echo e(optional($transaction->user)->username); ?></td>
                                        <td data-caption="<?php echo e(__('Amount')); ?>"><?php echo e(Config::formatter($transaction->amount)); ?></td>
                                        
                                        <td data-caption="<?php echo e(__('Charge')); ?>">
                                            <?php echo e(Config::formatter($transaction->charge) . ' ' . Config::config()->currency); ?></td>
                                        <td data-caption="<?php echo e(__('Details')); ?>"><?php echo e($transaction->details); ?></td>
                                        <td data-caption="<?php echo e(__('Type')); ?>">
                                            <?php if($transaction->type == '-'): ?>
                                                <span class="sp_text_danger fs-5"> <?php echo e($transaction->type); ?></span>
                                            <?php else: ?>
                                                <span class="sp_text_success fs-5"> <?php echo e($transaction->type); ?></span>
                                            <?php endif; ?>

                                        </td>
                                        <td data-caption="<?php echo e(__('Payment Date')); ?>">
                                            <?php echo e($transaction->created_at->format('Y-m-d')); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-center" colspan="100%">
                                            <?php echo e(__('No Transaction Found')); ?>

                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
                <?php if($transactions->hasPages()): ?>
                    <div class="card-footer">
                        <?php echo e($transactions->links()); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(Config::theme() . 'layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/crypto-script/main/resources/views/frontend/light/user/transaction.blade.php ENDPATH**/ ?>