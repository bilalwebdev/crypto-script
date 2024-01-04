

<?php $__env->startSection('element'); ?>



    <div class="row gy-4">
        <div class="col-lg-9">
            <div class="p-4 bg-white rounded-lg">
                <h5><?php echo e($user->username); ?></h5>
                <p><?php echo e($user->email); ?></p>
                <div class="row pb-1">
                    <div class="col-xxl-2 col-md-4 col-sm-6 mb-xxl-0 mb-4">
                        <div class="sp-user-box">
                            <div class="sp-user-box_icon gr-bg-1">
                                <i class="las la-hand-holding-usd"></i>
                            </div>
                            <div class="sp-user-box_content">
                                <h4 class="mb-1">
                                    <?php echo e($user->currentplan->first() ? $user->currentplan->first()->plan->name : 'N/A'); ?>

                                </h4>
                                <p><?php echo e(__('Current Plan')); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6 mb-xxl-0 mb-4">
                        <div class="sp-user-box">
                            <div class="sp-user-box_icon gr-bg-2">
                                <i class="las la-users"></i>
                            </div>
                            <div class="sp-user-box_content">
                                <h4 class="mb-1"><?php echo e($totalRef); ?></h4>
                                <p><?php echo e(__('Total Refferal')); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6 mb-xxl-0 mb-4">
                        <div class="sp-user-box">
                            <div class="sp-user-box_icon gr-bg-3">
                                <i class="las la-dollar-sign"></i>
                            </div>
                            <div class="sp-user-box_content">
                                <h4 class="mb-1"> <?php echo e(Config::formatter($userCommission)); ?></h4>
                                <p><?php echo e(__('Total Commission')); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6 mb-sm-0 mb-4">
                        <div class="sp-user-box">
                            <div class="sp-user-box_icon gr-bg-4">
                                <i class="las la-hand-holding-usd"></i>
                            </div>
                            <div class="sp-user-box_content">
                                <h4 class="mb-1"> <?php echo e(Config::formatter($withdrawTotal)); ?></h4>
                                <p><?php echo e(__('Total Withdraw')); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6 mb-sm-0 mb-4">
                        <div class="sp-user-box">
                            <div class="sp-user-box_icon gr-bg-5">
                                <i class="las la-credit-card"></i>
                            </div>
                            <div class="sp-user-box_content">
                                <h4 class="mb-1"> <?php echo e(Config::formatter($totalDeposit)); ?></h4>
                                <p><?php echo e(__('Total Deposit')); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6">
                        <div class="sp-user-box">
                            <div class="sp-user-box_icon gr-bg-6">
                                <i class="las la-credit-card"></i>
                            </div>
                            <div class="sp-user-box_content">
                                <h4 class="mb-1"> <?php echo e(Config::formatter($totalInvest)); ?></h4>
                                <p><?php echo e(__('Total Invest amount')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 mt-4 bg-white rounded-lg">
                <h4 class="mb-3"><?php echo e(__('User Profile Settings')); ?></h4>
                <form action="<?php echo e(route('admin.user.update', $user->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="row">

                        <div class="form-group col-sm-6 mb-3 ">
                            <label><?php echo e(__('Phone')); ?></label>
                            <input type="text" name="phone" class="form-control" value="<?php echo e($user->phone); ?>">
                        </div>
                        <div class="form-group col-sm-6 mb-3 ">
                            <label><?php echo e(__('Country')); ?></label>
                            <input type="text" name="country" class="form-control"
                                value="<?php echo e(optional($user->address)->country); ?>">
                        </div>

                        <div class="col-sm-6 mb-3">

                            <label><?php echo e(__('city')); ?></label>
                            <input type="text" name="city" class="form-control form_control"
                                value="<?php echo e(optional($user->address)->city); ?>">
                        </div>

                        <div class="col-sm-6 mb-3">

                            <label><?php echo e(__('zip')); ?></label>
                            <input type="text" name="zip" class="form-control form_control"
                                value="<?php echo e(optional($user->address)->zip); ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label><?php echo e(__('state')); ?></label>
                            <input type="text" name="state" class="form-control form_control"
                                value="<?php echo e(optional($user->address)->state); ?>">
                        </div>

                        <div class="form-group col-md-6">
                            <label for=""><?php echo e(__('Admins')); ?></label>
                            <select name="admins[]" class="form-control js-example-tokenizer" multiple>
                                <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if(array_key_exists($key, $admin_users)): ?> selected <?php endif; ?> value="<?php echo e($key); ?>">
                                        <?php echo e($admin); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="row">
                                <div class="col-xl-3 col-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" <?php echo e($user->is_email_verified ? 'checked' : ''); ?>

                                            name="email_status" class="custom-control-input" id="useCheck1">
                                        <label class="custom-control-label"
                                            for="useCheck1"><?php echo e(__('Email Verified')); ?></label>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="sms_status"
                                            <?php echo e($user->is_sms_verified ? 'checked' : ''); ?> class="custom-control-input"
                                            id="useCheck2">
                                        <label class="custom-control-label"
                                            for="useCheck2"><?php echo e(__('SMS Verified')); ?></label>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="kyc_status"
                                            <?php echo e($user->is_kyc_verified ? 'checked' : ''); ?> class="custom-control-input"
                                            id="useCheck3">
                                        <label class="custom-control-label"
                                            for="useCheck3"><?php echo e(__('KYC Verified')); ?></label>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="status" <?php echo e($user->status ? 'checked' : ''); ?>

                                            class="custom-control-input" id="useCheck4">
                                        <label class="custom-control-label" for="useCheck4"><?php echo e(__('Status')); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xxl-3 col-xl-4 mt-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-sync-alt"></i>
                                <?php echo e('Update User'); ?>

                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="p-4 bg-white rounded-lg">
                <div class="sp-widget-user-thumb">
                    <img src="<?php echo e(Config::getFile('user', $user->image, true)); ?>">
                </div>
                <div class="text-center mt-3">
                    <div><?php echo e(__('Total Balance')); ?></div>
                    <h2 class="mb-0 mt-1 sp_d_user_balance"> <?php echo e(Config::formatter($user->balance)); ?></h2>
                </div>

                <div class="sp_balance_btns mt-4">
                    <button type="button" id="addBtn"
                        class="btn btn-sm py-2 btn-success"><?php echo e(__('Add Balance')); ?></button>
                    <button type="button" id="subBtn"
                        class="btn btn-sm py-2 btn-danger"><?php echo e(__('Subtract Balance')); ?></button>
                </div>

                <form action="<?php echo e(route('admin.user.balance.update', $user->id)); ?>" method="post" id="addBalance"
                    class="mt-3">
                    <?php echo csrf_field(); ?>
                    <div class="input-group mb-3">
                        <input type="hidden" class="form-control" name="user_id" value="<?php echo e($user->id); ?>">
                        <input type="hidden" class="form-control" name="type" value="add">
                        <input type="number" class="form-control" name="balance" min="1"
                            placeholder="add balance">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </form>
                <form action="<?php echo e(route('admin.user.balance.update', $user->id)); ?>" method="post" id="subBalance"
                    class="mt-3">
                    <?php echo csrf_field(); ?>
                    <div class="input-group mb-3">
                        <input type="hidden" class="form-control" name="user_id" value="<?php echo e($user->id); ?>">
                        <input type="hidden" class="form-control" name="type" value="minus">
                        <input type="number" class="form-control" name="balance" min="1"
                            placeholder="Subtract Balance">
                        <button class="btn btn-danger" type="submit">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
    <?php
        $reference = $user
            ->refferals()
            ->with('refferals')
            ->get();
    ?>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><?php echo e(__('Reference Tree')); ?></h5>
                </div>
                <div class="card-body">
                    <?php if($reference->count() > 0): ?>
                        <ul class="sp-referral">
                            <li class="single-child root-child">
                                <p>
                                    <img src="<?php echo e(Config::getFile('user', $user->image, true)); ?>">
                                    <span class="mb-0"><?php echo e($user->username); ?></span>
                                </p>
                                <ul class="sub-child-list step-2">
                                    <?php $__currentLoopData = $reference; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $us): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="single-child">
                                            <p>
                                                <img src="<?php echo e(Config::getFile('user', $user->image, true)); ?>">
                                                <span class="mb-0"><?php echo e($us->username); ?></span>
                                            </p>

                                            <ul class="sub-child-list step-3">
                                                <?php $__currentLoopData = $us->refferals()->with('refferals')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ref): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="single-child">
                                                        <p>
                                                            <img src="<?php echo e(Config::getFile('user', $ref->image, true)); ?>">
                                                            <span class="mb-0"><?php echo e($ref->username); ?></span>
                                                        </p>

                                                        <ul class="sub-child-list step-4">
                                                            <?php $__currentLoopData = $ref->refferals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ref2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li class="single-child">
                                                                    <p>
                                                                        <img
                                                                            src="<?php echo e(Config::getFile('user', $ref2->image)); ?>">
                                                                        <span class="mb-0"><?php echo e($ref2->username); ?></span>
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
                            <i class="las la-envelope-open display-1"></i>
                            <p class="mt-2">
                                <?php echo e(__('No Reference User Found')); ?>

                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="mail">
        <div class="modal-dialog modal-lg" role="document">
            <form action="<?php echo e(route('admin.user.mail', $user->id)); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('Send Mail to user')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for=""><?php echo e(__('Subject')); ?></label>
                            <input type="text" name="subject" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for=""><?php echo e(__('Message')); ?></label>
                            <textarea name="message" id="" cols="30" rows="10" class="form-control summernote"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-dark"
                            data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><i class="las la-envelope"></i>
                            <?php echo e(__('Send Mail')); ?></button>
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="user_id" value="<?php echo e($user->id); ?>">
                        <input type="hidden" class="form-control" name="type" value="">
                        <input type="hidden" class="form-control" name="balance" value="">
                        <p><?php echo e(__('Are you sure to perform this action')); ?> ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Update')); ?></button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('external-style'); ?>
    <link rel="stylesheet" href="<?php echo e(Config::cssLib('backend', 'toogle.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('external-script'); ?>
    <script src="<?php echo e(Config::jsLib('backend', 'toogle.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

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


