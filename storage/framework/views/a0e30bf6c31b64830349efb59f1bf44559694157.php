<?php
    $plans = \App\Models\Plan::whereStatus(true)
        ->latest()
        ->take(6)
        ->get();
?>
<!-- plan section start -->
<section class="plan-section sp_pt_120 sp_pb_120" style="background-image: url('<?php echo e(Config::getFile('plans', $content->image_one)); ?>');">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <div class="sp_theme_top  wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">
                    <div class="sp_theme_top_caption"><i class="fas fa-bolt"></i> <?php echo e(Config::trans($content->title)); ?></div>
                    <h2 class="sp_theme_top_title"><?= Config::colorText(optional($content)->title, optional($content)->color_text_for_title) ?></h2>
                </div>
            </div>
        </div>

        <div class="row gy-4 items-wrapper justify-content-center">
            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="0.3s">
                    <div class="sp_pricing_item">
                        <div class="pricing-header">
                            <div class="left">
                                <div class="icon">
                                    <i class="far fa-gem"></i>
                                </div>
                                <div class="content">
                                    <h6 class="package-name"><?php echo e(__($plan->name)); ?></h6>
                                    <p><?php echo e(__('Duration')); ?>

                                        <span><?php echo e(($plan->duration == 0 ? 'unlimited' : $plan->duration).' '.'days'); ?></span></p>
                                </div>
                            </div>
                            <div class="right">
                                <h4 class="package-price"><?php echo e(Config::formatter($plan->price)); ?></h3>
                            </div>
                        </div>
                        <div class="pricing-body">
                            <ul class="package-features">
                                <?php if($plan->feature): ?>
                                    <?php $__currentLoopData = $plan->feature; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e(__($item)); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <?php if(auth()->guard()->check()): ?>
                            <?php
                                $currentplan = auth()
                                    ->user()
                                    ->currentplan->first();
                            ?>

                            <div class="pricing-footer">
                                <?php if($currentplan != null && $currentplan->plan_id == $plan->id): ?>
                                    <button class="btn sp_theme_btn w-100" disabled><?php echo e(__('Already in a Plan')); ?>

                                    </button>
                                <?php else: ?>
                                    <a href="" data-id="<?php echo e($plan->id); ?>"
                                        class="btn sp_theme_btn w-100 chooseBtn"><?php echo e(__('Choose Plan')); ?>

                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <a href="" data-id="<?php echo e($plan->id); ?>"
                                class="btn sp_theme_btn w-100 chooseBtn"><i class="las la-arrow-right me-2"></i> <?php echo e(__('Choose Plan')); ?>

                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="text-center mt-5">
            <a href="<?php echo e(route('pages','packages')); ?>" class="btn sp_theme_btn"><?php echo e(__('More Plans')); ?></a>
        </div>
    </div>
</section>


<div class="modal fade" id="confirmation" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="<?php echo e(route('user.plans.post')); ?>" method="post">
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
                    <button class="btn sp_theme_btn" type="submit"><?php echo e(__('Next')); ?></button>
                    <button class="btn sp_btn_secondary" type="button"
                        data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                </div>

            </div>
        </form>
    </div>
</div>



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

                modal.find('input[name=payment]').val($(this).data('id'))

                modal.modal('show')
            })
        })
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('external-css'); ?>
    <style>
        .wrapper {
            display: inline-flex;

            height: 100px;
            width: 100%;
            align-items: center;
            justify-content: space-evenly;
            border-radius: 5px;
            padding: 20px 15px;
            box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.2);
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
            font-size: 20px;
            color: #808080;
        }

        #option-1:checked:checked~.option-1 span,
        #option-2:checked:checked~.option-2 span {
            color: #fff;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php /**PATH E:\personal\crypto-script\main\resources\views/frontend/light/widgets/plans.blade.php ENDPATH**/ ?>