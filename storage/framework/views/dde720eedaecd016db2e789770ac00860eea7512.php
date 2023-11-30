<?php
    $invest = \App\Models\Referral::where('type', 'invest')->first();
?>
<section class="sp_pt_120 sp_pb_120">
    <div class="container">
        <div class="row gy-4">
            <div class="col-xl-5 col-lg-5">
                <img src="<?php echo e(Config::getFile('referral', $content->image_one)); ?>" alt="image">
            </div>
            <div class="col-xl-6 col-lg-7 ps-xl-5">
                <h2 class="sp_theme_top_title"><?= Config::colorText(optional($content)->title, optional($content)->color_text_for_title) ?> </h2>

                <p><?php echo e(Config::trans($content->description)); ?></p>

                <div class="row gy-4 mt-2">
                    <?php for($i = 0; $i < count($invest->level ?? []); $i++): ?>
                    <div class="col-lg-6 col-6">
                        <div class="sp_referral_item">
                            <h4 class="sp_referral_item_title"><?php echo e(__('Level '. ($i + 1))); ?></h3>
                            <p><?php echo e(__('You Will Get Referral Bonus'. $invest->commission[$i] . '%')); ?></p>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</section><?php /**PATH E:\personal\crypto-script\main\resources\views/frontend/light/widgets/referral.blade.php ENDPATH**/ ?>