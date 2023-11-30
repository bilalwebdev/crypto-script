<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12 col-lg-4">

            <div class="sp_site_card mb-4">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0 ">Withdraw Funds</h6>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="form-group mb-3">
                            <label for="">ACCOUNT NUMBER</label>
                            <select class="form-control">
                                <option value="0"></option>
                                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option data-login="<?php echo e($item->login); ?>" value="<?php echo e($item->id); ?>"><?php echo e($item->login); ?> <?php echo e($item->account_type=='4'?'(DEMO)':''); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">PAYMENT METHOD</label>
                            <select class="form-control">

                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">AMOUNT</label>
                            <input type="text" class="form-control" required placeholder="Amount in USD">
                        </div>
                        <button type="submit" class="btn sp_theme_btn btn-md text-uppercase"><i class="fas fa-lock" aria-hidden="true"></i>&nbsp;Withdraw Funds</button>
                    </form>
                </div>
            </div>


        </div>

        <div class="col-sm-12 col-lg-5">

            <div class="sp_site_card mb-4">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0 ">Withdraw details</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">Please select account number on your left</div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-lg-3">

            <div class="sp_site_card mb-4">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0 ">Real account status</h6>
                </div>
                <div class="card-body">

                    <div class="account-item-value pt-0">
                        <label>Available fund</label>
                        <span class="account-item-pin green"> </span>
                        <span class="balance">0 </span> <span class="currency"></span>
                        <span class="loading" style="display:none"><img src="assets/images/loading.gif"
                                width="30px"></span>
                    </div>


                    <div class="account-item-value">
                        <label>Total Profit</label>
                        <span class="account-item-pin yellow"> </span>
                        <span class="profit">0 </span> <span class="currency"></span>
                        <span class="loading" style="display:none"><img src="assets/images/loading.gif"
                                width="30px"></span>
                    </div>


                    <div class="account-item-value">
                        <label>Floating P/L</label>
                        <span class="account-item-pin purple"> </span>
                        <span class="floating">0 </span> <span class="currency"></span>
                        <span class="loading" style="display:none"><img src="assets/images/loading.gif"
                                width="30px"></span>
                    </div>



                    <div class="account-item-value">
                        <label>Free Margin</label>
                        <span class="account-item-pin yellow"> </span>
                        <span class="margin">0 </span> <span class="currency"></span>
                        <span class="loading" style="display:none"><img src="assets/images/loading.gif"
                                width="30px"></span>
                    </div>


                    <div class="account-item-value border-0">
                        <label>Equity</label>
                        <span class="account-item-pin red"> </span>
                        <span class="equity">0 </span> <span class="currency"></span>
                        <span class="loading" style="display:none"><img src="assets/images/loading.gif"
                                width="30px"></span>
                    </div>
                </div>
            </div>

        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('external-css'); ?>
    <link rel="stylesheet" href="<?php echo e(Config::cssLib('frontend', 'lib/apex.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php echo $__env->make(Config::theme() . 'layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/crypto-script/main/resources/views/frontend/light/user/withdraw/index.blade.php ENDPATH**/ ?>