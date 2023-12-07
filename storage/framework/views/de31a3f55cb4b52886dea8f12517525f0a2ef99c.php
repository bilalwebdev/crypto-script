

<?php $__env->startSection('element'); ?>
    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header justify-content-between no-gutters">
                    <h5 class="col-md-8"><?php echo e(__('Payment Commission')); ?></h5>
                    <div class="col-md-4">
                        <div class="custom-control custom-switch text-lg-right">
                            <input data-status="<?php echo e(optional($invest_referral)->status); ?>"
                                data-url="<?php echo e(route('admin.refferal.refferalstatus', optional($invest_referral)->id)); ?>"
                                type="checkbox" name="status" <?php echo e(optional($invest_referral)->status ? 'checked' : ''); ?>

                                class="custom-control-input" id="investstatus">
                            <label class="custom-control-label" for="investstatus"><?php echo e(__('Active / Deactive')); ?></label>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="text-right">
                        <button type="button" class="btn btn-sm btn-primary append_invest">
                            <i class="fas fa-plus"></i>
                            <?php echo e(__('Add New Level')); ?>

                        </button>
                    </div>

                    <?php
                        $payment = count($invest_referral->level) + 1;
                        $referral = count($interest_referral->level) + 1;
                    ?>

                    <div class="append_table">
                        <form method="POST" action="<?php echo e(route('admin.refferal.invest')); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="text" name="type" value="invest" hidden>

                            <div class="row mt-4" id="append_invest">
                                <?php if($invest_referral): ?>
                                    <?php $__currentLoopData = $invest_referral->level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-auto">
                                            <div class="sp_referral_box mb-4">
                                                <input class="referral-level-btn" type="text" name=level[]
                                                    value="<?php echo e($level); ?>" readonly>



                                                <div class="input-group">

                                                    <input type="number" required class="form-control" name=commision[]
                                                        placeholder="Commision %"
                                                        value="<?php echo e($invest_referral->commission[$key]); ?>">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">%</span>
                                                    </div>
                                                </div>



                                                <button class="sp_referral_del_btn delete_invest" type="button"><i
                                                        class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>


                            <button class="btn btn-primary w-100 create-invest" type="submit">
                                <i class="fas fa-sync-alt mr-2"></i>
                                <?php echo e(__('Update Payment Refferal')); ?>

                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header no-gutters justify-content-between">
                    <h5 class="col-md-8"><?php echo e(__('Referral Commission')); ?></h5>
                    <div class="col-md-4">
                        <div class="custom-control custom-switch text-lg-right">
                            <input data-status="<?php echo e(optional($interest_referral)->status); ?>"
                                data-url="<?php echo e(route('admin.refferal.refferalstatus', optional($interest_referral)->id)); ?>"
                                type="checkbox" name="status" <?php echo e(optional($interest_referral)->status ? 'checked' : ''); ?>

                                class="custom-control-input" id="intereststatus">
                            <label class="custom-control-label" for="intereststatus"><?php echo e(__('Active / Deactive')); ?></label>
                        </div>
                    </div>
                </div>

                <div class="card-body">


                    <div class="text-right">
                        <button type="button" class="btn btn-sm btn-primary" id="referral_com">
                            <i class="fas fa-plus"></i>
                            <?php echo e(__('Add New Level')); ?>

                        </button>
                    </div>

                    <div class="append_table">

                        <form method="POST" action="<?php echo e(route('admin.refferal.invest')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="row mt-4" id="append_interest">
                                <?php if($interest_referral): ?>
                                    <?php $__currentLoopData = $interest_referral->level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-auto">
                                            <div class="sp_referral_box mb-4">
                                                <input class="referral-level-btn" type="text" name=level[]
                                                    value="<?php echo e($level); ?>" readonly>

                                                <div class="input-group">

                                                    <input type="number" required class="form-control" name=commision[]
                                                    placeholder="Commision %"
                                                    value="<?php echo e($interest_referral->commission[$key]); ?>">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">
                                                            <?php echo e(__('Fixed')); ?>

                                                        </span>
                                                    </div>
                                                </div>


                                              

                                                <button class="sp_referral_del_btn delete_interest" type="button"><i
                                                        class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>



                            <input type="text" name="type" value="interest" hidden>

                            <button class="btn btn-primary w-100 create-interest" type="submit"><i
                                    class="fas fa-sync-alt mr-2"></i> <?php echo e(__('Update Refferal Commission')); ?></button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('script'); ?>
    <script>
        'use strict';

        $(document).ready(function() {

            let level = "<?php echo e($payment); ?>";

            $('.append_invest').on('click', function() {

                let viewHtml = `
                                
                    <div class="col-auto removeItem">
                        <div class="sp_referral_box mb-4">
                            <input class="referral-level-btn" type="text" name=level[] value="level ${level}" readonly>

                            <input type="number" required class="form-control" name=commision[] placeholder="Commision %" value="">

                            <button class="sp_referral_del_btn delete_invest" type="button"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                `

                $('#append_invest').append(viewHtml).slideDown('slow');

                level++;

            });

            $(document).on('click', '.delete_invest', function() {

                $(this).parent().parent().remove()

            });

            let referral_level = "<?php echo e($referral); ?>";

            $('#referral_com').on('click', function() {

                let viewHtml = `
                                
                    <div class="col-auto removeItem">
                        <div class="sp_referral_box mb-4">
                            <input class="referral-level-btn" type="text" name=level[] value="level ${referral_level}" readonly>

                            <input type="number" required class="form-control" name=commision[] placeholder="Commision %" value="">

                            <button class="sp_referral_del_btn delete_interest" type="button"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                `

                $('#append_interest').append(viewHtml).slideDown('slow');

                referral_level++;

            });



            $(document).on('click', '.delete_interest', function() {
                $(this).parent().parent().remove();
            });
        });

        $(function() {

            $('#investstatus').on('change', function() {
                let status = $(this).data('status');
                let url = $(this).data('url');

                $.ajax({

                    headers: {
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                    },

                    url: url,

                    data: {
                        status: status
                    },

                    method: "POST",

                    success: function(response) {
                        if (response.success) {

                            <?php if(Config::config()->alert === 'izi'): ?>
                                iziToast.success({
                                    position: 'topRight',
                                    message: "Refferal changed Successfully",
                                });
                            <?php elseif(Config::config()->alert === 'toast'): ?>
                                toastr.success("Refferal changed Successfully", {
                                    positionClass: "toast-top-right"

                                })
                            <?php else: ?>
                                Swal.fire({
                                    icon: 'success',
                                    title: "Refferal changed Successfully"
                                })
                            <?php endif; ?>

                            return
                        }


                        <?php if(Config::config()->alert === 'izi'): ?>
                            iziToast.error({
                                position: 'topRight',
                                message: "Something went wrong",
                            });
                        <?php elseif(Config::config()->alert === 'toast'): ?>
                            toastr.error("Something went wrong", {
                                positionClass: "toast-top-right"

                            })
                        <?php else: ?>
                            Swal.fire({
                                icon: 'error',
                                title: "Something went wrong"
                            })
                        <?php endif; ?>
                    }
                })
            })
        })

        $(function() {

            $('#intereststatus').on('change', function() {
                let status = $(this).data('status');
                let url = $(this).data('url');

                $.ajax({

                    headers: {
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                    },

                    url: url,

                    data: {
                        status: status
                    },

                    method: "POST",

                    success: function(response) {
                        if (response.success) {

                            <?php if(Config::config()->alert === 'izi'): ?>
                                iziToast.success({
                                    position: 'topRight',
                                    message: "Refferal changed Successfully",
                                });
                            <?php elseif(Config::config()->alert === 'toast'): ?>
                                toastr.success("Refferal changed Successfully", {
                                    positionClass: "toast-top-right"

                                })
                            <?php else: ?>
                                Swal.fire({
                                    icon: 'success',
                                    title: "Refferal changed Successfully"
                                })
                            <?php endif; ?>

                            return
                        }


                        <?php if(Config::config()->alert === 'izi'): ?>
                            iziToast.error({
                                position: 'topRight',
                                message: "Something went wrong",
                            });
                        <?php elseif(Config::config()->alert === 'toast'): ?>
                            toastr.error("Something went wrong", {
                                positionClass: "toast-top-right"

                            })
                        <?php else: ?>
                            Swal.fire({
                                icon: 'error',
                                title: "Something went wrong"
                            })
                        <?php endif; ?>
                    }
                })
            })
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/backend/referral/index.blade.php ENDPATH**/ ?>