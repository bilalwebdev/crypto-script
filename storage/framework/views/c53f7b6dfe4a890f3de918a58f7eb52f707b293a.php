

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="sp_site_card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h3><i class="fa fa-info-circle" aria-hidden="true" style="color:#28a745">
                        </i> New Live MT5 Account Details</h3>

                </div>
                <div class="card-body">
                    <div class="panel-body">
                        <table class="table row-border datatable" style="margin-top:20px;padding:50px">
                            <thead>
                                <tr>
                                    <td style="border-top: 1px !important;padding:7px"><strong>Account No.
                                            :</strong></td>
                                    <td style="border-top: 1px !important;"><?php echo e($acc_created->login); ?></td>
                                </tr>
                                <tr>
                                    <td style="border-top: 1px solid #014d65 !important;padding:7px"><strong>Account Type
                                            :</strong></td>
                                    <td style="border-top: 1px solid #014d65 !important;padding:7px">
                                        &nbsp;&nbsp;&nbsp;&nbsp; <span class="tdStyle">
                                            <?php if($acc_created->account_type == 1): ?>
                                                Standard
                                            <?php elseif($acc_created->account_type == 2): ?>
                                                Premium
                                            <?php elseif($acc_created->account_type == 3): ?>
                                                VIP
                                            <?php else: ?>
                                                Demo
                                            <?php endif; ?>
                                        </span></td>
                                </tr>

                                <tr>
                                    <td style="border-top: 1px solid #014d65 !important;padding:7px"><strong>Master's
                                            Password :</strong></td>
                                    <td style="border-top: 1px solid #014d65 !important;padding:7px">
                                        &nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($acc_created->master_pass); ?></td>
                                </tr>
                                <tr>
                                    <td style="border-top: 1px solid #014d65 !important;padding:7px"><strong>Investor's
                                            Password :</strong></td>
                                    <td style="border-top: 1px solid #014d65 !important;padding:7px">
                                        &nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($acc_created->investor_pass); ?></td>
                                </tr>


                            </thead>
                        </table>
                    </div>
                    <div class="return-link1">
                        <br>
                        <a href="/dashboard"><button class="btn sp_theme_btn btn-md text-uppercase" type="button"
                                style="">GO
                                BACK <i class="fas fa-arrow-circle-o-left  " style="color:white;font-size:17px"
                                    ;aria-hidden="true"></i></button></a>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('external-css'); ?>
    <link rel="stylesheet" href="<?php echo e(Config::cssLib('frontend', 'lib/apex.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php echo $__env->make(Config::theme() . 'layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\personal\crypto-script\resources\views/frontend/light/user/open_account_success.blade.php ENDPATH**/ ?>