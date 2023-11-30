<?php $__env->startSection('content'); ?>
     <div class="row">
            <div class="col-md-12">
                <div class="sp_site_card">
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                        <h4><?php echo e(__('Profile Settings')); ?></h4>
                        <a href="<?php echo e(route('user.change.password')); ?>" class="btn btn-sm sp_theme_btn mb-2"><?php echo e(__('Change Password')); ?></a>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('user.profileupdate')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row gy-4 justify-content-center">
                                <div class="col-md-4 pe-lg-5 pe-md-4 justify-content-center">
                                    <div class="img-choose-div text-center">
                                        <p class="mb-4"><?php echo e(__('Profile Picture')); ?></p>
        
                                            <img class=" rounded file-id-preview" id="file-id-preview"
                                                src="<?php echo e(Config::getFile('user', Auth::user()->image, true)); ?>" alt="pp">
        
                                        <input type="file" name="image" id="imageUpload" class="upload"
                                            accept=".png, .jpg, .jpeg" hidden>
        
                                        <label for="imageUpload"
                                            class="editImg btn btn-md sp_theme_btn w-100"><?php echo e(_('Choose file')); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                       
                                        <div class="mb-3 col-md-6">
                                            <label><?php echo e(__('Username')); ?></label>
                                            <input type="text" class="form-control text-white" name="username"
                                                value="<?php echo e(Auth::user()->username); ?>"
                                                placeholder="<?php echo e(__('Enter User Name')); ?>" disabled>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label><?php echo e(__('Email address')); ?></label>
                                            <input type="email" class="form-control" name="email"
                                                value="<?php echo e(Auth::user()->email); ?>" placeholder="<?php echo e(__('Enter Email')); ?>" disabled>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label><?php echo e(__('Phone')); ?></label>
                                            <input type="text" class="form-control" name="phone"
                                                value="<?php echo e(Auth::user()->phone); ?>" placeholder="<?php echo e(__('Enter Phone')); ?>">
                                        </div>
                                    
                                      
        
                                        <div class="form-group col-md-6 mb-3 ">
                                            <label><?php echo e(__('Country')); ?></label>
                                            <input type="text" name="country" class="form-control"
                                                value="<?php echo e(optional( Auth::user()->address)->country); ?>">
                                        </div>
        
                                        <div class="col-md-6 mb-3">
        
                                            <label><?php echo e(__('city')); ?></label>
                                            <input type="text" name="city" class="form-control form_control"
                                                value="<?php echo e(optional( Auth::user()->address)->city); ?>">
        
                                        </div>
        
                                        <div class="col-md-6 mb-3">
        
                                            <label><?php echo e(__('zip')); ?></label>
                                            <input type="text" name="zip" class="form-control form_control"
                                                value="<?php echo e(optional( Auth::user()->address)->zip); ?>">
        
                                        </div>
        
                                        <div class="col-md-6 mb-3">
        
                                            <label><?php echo e(__('state')); ?></label>
                                            <input type="text" name="state" class="form-control form_control"
                                                value="<?php echo e(optional( Auth::user()->address)->state); ?>">
        
                                        </div>


                                        <div class="col-md-6 mb-3">
        
                                            <label><?php echo e(__('Telegram Username')); ?></label>
                                            <input type="text" name="telegram_id" class="form-control form_control"
                                                value="<?php echo e(Auth::user()->telegram_id); ?>" required>
        
                                        </div>
        
                                    </div>
        
                                    <button class="btn sp_theme_btn mt-3 w-100"><?php echo e(__('Update')); ?></button>
                                </div>
        
        
        
        
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('style'); ?>
    <style>
        .file-id-preview {
            max-height: 300px;
            display: inline-block !important;
        }
    </style>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('script'); ?>
    <script>
        'use strict'

        document.getElementById("imageUpload").onchange = function() {
            show();
        };

        function show() {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-id-preview");
                preview.src = src;
                preview.style.display = "block";
                document.getElementById("file-id-preview").style.visibility = "visible";
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(Config::theme().'layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\crypto-script\main\resources\views/frontend/light/user/profile.blade.php ENDPATH**/ ?>