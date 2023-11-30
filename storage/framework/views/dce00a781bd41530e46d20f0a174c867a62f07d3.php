
<section class="work-section sp_pt_120 sp_pb_120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <div class="sp_theme_top  wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">
                    <div class="sp_theme_top_caption"><i class="fas fa-bolt"></i> <?php echo e(Config::trans($content->section_header)); ?></div>
                    <h2 class="sp_theme_top_title"><?= Config::colorText(optional($content)->title, optional($content)->color_text_for_title) ?></span>
                    </h2>
                </div>
            </div>
        </div>

        <div class="row gy-5 justify-content-center">
            <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xl-4 col-md-6">
                    <div class="sp_work_item">
                        <div class="sp_work_number">
                            <?php echo e($loop->iteration); ?>

                        </div>
                        <div class="sp_work_content">
                            <img src="<?php echo e(Config::getFile('how_works', $item->content->image_one)); ?>" alt="image">
                            <h4 class="title"><?php echo e(Config::trans($item->content->title)); ?></h4>
                            <p class="mt-2"><?php echo e(Config::trans($item->content->description)); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<!-- how work section end --><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/crypto-script/main/resources/views/frontend/light/widgets/how_works.blade.php ENDPATH**/ ?>