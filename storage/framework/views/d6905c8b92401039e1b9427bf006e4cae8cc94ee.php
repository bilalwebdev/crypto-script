<?php $__env->startSection('content'); ?>
    <div class="row gy-4">
        <?php $__empty_1 = true; $__currentLoopData = $gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-xxl-2 col-lg-3 col-sm-4 col-6">
                <div class="payment-box text-center">
                    <div class="payment-box-thumb">
                        <img src="<?php echo e(Config::getFile('gateways', $gateway->image, true)); ?>" alt="Lights" class="trans-img">
                    </div>
                    <div class="payment-box-content">
                        <h4 class="title"><?php echo e(ucwords(str_replace('_', ' ', $gateway->name))); ?></h4>
                        <button data-href="<?php echo e(route('user.paynow', $gateway->id)); ?>" data-id="<?php echo e($gateway->id); ?>" class="btn sp_theme_btn btn-sm w-100 paynow mt-3"><?php echo e(__('Pay Now')); ?></button>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php echo e(__('Not Found')); ?>

        <?php endif; ?>
    </div>

    <?php if(isset($type) && $type == 'deposit'): ?>
        <div class="modal fade" tabindex="-1" role="dialog" id="paynow">
            <div class="modal-dialog" role="document">
                <form action="" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('Deposit Amount')); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="id" value="">
                                <div class="form-group">
                                    <label for=""><?php echo e(__('Amount')); ?></label>
                                    <input type="text" name="amount" class="form-control"
                                        placeholder="<?php echo e(__('Enter Amount')); ?>">

                                    <input type="hidden" name="user_id" class="form-control" value="<?php echo e(auth()->id()); ?>">
                                    <input type="hidden" name="type" class="form-control" value="deposit">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm sp_btn_secondary"
                                data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                            <button type="submit" class="btn btn-sm sp_theme_btn"><?php echo e(__('Deposit Now')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="modal fade" tabindex="-1" role="dialog" id="paynow">
            <div class="modal-dialog" role="document">
                <form action="" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('Pay Amount')); ?></h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="id" value="">
                                <div class="form-group">
                                    <label for=""><?php echo e(__('Amount')); ?></label>
                                    <input type="text" name="amount" class="form-control"
                                        placeholder="<?php echo e(__('Enter Amount')); ?>" value="<?php echo e($plan->price); ?>" readonly>

                                    <input type="text" name="plan_id" class="form-control" value="<?php echo e($plan->id); ?>"
                                        hidden>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm sp_btn_secondary"
                                data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                            <button type="submit" class="btn btn-sm sp_theme_btn"><?php echo e(__('Pay Now')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        $(function() {
            'use strict'

            $('.paynow').on('click', function() {
                const modal = $('#paynow')

                modal.find('form').attr('action', $(this).data('href'))
                modal.find('input[name=id]').val($(this).data('id'))

                modal.modal('show')
            })
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(Config::theme() . 'layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/crypto-script/main/resources/views/frontend/light/user/gateway/gateways.blade.php ENDPATH**/ ?>