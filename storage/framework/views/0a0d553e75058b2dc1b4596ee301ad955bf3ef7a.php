

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="sp_site_card">
                <div class="card-header d-flex justify-content-between">
                 
                   <h5 class="mb-0 fw-medium"><?php echo e(__('Payment Methods')); ?></h5>

                    <button id="new_p_method" class="btn sp_theme_btn btn-sm"><?php echo e(__('Create Payment Method ')); ?> </button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table sp_site_table">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $p_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td data-caption="<?php echo e(__('Name')); ?>"><?php echo e($p_method->name); ?></td>
                                       <td>
                                           <div class="custom-control custom-switch">
                                                <input type="checkbox" name="status" <?php echo e($p_method->status ? 'checked' : ''); ?>

                                                    class="custom-control-input status" id="status<?php echo e($p_method->id); ?>"
                                                    data-id="<?php echo e($p_method->id); ?>"
                                                    data-route="<?php echo e(route('user.user-payment-method.changestatus', $p_method)); ?>">
                                                <label class="custom-control-label"
                                                    for="status<?php echo e($p_method->id); ?>"></label>
                                           </div>
                                        </td>
                                       
                                        <td data-caption="<?php echo e(__('Action')); ?>">
                                                 <button data-route="<?php echo e(route('user.user-payment-method.update', $p_method->id)); ?>"
                                                data-p_method="<?php echo e($p_method); ?>"
                                                data-message="<?php echo e($p_method->where('id', $p_method->id)->first()); ?>"
                                                class="view-btn view-sp_btn_primary edit-modal"><i
                                                    class="fas fa-pen"></i></button>


                                            <a data-route="<?php echo e(route('user.user-payment-method.destroy', $p_method->id)); ?>"
                                                class="view-btn view-sp_btn_danger delete"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td data-caption="<?php echo e(__('Status')); ?>" class="text-center" colspan="100%">
                                            <?php echo e(__('No Data Found')); ?>

                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

 

    <div class="modal fade " id="add" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <form action="<?php echo e(route('user.user-payment-method.store')); ?>" enctype="multipart/form-data" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title "><?php echo e(__('Create Payment Method')); ?></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo e(__('Name')); ?></label>
                                    <input type="text" name="name" class="form-control" required=""
                                        placeholder="<?php echo e(__('Name here')); ?>" value="<?php echo e(old('name')); ?>">
                                </div>

                            </div>
                           <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo e(__('Wallet')); ?></label>
                                    <input type="text" name="wallet_address" class="form-control" required=""
                                        placeholder="<?php echo e(__('Wallet here')); ?>" value="<?php echo e(old('wallet_address')); ?>">
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm sp_btn_secondary"
                                data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                            <button type="submit" class="btn btn-sm sp_theme_btn"><?php echo e('Create Payment-Method'); ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade " id="edit_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <form  enctype="multipart/form-data" method="post">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
              <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title "><?php echo e(__('Update Payment Method')); ?></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo e(__('Name')); ?></label>
                                    <input type="text" name="name" class="form-control" required=""
                                        placeholder="<?php echo e(__('Name here')); ?>" value="<?php echo e(old('name')); ?>">
                                </div>

                            </div>
                           <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo e(__('Wallet')); ?></label>
                                    <input type="text" name="wallet_address" class="form-control" required=""
                                        placeholder="<?php echo e(__('Wallet here')); ?>" value="<?php echo e(old('wallet_address')); ?>">
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm sp_btn_secondary"
                                data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                            <button type="submit" class="btn btn-sm sp_theme_btn"><?php echo e('Create Payment-Method'); ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>




    <div class="modal fade" tabindex="-3" id="delete" role="dialog">
        <div class="modal-dialog" role="document">
            <form  method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>

                <div class="modal-content bg1">
                    <div class="modal-header ">
                        <h5 class="modal-title"><?php echo e(__('Delete Payment Method')); ?></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <p><?php echo e(__('Are you sure to delete this payment method?')); ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm sp_btn_secondary"
                            data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-sm sp_btn_danger"><?php echo e(__('Delete')); ?></button>
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

            $('#new_p_method').on('click', function() {

                const modal = $('#add');

                modal.modal('show');

            })

            $('.edit-modal').on('click', function(e) {

                e.preventDefault();

                const modal = $('#edit_modal');

                modal.find('form').attr('action', $(this).data('route'));

                modal.find('input[name=name]').val($(this).data('p_method').name)
                modal.find('input[name=wallet_address]').val($(this).data('p_method').wallet_address)
                modal.modal('show');
            })

            $('.delete').on('click', function(e) {

                e.preventDefault();

                const modal = $('#delete');

                modal.find('form').attr('action', $(this).data('route'));

                modal.modal('show');

            })

            $('.status').on('change', function() {

                let id = $(this).data('id');
                let route = $(this).data('route');

                $.ajax({

                    url: route,
                    method: "POST",
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(response) {
                        <?php echo $__env->make('backend.layout.ajax_alert', [
                            'message' => 'Successfully change status',
                            'message_error' => '',
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    }

                })




            })
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(Config::theme() . 'layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/frontend/light/user/payment-method/list.blade.php ENDPATH**/ ?>