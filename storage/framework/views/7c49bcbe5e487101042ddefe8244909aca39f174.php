

<?php $__env->startSection('content'); ?>
    <div class="row gy-4">

        <div class="col-md-12">
            <div class="sp_site_card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="mb-0"><?php echo e(__('KYC Verification')); ?></h4>
                    <?php if(auth()->user()->kyc == 2): ?>
                        <div class="alert alert-warning p-2">
                            <p><?php echo e(__('Kyc Verification Requst is Pending')); ?></p>
                        </div>
                    <?php elseif(auth()->user()->kyc == 3): ?>
                        <div class="alert alert-danger p-2">
                            <p><?php echo e(__('Kyc Verification Requst is Rejected! Please Re-submit again')); ?></p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <?php $__currentLoopData = Config::config()->kyc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proof): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($proof['type'] == 'text'): ?>
                                    <div class="form-group col-md-12">
                                        <label for="" class="mb-2 mt-2"><?php echo e(__($proof['field_label'])); ?></label>
                                        <input type="text"
                                            name="<?php echo e(strtolower(str_replace(' ', '_', $proof['field_name']))); ?>"
                                            class="form-control "
                                            <?php echo e($proof['validation'] == 'required' ? 'required' : ''); ?>>
                                    </div>
                                <?php endif; ?>
                                <?php if($proof['type'] == 'textarea'): ?>
                                    <div class="form-group col-md-12">
                                        <label for="" class="mb-2 mt-2"><?php echo e(__($proof['field_label'])); ?></label>
                                        <textarea name="<?php echo e(strtolower(str_replace(' ', '_', $proof['field_name']))); ?>" class="form-control "
                                            <?php echo e($proof['validation'] == 'required' ? 'required' : ''); ?>></textarea>
                                    </div>
                                <?php endif; ?>

                                <?php if($proof['type'] == 'file'): ?>
                                    <div class="form-group col-md-12">
                                        <label for="" class="mb-2 mt-2"><?php echo e(__($proof['field_label'])); ?></label>
                                        <input type="file"
                                            name="<?php echo e(strtolower(str_replace(' ', '_', $proof['field_name']))); ?>"
                                            class="form-control "
                                            <?php echo e($proof['validation'] == 'required' ? 'required' : ''); ?>>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                            <div class="form-group">
                                <button class="btn sp_theme_btn mt-4" type="submit"><?php echo e(__('KYC Verification')); ?></button>
                            </div>




                        </div>



                    </form>



                </div>

            </div>




        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(Config::theme(). 'layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/frontend/light/user/kyc.blade.php ENDPATH**/ ?>