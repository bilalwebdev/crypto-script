

<?php $__env->startSection('element'); ?>
    <div class="row gy-4">
        <div class="col-lg-9">
            
            <div class="p-4  bg-white rounded-lg">
                <form action="<?php echo e(route('admin.user.update', $user->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="form-group col-sm-6 mb-3 ">
                            <label><?php echo e(__('Name')); ?></label>
                            <input type="text" name="username" value="<?php echo e($user->username); ?>" class="form-control"
                                value="">
                        </div>
                        <div class="form-group col-sm-6 mb-3 ">
                            <label><?php echo e(__('Phone')); ?></label>
                            <input type="text" name="phone" class="form-control" value="<?php echo e($user->phone); ?>">
                        </div>
                        <div class="form-group col-sm-6 mb-3 ">
                            <label><?php echo e(__('Email')); ?></label>
                            <input type="text" name="email" value="<?php echo e($user->email); ?>" class="form-control"
                                value="">
                        </div>
                        <div class="form-group col-sm-6 mb-3 ">
                            <label><?php echo e(__('Country')); ?></label>
                            <input type="text" name="country" class="form-control"
                                value="<?php echo e(optional($user->address)->country); ?>">
                        </div>

                        

                        

                        

                        <div class="col-md-6 mb-3">
                            <label><?php echo e(__('Password')); ?></label>
                            <input type="password" name="password" class="form-control form_control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><?php echo e(__('Confirm Password')); ?></label>
                            <input type="password" name="password_confirmation" class="form-control form_control">
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
                                <?php echo e('Update Wallet'); ?>

                            </button>
                        </div>
                    </div>
                </form>
            </div>
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

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\personal\crypto-script\resources\views/backend/users/edit.blade.php ENDPATH**/ ?>