<?php $__env->startPush('script'); ?>
    <script>
        $(function() {
            'use strict'

            let addBalance = $("#addBalance");
            let subBalance = $("#subBalance");

            addBalance.addClass('d-none');
            subBalance.addClass('d-none');

            $("#addBtn").on('click', function() {
                addBalance.toggleClass('d-none');
                if (subBalance.hasClass('d-none')) {
                    return true;
                } else {
                    subBalance.addClass('d-none');
                }
            });

            $("#subBtn").on('click', function() {
                subBalance.toggleClass('d-none');
                if (addBalance.hasClass('d-none')) {
                    return true;
                } else {
                    addBalance.addClass('d-none');
                }
            });

            $('#addBalance').on('submit', function(e) {
                e.preventDefault();

                let formData = $(this).serializeArray();

                const modal = $('#confirmation');

                modal.find('input[name=type]').val(formData[2].value)
                modal.find('input[name=balance]').val(formData[3].value)

                modal.find('form').attr('action', $(this).attr('action'))

                modal.modal('show')
            })


            $('#subBalance').on('submit', function(e) {
                e.preventDefault();

                let formData = $(this).serializeArray();

                const modal = $('#confirmation');

                modal.find('input[name=type]').val(formData[2].value)
                modal.find('input[name=balance]').val(formData[3].value)

                modal.find('form').attr('action', $(this).attr('action'))

                modal.modal('show')

            })

            $('.sendMail').on('click', function(e) {
                e.preventDefault();

                const modal = $('#mail');

                modal.modal('show');
            })
        })
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('external-style'); ?>
    <link rel="stylesheet" href="<?php echo e(Config::cssLib('backend', 'select2.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('external-script'); ?>
    <script src="<?php echo e(Config::jsLib('backend', 'select2.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict'

        $(function() {

            $(".js-example-tokenizer").select2({
                placeholder: "Select Admin"
            })
            $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "<?php echo e(__('Choose File')); ?>", // Default: Choose File
                label_selected: "<?php echo e(__('Update Image')); ?>", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/backend/users/edit.blade.php ENDPATH**/ ?>