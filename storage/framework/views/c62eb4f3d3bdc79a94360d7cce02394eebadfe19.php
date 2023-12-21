

<?php $__env->startSection('element'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h4 class="card-title"><?php echo e(__('Admin Edit')); ?></h4>
                    <a href="<?php echo e(route('admin.admins.index')); ?>" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> <?php echo e(__('Go Back')); ?></a>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.admins.update', $admin)); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="col-form-label"><?php echo e(__('Admin Image')); ?></label>

                                <div id="image-preview" class="image-preview"
                                    style="background-image:url(<?php echo e(Config::getFile('admin', $admin->image, true)); ?>);">
                                    <label for="image-upload" id="image-label"
                                        class="mb-0"><?php echo e(__('Choose File')); ?></label>
                                    <input type="file" name="admin_image" id="image-upload" />
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                   

                                    <div class="form-group col-md-6">
                                        <label for=""><?php echo e(__('Username')); ?></label>
                                        <input type="text" name="username" class="form-control" required
                                            value="<?php echo e($admin->username); ?>">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for=""><?php echo e(__('Email')); ?></label>
                                        <input type="email" name="email" class="form-control" required
                                            value="<?php echo e($admin->email); ?>">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for=""><?php echo e(__('Roles')); ?></label>
                                        <select name="roles[]" class="form-control js-example-tokenizer" multiple>
                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($role->name); ?>"
                                                    <?php echo e($admin->hasRole($role->name) ? 'selected' : ''); ?>>
                                                    <?php echo e($role->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for=""><?php echo e(__('Password')); ?></label>
                                        <input type="password" name="password" class="form-control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for=""><?php echo e(__('Password Confirmation')); ?></label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>



                                    <div class="col-md-6">

                                        <button class="btn btn-primary" type="admin">
                                            <i class="las la-sync"></i>
                                            <?php echo e(__('Update Admin')); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('external-style'); ?>
    <link rel="stylesheet" href="<?php echo e(Config::cssLib('backend', 'select2.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('external-script'); ?>
    <script src="<?php echo e(Config::jsLib('backend', 'select2.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        $(function() {
            'use strict'
            
            $(".js-example-tokenizer").select2({
                placeholder: "Select Role"
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

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/backend/admins/edit.blade.php ENDPATH**/ ?>