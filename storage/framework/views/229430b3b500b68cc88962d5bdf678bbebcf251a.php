

<?php $__env->startSection('element'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-wrapper">
                <div class="card-header">
                    <div class="project-status-top">
                        <h4 class="project-status-heading"> <?php echo e(__('Subject')); ?>: <?php echo e($ticket->subject); ?></h4>
                        <div>
                            <p class="mb-0"><?php echo e(__('Ticket').' '.$ticket->support_id); ?> <?php echo e(__('Created by')); ?> <?php echo e($ticket->user->username); ?></p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.ticket.reply', $ticket->id)); ?>" enctype="multipart/form-data"
                        method="post">
                        <?php echo csrf_field(); ?>
                        <div class="row justify-content-md-between">
                            <div class="col-md-12">
                                <div class="form-group ticket-comment-box">
                                    <input type="hidden" name="ticket_id" value="<?php echo e($ticket->id); ?>">
                                    <label for="exampleFormControlTextarea1"><?php echo e(__('Message')); ?></label>
                                    <textarea class="form-control textarea" id="exampleFormControlTextarea1" rows="3" name="message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="image-upload"><?php echo e(__('Choose File')); ?></label>
                                    <input type="file" name="image" class="form-control" id="image-upload" />
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="form-group">
                                    <button type="submit" class="btn cms-submit ticket-reply btn btn-primary">
                                        <i class="fas fa-reply"> </i>
                                        <?php echo e(__('Reply')); ?>

                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="ticket-area">
        <?php $__currentLoopData = $ticket_reply; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="single-reply">
                <div class="d-flex flex-wrap align-items-center">
                    <h5 class="mb-0">
                        <?php echo e(__('Reply From - ')); ?>

                        <?php if(!$reply->admin_id): ?>
                            <?php echo e($reply->ticket->user->fullname); ?>

                        <?php endif; ?>
                        <?php if($reply->admin_id): ?>
                            <?php echo e($reply->admin->name ?? 'Admin'); ?>

                        <?php endif; ?>
                    </h5>
                    <p class="mb-0 ml-3">( <?php echo e($reply->created_at->diffforhumans()); ?> )</p>
                </div>
                <p class="mt-3"><?php echo e($reply->message); ?></p>
                <?php if($reply->file != null): ?>
                    <div class="gallery">
                        <a href="<?php echo e(Config::getFile('Ticket', $reply->file, true)); ?>" class="glightbox">
                            <img src="<?php echo e(Config::getFile('Ticket', $reply->file, true)); ?>" alt="image" />
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('external-style'); ?>
    <link rel="stylesheet" href="<?php echo e(Config::cssLib('backend', 'glightbox.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('external-script'); ?>
    <script src="<?php echo e(Config::jsLib('backend', 'glightbox.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .glightbox img {
            width: 100px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        $(function() {
            'use strict'

            const lightbox = GLightbox();

            $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "<?php echo e(__('Choose File')); ?>", // Default: Choose File
                label_selected: "<?php echo e(__('Update Image')); ?>", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\personal\crypto-script\resources\views/backend/ticket/show.blade.php ENDPATH**/ ?>