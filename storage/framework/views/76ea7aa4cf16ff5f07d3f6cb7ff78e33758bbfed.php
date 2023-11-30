<section class="overview-section sp_separator_bg sp_pt_120 sp_pb_120">
    <div class="overview-el">
        <img src="<?php echo e(Config::getFile('overview', $content->image_one)); ?>" alt="image">

        <div class="map-dot dot-1"></div>
        <div class="map-dot dot-2"></div>
        <div class="map-dot dot-3"></div>
        <div class="map-dot dot-4"></div>
        <div class="map-dot dot-5"></div>
        <div class="map-dot dot-6"></div>
        <div class="map-dot dot-7"></div>
        <div class="map-dot dot-8"></div>
        <div class="map-dot dot-9"></div>
        <div class="map-dot dot-10"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="sp_theme_top_title"><?= Config::colorText(optional($content)->title, optional($content)->color_text_for_title) ?></h2>
                <p class="mb-lg-5 mb-4 mt-3"><?php echo e(Config::trans($content->description)); ?></p>
                <div class="sp_overview_wrapper">
                    <div class="row gy-4">
                        <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-xl-3 col-6">
                                <div class="sp_overview_item">
                                    <div class="sp_overview_content">
                                        <div class="d-flex flex-wrap align-items-center">
                                            <h4 class="sp_overview_amount odometer me-1"
                                                data-odometer-final="<?php echo e(filter_var($item->content->counter, FILTER_SANITIZE_NUMBER_INT)); ?>">
                                            </h4>
                                            <h4 class="sp_overview_amount">
                                                <?php echo e(preg_replace('/[^a-zA-Z]+/', '', $item->content->counter)); ?></h4>
                                        </div>
                                        <p class="sp_overview_caption"><?php echo e(Config::trans($item->content->title)); ?></p> 
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- overview section end --><?php /**PATH E:\personal\crypto-script\main\resources\views/frontend/light/widgets/overview.blade.php ENDPATH**/ ?>