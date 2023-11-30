<section class="blog-section sp_pt_120 sp_pb_120 sp_separator_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <div class="sp_theme_top  wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">
                    <div class="sp_theme_top_caption"><i class="fas fa-bolt"></i>
                        <?php echo e(Config::trans($content->section_header)); ?>

                    </div>
                    <h2 class="sp_theme_top_title">
                        <?= Config::colorText(optional($content)->title ?? '', optional($content)->color_text_for_title ?? '') ?>
                    </h2>
                </div>
            </div>
        </div>

        <?php
            $elements = $element;
            if (request()->routeIs('home')) {
                $elements = $element->take(3);
            }
        ?>

        <div class="row gy-4 justify-content-center">
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6">
                    <div class="sp_blog_item">
                        <div class="sp_blog_thumb">
                            <img src="<?php echo e(Config::getFile('blog', $blog->content->image_one)); ?>"
                                alt="blog thumb">
                        </div>
                        <div class="sp_blog_content">
                            <ul class="sp_blog_meta mb-2">
                                <li><i class="far fa-user-circle"></i> <?php echo e(__('by Admin')); ?></li>
                                <li><i class="far fa-clock"></i> <?php echo e($blog->created_at->format('d m, Y')); ?></li>
                            </ul>
                            <h4 class="sp_blog_title"><a
                                    href="<?php echo e(route('blog.details', [$blog->id, Str::slug($blog->content->blog_title)])); ?>"><?php echo e(Config::trans($blog->content->blog_title)); ?></a>
                            </h4>
                            <a href="<?php echo e(route('blog.details', [$blog->id, Str::slug($blog->content->blog_title)])); ?>"
                                class="sp_blog_btn">
                                <span><?php echo e(__('Read More')); ?></span>
                                <i class="las la-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</section>
<!-- blog section end -->
<?php /**PATH C:\xampp\htdocs\code_sig\Scripts\main\resources\views/frontend/light/widgets/blog.blade.php ENDPATH**/ ?>