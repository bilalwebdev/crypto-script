

<?php $__env->startSection('element'); ?>
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-header justify-content-end">
                    <a href="<?php echo e(route('admin.plan.index')); ?>" class="btn btn-outline-primary btn-sm"><i
                            class="fa fa-arrow-left mr-2"></i><?php echo e(__('Back')); ?></a>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('admin.plan.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="row">

                            <div class="col-sm-6 mb-3">
                                <label class="form-label"><?php echo e(__('Plan Name')); ?> <code>*</code> </label>
                                <input type="text" class="form-control" name="plan_name">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label"><?php echo e(__('Plan Type')); ?> <code>*</code> </label>
                                <select name="plan_type" class="form-control" id="plan_type">
                                    <option value="unlimited"><?php echo e(__('Unlimited')); ?></option>
                                    <option value="limited"><?php echo e(__('Limited')); ?></option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3" id="append">
                                <label class="form-label"><?php echo e(__('Price Type')); ?> <code>*</code> </label>
                                <select name="price_type" class="form-control" id="price_type">
                                    <option value="free"><?php echo e(__('Free')); ?></option>
                                    <option value="paid"><?php echo e(__('Paid')); ?></option>
                                </select>
                            </div>


                            <div class="col-sm-12 mt-2 mb-4">
                                <div class="d-flex flex-wrap justify-content-between">
                                    <h4 class="mb-0">
                                        <?php echo e(__('Create Features')); ?>

                                    </h4>
                                    <button type="button" class="btn btn-primary btn-sm add">
                                        <i class="las la-plus-circle"></i>
                                        <?php echo e(__('Add New')); ?>

                                    </button>
                                </div>
                                <div class="row" id="feature">
                                    <div class="col-md-6 mt-3">
                                        <div class="input-group">
                                            <input type="text" name="feature[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <div class="input-group">
                                            <input type="text" name="feature[]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->

                        <div class="row">
                            <div class="col-xxl-5-items col-lg-4 col-sm-6 mb-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="whatsapp"
                                        class="custom-control-input" id="whatsapp">
                                    <label class="custom-control-label"
                                        for="whatsapp"><?php echo e(__('Whatsapp notification')); ?></label>
                                </div>
                            </div>

                            <div class="col-xxl-5-items col-lg-4 col-sm-6 mb-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="telegram"
                                        class="custom-control-input" id="telegram">
                                    <label class="custom-control-label"
                                        for="telegram"><?php echo e(__('Telegram notification')); ?></label>
                                </div>
                            </div>

                            <div class="col-xxl-5-items col-lg-4 col-sm-6 mb-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="email"
                                        class="custom-control-input" id="email">
                                    <label class="custom-control-label"
                                        for="email"><?php echo e(__('Email notification')); ?></label>
                                </div>
                            </div>

                            <div class="col-xxl-5-items col-lg-4 col-sm-6 mb-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="sms"
                                        class="custom-control-input" id="sms">
                                    <label class="custom-control-label"
                                        for="sms"><?php echo e(__('SMS notification')); ?></label>
                                </div>
                            </div>

                            <div class="col-xxl-5-items col-lg-4 col-sm-6 mb-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="dashboard"
                                        class="custom-control-input" id="dashboard">
                                    <label class="custom-control-label"
                                        for="dashboard"><?php echo e(__('Dashboard notification')); ?></label>
                                </div>
                            </div>
                        </div><!-- Row -->
                        <button type="submit" class="btn btn-primary mt-4"><?php echo e(__('Plan Create')); ?></button>
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

            let price = `
           
            <div class="col-md-6" id="price_append">
                    <label class="form-label"><?php echo e(__('Plan Price')); ?></label>
                    <input type="number" class="form-control" name="price">
                
            </div>
        `;

            let duration = `
            
            <div class="col-md-6" id="duration">
                    <label class="form-label"><?php echo e(__('Duration (In Days)')); ?></label>
                    <input type="number" class="form-control" name="duration">
                </div>
            
        
        `;

        let feature = `
            <div class="col-md-6 remove mt-3">
                <div class="input-group">
                    <input type="text" name="feature[]" class="form-control">
                    <button class="btn btn-outline-secondary border-left-0 delete"><i class="fa fa-times text-danger"></i></button>
                </div>
            </div>
        `;


            $('#plan_type').on('change', function() {
                let value = $(this).val();

                if (value === 'limited') {
                    $('#append').after(duration)

                    return
                }

                $('#duration').remove();

            })

            $('#price_type').on('change', function() {
                let value = $(this).val();

                if (value === 'paid') {
                    $('#append').after(price)

                    return
                }

                $('#price_append').remove()

            })


            $('.add').on('click', function(){
                $('#feature').append(feature)
            })

            $(document).on('click', '.delete', function(){
                $(this).closest('.remove').remove()
            })



        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/backend/plan/create.blade.php ENDPATH**/ ?>