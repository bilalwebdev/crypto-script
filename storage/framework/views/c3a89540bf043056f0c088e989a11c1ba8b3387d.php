
<?php $__env->startSection('content'); ?>

    <div class="dashboard-body-part">

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="sp_site_card">
                    <div class="card-header">
                        <h5 class="mb-0 fw-medium"><?php echo e(__('Reference Tree')); ?></h5>
                    </div>
                    <div class="card-body">
                        <?php if($reference->count() > 0): ?>
                            <ul class="sp-referral">
                                <li class="single-child root-child">
                                    <p>
                                        <img src="<?php echo e(Config::getFile('user', auth()->user()->image, true)); ?>">
                                        <span class="mb-0"><?php echo e(auth()->user()->username); ?></span>
                                    </p>
                                    <ul class="sub-child-list step-2">
                                        <?php $__currentLoopData = $reference; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="single-child">
                                                <p>
                                                    <img src="<?php echo e(Config::getFile('user', $user->image, true)); ?>">
                                                    <span class="mb-0"><?php echo e($user->username); ?></span>
                                                </p>

                                                <ul class="sub-child-list step-3">
                                                    <?php $__currentLoopData = $user->refferals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ref): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="single-child">
                                                            <p>
                                                                <img src="<?php echo e(Config::getFile('user', $ref->image, true)); ?>">
                                                                <span class="mb-0"><?php echo e($ref->username); ?></span>
                                                            </p>

                                                            <ul class="sub-child-list step-4">
                                                                <?php $__currentLoopData = $ref->refferals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ref2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li class="single-child">
                                                                        <p>
                                                                            <img src="<?php echo e(Config::getFile('user', $ref2->image, true)); ?>">
                                                                            <span
                                                                                class="mb-0"><?php echo e($ref2->username); ?></span>
                                                                        </p>
                                                                    </li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>

                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </ul>
                                </li>
                            </ul>
                        <?php else: ?>
                            <div class="col-md-12 text-center mt-5">
                                <i class="far fa-folder-open display-1"></i>
                                <p class="mt-2">
                                    <?php echo e(__('No Reference User Found')); ?>

                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .sp-referral {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .sp-referral .single-child {
            padding: 6px 10px;
            border-radius: 5px;
        }

        .sp-referral .single-child+.single-child {
            margin-top: 15px;
        }

        .sp-referral .single-child p {
            display: flex;
            align-items: center;
            margin-bottom: 0;
        }

        .sp-referral .single-child p img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            -o-object-fit: cover;
            border: 2px solid #e5e5e5;
        }

        .sp-referral .single-child p span {
            width: calc(100% - 35px);
            font-size: 14px;
            padding-left: 10px;
        }

        .sub-child-list {
            position: relative;
            padding-left: 35px;
            list-style: none;
            margin-bottom: 0
        }

        .sub-child-list::before {
            position: absolute;
            content: '';
            top: 0;
            left: 17px;
            width: 1px;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.2);
        }

        .sp-referral>.single-child.root-child>p img {
            border: 2px solid #5463ff;
        }

        .sub-child-list>.single-child {
            position: relative;
        }

        .sub-child-list>.single-child::before {
            position: absolute;
            content: '';
            left: -18px;
            top: 21px;
            width: 30px;
            height: 5px;
            border-left: 1px solid rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 0 0 0 5px;
        }

        .sub-child-list.step-2>.single-child>p img {
            border: 2px solid #0aa27c;
        }

        .sub-child-list.step-3>.single-child>p img {
            border: 2px solid #a20a0a;
        }

        .sub-child-list.step-4>.single-child>p img {
            border: 2px solid #f562e6;
        }

        .sub-child-list.step-5>.single-child>p img {
            border: 2px solid #a20a0a;
        }

        #user_action_slider {
            display: none;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make(Config::theme() . 'layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/crypto-script/main/resources/views/frontend/light/user/refferal.blade.php ENDPATH**/ ?>