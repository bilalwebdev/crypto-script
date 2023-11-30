

<?php $__env->startSection('content'); ?>

    <div class="sp_site_card">
        <div class="card-header">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <h4><?php echo e(__($title)); ?></h4>
                <form class="search-form" method="GET" action="">
                    <input type="text" name="search" class="form-control form-control-sm card-bg" placeholder="Search ID or Title">
                    <button type="submit" class="text-center"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="row gy-4">
                <?php $__empty_1 = true; $__currentLoopData = $signals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-xxl-3 col-lg-4 col-md-6">
                    <div class="singnal-card <?php echo e($signal->direction === 'sell' ? 'border-warning' : 'border-success'); ?>">
                        <div class="singnal-card-top">
                            <div class="left">
                                <span
                                    class="status text-uppercase <?php echo e($signal->direction === 'sell' ? 'sell' : 'buy'); ?>"><?php echo e($signal->direction); ?></span>
                                <span class="fw-medium"><?php echo e($signal->pair->name); ?>

                                    <?php if($signal->direction === 'sell'): ?>
                                        <i class="fas fa-arrow-down sp_text_danger"></i>
                                    <?php else: ?>
                                        <i class="fas fa-arrow-up sp_text_success"></i>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="right">
                                <p class="text-uppercase"><?php echo e(__('ID')); ?>: <?php echo e($signal->id); ?></p>
                            </div>
                        </div>
                        <div class="singnal-card-thumb">
                            <img src="<?php echo e(Config::getFile('signal', $signal->image, true)); ?>" alt="">
                        </div>
                        <div class="singnal-card-body">
                            <h5 class="title"><a
                                    href="<?php echo e(route('user.signal.details', ['id' => $signal->id, 'slug' => Str::slug($signal->title)])); ?>"><?php echo e($signal->title); ?></a>
                            </h5>
                            <ul class="signal-info-list">
                                <li class="signal-single-list">
                                    <span class="caption"><i class="fas fa-id-badge"></i> <?php echo e(__('Stop Loss')); ?>:</span>
                                    <span class="value"><?php echo e($signal->sl); ?></span>
                                </li>
                                <li class="signal-single-list">
                                    <span class="caption"><i class="far fa-clock"></i> <?php echo e(__('Time Frame')); ?>:</span>
                                    <span class="value"><?php echo e($signal->time->name); ?></span>
                                </li>
                                <li class="signal-single-list">
                                    <span class="caption"><i class="fas fa-money-bill"></i> <?php echo e(__('Open')); ?>:</span>
                                    <span class="value"><?php echo e($signal->open_price); ?></span>
                                </li>
                                <li class="signal-single-list">
                                    <span class="caption"><i class="fas fa-hand-holding-usd"></i> <?php echo e(__('Take profit')); ?>:</span>
                                    <span class="value"><?php echo e($signal->tp); ?></span>
                                </li>
                            </ul>
                            <a href="<?php echo e(route('user.signal.details', ['id' => $signal->id, 'slug' => Str::slug($signal->title)])); ?>" class="view-signal-btn w-100 text-center mt-3"><?php echo e(__('View Details')); ?></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-md-12">
                        <div class="text-center py-5">
                            <i class="far fa-folder-open display-3"></i>
                            <p class="mt-4"><?php echo e(__('No Signals Found')); ?></p>
                        </div>
                    </div>
                <?php endif; ?>


                <?php if($signals->hasPages()): ?>
                    <div class="col-md-12">
                        <?php echo e($signals->links()); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(Config::theme() . 'layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/crypto-script/main/resources/views/frontend/light/user/signals.blade.php ENDPATH**/ ?>