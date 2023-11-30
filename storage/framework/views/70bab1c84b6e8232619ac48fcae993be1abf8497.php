<form action="<?php echo e(route('admin.general.basic')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="type" value="kyc">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-sm btn-primary payment"> <i class="fa fa-plus text-white"></i>
                <?php echo e(__('Add KYC Requirements')); ?></button>
        </div>
        <div class="card-body">
            <div class="row payment-instruction">
                <?php if($general->kyc != null): ?>
                    <?php $__currentLoopData = $general->kyc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-12 user-data">
                            <div class="mb-4">
                                <div class="row mb-md-0 mb-4">

                                    <div class="col-md-3">
                                        <label><?php echo e(__('Field Label')); ?></label>
                                        <input name="kyc[<?php echo e($key); ?>][field_label]"
                                            class="form-control form_control" type="text"
                                            value="<?php echo e($param['field_label']); ?>" required>
                                    </div>


                                    <div class="col-md-3">
                                        <label><?php echo e(__('Field Name')); ?></label>
                                        <input name="kyc[<?php echo e($key); ?>][field_name]"
                                            class="form-control form_control fieldName" type="text"
                                            value="<?php echo e($param['field_name']); ?>" required>
                                    </div>
                                    <div class="col-md-2 mt-md-0 mt-2">
                                        <label><?php echo e(__('Field Type')); ?></label>
                                        <select name="kyc[<?php echo e($key); ?>][type]" class="form-control selectric">
                                            <option value="text" <?php echo e($param['type'] == 'text' ? 'selected' : ''); ?>>
                                                <?php echo e(__('Input Text')); ?>

                                            </option>
                                            <option value="textarea"
                                                <?php echo e($param['type'] == 'textarea' ? 'selected' : ''); ?>>
                                                <?php echo e(__('Textarea')); ?>

                                            </option>
                                            <option value="file" <?php echo e($param['type'] == 'file' ? 'selected' : ''); ?>>
                                                <?php echo e(__('File upload')); ?>

                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mt-md-0 mt-2">
                                        <label><?php echo e(__('Field Validation')); ?></label>
                                        <select name="kyc[<?php echo e($key); ?>][validation]"
                                            class="form-control selectric">
                                            <option value="required"
                                                <?php echo e($param['validation'] == 'required' ? 'selected' : ''); ?>>
                                                <?php echo e(__('Required')); ?>

                                            </option>
                                            <option value="nullable"
                                                <?php echo e($param['validation'] == 'nullable' ? 'selected' : ''); ?>>
                                                <?php echo e(__('Optional')); ?>

                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 text-right my-auto ">

                                        <button class="btn btn-danger btn-lg remove w-100 mt-4" type="button">
                                            <i class="fa fa-times"></i>
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="col-md-12 user-data">
                        <div class="row">
                            <div class="col-md-12 user-data">
                                <div class="mb-4">
                                    <div class="row mb-md-0 mb-4">

                                        <div class="col-md-3">
                                            <label><?php echo e(__('Field Label')); ?></label>
                                            <input name="kyc[0][field_label]" class="form-control form_control"
                                                type="text" value="" required>
                                        </div>


                                        <div class="col-md-3">
                                            <label><?php echo e(__('Field Name')); ?></label>
                                            <input name="kyc[0][field_name]" class="form-control form_control fieldName"
                                                type="text" value="" required>
                                        </div>
                                        <div class="col-md-2 mt-md-0 mt-2">
                                            <label><?php echo e(__('Field Type')); ?></label>
                                            <select name="kyc[0][type]" class="form-control selectric">
                                                <option value="text"> <?php echo e(__('Input Text')); ?> </option>
                                                <option value="textarea"> <?php echo e(__('Textarea')); ?> </option>
                                                <option value="file"> <?php echo e(__('File upload')); ?> </option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 mt-md-0 mt-2">
                                            <label><?php echo e(__('Field Validation')); ?></label>
                                            <select name="kyc[0][validation]" class="form-control selectric">
                                                <option value="required"> <?php echo e(__('Required')); ?> </option>
                                                <option value="nullable"> <?php echo e(__('Optional')); ?> </option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 text-right my-auto">

                                            <button class="btn btn-danger btn-lg remove w-100 mt-4" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            <button type="submit" class="btn btn-primary"> <i class="fas fa-sync-alt mr-2"></i>
                <?php echo e(__('Update KYC Settings')); ?></button>
        </div>
    </div>
</form>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/crypto-script/main/resources/views/backend/setting/kyc.blade.php ENDPATH**/ ?>