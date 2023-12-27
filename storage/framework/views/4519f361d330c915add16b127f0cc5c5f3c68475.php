<?php $__env->startSection('element'); ?>
    <div class="card">
        <div class="row">
            <div class="col-md-12">
                <div class="tab" role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="tab-xx active"><a href="#acc" aria-controls="home" role="tab"
                                data-toggle="tab">Live Accounts</a></li>
                        <li role="presentation" class="tab-xx"><a href="#details" aria-controls="profile" role="tab"
                                data-toggle="tab">Personal Details</a></li>
                        <li role="presentation" class="tab-xx"><a href="#docs" aria-controls="messages" role="tab"
                                data-toggle="tab">Documents</a></li>
                        <li role="presentation" class="tab-xx"><a href="#dep" aria-controls="messages" role="tab"
                                data-toggle="tab">Deposit</a></li>
                        <li role="presentation" class="tab-xx"><a href="#with" aria-controls="messages" role="tab"
                                data-toggle="tab">Withdraw</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content tabs">
                        <div role="tabpanel" class="tab-pane fade  active show" id="acc">
                            <h3>LIVE ACCOUNTS</h3>
                            <div class="table-responsive">
                                <table class="table student-data-table m-t-20">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Sr. No')); ?></th>
                                            <th><?php echo e(__('MT5 A/C No')); ?></th>
                                            <th><?php echo e(__('Reg. Data')); ?></th>
                                            <th><?php echo e(__('Currency')); ?></th>
                                            <th><?php echo e(__('A/C Type')); ?></th>
                                            <th><?php echo e(__('Leverage')); ?></th>
                                            <th><?php echo e(__('Balance')); ?></th>
                                            <th><?php echo e(__('Equity')); ?></th>
                                            <th><?php echo e(__('Floating P/L')); ?></th>
                                            <th><?php echo e(__('Password')); ?></th>
                                            <th><?php echo e(__('Investor Password')); ?></th>
                                            <th><?php echo e(__('Delete')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $user->accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $acc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>

                                                <?php
                                                    $accDetails = $mt5->getAccount($acc->login);
                                                ?>

                                                <td>
                                                    <span><?php echo e($key + 1); ?></span>
                                                </td>
                                                <td> <span>
                                                        <?php echo e($acc->login); ?>

                                                    </span></td>
                                                <td> <span>
                                                        <?php echo e($acc->created_at); ?>

                                                    </span></td>
                                                <td> <span>
                                                        <?php echo e(strtoupper($acc->currency)); ?>

                                                    </span></td>
                                                <td> <span>
                                                        <?php if($acc->account_type == 1): ?>
                                                            Standard Account
                                                        <?php elseif($acc->account_type == 2): ?>
                                                            Premium Account
                                                        <?php else: ?>
                                                            VIP Account
                                                        <?php endif; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span><?php echo e($acc->leverage); ?></span>
                                                </td>
                                                <td>
                                                    <span><?php echo e($accDetails['balance'] ?? ''); ?></span>
                                                </td>
                                                <td>
                                                    <span><?php echo e($accDetails['equity'] ?? ''); ?></span>
                                                </td>
                                                <td>
                                                    <span><?php echo e($accDetails['floating'] ?? ''); ?></span>
                                                </td>
                                                <td>
                                                    <span><?php echo e($acc->master_pass); ?></span>
                                                </td>
                                                <td>
                                                    <span><?php echo e($acc->investor_pass); ?></span>
                                                </td>
                                                <td>
                                                    <button class="btn-sm btn-danger del-modal"><i
                                                            class=""></i>&times;</button>
                                                </td>

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td class="text-center" colspan="100%"><?php echo e(__('No Data Found')); ?>

                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="details">
                            <h3>USER DETAILS</h3>
                            <ul class="list-group col-md-6">

                                <li class="list-group-item d-flex justify-content-between">

                                    <span><?php echo e(__('First Name')); ?></span>
                                    <span><?php echo e($user->username); ?></span>

                                </li>
                                <li class="list-group-item d-flex justify-content-between">

                                    <span><?php echo e(__('Last Name')); ?></span>
                                    <span><?php echo e($user->username); ?></span>

                                </li>
                                <li class="list-group-item d-flex justify-content-between">

                                    <span><?php echo e(__('Email')); ?></span>
                                    <span><?php echo e($user->email); ?></span>

                                </li>
                                <li class="list-group-item d-flex justify-content-between">

                                    <span><?php echo e(__('Phone')); ?></span>
                                    <span><?php echo e($user->phone); ?></span>

                                </li>
                                <li class="list-group-item d-flex justify-content-between">

                                    <span><?php echo e(__('Address')); ?></span>
                                    <span><?php echo e($user->address->city . ', ' . $user->address->city . ', ' . $user->address->city); ?></span>

                                </li>
                                <li class="list-group-item d-flex justify-content-between">

                                    <span><?php echo e(__('Country')); ?></span>
                                    <span><?php echo e($user->address->country); ?></span>

                                </li>
                                <li class="list-group-item d-flex justify-content-between">

                                    <span><?php echo e(__('Reg. Date')); ?></span>
                                    <span><?php echo e($user->created_at); ?></span>

                                </li>


                            </ul>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="docs">
                            <div class="tab-pane active col-md-12" id="DOCUMENT">
                                <h3>DOCUMENT</h3>
                                <form action="<?php echo e(url('admin/users/kyc-approve')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>" />
                                    <table class="table table-bordered table-striped datatable ">
                                        <thead>
                                            <tr>
                                                <th>Document Type</th>
                                                <th>Document</th>
                                                <th>Verify</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $user->kycinfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td>
                                                        <?php if($doc->type == 'proof_id1'): ?>
                                                            Proof of ID 1
                                                        <?php elseif($doc->type == 'proof_id2'): ?>
                                                            Proof of ID 2
                                                        <?php elseif($doc->type == 'proof_address1'): ?>
                                                            Proof of Address 1
                                                        <?php else: ?>
                                                            Proof of Address 2
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <img src="<?php echo e(Config::getFile('kyc', $doc->file, true)); ?>"
                                                            alt="" class=""
                                                            style="width:50px; height:50px; margin-right:8px">
                                                        <!-- Replace "path/to/your/image.jpg" with the actual path or URL of your image -->
                                                        <a href="<?php echo e(Config::getFile('kyc', $doc->file, true)); ?>"
                                                            class="btn-sm btn-primary" download>
                                                            Download
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="docs[]" name="docs[]"
                                                            <?php if($doc->status == 1): ?> checked <?php endif; ?>
                                                            value="<?php echo e($doc->id); ?>">
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td class="text-center" colspan="100%"><?php echo e(__('No Data Found')); ?>

                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td colspan="3" align="center">
                                                    <button class="btn-sm btn-primary" type="submit">verify</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>

                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="dep">
                            <h3>DEPOSITS</h3>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table student-data-table m-t-20">
                                        <thead>
                                            <tr>

                                                <th><?php echo e(__('Payment Type')); ?></th>
                                                <th><?php echo e(__('A/C No')); ?></th>
                                                <th><?php echo e(__('Email')); ?></th>
                                                <th><?php echo e(__('Trans. Date')); ?></th>
                                                <th><?php echo e(__('Amount')); ?></th>
                                                <th><?php echo e(__('status')); ?></th>
                                                <th><?php echo e(__('Action')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $user->deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $manual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>


                                                    <td> <span>
                                                            <?php echo e($manual->payment->name); ?>

                                                        </span></td>
                                                    <td> <span>
                                                            <?php echo e($manual->login); ?>

                                                        </span></td>
                                                    <td> <span>
                                                            <?php echo e($manual->user->email); ?>

                                                        </span></td>
                                                    <td> <span>
                                                            <?php echo e($manual->created_at); ?>

                                                        </span></td>
                                                    <td><?php echo e(Config::formatter($manual->amount)); ?></td>

                                                    <td>
                                                        <?php if($manual->status == 2): ?>
                                                            <span class="badge badge-warning"><?php echo e(__('Pending')); ?></span>
                                                        <?php elseif($manual->status == 1): ?>
                                                            <span class="badge badge-success"><?php echo e(__('Approved')); ?></span>
                                                        <?php elseif($manual->status == 3): ?>
                                                            <span class="badge badge-danger"><?php echo e(__('Rejected')); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        

                                                        <a class="btn
                                                          <?php if($manual->status != 2): ?> disabled <?php endif; ?> btn-sm btn-outline-primary accept"
                                                            data-url="<?php echo e(route('admin.deposit.accept', $manual->id)); ?>"><i
                                                                class="fas fa-check"></i></a>
                                                        <a class="btn <?php if($manual->status != 2): ?> disabled <?php endif; ?>  btn-sm btn-outline-danger reject"
                                                            data-url="<?php echo e(route('admin.deposit.reject', $manual->id)); ?>"><i
                                                                class="fas fa-times"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td class="text-center" colspan="100%"><?php echo e(__('No Data Found')); ?>

                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="with">
                            <h3>WITHDRAWS</h3>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table student-data-table m-t-20">
                                        <thead>
                                            <tr>

                                                <th><?php echo e(__('Payment Type')); ?></th>
                                                <th><?php echo e(__('A/C No')); ?></th>
                                                <th><?php echo e(__('Email')); ?></th>
                                                <th><?php echo e(__('Trans. Date')); ?></th>
                                                <th><?php echo e(__('Amount')); ?></th>
                                                <th><?php echo e(__('status')); ?></th>
                                                <th><?php echo e(__('Action')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $user->withdraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $manual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>


                                                    <td> <span>
                                                            <?php echo e($manual->payment?->name); ?>

                                                        </span></td>
                                                    <td> <span>
                                                            <?php echo e($manual->login); ?>

                                                        </span></td>
                                                    <td> <span>
                                                            <?php echo e($manual->user->email); ?>

                                                        </span></td>
                                                    <td> <span>
                                                            <?php echo e($manual->created_at); ?>

                                                        </span></td>
                                                    <td><?php echo e(Config::formatter($manual->amount)); ?></td>

                                                    <td>
                                                        <?php if($manual->status == 2): ?>
                                                            <span class="badge badge-warning"><?php echo e(__('Pending')); ?></span>
                                                        <?php elseif($manual->status == 1): ?>
                                                            <span class="badge badge-success"><?php echo e(__('Approved')); ?></span>
                                                        <?php elseif($manual->status == 3): ?>
                                                            <span class="badge badge-danger"><?php echo e(__('Rejected')); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        


                                                        <a class="btn
                                                              <?php if($manual->status != 2): ?> disabled <?php endif; ?> btn-sm btn-outline-primary accept"
                                                            data-url="<?php echo e(route('admin.withdraw.accept', $manual->id)); ?>"><i
                                                                class="fas fa-check"></i></a>
                                                        <a class="btn <?php if($manual->status != 2): ?> disabled <?php endif; ?>  btn-sm btn-outline-danger reject"
                                                            data-url="<?php echo e(route('admin.withdraw.reject', $manual->id)); ?>"><i
                                                                class="fas fa-times"></i></a>

                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td class="text-center" colspan="100%"><?php echo e(__('No Data Found')); ?>

                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="accept" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form action="" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('Payment Accept')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <p><?php echo e(__('Are you sure to you want to delete this account')); ?>?</p>

                            <div class="d-flex" style="gap: 8px">
                                <div class="">
                                    <input type="checkbox" name="mt5" id="" class="mr-1"><span>Mt5</span>
                                </div>
                                <div class="">
                                    <input type="checkbox" name="admin_panel" id="" class="mr-1"><span> Admin
                                        Panel</span>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Accept')); ?></button>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <style>
        a:hover,
        a:focus {
            outline: none;
            text-decoration: none;
        }

        .tab .nav-tabs {
            border-bottom: 2px solid #e8e8e8;
        }

        .tab .nav-tabs li a {
            display: block;
            padding: 10px 20px;
            margin: 0 5px 1px 0;
            background: #fff;
            font-size: 14px;
            font-weight: 700;
            color: #112529;
            text-align: center;
            border: none;
            border-radius: 0;
            z-index: 2;
            position: relative;
            transition: all 0.3s ease 0s;
        }

        .tab .nav-tabs li a:hover,
        .tab .nav-tabs li.active a {
            color: #198df8;
            border: none;
        }

        .tab .nav-tabs li.active a:before {
            content: "";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 25px;
            font-weight: 700;
            color: #198df8;
            margin: 0 auto;
            position: absolute;
            bottom: -30px;
            left: 0;
            right: 0;
        }

        .tab .nav-tabs li.active a:after {
            content: "";
            width: 100%;
            height: 3px;
            background: #198df8;
            position: absolute;
            bottom: -1px;
            left: 0;
            z-index: -1;
            transition: all 0.3s ease 0s;
        }

        .tab .tab-content {
            padding: 30px 20px 20px;
            margin-top: 0;
            background: #fff;
            font-size: 15px;
            color: #7a9181;
            line-height: 30px;
            border-radius: 0 0 5px 5px;
        }

        .tab .tab-content h3 {
            font-size: 24px;
            margin-top: 0;
        }

        @media  only screen and (max-width: 479px) {
            .tab .nav-tabs li {
                width: 100%;
                text-align: center;
            }

            .tab .nav-tabs li.active a:before {
                content: "\f105";
                bottom: 15%;
                left: 0;
                right: auto;
            }
        }
    </style>
    <?php $__env->startPush('script'); ?>
        <script>
            $(document).ready(function() {
                // Add click event listener to tabs
                $('.tab-xx').click(function() {

                    // Remove "active" class from all tabs
                    $('.tab-xx').removeClass('active');

                    // Add "active" class to the clicked tab
                    $(this).addClass('active');
                });
            });


            $('.del-modal').on('click', function() {
                const modal = $('#accept');

                modal.find('form').attr('action', $(this).data('url'));
                modal.modal('show');
            })
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/backend/users/details.blade.php ENDPATH**/ ?>