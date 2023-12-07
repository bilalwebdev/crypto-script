

<?php $__env->startSection('element'); ?>
    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">

                <div class="card-body text-center">
                    <ul class="list-group">

                        <?php if($info['kycinfo'] != null): ?>
                            <?php $__currentLoopData = $info['kycinfo']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $proof): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(is_array($proof)): ?>
                                    <li class="list-group-item d-flex justify-content-between" style="">

                                        <span style="white-space: nowrap">
                                            <?php if($proof['type'] == 'proof_id1'): ?>
                                                <?php echo e(__('Proof of ID 1')); ?>

                                            <?php elseif($proof['type'] == 'proof_id2'): ?>
                                                <?php echo e(__('Proof of ID 2')); ?>

                                            <?php elseif($proof['type'] == 'proof_address1'): ?>
                                                <?php echo e(__('Proof of Address 1')); ?>

                                            <?php else: ?>
                                                <?php echo e(__('Proof of Address 2')); ?>

                                            <?php endif; ?>
                                        </span>
                                        <span class="text-right"><img src="<?php echo e(asset('asset/images/kyc/' . $proof['file'])); ?>"
                                                alt="" class="w-50 "></span>

                                    </li>

                                    <?php continue; ?>
                                <?php endif; ?>

                                <li class="list-group-item d-flex justify-content-between">

                                    <span><?php echo e(__(str_replace('_', ' ', ucwords($key)))); ?></span>
                                    <span><?php echo e(__($proof)); ?></span>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                    </ul>


                    <?php if($info['is_kyc_verified'] == 2): ?>
                        <div class="col-md-12 mt-4 text-right">

                            <button class="btn btn-success approve"
                                data-url="<?php echo e(route('admin.user.kyc.status', ['approve', $info['id']])); ?>">
                                <i class="fa fa-check"></i>
                                <?php echo e(__('Approve')); ?>

                            </button>


                            <button class="btn btn-danger reject"
                                data-url="<?php echo e(route('admin.user.kyc.status', ['reject', $info['id']])); ?>">
                                <i class="fa fa-times"></i>
                                <?php echo e(__('Reject')); ?>

                            </button>
                        </div>
                    <?php endif; ?>






                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="approve" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('KYC Request Update')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo e(__('Are You Sure to Approve?')); ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Approve')); ?></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="reject" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('KYC Request Update')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo e(__('Are You Sure to Reject?')); ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Reject')); ?></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        $(function() {
            'use strict'

            $('.approve').on('click', function() {
                const modal = $('#approve')


                modal.find('form').attr('action', $(this).data('url'))


                modal.modal('show')
            })


            $('.reject').on('click', function() {
                const modal = $('#reject')


                modal.find('form').attr('action', $(this).data('url'))


                modal.modal('show')
            })
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/backend/users/kyc_details.blade.php ENDPATH**/ ?>