<?php $__env->startSection('content'); ?>
    <div class="row">


        <div class="col-sm-12 col-lg-3">
            <div class="sp_site_card mb-4">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0 ">Select transaction type</h6>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="_token" value="g3TvDwyj3LQSms88hy4duVAnFsUgK4r131aaAdfJ">
                        <div class="form-group mb-3">
                            <label for="">TRANSACTIONS TYPE</label>
                            <select class="form-control">
                                <option value="dep">Deposit</option>
                                <option value="with">Withdraw</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">ACCOUNT NUMBER</label>
                            <select class="form-control">
                                <option value="0"></option>
                                <option value="575021002">575021002</option>
                                <option value="575021003">575021003</option>
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
                        <table class="table sp_site_table" name="incidents"
                            id="incidents">
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

                                <tr>
                                    <td>575021002</td>
                                    <td>Deposit</td>
                                    <td>usdt-TRC20</td>
                                    <td>100</td>
                                    <td>Pending</td>
                                    <td><a href="history?cancelid=1700819880&amp;type=dp"
                                            style="font-style:italic;text-decoration:underline;font-size:11px;color:silver">Cancel</a>&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td>2023-11-24 10:58:49</td>

                                </tr>
                            </tbody>
                        </table>
                        <table class="table align-items-center table-flush table-borderless" name="incidents"
                            id="incidents">

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

<?php echo $__env->make(Config::theme() . 'layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\crypto-script\main\resources\views/frontend/light/user/history.blade.php ENDPATH**/ ?>