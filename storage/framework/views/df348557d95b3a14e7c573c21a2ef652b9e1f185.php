 

<?php $__env->startSection('element'); ?>
    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label><?php echo e(__('Gateway Image')); ?></label>
                                <div id="image-preview" class="image-preview"
                                    style="background-image:url(<?php echo e(Config::getFile('gateways', $gateway->image, true)); ?>);">
                                    <label for="image-upload" id="image-label"><?php echo e(__('Choose File')); ?></label>
                                    <input type="file" name="image" id="image-upload" />
                                </div>


                                <label class="mt-3 qr"><?php echo e(__('Qr Code Image')); ?></label>

                                <div id="image-preview-1" class="image-preview qr"
                                    style="background-image:url(<?php echo e(Config::getFile('gateways', $gateway->parameter->qr_code, true)); ?>);">
                                    <label for="image-upload-1" id="image-label-1"><?php echo e(__('Choose File')); ?></label>
                                    <input type="file" name="qr_code" id="image-upload-1" />
                                </div>
                            </div>

                            <div class="col-md-9">
                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for=""><?php echo e(__('Gateway Name')); ?></label>
                                        <input type="text" name="name" class="form-control"
                                            value="<?php echo e($gateway->parameter->name); ?>">
                                    </div>

                                    <div class="mb-4 col-md-6" id="append">
                                        <label for=""><?php echo e(__('Gateway Type')); ?></label>
                                        <select name="gateway_type" id="type" class="form-control">
                                            <option value="bank"
                                                <?php echo e($gateway->parameter->gateway_type == 'bank' ? 'selected' : ''); ?>>
                                                <?php echo e(__('Bank')); ?></option>
                                            <option value="crypto"
                                                <?php echo e($gateway->parameter->gateway_type == 'crypto' ? 'selected' : ''); ?>>
                                                <?php echo e(__('Crypto')); ?></option>
                                        </select>
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for=""><?php echo e(__('Gateway Currency')); ?></label>
                                        <input type="text" name="gateway_currency" class="form-control site-currency"
                                            value="<?php echo e($gateway->parameter->gateway_currency ?? ''); ?>">
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label><?php echo e(__('Conversion Rate')); ?></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <?php echo e('1 ' . Config::config()->currency . ' = '); ?>

                                                </div>
                                            </div>
                                            <input type="text" class="form-control currency" name="rate"
                                                value="<?php echo e(Config::formatter($gateway->rate) ?? 0); ?>">

                                            <div class="input-group-append">
                                                <div class="input-group-text append_currency">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label><?php echo e(__('Charge')); ?></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <?php echo e(Config::config()->currency); ?>

                                                </div>
                                            </div>
                                            <input type="text" class="form-control currency" name="charge"
                                                value="<?php echo e(Config::formatOnlyNumber($gateway->charge) ?? 0); ?>">
                                        </div>
                                    </div>

                                    <div class="mb-4 col-md-12">
                                        <label for=""><?php echo e(__('Payment Instruction')); ?></label>
                                        <textarea name="payment_instruction" cols="30" rows="10" class="form-control summernote"><?= clean($gateway->parameter->payment_instruction) ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card border">
                                    <div class="card-header">
                                        <h4><?php echo e(__('User Proof Requirements')); ?></h4>
                                        <button type="button" class="btn btn-primary ml-auto payment">
                                            <i class="fa fa-plus text-white"></i>
                                            <?php echo e(__('Add Payment Requirements')); ?>

                                        </button>
                                    </div>

                                    <div class="card-body">
                                        <div class="row payment-instruction">
                                            <div class="col-md-12 user-data">
                                                <div class="row">
                                                    <?php if($gateway->parameter->user_proof_param != null): ?>
                                                        <?php $__currentLoopData = $gateway->parameter->user_proof_param; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        
                                                            <div class="col-md-12 user-data">
                                                                <div class="form-group">
                                                                    <div class="input-group mb-md-0 mb-4">
                                                                        <div class="col-md-4">
                                                                            <label><?php echo e(__('Field Name')); ?></label>
                                                                            <input
                                                                                name="user_proof_param[<?php echo e($key); ?>][field_name]"
                                                                                class="form-control rounded-5 form_control"
                                                                                type="text"
                                                                                value="<?php echo e($param->field_name); ?>"
                                                                                required>
                                                                        </div>
                                                                        <div class="col-md-3 mt-md-0 mt-2">
                                                                            <label><?php echo e(__('Field Type')); ?></label>
                                                                            <select
                                                                                name="user_proof_param[<?php echo e($key); ?>][type]"
                                                                                class="form-control rounded-5 selectric">
                                                                                <option value="text"
                                                                                    <?php echo e($param->type == 'text' ? 'selected' : ''); ?>>
                                                                                    <?php echo e(__('Input Text')); ?>

                                                                                </option>
                                                                                <option value="textarea"
                                                                                    <?php echo e($param->type == 'textarea' ? 'selected' : ''); ?>>
                                                                                    <?php echo e(__('Textarea')); ?>

                                                                                </option>
                                                                                <option value="file"
                                                                                    <?php echo e($param->type == 'file' ? 'selected' : ''); ?>>
                                                                                    <?php echo e(__('File upload')); ?>

                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-3 mt-md-0 mt-2">
                                                                            <label><?php echo e(__('Field Validation')); ?></label>
                                                                            <select
                                                                                name="user_proof_param[<?php echo e($key); ?>][validation]"
                                                                                class="form-control rounded-5 selectric">
                                                                                <option value="required"
                                                                                    <?php echo e($param->validation== 'required' ? 'selected' : ''); ?>>
                                                                                    <?php echo e(__('Required')); ?>

                                                                                </option>
                                                                                <option value="nullable"
                                                                                    <?php echo e($param->validation== 'nullable' ? 'selected' : ''); ?>>
                                                                                    <?php echo e(__('Optional')); ?>

                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-2 text-right my-auto ">

                                                                            <button
                                                                                class="btn btn-danger btn-lg remove w-100 mt-4"
                                                                                type="button">
                                                                                <i class="fa fa-times"></i>
                                                                            </button>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Update Bank Information')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        $(function() {
            'use strict'

            let crypto = `
                <div class="mb-4 col-md-6 delete">
                    <label for=""><?php echo e(__('Bank Account Number')); ?></label>
                    <input type="text" name="account_number" class="form-control"
                        value="<?php echo e($gateway->parameter->account_number); ?>">
                </div>

                <div class="mb-4 col-md-6 delete">
                    <label for=""><?php echo e(__('Bank Routing Number')); ?></label>
                    <input type="text" name="routing_number" class="form-control"
                        value="<?php echo e($gateway->parameter->routing_number); ?>">
                </div>

                <div class="mb-4 col-md-6 delete">
                    <label for=""><?php echo e(__('Bank Branch Name')); ?></label>
                    <input type="text" name="branch_name" class="form-control"
                        value="<?php echo e($gateway->parameter->branch_name); ?>">
                </div>
            `;

            <?php if($gateway->parameter->gateway_type == 'bank'): ?>
                $('#append').after(crypto)
                $('.qr').addClass('d-none')
            <?php endif; ?>


            $('#type').on('change', function() {
                if ($(this).val() === 'bank') {
                    $('#append').after(crypto);
                    $('.qr').removeClass('d-block').addClass('d-none')
                    $('.qr').find('input[name=qr_code]').val('')
                } else {
                    $('.qr').removeClass('d-none').addClass('d-block')
                    $('.delete').remove();
                }
            })



            var i = <?php echo e(count($gateway->parameter->user_proof_param ?? [])); ?>;

            $('.payment').on('click', function() {

                var html = `
                <div class="col-md-12 user-data">
                    <div class="form-group">
                        <div class="input-group mb-md-0 mb-4">
                            <div class="col-md-4">
                                <label><?php echo e(__('Field Name')); ?></label>
                                <input name="user_proof_param[${i}][field_name]" class="form-control rounded-5 form_control" type="text" value="" required >
                            </div>
                            <div class="col-md-3 mt-md-0 mt-2">
                                <label><?php echo e(__('Field Type')); ?></label>
                                <select name="user_proof_param[${i}][type]" class="form-control rounded-5 selectric">
                                    <option value="text" > <?php echo e(__('Input Text')); ?> </option>
                                    <option value="textarea" > <?php echo e(__('Textarea')); ?> </option>
                                    <option value="file"> <?php echo e(__('File upload')); ?> </option>
                                </select>
                            </div>
                            <div class="col-md-3 mt-md-0 mt-2">
                                <label><?php echo e(__('Field Validation')); ?></label>
                                <select name="user_proof_param[${i}][validation]"
                                        class="form-control rounded-5 selectric">
                                    <option value="required"> <?php echo e(__('Required')); ?> </option>
                                    <option value="nullable">  <?php echo e(__('Optional')); ?> </option>
                                </select>
                            </div>
                            <div class="col-md-2 text-right my-auto">
                              
                                    <button class="btn btn-danger btn-lg remove w-100 mt-4" type="button">
                                        <i class="fa fa-times"></i>
                                    </button>
                                
                            </div>
                        </div>
                    </div>
                </div>`;
                $('.payment-instruction').append(html);

                i++;

            })

            $(document).on('click', '.remove', function() {
                $(this).closest('.user-data').remove();
            });

            $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "<?php echo e(__('Choose File')); ?>", // Default: Choose File
                label_selected: "<?php echo e(__('Update Image')); ?>", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });

            $.uploadPreview({
                input_field: "#image-upload-1", // Default: .image-upload
                preview_box: "#image-preview-1", // Default: .image-preview
                label_field: "#image-label-1", // Default: .image-label
                label_default: "<?php echo e(__('Choose File')); ?>", // Default: Choose File
                label_selected: "<?php echo e(__('Update Image')); ?>", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });

            $('.site-currency').on('keyup', function() {
                $('.append_currency').text($(this).val())
            })

            $('.append_currency').text($('.site-currency').val())
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\crypto-script\main\resources\views/backend/gateway/bank.blade.php ENDPATH**/ ?>