<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="sp_site_card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h4 class="mb-0"><?php echo e(__('Transfer Money')); ?></h4>
                    <p class="mb-0"><?php echo e(__('Current Balance')); ?> :
                    <span class="text-white"><?php echo e(Config::formatter(auth()->user()->balance)); ?></span></p>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="form-group mb-3">
                            <label for=""><?php echo e(__('Receiver Email')); ?></label>
                            <input type="text" name="email" id="refer-link" class="form-control"
                                placeholder="Transfer account email" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for=""><?php echo e(__('Amount')); ?></label>
                            <input type="text" name="amount" id="amount" class="form-control"
                                placeholder="Transfer Amount" data-type="<?php echo e(Config::config()->transfer_type); ?>"
                                data-charge="<?php echo e(Config::config()->transfer_charge); ?>" required>

                            <p id="totalAmount" class="sp_text_secondary mt-3"></p>
                        </div>

                        <p class="text-center mb-3"><?php echo e(__('Transfer Charge')); ?>

                            <?php echo e(number_format(Config::config()->transfer_charge,2) . ' ' . (Config::config()->transfer_type === 'fixed' ? Config::config()->currency : '%')); ?>

                        </p>

                        <ul class="list-group mb-4">
                            <li
                                class="list-group-item d-flex flex-wrap align-items-center justify-content-between px-0 border-0 py-0 bg-transparent">
                                <span><?php echo e(__('Min Transfer Amount')); ?></span>
                                <span><?php echo e(Config::formatter(Config::config()->transfer_min_amount)); ?></span>
                            </li>
                            <hr>
                            <li
                                class="list-group-item d-flex flex-wrap align-items-center justify-content-between px-0 border-0 py-0 bg-transparent">
                                <span><?php echo e(__('Max Transfer Amount')); ?></span>
                                <span><?php echo e(Config::formatter(Config::config()->transfer_max_amount)); ?></span>
                            </li>
                        </ul>

                        <button type="submit" class="btn sp_theme_btn w-100"
                            id="basic-addon2"><?php echo e(__('Transfer Money')); ?></button>
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
            let commission = 0;
            let total = 0;

            $('#amount').on('keyup', function() {

                if ($(this).val() == '') {
                    $('#totalAmount').text('')
                    return
                }

                if (/\D/g.test(this.value)) {

                    this.value = this.value.replace(/\D/g, '');

                    return
                }

                let charge = $(this).data('charge');

                if ($(this).data('type') === 'percent') {
                    commission = (parseFloat($(this).val()) * parseFloat(charge)) / 100;
                } else {
                    commission = parseFloat(charge)
                }

                total = parseFloat($(this).val()) + commission;


                $('#totalAmount').text('Total Amount with Charge - ' + total)



            })
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(Config::theme() . 'layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/crypto-script/main/resources/views/frontend/light/user/transfer_money.blade.php ENDPATH**/ ?>