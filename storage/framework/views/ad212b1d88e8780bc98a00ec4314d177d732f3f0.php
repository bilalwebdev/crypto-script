

<?php $__env->startSection('element'); ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    <div class="user-thumd">
                        <div class="image-upload">
                            <div class="image-edit text-center text-white">
                                <label for="imageUpload" class="mb-0"><i class="far fa-edit"></i> <?php echo e(__('Change Photo')); ?></label>
                            </div>
                            <div class="image-preview">
                                <div id="imagePreview"
                                    style="background-image: url(<?php echo e(Config::getFile('admin', auth()->guard('admin')->user()->image)); ?>);">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <ul class="nav nav-tabs sp_nav_tabs">
                        <li class="nav-item"><a href="#setting" data-toggle="tab"
                                class="nav-link active show"><i class="fas fa-cog"></i> <?php echo e(__('Settings')); ?></a>
                        </li>
                        <li class="nav-item"><a href="#password-change" data-toggle="tab"
                                class="nav-link "><i class="fas fa-key"></i> <?php echo e(__('Change Password')); ?></a>
                        </li>
                    </ul>
                    <div class="tab-content mt-4">
                        <div id="setting" class="tab-pane fade active show">
                            <form method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="settings-form">
                                    <div class="mb-3">
                                        <input type='file' class="form-control d-none" name="image" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label><?php echo e(__('Email')); ?></label>
                                            <input type="email" placeholder="Email" name="email"
                                                class="form-control"
                                                value="<?php echo e(auth()->guard('admin')->user()->email); ?>" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo e(__('Username')); ?></label>
                                            <input type="text" placeholder="Username" name="username"
                                                class="form-control"
                                                value="<?php echo e(auth()->guard('admin')->user()->username); ?>" required>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary"
                                        type="submit"><?php echo e(__('Update Profile')); ?></button>
                                </div>
                            </form>
                        </div>
                        
                        <div id="password-change" class="tab-pane fade">
                            <form action="<?php echo e(route('admin.change.password')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="settings-form">

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label><?php echo e(__('Old Password')); ?></label>
                                            <input type="password" name="old_password" placeholder="Old Password"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo e(__('New Password')); ?></label>
                                            <input type="password" name="password" placeholder="New Password"
                                                class="form-control">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label><?php echo e(__('Confirm Password')); ?></label>
                                            <input type="password" name="password_confirmation"
                                                placeholder="Confirm Password" class="form-control">
                                        </div>
                                    </div>

                                    <button class="btn btn-primary"
                                        type="submit"><?php echo e(__('Update Password')); ?></button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict'

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/backend/profile.blade.php ENDPATH**/ ?>