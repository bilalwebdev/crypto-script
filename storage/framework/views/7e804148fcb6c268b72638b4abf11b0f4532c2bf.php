

<?php $__env->startSection('element'); ?>
    <div class="row">
        <div class="col-md-12">


            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs page-link-list border-0" role="tablist">
                        <li>
                            <a class="<?php echo e(request()->query('notifications') || request()->query->count() == 0 ? 'active' : ''); ?>"
                                data-toggle="tab" href="#general">
                                <span class="text-uppercase">
                                    <i class="las la-home"></i>
                                    <?php echo e(__('All Notifications')); ?>

                                </span>
                            </a>
                        </li>

                        <li>
                            <a class="<?php echo e(request()->query('depositNotifications') ? 'active' : ''); ?>" data-toggle="tab"
                                href="#deposit">
                                <span class="text-uppercase">
                                    <i class="las la-home"></i>
                                    <?php echo e(__('Deposit Notifications')); ?>

                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="<?php echo e(request()->query('subscriptionNotifications') ? 'active' : ''); ?>" data-toggle="tab"
                                href="#subscription">
                                <span class="text-uppercase">
                                    <i class="las la-cog"></i>
                                    <?php echo e(__('Subscription Notification')); ?>

                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="<?php echo e(request()->query('withdrawNotifications') ? 'active' : ''); ?>" data-toggle="tab"
                                href="#withdraw">
                                <span class="text-uppercase">
                                    <i class="las la-cog"></i>
                                    <?php echo e(__('Withdraw Notifications')); ?>

                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="<?php echo e(request()->query('supportNotifications') ? 'active' : ''); ?>" data-toggle="tab"
                                href="#support">
                                <span class="text-uppercase">
                                    <i class="las la-cookie-bite"></i>
                                    <?php echo e(__('Support Notifications')); ?>

                                </span>
                            </a>
                        </li>


                        <li>
                            <a class="<?php echo e(request()->query('kycNotifications') ? 'active' : ''); ?>" data-toggle="tab"
                                href="#kyc">
                                <span class="text-uppercase">
                                    <i class="las la-cookie-bite"></i>
                                    <?php echo e(__('KYC Notifications')); ?>

                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="tab-content tabcontent-border">
                <div class="tab-pane fade <?php echo e(request()->query('notifications') || request()->query->count() == 0 ? 'show active' : ''); ?>"
                    id="general" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="pt-4">
                                <div class="notification-ui_dd-content">

                                    <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="notification-list <?php echo e($notification->read_at == null ? 'notification-list--unread' : 'notification-list--read'); ?>"
                                            id="remove-<?php echo e($notification->id); ?>">
                                            <div class="notification-list_content">
                                                <div class="notification-list_detail">
                                                    <p class="text-muted"><?php echo e($notification->data['message']); ?></p>
                                                    <p class="text-primary">
                                                        <i class="las la-clock"></i>
                                                        <small><?php echo e($notification->created_at->diffforhumans()); ?></small>
                                                    </p>
                                                </div>
                                            </div>
                                            <label class="toggle">
                                                <input type="checkbox"
                                                    data-url="<?php echo e(route('admin.markNotification.single', $notification->id)); ?>"
                                                    class="check" <?php echo e($notification->read_at != null ? 'checked' : ''); ?>

                                                    data-id="#remove-<?php echo e($notification->id); ?>">
                                                <span></span>
                                            </label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($notifications->hasPages()): ?>
                                        <div class="card">
                                            <div class="card-footer">
                                                <?php echo e($notifications->links()); ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane <?php echo e(request()->query('depositNotifications') ? 'show active' : ''); ?>" id="deposit"
                    role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="pt-4">
                                <div class="notification-ui_dd-content">

                                    <?php $__currentLoopData = $depositNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="notification-list <?php echo e($notification->read_at == null ? 'notification-list--unread' : 'notification-list--read'); ?>"
                                            id="remove-<?php echo e($notification->id); ?>">
                                            <div class="notification-list_content">
                                                <div class="notification-list_detail">
                                                    <p class="text-muted"><?php echo e($notification->data['message']); ?></p>
                                                    <p class="text-primary">
                                                        <i class="las la-clock"></i>
                                                        <small><?php echo e($notification->created_at->diffforhumans()); ?></small>
                                                    </p>
                                                </div>
                                            </div>
                                            <label class="toggle">
                                                <input type="checkbox"
                                                    data-url="<?php echo e(route('admin.markNotification.single', $notification->id)); ?>"
                                                    class="check" <?php echo e($notification->read_at != null ? 'checked' : ''); ?>

                                                    data-id="#remove-<?php echo e($notification->id); ?>">
                                                <span></span>
                                            </label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($depositNotifications->hasPages()): ?>
                                        <div class="card">
                                            <div class="card-footer">
                                                <?php echo e($depositNotifications->links()); ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade <?php echo e(request()->query('subscriptionNotifications') ? 'show active' : ''); ?>"
                    id="subscription" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="pt-4">
                                <div class="notification-ui_dd-content">

                                    <?php $__currentLoopData = $subscriptionNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="notification-list <?php echo e($notification->read_at == null ? 'notification-list--unread' : 'notification-list--read'); ?>"
                                            id="remove-<?php echo e($notification->id); ?>">
                                            <div class="notification-list_content">
                                                <div class="notification-list_detail">
                                                    <p class="text-muted"><?php echo e($notification->data['message']); ?></p>
                                                    <p class="text-primary">
                                                        <i class="las la-clock"></i>
                                                        <small><?php echo e($notification->created_at->diffforhumans()); ?></small>
                                                    </p>
                                                </div>
                                            </div>
                                            <label class="toggle">
                                                <input type="checkbox"
                                                    data-url="<?php echo e(route('admin.markNotification.single', $notification->id)); ?>"
                                                    class="check" <?php echo e($notification->read_at != null ? 'checked' : ''); ?>

                                                    data-id="#remove-<?php echo e($notification->id); ?>">
                                                <span></span>
                                            </label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($subscriptionNotifications->hasPages()): ?>
                                        <div class="card">
                                            <div class="card-footer">
                                                <?php echo e($subscriptionNotifications->links()); ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade <?php echo e(request()->query('withdrawNotifications') ? 'show active' : ''); ?>"
                    id="withdraw" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="pt-4">
                                <div class="notification-ui_dd-content">

                                    <?php $__currentLoopData = $withdrawNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="notification-list <?php echo e($notification->read_at == null ? 'notification-list--unread' : 'notification-list--read'); ?>"
                                            id="remove-<?php echo e($notification->id); ?>">
                                            <div class="notification-list_content">
                                                <div class="notification-list_detail">
                                                    <p class="text-muted"><?php echo e($notification->data['message']); ?></p>
                                                    <p class="text-primary">
                                                        <i class="las la-clock"></i>
                                                        <small><?php echo e($notification->created_at->diffforhumans()); ?></small>
                                                    </p>
                                                </div>
                                            </div>
                                            <label class="toggle">
                                                <input type="checkbox"
                                                    data-url="<?php echo e(route('admin.markNotification.single', $notification->id)); ?>"
                                                    class="check" <?php echo e($notification->read_at != null ? 'checked' : ''); ?>

                                                    data-id="#remove-<?php echo e($notification->id); ?>">
                                                <span></span>
                                            </label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($withdrawNotifications->hasPages()): ?>
                                        <div class="card">
                                            <div class="card-footer">
                                                <?php echo e($withdrawNotifications->links()); ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade <?php echo e(request()->query('supportNotifications') ? 'show active' : ''); ?>"
                    id="support" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="pt-4">
                                <div class="notification-ui_dd-content">

                                    <?php $__currentLoopData = $ticketNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="notification-list <?php echo e($notification->read_at == null ? 'notification-list--unread' : 'notification-list--read'); ?>"
                                            id="remove-<?php echo e($notification->id); ?>">
                                            <div class="notification-list_content">
                                                <div class="notification-list_detail">
                                                    <p class="text-muted"><?php echo e($notification->data['message']); ?></p>
                                                    <p class="text-primary">
                                                        <i class="las la-clock"></i>
                                                        <small><?php echo e($notification->created_at->diffforhumans()); ?></small>
                                                    </p>
                                                </div>
                                            </div>
                                            <label class="toggle">
                                                <input type="checkbox"
                                                    data-url="<?php echo e(route('admin.markNotification.single', $notification->id)); ?>"
                                                    class="check" <?php echo e($notification->read_at != null ? 'checked' : ''); ?>

                                                    data-id="#remove-<?php echo e($notification->id); ?>">
                                                <span></span>
                                            </label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($ticketNotifications->hasPages()): ?>
                                        <div class="card">
                                            <div class="card-footer">
                                                <?php echo e($ticketNotifications->links()); ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade <?php echo e(request()->query('kycNotifications') ? 'show active' : ''); ?>" id="kyc"
                    role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="pt-4">
                                <div class="notification-ui_dd-content">

                                    <?php $__currentLoopData = $kycNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="notification-list <?php echo e($notification->read_at == null ? 'notification-list--unread' : 'notification-list--read'); ?>"
                                            id="remove-<?php echo e($notification->id); ?>">
                                            <div class="notification-list_content">
                                                <div class="notification-list_detail">
                                                    <p class="text-muted"><?php echo e($notification->data['message']); ?></p>
                                                    <p class="text-primary">
                                                        <i class="las la-clock"></i>
                                                        <small><?php echo e($notification->created_at->diffforhumans()); ?></small>
                                                    </p>
                                                </div>
                                            </div>
                                            <label class="toggle">
                                                <input type="checkbox"
                                                    data-url="<?php echo e(route('admin.markNotification.single', $notification->id)); ?>"
                                                    class="check" <?php echo e($notification->read_at != null ? 'checked' : ''); ?>

                                                    data-id="#remove-<?php echo e($notification->id); ?>">
                                                <span></span>
                                            </label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($kycNotifications->hasPages()): ?>
                                        <div class="card">
                                            <div class="card-footer">
                                                <?php echo e($kycNotifications->links()); ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('style'); ?>
    <style>
        .toggle span {
            display: block;
            width: 40px;
            height: 24px;
            border-radius: 99em;
            background-color: #e9ecf4;
            box-shadow: inset 1px 1px 1px 0 rgba(0, 0, 0, 0.05);
            position: relative;
            transition: 0.15s ease;
        }

        .toggle span:before {
            content: "";
            display: block;
            position: absolute;
            left: 3px;
            top: 3px;
            height: 18px;
            width: 18px;
            background-color: #ffffff;
            border-radius: 50%;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.15);
            transition: 0.15s ease;
        }

        .toggle input {
            clip: rect(0 0 0 0);
            -webkit-clip-path: inset(50%);
            clip-path: inset(50%);
            height: 1px;
            overflow: hidden;
            position: absolute;
            white-space: nowrap;
            width: 1px;
        }

        .toggle input:checked+span {
            background-color: #434ce8;
        }

        .toggle input:checked+span:before {
            transform: translateX(calc(100% - 2px));
        }

        .toggle input:focus+span {
            box-shadow: 0 0 0 4px #ecf3fe;
        }



        .notification-ui_dd-content {
            margin-bottom: 30px;
        }

        .notification-list {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            margin-bottom: 7px;
            background: #fff;
            -webkit-box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
        }

        .notification-list--unread {
            border-left: 2px solid #ea8c08;
        }

        .notification-list--read {
            border-left: 2px solid #03ae30;
        }

        .notification-list .notification-list_content {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        .notification-list .notification-list_content .notification-list_img img {
            height: 48px;
            width: 48px;
            border-radius: 50px;
            margin-right: 20px;
        }

        .notification-list .notification-list_content .notification-list_detail p {
            margin-bottom: 5px;
            line-height: 1.2;
        }

        .notification-list .notification-list_feature-img img {
            height: 48px;
            width: 48px;
            border-radius: 5px;
            margin-left: 20px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        $(function() {
            'use strict'

            $('.check').on('change', function() {
                $.ajax({
                    url: $(this).data('url'),
                    method: "POST",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "id": $(this).data('id')
                    },
                    success: function(response) {
                        if (response.success) {

                            $(response.id).fadeOut(300, function() {
                                $(this).remove();
                            });

                            <?php if(Config::config()->alert === 'izi'): ?>
                                iziToast.success({
                                    position: 'topRight',
                                    message: "Notification Mark As Read",
                                });
                            <?php elseif(Config::config()->alert === 'toast'): ?>
                                toastr.success("Notification Mark As Read", {
                                    positionClass: "toast-top-right"

                                })
                            <?php else: ?>
                                Swal.fire({
                                    icon: 'success',
                                    title: "Notification Mark As Read"
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

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/backend/notifications.blade.php ENDPATH**/ ?>