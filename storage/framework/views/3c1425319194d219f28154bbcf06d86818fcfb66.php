<?php $__env->startSection('content'); ?>
    <div class="row">


        <div class="col-sm-12 col-lg-3">
            <div class="sp_site_card mb-4">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0 ">Select transaction type</h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(url('history/filter')); ?>" method="post">
                        <input type="hidden" name="_token" value="g3TvDwyj3LQSms88hy4duVAnFsUgK4r131aaAdfJ">
                        <div class="form-group mb-3">
                            <label for="">TRANSACTIONS TYPE</label>
                            <select class="form-control" name="type">
                                <option value="dep">Deposit</option>
                                <option value="with">Withdraw</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">ACCOUNT NUMBER</label>

                            <select class="form-control" name="login">
                                <option value=""></option>
                                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($acc->login); ?>"><?php echo e($acc->login); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                        </div>


                        <button type="submit" class="btn sp_theme_btn btn-md text-uppercase"><i class="fas fa-history"
                                aria-hidden="true"></i>&nbsp;Apply</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-lg-9">
            <div class="sp_site_card mb-4">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0 ">Transaction History</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                        </div>
                        <table class="table sp_site_table mb-2" name="incidents" id="incidents">
                            <thead>
                                <tr>
                                    <th class="default-cell">Account No<span uk-icon="triangle-down"
                                            class="ng-star-inserted uk-icon"></span></th>
                                    <th class="default-cell">Transaction type<span uk-icon="triangle-down"
                                            class="ng-star-inserted uk-icon"></span></th>
                                    <th class="default-cell">Payment type<span uk-icon="triangle-down"
                                            class="ng-star-inserted uk-icon"></span></th>
                                    <th class="default-cell">Amount<span uk-icon="triangle-down"
                                            class="ng-star-inserted uk-icon"></span></th>
                                    <th class="default-cell">Status<span uk-icon="triangle-down"
                                            class="ng-star-inserted uk-icon"></span></th>
                                    <th class="default-cell">Action<span uk-icon="triangle-down"
                                            class="ng-star-inserted uk-icon"></span></th>
                                    <th class="default-cell">Date<span uk-icon="triangle-down"
                                            class="ng-star-inserted uk-icon"></span></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dreq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($dreq->login); ?></td>
                                        <td>Deposit</td>
                                        <td><?php echo e($dreq->payment?->name); ?></td>
                                        <td><?php echo e($dreq->amount); ?></td>
                                        <?php if($dreq->status == 2): ?>
                                            <td>Pending</td>
                                        <?php elseif($dreq->status == 1): ?>
                                            <td>Approved</td>
                                        <?php else: ?>
                                            <td>Rejected</td>
                                        <?php endif; ?>
                                        <td><a href="<?php echo e(route('user.history.delete', $dreq->id)); ?>"
                                                style="font-style:italic;text-decoration:underline;font-size:11px;color:silver">Cancel</a>&nbsp;&nbsp;&nbsp;
                                        </td>
                                        <td><?php echo e(date($dreq->created_at)); ?></td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <span>No request found!</span>
                                <?php endif; ?>

                            </tbody>
                        </table>

                        <table class="table align-items-center table-flush table-borderless" name="incidents"
                            id="incidents">
                            <?php if($requests->hasPages()): ?>
                                <div class="col-md-12">
                                    <?php echo e($requests->links()); ?>

                                </div>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>










    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('external-css'); ?>
    <link rel="stylesheet" href="<?php echo e(Config::cssLib('frontend', 'lib/apex.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php echo $__env->make(Config::theme() . 'layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\personal\crypto-script\resources\views/frontend/light/user/history.blade.php ENDPATH**/ ?>