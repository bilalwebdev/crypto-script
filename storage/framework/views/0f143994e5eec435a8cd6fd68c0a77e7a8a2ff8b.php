


<?php $__env->startSection('element'); ?>
    <div class="row ">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header site-card-header justify-content-between align-items-center">
                    <div class="card-header-left ">
                        <div class="row gap-2">
                            <form action="" method="get">
                                <div class="input-group flex-wrap user-search-area">
                                    <input type="text" class="form-control form-control-sm"
                                        placeholder="username or email or phone" name="search">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary btn-sm" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="m-1">
                                <a href="<?php echo e(route('admin.user.create')); ?>" class="btn btn-primary btn-sm"><i
                                        class="fas fa-plus"></i> Add Wallet</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-header-right">
                        <form action="" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="row d-flex" style="gap: 5px">
                                <div class="form-group ">
                                    <select name="admin" class="form-control" style="height:35px">
                                        <option value="-">Select Admin</option>
                                        <?php $__currentLoopData = @$admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>">
                                                <?php echo e($admin); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                            </div>
                            <input type="text" id="checkedUsers" class="form-control d-none" name="checkedUsers">
                            <div class="">
                                <button class="btn btn-sm btn-primary"><?php echo e(__('Submit')); ?></button>
                            </div>
                    </div>

                    </form>
                </div>


                
                </div>

                
           

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table student-data-table m-t-20">
                        <thead>
                            <tr>

                                <th><?php echo e(__('Sl')); ?></th>
                                <th><?php echo e(__('Username')); ?></th>
                                
                                <th><?php echo e(__('Phone')); ?></th>
                                <th><?php echo e(__('Email')); ?></th>
                                <th><?php echo e(__('Reg. Date')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr onclick="rowSelected(<?php echo e($user->id); ?>)" id="user_<?php echo e($user->id); ?>">
                                    
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($user->username); ?></td>
                                    
                                    <td><?php echo e($user->phone); ?></td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td><?php echo e($user->created_at); ?></td>
                                    <td>
                                        <?php if($user->status): ?>
                                            <span class='badge badge-success'><?php echo e(__('Active')); ?></span>
                                        <?php else: ?>
                                            <span class='badge badge-danger'><?php echo e(__('Inactive')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.user.details', $user)); ?>"
                                            class="btn btn-sm btn-primary">View</a>
                                        <a href="" class="btn btn-info btn-sm">Uplaod Kyc</a>
                                        <a href="" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td class="text-center" colspan="100%"><?php echo e(__('No Data Found')); ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php if($users->hasPages()): ?>
                <div class="card-footer">
                    <?php echo e($users->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="mail">
        <div class="modal-dialog modal-lg" role="document">
            <form action="<?php echo e(route('admin.user.bulk')); ?>" method="post">
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
                        <button type="submit" class="btn btn-sm btn-primary"><i class="las la-envelope"></i>
                            <?php echo e(__('Send Mail')); ?></button>
                        <button type="button" class="btn btn-sm btn-danger"
                            data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .bg-blue {
            background-color: rgb(84, 126, 165);
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        $(function() {
            'use strict'
            $('.sendMail').on('click', function(e) {
                e.preventDefault();
                const modal = $('#mail');
                modal.modal('show');
            })
        })

        var user_id = '';
        var usersChecked = [];
        var isChecked = false;

        function rowSelected(id) {
            // alert('#user_' + id);
            user_id = id;
            isChecked = !isChecked;
            $('#usercheck_' + id).prop("checked", isChecked);
            $('.user_check').removeClass('d-none');
            $('#user_' + id).toggleClass('bg-blue');

            usersChecked.push(id);
            // $('#usercheck_' + id).dbclick(function() {
            //     $('#user_' + id).removeClass('bg-gray');
            //     usersChecked.pop(id);
            // });

            $('#checkedUsers').val(usersChecked.join(', '));
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\personal\crypto-script\resources\views/backend/users/index.blade.php ENDPATH**/ ?>