

<?php $__env->startSection('content'); ?>


    <div class="row gy-4">

        <?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-lg-4">
                <div class="sp_pricing_item">
                    <div class="pricing-header">
                        <div class="left">
                            <div class="icon">
                                <i class="far fa-gem"></i>
                            </div>
                            <div class="content">
                                <h6 class="package-name"><?php echo e($plan->name); ?></h6>
                                <p><?php echo e(__('Duration')); ?>

                                    <span><?php echo e(($plan->duration == 0 ? 'unlimited' : $plan->duration) . ' ' . 'days'); ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="right">
                            <h4 class="package-price">
                                <?php if($plan->price_type == 'free'): ?>
                                    <?php echo e(__('Free')); ?>

                                <?php else: ?>
                                    <?php echo e(Config::formatter($plan->price)); ?>

                                <?php endif; ?>
                            </h4>
                        </div>
                    </div>
                    <div class="pricing-body">
                        <ul class="package-features">
                            <?php if($plan->feature): ?>
                                <?php $__currentLoopData = $plan->feature; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($feature); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php
                        $currentplan = auth()
                            ->user()
                            ->currentplan->first();
                        
                    ?>
                    <div class="pricing-footer">

                        <?php if($plan->price_type == 'free'): ?>
                            <?php if($currentplan != null && $currentplan->plan_id == $plan->id): ?>
                                <button class="btn sp_theme_btn w-100" disabled><?php echo e(__('Already in a Plan')); ?>

                                </button>
                            <?php else: ?>
                                <a href="" data-id="<?php echo e($plan->id); ?>"
                                    class="btn sp_theme_btn w-100 balance"><?php echo e(__('Choose Plan')); ?>

                                </a>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if($currentplan != null && $currentplan->plan_id == $plan->id): ?>
                                <button class="btn sp_theme_btn w-100" disabled><?php echo e(__('Already in a Plan')); ?>

                                </button>
                            <?php else: ?>
                                <a href="" data-id="<?php echo e($plan->id); ?>"
                                    class="btn sp_theme_btn w-100 chooseBtn"><?php echo e(__('Choose Plan')); ?>

                                </a>
                            <?php endif; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-lg-12 mt-3">
                <p><?php echo e(__('No Plans Found')); ?></p>
            </div>
        <?php endif; ?>

        <?php if($plans->hasPages()): ?>
            <div class="col-md-12">
                <?php echo e($plans->links()); ?>

            </div>
        <?php endif; ?>

    </div>


    <div class="modal fade" id="balance" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('Confirmation')); ?></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="payment" value="">
                        <p><?php echo e(__('Are you sure to subscribe this plan')); ?></p>
                    </div>

                    <div class="modal-footer">
                        <button class="btn sp_theme_btn" type="submit"><?php echo e(__('Next')); ?></button>
                        <button class="btn sp_btn_secondary" type="button"
                            data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="confirmation" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('Confirmation')); ?></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="wrapper">
                            <input type="hidden" name="payment" value="">
                            <input type="radio" name="payment_type" id="option-1" checked value="balance">
                            <input type="radio" name="payment_type" id="option-2" value="wallet">
                            <label for="option-1" class="option option-1">
                                <div class="dot"></div>
                                <span><?php echo e(__('Using Balance')); ?></span>
                            </label>
                            <label for="option-2" class="option option-2">
                                <div class="dot"></div>
                                <span><?php echo e(__('Using Wallet')); ?></span>
                            </label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-sm sp_theme_btn" type="submit"><?php echo e(__('Next')); ?></button>
                        <button class="btn btn-sm sp_btn_secondary" type="button"
                            data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                    </div>

                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        $(function() {
            'use strict'

            $('.balance').on('click', function(e) {
                e.preventDefault();
                const modal = $('#balance')
                modal.find('input[name = payment]').val($(this).data('id'))
                modal.modal('show')
            })

            $('.chooseBtn').on('click', function(e) {
                e.preventDefault();
                const modal = $('#confirmation')

                modal.find('input[name = payment]').val($(this).data('id'))

                modal.modal('show')
            })
        })
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .wrapper {
            display: inline-flex;
            width: 100%;
            align-items: center;
            justify-content: space-evenly;
            border-radius: 5px;
        }

        .wrapper .option {
            background: #fff;
            height: 55px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            margin: 0 10px;
            border-radius: 5px;
            cursor: pointer;
            padding: 0 10px;
            border: 2px solid lightgrey;
            transition: all 0.3s ease;
        }

        .wrapper .option .dot {
            height: 20px;
            width: 20px;
            background: #d9d9d9;
            border-radius: 50%;
            position: relative;
        }

        .wrapper .option .dot::before {
            position: absolute;
            content: "";
            top: 4px;
            left: 4px;
            width: 12px;
            height: 12px;
            background: var(--clr-main);
            border-radius: 50%;
            opacity: 0;
            transform: scale(1.5);
            transition: all 0.3s ease;
        }

        input[type="radio"] {
            display: none;
        }

        #option-1:checked:checked~.option-1,
        #option-2:checked:checked~.option-2 {
            border-color: var(--clr-main);
            background: var(--clr-main);
        }

        #option-1:checked:checked~.option-1 .dot,
        #option-2:checked:checked~.option-2 .dot {
            background: #fff;
        }

        #option-1:checked:checked~.option-1 .dot::before,
        #option-2:checked:checked~.option-2 .dot::before {
            opacity: 1;
            transform: scale(1);
        }

        .wrapper .option span {
            font-size: 16px;
            color: #808080;
        }

        #option-1:checked:checked~.option-1 span,
        #option-2:checked:checked~.option-2 span {
            color: #fff;
        }
        
        @media (max-width: 575px) {
            .wrapper {
                padding: 0;
            }
            .wrapper .option {
                margin: 0 5px;
                height: 45px;
            }
            .wrapper .option .dot {
                width: 15px;
                height: 15px;
                margin-right: 6px;
            }
            .wrapper .option .dot::before {
                width: 10px;
                height: 10px;
                left: 50%;
                top: 50%;
                margin-top: -5px;
                margin-left: -5px;
            }
            .wrapper .option span {
                font-size: 14px;
                margin-bottom: -2px;
            }
        }
        
        
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(Config::theme() . 'layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/crypto-script/main/resources/views/frontend/light/user/plans.blade.php ENDPATH**/ ?>