

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="sp_site_card">
                <div class="card-header d-flex justify-content-between">
                    <h4><?php echo e($ticket->support_id); ?> - <?php echo e($ticket->subject); ?> </h4>

                    <a href="<?php echo e(route('user.ticket.index')); ?>" class="color-change"><i class="fas fa-arrow-left"></i>
                        <?php echo e(__('Back to Ticket List')); ?></a>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('user.ticket.reply', $ticket->id)); ?>" enctype="multipart/form-data" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="row justify-content-md-between">
                            <div class="col-md-12">
                                <div class="form-group ticket-comment-box">
                                    <input type="hidden" name="ticket_id" value="<?php echo e($ticket->id); ?>">
                                    <label for="exampleFormControlTextarea1"><?php echo e(__('Message')); ?></label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 form-group mt-3">
                                <div id="image-preview" class="image-preview">
                                    <label for="image-upload" id="image-label"><?php echo e(__('Choose File')); ?></label>
                                    <input type="file" name="file" id="image-upload" class="form-control" />
                                </div>
                            </div>

                            <div class="col-lg-12 mt-3 text-end">
                                <button type="submit" class="btn sp_theme_btn ticket-reply"><i class="fas fa-reply me-2"></i>
                                    <?php echo e(__('Reply')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="ticket-reply-area">
                        <?php $__empty_1 = true; $__currentLoopData = $ticket_reply; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="single-reply <?php echo e($ticket->admin_id != null ? 'admin-reply' : ''); ?> mt-5">
                                <span class="text-small sp_text_secondary mb-2"><?php echo e('Reply In'); ?>

                                    <?php echo e($ticket->created_at->format('Y-m-d H:i:s')); ?></span>
                                <p>
                                    <?php echo e($ticket->message); ?>

                                </p>
                                <?php if($ticket->file): ?>
                                    <p class="mb-0 mt-2">
                                        <a class="color-change" href="<?php echo e(route('user.ticket.download', $ticket->id)); ?>"> <i
                                                class="fas fa-cloud-download-alt"></i> <?php echo e(__('View Attachement')); ?></a>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <hr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(Config::theme() . 'layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/frontend/light/user/ticket/show.blade.php ENDPATH**/ ?>