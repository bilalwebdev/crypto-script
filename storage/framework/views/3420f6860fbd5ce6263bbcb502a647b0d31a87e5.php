


<?php $__env->startSection('element'); ?>
    <div class="row card">
        <div class="col-md-12">
            <div class="">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                    <h4><?php echo e(__('Upload KYC Documents')); ?></h4>

                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo e(url('admin/user/upload-kyc-submit')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="col-12">
                            <div class="col-6">
                                <label for="">Select Document Type</label>
                                <select name="doc_type" id="" class="form-control" required>
                                    <option value=""></option>
                                    <option value="proof_id">Identity Proof</option>
                                    <option value="proof_address">Address Proof</option>
                                </select>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="">Select Document</label>
                                <input type="file" name="file" class="form-control" required id="">
                            </div>
                            <input type="hidden" name="user_id" value="<?php echo e($user_id); ?>" class="form-control"
                                id="">
                            <div class="col-6 mt-2">
                                <button type="submit" class="btn btn-md btn-primary ">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pratice\crypto-script\resources\views/backend/users/upload-kyc.blade.php ENDPATH**/ ?>